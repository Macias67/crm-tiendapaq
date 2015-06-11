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
		$this->load->helper('form');
		$this->data['form'] = array(
				'class' 	=> 'form-horizontal',
				'id' 		=> 'encuesta',
				'role' 	=> 'form');
		$this->_vista('encuesta');
	}

	public function validar()
	{
		$data =$this->input->post();

		$pregunta1 = $data['pregunta1'];
		$pregunta2 = $data['pregunta2'];
		$pregunta3 = $data['pregunta3'];
		$pregunta4 = $data['pregunta4'];
		$pregunta5 = $data['pregunta5'];

		// Puntaje
		$puntaje = 0;

		// Pregunta 1 - 25pts.
		if ($pregunta1 == 'si') {
			$puntaje += 25;
		}

		// Pregunta 2 - 15pts.
		if ($pregunta2 == 'si') {
			$puntaje += 15;
		}

		// Pregunta 3 - 10 - 30pts
		$pregunta3 = (int)$pregunta3;
		$puntaje 	+= ($pregunta3*30)/10;

		// Pregunta 4 - 10 - 30pts
		$pregunta4 = (int)$pregunta4;
		$puntaje 	+= ($pregunta4*30)/10;

		// Pregunta 5
		if ($pregunta5 == 'si') {
			$puntaje += 10;
		} elseif ($pregunta5 == 'no') {
			$puntaje += 5;
		} elseif ($pregunta5 == 'nunca') {
			$puntaje += 0;
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('puntaje' => $puntaje)));
	}
}

/* End of file encuesta.php */
/* Location: ./application/controllers/encuesta.php */