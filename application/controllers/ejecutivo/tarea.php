<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends AbstractController {

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
		$ejecutivo = $this->input->post('ejecutivo');
		$response = array('exito' => TRUE);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

}

/* End of file tarea.php */
/* Location: ./application/controllers/tarea.php */