<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends AbstractAccess {

	public function index()
	{
		
	}

	/**
	 * Funcion que muestra la vista
	 * del formulario nuevo
	 *
	 * @return void
	 * @author 
	 **/
	public function nuevo($vista = null)
	{
		$this->load->model('ejecutivoModel');
		$this->load->model('oficinasModel');
		$this->load->helper('form');
		// Creo options de ejecutivos
		$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
		$options_ejecutivos = array('' => '');
		foreach ($ejecutivos as $index => $ejecutivo) {
			$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
		}
		// Creo options de oficinas
		$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
		$options_oficinas = array('' => '');
		foreach ($oficinas as $index => $oficina) {
			$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
		}

		$this->data['options_ejecutivos'] 	= $options_ejecutivos;
		$this->data['options_oficinas'] 	= $options_oficinas;
		$this->_vista('nuevo-evento');
	}

	public function create()
	{
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//Datos basicos
		$this->form_validation->set_rules('ejecutivo', 'Ejecutivo', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|strtolower|ucfirst|max_length[100]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|xss_clean');
		$this->form_validation->set_rules('costo', 'Costo', 'trim|required|decimal|xss_clean');
		$this->form_validation->set_rules('cupo', 'Max. Cupo', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('lugar', 'Lugar', 'trim|required|xss_clean');

		$lugar 	= $this->input->post('lugar');

		if ($lugar == 'online')
		{
			$this->form_validation->set_rules('link', 'Link', 'trim|required|strtolower|valid_url|prep_url|xss_clean');
		} else if($lugar == 'sucursal')
		{
			$this->form_validation->set_rules('sucursal', 'Oficinas', 'trim|required|integer|xss_clean');
		} else if($lugar == 'otro')
		{
			$this->form_validation->set_rules('otro', 'Dirección', 'trim|required|strtolower|ucfirst|xss_clean');
		}

		$this->form_validation->set_rules('userfile', 'Temario', 'file_required|file_size_min[10KB]|file_size_max[2MB]|file_allowed_type[imagen]|file_image_mindim[299,299]|file_image_maxdim[1601,1601]');
		$this->form_validation->set_rules('sesion1', 'Sesión 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dsesion1', 'Duración Sesion 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sesion2', 'Sesión 2', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion2', 'Duración Sesion 2', 'trim|xss_clean');
		$this->form_validation->set_rules('sesion3', 'Sesión 3', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion3', 'Duración Sesion 3', 'trim|xss_clean');
		$this->form_validation->set_rules('sesion4', 'Sesión 4', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion4', 'Duración Sesion 1', 'trim|xss_clean');

		// Validamos formulario
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->model('ejecutivoModel');
			$this->load->model('oficinasModel');
			$this->load->helper('form');
			// Creo options de ejecutivos
			$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
			$options_ejecutivos = array('' => '');
			foreach ($ejecutivos as $index => $ejecutivo) {
				$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
			}
			// Creo options de oficinas
			$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
			$options_oficinas = array('' => '');
			foreach ($oficinas as $index => $oficina) {
				$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
			}

			$this->data['options_ejecutivos'] 	= $options_ejecutivos;
			$this->data['options_oficinas'] 	= $options_oficinas;
			$this->_vista('nuevo-evento');
		} else {
			// Procesar informacion
		}
	}

	/**
	 * Calculo la duracion de horas
	 * en una sesion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function duracion()
	{
		if($this->input->is_ajax_request()) {
			$rango 	= $this->input->post('rango');
			$rango 	= explode('-', $rango);
			$inicio 	= explode(' ', $rango[0]);
			$fin 	= explode(' ', trim($rango[1]));

			$fecha_inicio 	=  explode('/', $inicio[0]);
			$fecha_inicio 	=  $fecha_inicio[2].'/'.$fecha_inicio[1].'/'.$fecha_inicio[0];
			$hora_inicio 	=  $inicio[1].':00 '.$inicio[2];
			$inicio 			= $fecha_inicio.' '.$hora_inicio;

			$fecha_fin 		=  explode('/', $fin[0]);
			$fecha_fin 		=  $fecha_fin[2].'/'.$fecha_fin[1].'/'.$fecha_fin[0];
			$hora_fin 		=  $fin[1].':00 '.$fin[2];
			$fin 			= $fecha_fin.' '.$hora_fin;

			$diferencia		= strtotime($fin) - strtotime($inicio);
			$horas			= floor($diferencia/(60*60)); // horas
			$minutos		= floor(($diferencia%(60*60))/60); // minutos
			$minutos		= ($minutos == 0) ? '00': $minutos;
			$duracion 		= ($horas == 1 && $minutos == '00') ? $horas.':'.$minutos.' hora aprox.' : $horas.':'.$minutos.' horas aprox.';

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array(
				             'duracion' 	=> $duracion,
				              'valor' 		=> $horas.':'.$minutos
				             )));
		}
	}

	/**
	 * Calcula el limite de inscipcion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function limite()
	{
		if($this->input->is_ajax_request()) {
			$this->load->helper('formatofechas');
			$rango 	= $this->input->post('rango');
			$rango 	= explode('-', $rango);
			$inicio 	= explode(' ', $rango[0]);

			$fecha_inicio 	=  explode('/', $inicio[0]);
			$fecha_inicio 	=  $fecha_inicio[2].'/'.$fecha_inicio[1].'/'.$fecha_inicio[0];
			$hora_inicio 	=  $inicio[1].':00 '.$inicio[2];
			$inicio 			= $fecha_inicio.' '.$hora_inicio;

			$diferencia		= strtotime($inicio) - (60*60);
			$fecha 			= date('Y-m-d H:i:s', $diferencia);
			$limite 			= fecha_completa($fecha);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('limite' => $limite)));
		}
	}

}

/* End of file evento.php */
/* Location: ./application/controllers/evento.php */