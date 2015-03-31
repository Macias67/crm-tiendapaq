<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Evento extends AbstractAccess {

	public function index()
	{}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventoModel');
		$this->load->model('clienteModel');
		$this->load->model('contactosModel');
		$this->load->model('participantesModel');
	}

	public function ver_eventos()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'eventos.id_ejecutivo',
				'eventos.costo',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo'
			));

		$this->_vista('ver_eventos');
	}

	public function registro_evento($id_evento=null)
	{
		$this->data['id_evento'] = $id_evento;
		$this->data['contactos_cliente']=$this->contactosModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));
		$this->_vista('registro_evento');
	}

	public function registro_participante()
	{
		$participante = array(
								'id' 			=> null,
								'id_evento' 	=> $this->input->post('idevento'),
								'id_contacto' 	=> $this->input->post('idcontacto'));
		// var_dump($participante);
		if ($this->participantesModel->insert($participante)) {
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>Participante agregado con éxito.</h4>');
		}else{
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! revisa la consola para más detalles.</h4>');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}
}

/* End of file evento.php */
/* Location: ./application/controllers/cliente/evento.php */