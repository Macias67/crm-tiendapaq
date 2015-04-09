<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends AbstractController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tareaModel');
	}

	public function index()
	{
		
	}

	/**
	 * Funcion para crear una nueva
	 * tarea de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function nueva()
	{
		if($this->input->is_ajax_request()) {
			$this->load->model('estatusGeneralModel');

			$id_caso		= $this->input->post('id_caso');
			$ejecutivo		= $this->input->post('ejecutivo');
			$tarea			= $this->input->post('tarea');
			$descripcion	= $this->input->post('descripcion');

			$tarea = array(
					'id_caso'		=> $id_caso,
					'id_ejecutivo'	=> $ejecutivo,
					'id_estatus'	=> $this->estatusGeneralModel->PENDIENTE,
					'fecha_inicio'	=> date('Y-m-d H:i:s'),
					'tarea'			=> ucfirst(strtolower($tarea)),
					'descripcion'	=> ucfirst(strtolower($descripcion))
					);

			$msg = (!$this->tareaModel->insert($tarea)) ? 'No se inserto en la base de datos' : '';
			$response = array('exito' => $exito, 'msg' => $msg);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

}

/* End of file tarea.php */
/* Location: ./application/controllers/tarea.php */