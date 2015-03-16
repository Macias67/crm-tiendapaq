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
	}

	public function index()
	{}

	/**
	 * Muestra la vista para la
	 * tabla eventos.
	 *
	 * @author Julio Trujillo
	 **/
	public function revisar()
	{
		// Cargo la librería para las fechas con formato
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel // Modelo al cual mandaré mis campos con array siguiente
								->get_evento_revision( // Función que recibirá el array
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
	 * Función para mostrar tabla
	 * con los datos de los
	 * participantes al
	 * evento.
	 *
	 * @author  Julio Trujillo
	 **/
	public function participantes_detalles($id_evento)
	{
		$this->data['id_evento'] = $id_evento;
		$this->data['participantes'] = $this->eventoModel->get(array('*'));
		$this->_vista('participantes');
	}

	/**
	 * Metodo consultado para el plugin
	 * dataTable del archivo
	 * table-managed-evento.
	 *
	 *
	 * @return json
	 * @author Julio Trujillo
	 **/
	public function table()
	{
		$draw		= $this->input->post('draw');
		$start		= $this->input->post('start');
		$length	= $this->input->post('length');
		$order		= $this->input->post('order');
		$columns	= $this->input->post('columns');
		$search	= $this->input->post('search');
		$total		=  $this->eventoModel->count();

		if($length == -1)
		{
			$length	= null;
			$start	= null;
		}

		$contactos	= $this->eventoModel->get_or_like(
							array('id', 'id_cliente', 'nombre_contacto', 'apellido_paterno', 'apellido_materno', 'email_contacto', 'telefono_contacto'),
							array(
								'nombre_contacto'		=> $search['value'],
								'apellido_paterno'		=> $search['value'],
								'apellido_materno'		=> $search['value'],
								'email_contacto'		=> $search['value'],
								'telefono_contacto'		=> $search['value']
							),
							$columns[$order[0]['column']]['data'],
							$order[0]['dir'],
							$length,
							$start
		                                     );
		var_dump($contactos);
		$proceso	= array();

		foreach ($contactos as $index => $contacto) {
			$p = array(
				"DT_RowId"		=> $cliente->id,
				'codigo'		=> $cliente->codigo,
				'razon_social'		=> $cliente->razon_social,
				'rfc'			=> $cliente->rfc,
				'email'			=> $cliente->email,
				'tipo'			=> ucfirst($cliente->tipo),
				'activo'		=> ($cliente->activo) ? TRUE : FALSE
				//'tipo'			=> ($cliente->tipo == 'normal') ? '<span class="label label-success">Normal</span>' : '<span class="label label-danger">'.ucfirst($cliente->tipo).' </span>'
			       );
			array_push($proceso, $p);
		}

		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($clientes),
			'recordsFiltered'	=> $total,
			'data'				=> $proceso);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
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

			case 'eliminar':
				$id = $this->input->post('id');
				/**
				 * Si exsite una cotizacion o pendiente ligada a este ID de cliente entonces
				 * NO procede a eliminarse, solo a desactivar su identidad
				 * en la aplicacion y en las busquedas
				 */
				$this->load->model('cotizacionModel');
				$this->load->model('pendienteModel');
				// Si NO hay cotizacion
				if (!$this->pendienteModel->exist(array('id_cliente' => $id)) || !$this->cotizacionModel->exist(array('id_cliente' => $id))) {
					if ($this->clienteModel->delete(array('id' => $id))) {
						$response = array('exito' => TRUE, 'mensaje' => 'El cliente se ha eliminado de la base de datos.');
					}
				} else {
					$response = array('exito' => FALSE, 'mensaje' => 'El cliente tiene pendientes o cotizaciones ligadas, por lo tanto solo será desactivado.');
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
				break;

			case 'activar':
				$id 			= $this->input->post('id');
				$selected 	= $this->input->post('selected');
				$activo 	= ($selected == 'true') ? 1 : 0;
				$mensaje	= ($selected == 'true') ? '<h4>El cliente podrá acceder al sistema y aparecerá en los buscadores.</h4>' : '<h4>El cliente ya <b>NO</b> podrá acceder al sistema y desaparecerá de los buscadores del sistema.</h4>';
				if ($this->clienteModel->update(array('activo' => $activo), array('id' => $id))) {
					$response = array('exito' => TRUE, 'mensaje' => $mensaje);
				}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
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