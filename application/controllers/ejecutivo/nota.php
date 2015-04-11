<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends AbstractAccess {

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
			$this->load->model('notastareaModel');

			$id_tarea		= $this->input->post('id_tarea');
			$nota			= $this->input->post('nota');
			$privacidad		= $this->input->post('privacidad');

			$tarea = array(
					'id_tarea'		=> $id_tarea,
					'privacidad'		=> $privacidad,
					'fecha_registro'=> date('Y-m-d H:i:s'),
					'nota'			=> ucfirst(strtolower($nota))
					);

			$exito 	= $this->notastareaModel->insert($tarea);
			$msg 	= (!$exito) ? 'No se inserto en la base de datos' : '';
			$response = array('exito' => $exito, 'msg' => $msg);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}
}

/* End of file notas.php */
/* Location: ./application/controllers/notas.php */