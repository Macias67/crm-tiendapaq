<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de eventos y funciones
 * para el mismo.
 *
 * @author Julio Trujillo
 **/
class Evento extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventoModel');
	}

	public function index()
	{}

	/**
	 * Muestra la vista para los
	 * eventos
	 * @author Julio Trujillo
	 **/
	public function revisar()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_creacion'
			));
		$this->_vista('administrar');
	}

	/**
	 * Función para mostrar ventana modal
	 * con informacion detallada
	 * sobre un evento.
	 * @author  Julio Trujillo
	 **/
	public function detalles($id_evento)
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['evento'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_evento',
				'eventos.fecha_creacion',
				'eventos.descripcion',
				'eventos.temario',
				'eventos.sesiones',
				'eventos.hora',
				'eventos.duracion',
				'eventos.costo',
			));

		$this->_vista_completa('evento/modal-detalles-evento');
	}
}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */