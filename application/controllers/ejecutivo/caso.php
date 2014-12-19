<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caso extends AbstractAccess {

	public function index()
	{
		$this->load->model('ejecutivoModel');
		$this->load->helper('formatofechas_helper');
		$this->load->model('ejecutivoModel');

		$asignador_casos = $this->ejecutivoModel->get(array('asignador_casos'),array('id' => $this->data['usuario_activo']['id']));
		if($asignador_casos[0]->asignador_casos=="si"){
			$this->load->model('casoModel');

			$campos = array('*');
			$this->data['casos_asignacion'] = $this->casoModel->get_casos_asignacion($campos);
			$this->_vista('caso');
		}else{
			show_404();
		}
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */