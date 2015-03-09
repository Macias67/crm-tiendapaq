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
		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'clientes.razon_social',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha',
				'eventos.descripcion',
				'eventos.temario',
				'eventos.sesiones',
				'eventos.hora',
				'eventos.duracion',
				'eventos.costo',
			));
		$this->_vista('administrar');
	}


}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */