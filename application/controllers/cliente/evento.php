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
		$this->load->model('sesionesModel');
	}

	public function ver_eventos()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$eventos = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'eventos.id_ejecutivo',
				'eventos.costo',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.modalidad',
				'eventos.costo'
			));

		$fechas = $this->sesionesModel->fecha_inicio(array('id_evento'));

		foreach ($eventos as $k1 => $v1) {
			foreach ($fechas as $k2 => $v2) {
				if ($v1->id_evento===$v2->id_evento)
					$eventos[$k1]->fecha_inicio = $v2->fecha_inicio;
			}
		}

		$this->data['eventos_revision'] = $eventos;
		$this->_vista('ver_eventos');
	}

	/**
	 * Función para mostrar los detalles
	 * de un registro de
	 * participante.
	 *
	 * @author Diego Rodriguez
	 **/
	public function detalles($id_evento,$id_contacto)
	{
		// Para ayudarnos del helper con las fechas
		$this->load->helper('formatofechas_helper');

		// Traemos los eventos y los guardamos en una variable
		$evento = $this->eventoModel->get_eventos(
		array(
			'eventos.id_evento',
			'eventos.titulo',
			'eventos.id_ejecutivo',
			'eventos.costo',
			'ejecutivos.primer_nombre',
			'ejecutivos.apellido_paterno',
			'eventos.modalidad',
			'eventos.costo',
			'eventos.sesiones'
		), $id_evento);

		$contacto = $this->contactosModel->get(array('*'),array('id'=>$id_contacto));

		$fechas = $this->sesionesModel->fecha_inicio(array('id_evento'));

		foreach ($eventos as $k1 => $v1) {
			foreach ($fechas as $k2 => $v2) {
				if ($v1->id_evento===$v2->id_evento)
					$eventos[$k1]->fecha_inicio = $v2->fecha_inicio;
			}
		}

		$this->data['id_evento'] = $id_evento;
		$this->data['id_contacto'] = $id_contacto;
		$this->data['contacto'] = $contacto[0];
		$this->data['evento'] = $evento[0];
		$this->_vista_completa('evento/modal-registro-evento');
	}

	public function registro_evento($id_evento=null)
	{
		$this->data['id_evento'] = $id_evento;
		$this->data['contactos_cliente']=$this->contactosModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));
		$this->_vista('registro_evento');
	}

	public function registro_participante()
	{
		$id_contacto	= $this->input->post('id_contacto');
		$id_cliente		= $this->input->post('id_cliente');
		$id_evento		= $this->input->post('id_evento');

		$data = array(
					'id_evento' 	=> $id_evento,
					'id_contacto' 	=> $id_contacto,
					'id_cliente'	=> $id_cliente);

		// $participante = $this->participantesModel->arrayToObject($data);
		
		$sql = $this->participantesModel->insert($data);
		var_dump($sql);

		if ($sql) {
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