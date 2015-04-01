<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de eventos y funciones
 * para el mismo.
 *
 * @author Julio Trujillo
 **/
class Evento extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('eventoModel');
		$this->load->helper('formatofechas_helper');
		$this->load->model('ejecutivoModel');
		$this->load->model('sesionesModel');
		$this->load->helper('date');
	}

	// public function index()
	// {
	// $this->load->model('ejecutivoModel');
	// // Nombre de ejecutivos
	// $this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
	// 	array('id','primer_nombre', 'apellido_paterno'),
	// 	'privilegios',
	// 	array('soporte', 'admin'),
	// 	'primer_nombre');
	
	// $this->_vista('form-nuevo-evento');
	// }
	private function _crearFecha($fecha_editar)
	{
	// creo la fecha a inserta en la base de datos
		if ($fecha_editar[fecha]!=null) {
			$mostrar1= explode(" ", $fecha_editar[fecha]);
			switch ($mostrar1[1]) {
					case 'January':
						$mes="01";
						break;
					case 'February':
						$mes="02";
						break;
					case 'March':
						$mes="03";
						break;
					case 'April':
						$mes="04";
						break;
					case 'May':
						$mes="05";
						break;
					case 'June':
						$mes="06";
						break;
					case 'July':
						$mes="07";
						break;
					case 'August':
						$mes="08";
						break;
					case 'September':
						$mes="09";
						break;
					case 'October':
						$mes="10";
						break;
					case 'November':
						$mes="11";
						break;
					case 'December':
						$mes="12";
						break;
					
					default:
						# code...
						break;
			}
		$fecha1=$mostrar1[2]."-".$mes."-".$mostrar1[0]." ".$mostrar1[4].":00";
		return $fecha1;
		}else{
			# code...
		}
		
	}

	public function index()
		{
			if($this->usuario_activo['privilegios'] == "cliente")
			{
				// SECCION PARA CLIENTES

				// Cargo modelos
				$this->load->model('estatusCotizacionModel');
				// Cargo helper
				$this->load->helper('formatofechas');

				//codigo para cambiar cotizaciones a vencidas
				$campos = array('cotizacion.folio',
							'cotizacion.fecha',
							'cotizacion.vigencia',
							'cotizacion.total_comentarios',
							'cotizacion.visto',
							'oficinas.ciudad_estado',
							'estatus_cotizacion.id_estatus',
							'estatus_cotizacion.descripcion');
				$where = array('id_cliente' => $this->usuario_activo['id'],'cotizacion.id_estatus_cotizacion' => $this->estatusCotizacionModel->PORPAGAR);

				//seccion de codigo para revisar cotizaciones vencidas
				$cotizaciones = $this->cotizacionModel->get_cotizaciones_cliente($this->usuario_activo['id'], $campos, $where);
				$fecha_actual = date('Y-m-d H:i:s');
				foreach ($cotizaciones as $cotizacion) {
					if($fecha_actual > $cotizacion->vigencia){
						$this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->VENCIDO), array('folio' => $cotizacion->folio));
					}
				}

				//recargo los datos y mando llamar la vista
				$this->data['cotizaciones'] = $this->cotizacionModel->get_cotizaciones_cliente($this->usuario_activo['id'], $campos);
				$this->_vista('principal');
			} else
			{
				// SECCION PARA GENTE DE TIENDAPAQ

				// Cargo modelos
				$this->load->model('ejecutivoModel');
				$this->load->model('actividadPendienteModel');
				$this->load->model('pendienteModel');
				$this->load->model('estatusGeneralModel');
				$this->load->model('casoModel');
				$this->load->model('clienteModel');

				//Helper
				$this->load->helper('formatofechas');

				// Nombre de ejecutivos
				$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
					array('id','primer_nombre', 'apellido_paterno'),
					'privilegios',
					array('soporte', 'admin'),
					'primer_nombre');
				//variables para registro de un cliente prospecto
				$this->data['user_pass_prospecto'] =  $this->clienteModel->password();
				//cantidad de cotizaciones con nuevos comentarios
				$this->data['cotizaciones_comentarios'] = count($this->cotizacionModel->get(array('*'), array('visto' => 0)));
				//cantidad de cotizaciones pagadas por revisar
				$this->data['cotizaciones_revision'] = count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => 2)));
				//cantidad de casos por asignar
				$this->data['casos_asignar'] = count($this->casoModel->get(array('*'), array('id_estatus_general' => 8)));
				//variable para saber si el ejecutivo logeado puede asignar casos
				$asignador_casos = $this->ejecutivoModel->get(array('asignador_casos'), array('id' => $this->usuario_activo['id']), null, 'ASC', 1);
				$this->data['asignador_casos'] = $asignador_casos->asignador_casos;
				// Listado de actividades para levantar un pendiente
				$this->data['actividades_pendientes'] = $this->actividadPendienteModel->get('*');
				// Listado de pendientes DEL USUARIO ACTIVO
				$this->data['pendientes_usuario'] = $this->pendienteModel->getPendientes(array(	'id_pendiente',
																'actividades_pendiente.actividad',
																'clientes.razon_social',
																'fecha_origen',
																'id_estatus_general'),
																$this->usuario_activo['id'],
																$this->controlador);
				//los pendientes de los demas usuarios
				$this->data['pendientes_generales'] = $this->pendienteModel->get_pendientes_generales(array(	'id_pendiente',
														                                     	'ejecutivos.primer_nombre',
														                                     	'ejecutivos.apellido_paterno',
														                                     	'clientes.razon_social',
														                                     	'id_estatus_general'),
																								$this->usuario_activo['id']);
				// Titulo header
				$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;

				// Cargo los casos para tabla casos
				$this->data['casos'] = $this->casoModel
							->get_casos_ejecutivo($this->usuario_activo['id'],
								array(	'caso.id as id_caso',
					                                    	'caso.id_estatus_general',
					                                                'clientes.razon_social',
					                                                'estatus_general.descripcion',
					                                                'id_cliente',
					                                                'folio_cotizacion',
					                                                'fecha_inicio',
					                                                'fecha_final'));

				// Cargo todos los casos para tabla casos generales
				$this->data['casos_generales'] = $this->casoModel->
					get_casos_generales($this->usuario_activo['id'],
										 array( 'caso.id as id_caso',
										 		'ejecutivos.primer_nombre',
												'ejecutivos.apellido_paterno',
												'caso.id_estatus_general',
												'clientes.razon_social',
					                            'estatus_general.descripcion',
					                            'folio_cotizacion'));

				//DEJAS SOLO LA VISTA KOKIN EN CASO DE CONFLICTO
				$this->_vista('form-nuevo-evento');
			}
		}

	/**
	 * Muestra la vista para los
	 * eventos
	 * @author Julio Trujillo
	 **/
	public function revisar()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_creacion'
			));
		$this->_vista('administrar');
	}

	/**
	 * Función para mostrar ventana modal
	 * con informacion detallada
	 * sobre un evento.
	 * @author  Julio Trujillo
	 **/
	public function detalles($id_evento)
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['evento'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_evento',
				'eventos.fecha_creacion',
				'eventos.descripcion',
				'eventos.temario',
				'eventos.sesiones',
				'eventos.hora',
				'eventos.duracion',
				'eventos.costo',
			));

		$this->_vista_completa('evento/modal-detalles-evento');
	}

	/**
	 * funcion para crear
	 * y gestionar
	 * eventos
	 * @author  David
	 **/
	public function gestionar($accion=null, $id_evento=null)
	{
		switch ($accion)
		{
			case 'nuevo':
				$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'),
				'privilegios',
				array('soporte', 'admin'),
				'primer_nombre');
				$this->_vista('form-nuevo-evento');
			break;

			case 'editar':
				$evento 	= $this->eventoModel->get_where(array('id_evento' => $id_evento));
				if (!empty($evento))
				{
					// Datos a enviar a la vista
					$this->data['evento']				= $evento;
					$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
					array('id','primer_nombre', 'apellido_paterno'),
					'privilegios',
					array('soporte', 'admin'),
					'primer_nombre');
					$this->_vista('editar-evento');
				} else
				{
					show_error('No existe este evento.', 404);
				}
			break;

			case 'eliminar':
				$id = $this->input->post('id');
				/**
				 * Si exsite una cotizacion o pendiente ligada a este ID de cliente entonces
				 * NO procede a eliminarse, solo a desactivar su identidad
				 * en la aplicacion y en las busquedas
				 */
				$this->load->model('cotizacionModel');
				$this->load->model('pendienteModel');
				// Si NO hay cotizacion
				if (!$this->pendienteModel->exist(array('id_cliente' => $id)) || !$this->cotizacionModel->exist(array('id_cliente' => $id))) {
					if ($this->clienteModel->delete(array('id' => $id))) {
						$response = array('exito' => TRUE, 'mensaje' => 'El cliente se ha eliminado de la base de datos.');
					}
				} else {
					$response = array('exito' => FALSE, 'mensaje' => 'El cliente tiene pendientes o cotizaciones ligadas, por lo tanto solo será desactivado.');
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
				break;

			case 'activar':
				$id 			= $this->input->post('id');
				$selected 	= $this->input->post('selected');
				$activo 	= ($selected == 'true') ? 1 : 0;
				$mensaje	= ($selected == 'true') ? '<h4>El cliente podrá acceder al sistema y aparecerá en los buscadores.</h4>' : '<h4>El cliente ya <b>NO</b> podrá acceder al sistema y desaparecerá de los buscadores del sistema.</h4>';
				if ($this->clienteModel->update(array('activo' => $activo), array('id' => $id))) {
					$response = array('exito' => TRUE, 'mensaje' => $mensaje);
				}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
				break;

			default:
				$this->data['clientes'] = $this->clienteModel->get(array('*'));
				$this->_vista('gestionar');
			break;
		}
	}

	public function nuevo ()
	{
		//reglas de evento
		$this->form_validation->set_rules('ejecutivos', 'Ejecutivo', 'strtolower|xss_clean');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required|max_length[65536]|xss_clean');
		$this->form_validation->set_rules('temario', 'Temario', 'required|max_length[65536]|xss_clean');
		$this->form_validation->set_rules('costo', 'Costo', 'max_length[6]|xss_clean');
		$this->form_validation->set_rules('sesion_1', 'Sesion1', 'xss_clean');
		$this->form_validation->set_rules('sesion_2', 'Sesion2', 'xss_clean');
		$this->form_validation->set_rules('sesion_3', 'Sesion3', 'xss_clean');
		$this->form_validation->set_rules('sesion_4', 'Sesion4', 'xss_clean');

		if($this->form_validation->run() === FALSE)
		{
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
			//si las reglas son correctas preparo los datos para insertar
			$evento = array(
				'id_evento'		=>$this->input->post(''),
				'id_ejecutivo'	=> $this->input->post('ejecutivo'),
				'titulo'		=> $this->input->post('titulo'),
				'descripcion'	=> $this->input->post('descripcion'),
				'temario'		=> $this->input->post('temario'),
				'costo'			=> $this->input->post('costo')
			);
			//Inserto en la BD el nuevo evento
			if($this->eventoModel->insert($evento))
			{
				$respuesta = array('exito' => TRUE, 'msg' => '<h4>Nuevo evento añadido con éxito.</h4>.');
			} else
			{
				$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, error en la insercion de evento, revisa la consola o la base de datos para detalles');
			}
		// 	obtengo el ultimo id_evento insertado
		// 	comprueba cual es el id_evento mas grande insertado
		// 	la variable id guarda el id_evento.
			$rs = mysql_query("SELECT MAX(id_evento) AS id FROM eventos");
			if ($row = mysql_fetch_row($rs)) {
			$id = trim($row[0]);
			}

			$sesiones1=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'		=>$this->input->post('sesion_1'),
				'duracion'	=>$this->input->post('duracion_1')
				);
			$sesiones2=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'		=>$this->input->post('sesion_2'),
				'duracion'	=>$this->input->post('duracion_2')
				);
			$sesiones3=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'		=>$this->input->post('sesion_3'),
				'duracion'	=>$this->input->post('duracion_3')
				);
			$sesiones4=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'		=>$this->input->post('sesion_4'),
				'duracion'	=>$this->input->post('duracion_4')
				);

			if ($sesiones1[fecha]!=null) 
				{
				$sesiones1[fecha]=$this->_crearFecha($sesiones1);
				$this->sesionesModel->insert($sesiones1);
				}
			if ($sesiones2[fecha]!=null)
				{
				$sesiones2[fecha]=$this->_crearFecha($sesiones2);
				$this->sesionesModel->insert($sesiones2);
				}
			if ($sesiones3[fecha]!=null) 
				{
				$sesiones3[fecha]=$this->_crearFecha($sesiones3);
				$this->sesionesModel->insert($sesiones3);
				}
			if ($sesiones4[fecha]!=null) 
				{
				$sesiones4[fecha]=$this->_crearFecha($sesiones4);
				$this->sesionesModel->insert($sesiones4);
				}

		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
		}

	}
}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */