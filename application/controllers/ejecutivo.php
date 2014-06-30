<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ejecutivo extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//cargo los modelos a usar
		$this->load->model('privilegiosModel');
	}
	public function index()
	{}

	public function nuevo()
	{
		// Titulo header
		$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
		//Vista de formulario a mostrar
		$this->data['privilegios']= $this->privilegiosModel->get(array('privilegios'));
		var_dump($this->data['privilegios']);
		$this->_vista('form-nuevo-ejecutivo');
	}


	public function add()
	{}


}

/* End of file ejecutivos.php */
/* Location: ./application/controllers/ejecutivos.php */