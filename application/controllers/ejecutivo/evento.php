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
		$this->load->model('eventoModel');
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
	public function gestionar($accion=null, $id_cliente=null)
	{
		switch ($accion)
		{
			case 'nuevo':
				$this->load->model('ejecutivoModel');
				$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'),
				'privilegios',
				array('soporte', 'admin'),
				'primer_nombre');
				$this->_vista('form-nuevo-evento');
			break;

			case 'editar':
				$cliente = $this->clienteModel->get_where(array('id' => $id_cliente));
				if (!empty($cliente))
				{
					// Datos a enviar a la vista
					$this->data['cliente']						= $cliente;
					$this->data['contactos']					= $this->contactosModel->get(array('*'), array('id_cliente' => $id_cliente));
					$this->data['sistemas_contpaqi']			= $this->sistemasContpaqiModel->get(array('*'));
					$this->data['sistemas_contpaqi_cliente']	= $this->sistemasClienteModel->get(array('*'), array('id_cliente' => $id_cliente));
					$this->data['equipos']						= $this->equiposComputoModel->get(array('*'), array('id_cliente' => $id_cliente));
					$this->data['sistemas_operativos']			= $this->sistemasOperativosModel->get(array('*'), $where = null, $orderBy = 'id_so', $orderForm = 'ASC');
					//Vista de formulario a mostrar
					$this->_vista('editar-cliente');
				} else
				{
					show_error('No existe este cliente.', 404);
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
}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */