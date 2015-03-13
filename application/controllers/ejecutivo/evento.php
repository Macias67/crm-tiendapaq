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
		$this->load->model('eventoModel'); // Cargo mi modelo de eventos
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
		// Cargo la librería para las fechas con formato
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel // Modelo al cual mandaré mis campos con array siguiente
												->get_evento_revision( // Función que recibirá el array
													array(	'eventos.id_evento',
															'ejecutivos.primer_nombre',
															'ejecutivos.apellido_paterno',
															'eventos.titulo',
															'eventos.fecha_creacion'
													)
												);
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
		$length		= $this->input->post('length');
		$order		= $this->input->post('order');
		$columns	= $this->input->post('columns');
		$search		= $this->input->post('search');
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
		$proceso	= array();

		foreach ($clientes as $index => $cliente) {
			$p = array(
				"DT_RowId"	=> $cliente->id,
				'codigo'		=> $cliente->codigo,
				'razon_social'	=> $cliente->razon_social,
				'rfc'			=> $cliente->rfc,
				'email'			=> $cliente->email,
				'tipo'			=> ucfirst($cliente->tipo),
				'activo'			=> ($cliente->activo) ? TRUE : FALSE
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
}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */