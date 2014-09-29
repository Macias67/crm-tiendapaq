<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->usuario_activo['privilegios']=="cliente"){
			$this->_vista('principal');
			//var_dump($this->data);
		}else{
			//Helper
			$this->load->helper('formatofechas');

			// Nombre de ejecutivos
			$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'),
				'privilegios',
				array('soporte', 'admin'),
				'primer_nombre');
			// Listado de actividades para levantar un pendiente
			$this->data['actividades_pendientes'] = $this->actividadPendienteModel->get('*');
			// Listado de pendientes DEL USUARIO ACTIVO
			$this->data['pendientes_usuario'] = $this->pendienteModel->getPendientes($this->usuario_activo['id']);
			// Titulo header
			$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
			// Muestro Vista
			$this->_vista('principal');
			//var_dump($this->data);
		}
	}

	public function add(){}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */