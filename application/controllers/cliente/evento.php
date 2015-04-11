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

	/**
	 * Función para mostrar la descripción de
	 * los eventos.
	 *
	 * @author Julio Trujillo
	 **/
	public function ver_eventos()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		// Obtengo los eventos de la base de datos
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

		// Obtengo las fechas de inicio de los eventos desde BD
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
	 * Función para mostrar los contactos
	 * de la empresa y poder registrarlo.
	 *
	 * @author Julio Trujillo
	 **/
	public function registro_evento($id_evento=null)
	{
		// Obtengo el ID para mandarlo después como parámetro a la ventana modal
		$this->data['id_evento'] = $id_evento;
		// Obtengo los contactos del cliente
		$this->data['contactos_cliente']=$this->contactosModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));
		// Mando la vista para registrar al evento
		$this->_vista('registro_evento');
	}

	/**
	 * Función para mostrar los detalles
	 * de un registro a evento de
	 * un participante.
	 *
	 * @author Julio Trujillo
	 **/
	public function detalles($id_evento,$id_contacto)
	{
		// Para ayudarnos del helper con las fechas
		$this->load->helper('formatofechas_helper');

		// Traemos el evento seleccionado desde la BD
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

		// Obtenemos el contacto
		$contacto = $this->contactosModel->get(array('*'),array('id'=>$id_contacto));

		// Obtenemos la fecha
		$fechas = $this->sesionesModel->fecha_inicio(array('id_evento'));

		// Agrego la fecha de inicio a cada evento
		foreach ($eventos as $k1 => $v1) {
			foreach ($fechas as $k2 => $v2) {
				if ($v1->id_evento===$v2->id_evento)
					$eventos[$k1]->fecha_inicio = $v2->fecha_inicio;
			}
		}

		// Mando la vista modal con los datos
		$this->data['id_evento'] = $id_evento;
		$this->data['id_contacto'] = $id_contacto;
		$this->data['contacto'] = $contacto[0];
		$this->data['evento'] = $evento[0];
		$this->_vista_completa('evento/modal-registro-evento');
	}

	/**
	 * Función para registrar a los
	 * contactos del cliente
	 * en algun evento.
	 *
	 * @author Julio Trujillo
	 **/
	public function registro_participante()
	{
		// Obtengo los respectivos datos a insertar
		$id_evento		= $this->input->post('id_evento');
		$id_contacto	= $this->input->post('id_contacto');
		$id_cliente		= $this->input->post('id_cliente');

		//Se hace validación para ver si ya está registrado
		$participante = $this->participantesModel->get(array('id_contacto'), array('id_evento' => $id_evento,'id_cliente'=>$id_cliente,'id_contacto'=>$id_contacto));
		if (empty($participante)) {
			// Preparo mi arreglo
		$data = array(
					'id_evento' 	=> $id_evento,
					'id_contacto' 	=> $id_contacto,
					'id_cliente'	=> $id_cliente);

		// Se convierte el arreglo a objeto para insertar
		$participante = $this->participantesModel->arrayToObject($data);

		// Hago la inserción a la BD
		if ($this->participantesModel->insert($participante)) {
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>Participante agregado con éxito.</h4>');
		}else{
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! revisa la consola para más detalles.</h4>');
		}

		// Mando la respuesta de la inserción
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
		}else{
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>El contacto ya está registrado a éste evento.</h4>');
			// Mando la respuesta de la inserción
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}
}

/* End of file evento.php */
/* Location: ./application/controllers/cliente/evento.php */