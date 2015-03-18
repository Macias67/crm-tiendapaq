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
		$this->load->model('participantesModel');
	}

	public function index()
	{}

	/**
	 * Muestra la vista para los
	 * eventos.
	 * 
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
		$this->_vista('revisar');
	}

	/**
	 * Función para mostrar ventana modal
	 * con informacion detallada
	 * sobre un evento.
	 * 
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

	/**
	 * Función que muestra todos los
	 * participantes inscritos en
	 * algún evento.
	 *
	 * @author  Julio Trujillo
	 **/
	public function participantes_detalles($id_evento)
	{
		$this->data['participantes'] = $this->participantesModel->get_participantes(
			array(
				'contactos.id',
				'contactos.nombre_contacto',
				'contactos.apellido_paterno',
				'contactos.apellido_materno',
				'contactos.email_contacto',
				'contactos.telefono_contacto'), $id_evento);
		$this->_vista('participantes');
	}

	/**
	 * funcion para crear
	 * y gestionar
	 * eventos
	 * @author  David
	 **/
	public function gestionar($accion=null, $id_cliente=null)
	{
		switch ($accion)
		{
			case 'nuevo':
				$this->load->model('ejecutivoModel');
				$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'),
				'privilegios',
				array('soporte', 'admin'),
				'primer_nombre');
				$this->_vista('form-nuevo-evento');
			break;

			case 'editar':
				$cliente = $this->clienteModel->get_where(array('id' => $id_cliente));
				if (!empty($cliente))
				{
					// Datos a enviar a la vista
					$this->data['cliente']						= $cliente;
					$this->data['contactos']					= $this->contactosModel->get(array('*'), array('id_cliente' => $id_cliente));
					$this->data['sistemas_contpaqi']			= $this->sistemasContpaqiModel->get(array('*'));
					$this->data['sistemas_contpaqi_cliente']	= $this->sistemasClienteModel->get(array('*'), array('id_cliente' => $id_cliente));
					$this->data['equipos']						= $this->equiposComputoModel->get(array('*'), array('id_cliente' => $id_cliente));
					$this->data['sistemas_operativos']			= $this->sistemasOperativosModel->get(array('*'), $where = null, $orderBy = 'id_so', $orderForm = 'ASC');
					//Vista de formulario a mostrar
					$this->_vista('editar-cliente');
				} else
				{
					show_error('No existe este cliente.', 404);
				}
			break;

			default:
				$this->data['clientes'] = $this->clienteModel->get(array('*'));
				$this->_vista('gestionar');
			break;
		}
	}
}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */