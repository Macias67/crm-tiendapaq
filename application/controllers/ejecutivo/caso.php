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
		//var_dump($this->data);

		$asignador_casos = $this->ejecutivoModel->get(array('asignador_casos'),array('id' => $this->data['usuario_activo']['id']));
		if($asignador_casos[0]->asignador_casos=="si"){
			$this->load->model('casoModel');

			$campos = array('caso.id as id_caso','clientes.razon_social','estatus_general.descripcion','id_cliente','folio_cotizacion','fecha_inicio','fecha_final');
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
	public function asignar($accion=null, $id_caso=null)
	{
		switch ($accion) {
			case 'asignar':
				$this->load->model('estatusGeneralModel');

				$id_caso = $this->input->post('id_caso');
				$id_ejecutivo = $this->input->post('id_ejecutivo');

				if($this->casoModel->update(array('id_lider' => $id_ejecutivo, 'id_estatus_general' => $this->estatusGeneralModel->PENDIENTE),array('id' => $id_caso))){
					$respuesta = array('exito' => TRUE);
				}else{
					$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error, revisa la consola para mas información</h4>');
				}

				$this->output
						->set_content_type('application/json')
						->set_output(json_encode($respuesta));
			break;

			case 'mostrar':
				$this->load->model('ejecutivoModel');
				$this->data['ejecutivos'] = $this->ejecutivoModel->get(array('id','primer_nombre','apellido_paterno'));
				$this->data['id_caso'] = $id_caso;

				$this->_vista_completa('caso/modal-asignar-ejecutivo');
			break;
		}
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */