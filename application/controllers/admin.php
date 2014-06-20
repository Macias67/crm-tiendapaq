<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends AbstractAccess {

	public function index()
	{
		echo $this->controller;
		$this->_vista($this->controller,'principal');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */