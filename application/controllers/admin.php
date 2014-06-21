<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends AbstractAccess {

	public function index()
	{
		//var_dump($this->data);
		$this->_vista($this->privilegios,'principal');
	}

	public function add(){
		$this->_vista($this->privilegios,'form-nuevo-cliente');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */