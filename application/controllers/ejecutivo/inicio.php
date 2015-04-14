<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador de la vista principal
 * de la aplicacion
 */
class Inicio extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		// Cargo modelos
		$this->load->model('cotizacionModel');
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
			$this->data['pendientes_generales'] = $this->pendienteModel->get_pendientes_generales(array('id_pendiente',
																											                                     	'ejecutivos.primer_nombre',
																											                                     	'ejecutivos.apellido_paterno',
																											                                     	'clientes.razon_social',
																											                                     	'id_estatus_general'),
																																														$this->usuario_activo['id']);
			// Titulo header
			$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;

			// Cargo los casos para tabla casos
			$this->data['casos'] = $this->casoModel
						->get_casos_generales(
							array(
								'caso.id as id_caso',
								'caso.id_estatus_general',
								'clientes.razon_social',
								'estatus_general.descripcion',
								'id_cliente',
								'folio_cotizacion',
								'fecha_inicio',
								'ejecutivos.primer_nombre',
								'ejecutivos.apellido_paterno'));
			$this->_vista('principal');
		}
	}

	/**
	 * Metodo para enviar datos de notificaciones
	 * en los botones de acceso rapido
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function actualiza()
	{
		$this->load->model('casoModel');
		$this->load->model('tareaModel');
		$this->load->model('estatusGeneralModel');

		$comentarios_cotizacion 	= count($this->cotizacionModel->get(array('*'), array('visto' => 0)));
		$cotizaciones_revision 		= count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => 2)));
		$casos_asignar 			= count($this->casoModel->get(array('*'), array('id_estatus_general' => 8)));
		$tareas_pendiente			=  count($this->tareaModel->get(array('*'),
		                             							array(
													'id_ejecutivo' 	=> $this->usuario_activo['id'],
													'id_estatus' 	=> $this->estatusGeneralModel->PENDIENTE
												)));
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
			             'comentarios_cotizacion' 	=> $comentarios_cotizacion,
			             'cotizaciones_revision' 		=> $cotizaciones_revision,
			             'casos_asignar'				=> $casos_asignar,
			             'tareas_pendiente'			=> $tareas_pendiente
			             )));
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */