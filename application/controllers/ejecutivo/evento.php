<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de eventos y funciones
 * para el mismo.
 *
 * @author Julio Trujillo
 **/
class Evento extends AbstractAccess {

	/**
	 *
	 *Constructor de la función.
	 *
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventoModel');
		$this->load->model('participantesModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('clienteModel');
		$this->load->model('sesionesModel');
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
		// Cargo el modelo de sesiones para la fecha de inicio de evento
		$this->load->model('sesionesModel');

		$eventos = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'eventos.id_ejecutivo',
				'eventos.costo',
				'eventos.modalidad',
				'eventos.titulo',
				'eventos.fecha_creacion',
				'eventos.total_participantes',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
			));

		$fechas = $this->sesionesModel->fecha_inicio(array('id_evento'));

		foreach ($eventos as $k1 => $v1) {
			foreach ($fechas as $k2 => $v2) {
				if ($v1->id_evento===$v2->id_evento)
					$eventos[$k1]->fecha_inicio = $v2->fecha_inicio;
			}
		}
		$this->data['eventos_revision'] = $eventos;
		$this->_vista('revisar');
	}

	/**
	 * Función para mostrar ventana modal
	 * con información detallada
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
				'eventos.id_ejecutivo',
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
				'contactos.id_cliente',
				'contactos.nombre_contacto',
				'contactos.apellido_paterno',
				'contactos.apellido_materno',
				'contactos.email_contacto',
				'contactos.telefono_contacto',
				'clientes.razon_social'), $id_evento);
		$id_contactos = array();

		$this->data['clientes'] = $this->clienteModel->get(array('*'));

		$this->_vista('participantes');
	}

	/**
	 * funcion para crear
	 * y gestionar
	 * eventos
	 * @author  David | Julio Trujillo
	 **/
	public function gestionar($accion=null, $id_evento=null,$id_ejecutivo=null)
	{
		switch ($accion)
		{
			case 'nuevo':
				$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'),
				'privilegios',
				array('soporte', 'admin'),
				'primer_nombre');
				$this->_vista('form-nuevo-evento');
			break;

			case 'editar':
				$this->load->helper('formatofechas_helper');
				$evento = $this->eventoModel->get_where(array('id_evento' => $id_evento));
				$ejecutivo_actual = $this->ejecutivoModel->get_where(array('id' => $id_ejecutivo));

				if (!empty($evento))
				{
					// Busco todos los Ejecutivos para mandarlos en select
					$ejecutivos = $this->ejecutivoModel->where_in(
					array('id','primer_nombre', 'apellido_paterno'),
					'privilegios',
					array('soporte', 'admin'),
					'primer_nombre');

					// Datos a enviar a la vista
					$this->data['cliente']	= $cliente;
					$this->data['ejecutivos'] 	= $ejecutivos;
					//Vista de formulario a mostrar
					$this->_vista('editar-evento');
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

	/**
	 * Método consultado para el plugin dataTable
	 * del archivo table-managed-evento
	 * que es la tabla vía ajax.
	 *
	 * @return json
	 * @author Luis Macias | Julio Trujillo
	 **/
	public function table()
	{
		/**
		 * Parámetros de DataTables.
		 *
		 * http://datatables.net/manual/server-side
		 **/
		$draw		= $this->input->post('draw');
		$search	= $this->input->post('search');
		$columns	= $this->input->post('columns');
		$order		= $this->input->post('order');
		$length	= $this->input->post('length');
		$start		= $this->input->post('start');
		$total		= $this->eventoModel->count();

		if($length == -1)
		{
			$length= null;
			$start	= null;
		}

		// Obtenemos los eventos, sesiones y los ejecutivos
		$fechas 	= $this->sesionesModel->fecha_inicio(array('id_evento'));
		$ejecutivos 	= $this->ejecutivoModel->get(array('*'));
		$eventos	= $this->eventoModel->get_or_like(
							array('id_evento',
								'id_ejecutivo',
								'titulo',
								'costo',
								'modalidad',
								'total_participantes'
							),
							array(
								'id_evento'				=> $search['value'],
								'titulo'					=> $search['value'],
								'costo'					=> $search['value'],
								'modalidad'				=> $search['value'],
								'total_participantes'	=> $search['value']
							),
							$columns[$order[0]['column']]['data'],
							$order[0]['dir'],
							$length,
							$start
	                    );

		$selecciona_ejecutivos = array();
		$proceso	= array();

		// Creamos nuestro array de ejecutivos
		foreach ($ejecutivos as $k1 => $v1) {
			foreach ($eventos as $k2 => $v2) {
				if ($v1->id===$v2->id_ejecutivo) {
					$sel = array('nombre'=>$v1->primer_nombre." ".$v1->segundo_nombre." ".$v1->apellido_paterno);
					array_push($selecciona_ejecutivos, $sel);
				}
			}
		}

		// Preparamos los datos de la tabla
		for ($i=0; $i < $total; $i++) {
			$p = array(
					"DT_RowId"		=> $eventos[$i]->id_evento,
					'fecha_inicio' 	=> $fechas[$i] ->fecha_inicio,
					'titulo'		=> $eventos[$i]->titulo,
					'modalidad'		=> $eventos[$i]->modalidad,
					'costo'			=> $eventos[$i]->costo,
					'ejecutivo'		=> $selecciona_ejecutivos[$i]['nombre'],
					'participantes'	=> $eventos[$i]->total_participantes
		       );
			array_push($proceso, $p);
		};

		// Se prepara la devolución de la llamada
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($eventos),
			'recordsFiltered'	=> $total,
			'data'				=> $proceso);

		// Se envía la respuesta en formato JSON
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
}

/* End of file eventos.php */
/* Location: ./application/controllers/ejecutivo/eventos.php */