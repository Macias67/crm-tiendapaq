<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends AbstractController {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{}

	public function form($id)
	{
		$this->_vista('encuesta');
	}
}

/* End of file encuesta.php */
/* Location: ./application/controllers/encuesta.php */