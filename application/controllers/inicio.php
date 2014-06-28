<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('ejecutivoModel');
		$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
			array('id','primer_nombre', 'apellido_paterno'),
			'privilegios',
			array('soporte', 'admin'),
			'primer_nombre');
		// Titulo header
		$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
		// Muestro Vista
		$this->_vista($this->privilegios, $this->controlador,'principal');
	}

	public function add(){}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */