<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends AbstractAccess {

	public function index()
	{
		//var_dump($this->data);
		$this->_vista($this->privilegios, $this->controlador,'principal');
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */