<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para gestionar la informacion respecto a los casos
 *
 * @package default
 * @author Diego Rodriguez
 **/

class Caso extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('casoModel');
	}
	/**
	 * Funcion de inicio para asignar casos
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->load->model('ejecutivoModel');
		$this->load->helper('formatofechas_helper');
		$this->load->model('ejecutivoModel');

		$this->data['ejecutivos'] = $this->ejecutivoModel->get(array('id','primer_nombre','apellido_paterno'));
		//var_dump($this->data);

		$asignador_casos = $this->ejecutivoModel->get(array('asignador_casos'),array('id' => $this->data['usuario_activo']['id']));
		if($asignador_casos[0]->asignador_casos=="si"){
			$this->load->model('casoModel');

			$campos = array('*');
			$this->data['casos_asignacion'] = $this->casoModel->get_casos_asignacion($campos);
			$this->_vista('casos_asignar');
		}else{
			show_404();
		}
	}

	/**
	 * Funcion para mostrar los detalles de un caso
	 *
	 * @author Diego Rodriguez
	 **/
	public function detalles($id_caso)
	{
		
	}

	/**
	 * Funcion para asignarle un caso a un ejecutivo
	 *
	 * @return json
	 * @author Diego Rodriguez
	 **/
	public function asignar($id_caso,$id_ejecutivo)
	{
		
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */