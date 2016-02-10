<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador de la vista principal
 * de la aplicacion
 */
class Inicio extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cotizacionModel');
	}

	public function index()
	{
		if ($this->usuario_activo['privilegios'] == 'cliente') {
			redirect('usuario');
		} else {
			// Cargo modelos
			$this->load->model('ejecutivomodel');
			$this->load->model('actividadPendienteModel');
			$this->load->model('pendienteModel');
			$this->load->model('estatusGeneralModel');
			$this->load->model('estatuscotizacionmodel');
			$this->load->model('casoModel');
			$this->load->model('clienteModel');
			$this->load->model('ticketmodel');

			//Helper
			$this->load->helper('formatofechas');

			// Nombre de ejecutivos
			$this->data['ejecutivos'] = $this->ejecutivomodel->where_in(array('id','primer_nombre', 'apellido_paterno'),'privilegios',array('soporte', 'admin'),'primer_nombre');
			//variables para registro de un cliente prospecto
			$this->data['user_pass_prospecto'] =  $this->clienteModel->password();
			//cantidad de cotizaciones con nuevos comentarios
			$this->data['cotizaciones_comentarios'] = count($this->cotizacionModel->get(array('*'), array('visto' => 0)));
			//cantidad de cotizaciones pagadas por revisar
			$cotizaciones_revision 		= count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => $this->estatuscotizacionmodel->REVISION)));
			$cotizaciones_cxc 			= count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => $this->estatuscotizacionmodel->CXC)));
			$this->data['cotizaciones_revision'] = ($cotizaciones_revision + $cotizaciones_cxc);
			//cantidad de casos por asignar
			$this->data['casos_asignar'] = count($this->casoModel->get(array('*'), array('id_estatus_general' => 8)));
			//cantidad de tickets  por asignar
			$this->data['tickets_asignar'] = count($this->ticketmodel->get(array('*'), array('id_estatus' => $this->estatusgeneralmodel->PENDIENTE)));
			//variable para saber si el ejecutivo logeado puede asignar casos
			$asignador_casos = $this->ejecutivomodel->get(array('asignador_casos'), array('id' => $this->usuario_activo['id']), null, 'ASC', 1);
			$this->data['asignador_casos'] = $asignador_casos->asignador_casos;
			// Listado de actividades para levantar un pendiente
			$this->data['actividades_pendientes'] = $this->actividadPendienteModel->get('*');
			// Listado de pendientes DEL USUARIO ACTIVO
			$this->data['pendientes_usuario'] = $this->pendienteModel->getPendientes(array('id_pendiente','actividades_pendiente.actividad','clientes.razon_social','fecha_origen','id_estatus_general'), $this->usuario_activo['id'], $this->controlador);
			//los pendientes de los demas usuarios
			$this->data['pendientes_generales'] = $this->pendienteModel->get_pendientes_generales(array('id_pendiente','ejecutivos.primer_nombre','ejecutivos.apellido_paterno','clientes.razon_social','id_estatus_general'), $this->usuario_activo['id']);
			// Titulo header
			$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;

			// Cargo los casos para tabla casos
			$this->data['casos'] = $this->casoModel->get_casos_generales(
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
		$this->load->model('estatuscotizacionmodel');
		$this->load->model('ticketmodel');

		$comentarios_cotizacion 	= count($this->cotizacionModel->get(array('*'), array('visto' => 0)));
		$cotizaciones_revision 		= count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => $this->estatuscotizacionmodel->REVISION)));
		$cotizaciones_cxc 			= count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => $this->estatuscotizacionmodel->CXC)));
		$casos_asignar 			= count($this->casoModel->get(array('*'), array('id_estatus_general' => 8)));
		$lider_casos_pediente 		= count($this->casoModel->get(array('*'), array('id_estatus_general' => 3, 'id_lider' => $this->usuario_activo['id'])));
		$lider_casos_pediente 		= count($this->casoModel->get(array('*'), array('id_estatus_general' => 7, 'id_lider' => $this->usuario_activo['id'])));
		$tareas_pendiente			= count($this->tareaModel->get(array('*'), array('id_ejecutivo' => $this->usuario_activo['id'],'id_estatus'  => $this->estatusGeneralModel->PENDIENTE)));
		$tickets_pendiente = count($this->ticketmodel->get(array('*'), array('id_estatus' => $this->estatusgeneralmodel->PENDIENTE)));
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
			             'comentarios_cotizacion' 	=> $comentarios_cotizacion,
			             'cotizaciones_revision' 		=> ($cotizaciones_revision + $cotizaciones_cxc),
			             'casos_asignar'				=> $casos_asignar,
			             'lider_casos_pediente'		=> $lider_casos_pediente,
			             'tareas_pendiente'			=> $tareas_pendiente,
			             'tickets_pendiente' => $tickets_pendiente
			             )));
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */