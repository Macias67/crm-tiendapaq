<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends AbstractController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventomodel');
	}

	public function index($filtro = null)
	{
		$this->load->model('oficinasmodel');
		$this->load->model('sesionmodel');
		$this->load->model('estatusgeneralmodel');
		$this->load->helper('formatofechas');

		$eventos = $this->eventomodel->get('*',array('id_estatus' => $this->estatusgeneralmodel->PENDIENTE), 'fecha_limite', 'ASC');
		// Clasifico segun modalidad
		$otro 		= array();
		$sucursal	= array();
		$online 	= array();
		foreach ($eventos as $index => $evento) {
			$primera_sesion = $this->sesionmodel->get("MIN(fecha_inicio) as primera_sesion",array('id_evento' => $evento->id_evento), null, 'ASC', 1);
			$evento->primera_sesion = $primera_sesion->primera_sesion;

			if ($evento->modalidad == 'online') {
				array_push($online, $evento);
			} else if ($evento->modalidad == 'sucursal')
			{
				$oficina = $this->oficinasmodel->get('ciudad_estado', array('id_oficina' => $evento->id_oficina), null, 'ASC', 1);
				$evento->oficina = $oficina->ciudad_estado;
				array_push($sucursal, $evento);
			} else if ($evento->modalidad == 'otro')
			{
				array_push($otro, $evento);
			}
		}

		$this->data['online'] 	= $online;
		$this->data['sucursal'] 	= $sucursal;
		$this->data['otro'] 		= $otro;
		$this->_vista('listado-eventos');
	}

	/**
	 * Vista para mostrar detalles
	 * a un evento
	 *
	 * @return void
	 * @author 
	 **/
	public function detalles($id_evento)
	{
		if ($evento = $this->eventomodel->get_where(array('id_evento' => $id_evento))) {
			$this->load->model('sesionmodel');
			$this->load->helper('formatofechas');

			$lugar = '';
			if ($evento->modalidad != 'online' && !is_null($evento->id_oficina)) {
				$this->load->model('oficinasmodel');
				$oficina 	= $this->oficinasmodel->get('*', array('id_oficina' => $evento->id_oficina), null, 'ASC', 1);
				$lugar 		= $oficina->calle.' '.$oficina->numero.', Col. '.$oficina->colonia.', '.$oficina->ciudad_estado;
			} else if ($evento->modalidad != 'online' && !is_null($evento->direccion)) {
				$lugar = $evento->direccion;
			}

			$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));
			$this->data['temario_url'] 	= site_url('assets/admin/pages/media/eventos/'.$id_evento.'/temario.jpg');
			$this->data['sesiones'] 	= $sesiones;
			$this->data['evento'] 		= $evento;
			$this->data['lugar'] 		= $lugar;
			$this->_vista('detalles');
		} else {
			show_404();
		}
	}

	/**
	 * Vista para mostrar el formulario de inscripcion
	 * a un evento
	 *
	 * @return void
	 * @author 
	 **/
	public function inscripcion($id_evento)
	{
		if ($evento = $this->eventomodel->get_where(array('id_evento' => $id_evento))) {
			$this->load->model('participantesmodel');
			$participantes = $this->participantesmodel->get_where(array('id_evento' => $evento->id_evento));
			$participantes = count($participantes);

			// Valido cupo del evento
			if (($evento->max_participantes == 0) || ($evento->max_participantes >= $participantes))  {
				$this->load->model('sesionmodel');
				$this->load->helper('formatofechas');
				$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));

				$this->data['sesiones'] 	= $sesiones;
				$this->data['evento'] = $evento;
				$this->_vista('form-inscripcion');
			} else {
				var_dump($participantes);
				var_dump($evento->max_participantes);
				show_error('El evento esta a tope');
			}
		} else {
			show_404();
		}
	}

	public function existe_cliente()
	{
		if ($this->input->is_ajax_request()) {
			$this->load->model('clientemodel');

			$rfc = $this->input->post('rfc');
			if ($cliente = $this->clientemodel->get_where(array('rfc' => $rfc))) {
				$cliente = (array)$cliente;
				$response = array('cliente' => $cliente, 'existe' => TRUE);
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}

		}
	}

}

/* End of file evento.php */
/* Location: ./application/controllers/publica/evento.php */