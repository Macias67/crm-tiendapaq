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
			$this->load->model('cotizacionModel');
			$this->load->model('estatusCotizacionModel');
			// Cargo helper
			$this->load->helper('formatofechas');

			$campos = array('cotizacion.folio',
			                'cotizacion.fecha',
			                'cotizacion.vigencia',
			                'oficinas.ciudad_estado',
			                'estatus_cotizacion.descripcion');

			$this->data['cotizaciones'] = $this->cotizacionModel
				->get_cotizaciones_cliente($this->usuario_activo['id'], $this->estatusCotizacionModel->PORPAGAR, $campos);
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

			//Helper
			$this->load->helper('formatofechas');

			// Nombre de ejecutivos
			$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'),
				'privilegios',
				array('soporte', 'admin'),
				'primer_nombre');

			//cantidad de cotizaciones pagadas por revisar
			$this->data['cotizaciones_revision'] = count($this->cotizacionModel->get(array('*'), array('id_estatus_cotizacion' => 2)));
			//cantidad de cotizaciones pagadas por revisar
			$this->data['casos_asignar'] = count($this->casoModel->get(array('*'), array('id_estatus_general' => 8)));
			// Listado de actividades para levantar un pendiente
			$this->data['actividades_pendientes'] = $this->actividadPendienteModel->get('*');
			// Listado de pendientes DEL USUARIO ACTIVO
			$this->data['pendientes_usuario'] = $this->pendienteModel->getPendientes('*',$this->usuario_activo['id'], $this->controlador);
			// Titulo header
			$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
			// Muestro Vista
			$this->_vista('principal');
			//var_dump($this->data);
		}
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */