<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caso extends AbstractAccess {

	public function index()
	{
		$this->load->model('casoModel');

		$campos = array('*');
		$this->data['casos_asignacion'] = $this->casoModel->get_casos_asignacion($campos);
		$this->_vista('caso');

		var_dump($this->data);
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */