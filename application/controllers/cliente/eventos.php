<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento extends MY_Controller {

	public function index()
	{}
	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventoModel');
	}

	public function ver_eventos()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'eventos.id_ejecutivo',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_creacion'
			));

		$this->_vista('ver_eventos');
	}

}

/* End of file evento.php */
/* Location: ./application/controllers/cliente/evento.php */