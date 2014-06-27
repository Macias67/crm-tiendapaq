<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Titulo header
		$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
		// Muestro Vista
		$this->_vista($this->privilegios, $this->controlador,'principal');
	}

	public function add(){}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */