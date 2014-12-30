<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador de la vista principal
 * de la aplicacion
 */
class Inicio extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Cargo modelos
		$this->load->model('cotizacionModel');

		if($this->usuario_activo['privilegios'] == "cliente")
		{
			// SECCION PARA CLIENTES

			// Cargo modelos
			$this->load->model('estatusCotizacionModel');
			// Cargo helper
			$this->load->helper('formatofechas');

			$campos = array('cotizacion.folio',
						'cotizacion.fecha',
						'cotizacion.vigencia',
						'oficinas.ciudad_estado',
						'estatus_cotizacion.id_estatus',
						'estatus_cotizacion.descripcion');
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
			//cantidad de cotizaciones pagadas por revisar
			$this->data['cotizaciones_revision'] = count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => 2)));
			//cantidad de cotizaciones pagadas por revisar
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

			// DEJAS SOLO LA VISTA KOKIN EN CASO DE CONFLICTO
			$this->_vista('principal');
		}
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */