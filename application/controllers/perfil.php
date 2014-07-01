<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends AbstractAccess {

public function __construct()
{
	parent::__construct();
	$this->load->model('departamentoModel');
	
	$this->data['tabladepartamentos']= $this->departamentoModel->get(array('area'));
}
	public function index()
	{
		$this->_vista('perfil');
		var_dump($this->data);
	}

	public function add()
	{
		
	}

}

/* End of file perfil.php */
/* Location: ./application/controllers/perfil.php */