<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tareaModel');
	}

	public function index()
	{
		$id_ejecutivo = $this->usuario_activo['id'];
		$this->_vista('listado-tareas');
	}

	/**
	 * Funcion para crear una nueva
	 * tarea de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function nueva()
	{
		if($this->input->is_ajax_request()) {
			$this->load->model('estatusGeneralModel');

			$id_caso		= $this->input->post('id_caso');
			$ejecutivo		= $this->input->post('ejecutivo');
			$tarea			= $this->input->post('tarea');
			$descripcion	= $this->input->post('descripcion');

			$tarea = array(
					'id_caso'		=> $id_caso,
					'id_ejecutivo'	=> $ejecutivo,
					'id_estatus'	=> $this->estatusGeneralModel->PENDIENTE,
					'fecha_inicio'	=> date('Y-m-d H:i:s'),
					'tarea'			=> ucfirst(strtolower($tarea)),
					'descripcion'	=> ucfirst(strtolower($descripcion))
					);

			$exito 	= $this->tareaModel->insert($tarea);
			$msg 	= (!$exito) ? 'No se inserto en la base de datos' : '';
			$response = array('exito' => $exito, 'msg' => $msg);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

	/**
	 * Funcion para crear una editar
	 * tarea de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function edita()
	{
		if($this->input->is_ajax_request()) {

			$id_tarea		= $this->input->post('id_tarea');
			$ejecutivo		= $this->input->post('ejecutivo');
			$tarea			= $this->input->post('tarea');
			$descripcion	= $this->input->post('descripcion');
			$estatus		= $this->input->post('estatus');
			$avance		= $this->input->post('avance');

			$tarea = array(
					'id_ejecutivo'	=> $ejecutivo,
					'id_estatus'	=> $estatus,
					'tarea'			=> ucfirst(strtolower($tarea)),
					'descripcion'	=> ucfirst(strtolower($descripcion)),
					'avance'		=> ucfirst(strtolower($avance))
					);

			$exito 	= $this->tareaModel->update($tarea, array('id_tarea' => $id_tarea));
			$msg 	= (!$exito) ? 'No se actualizo en la base de datos' : '';
			$response = array('exito' => $exito, 'msg' => $msg);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

	public function modal($accion)
	{
		$id_tarea = $this->uri->segment(4);
		switch ($accion) {
			case 'editar':
				if ($tarea = $this->tareaModel->get_tarea($id_tarea)) {
					$this->load->model('ejecutivoModel');
					$this->load->model('estatusGeneralModel');
					$this->load->helper('form');
					// Obtengo ejecutivos y armo opciones del select
					$ejecutivos 			= $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
					$opciones_ejecutivos 	= array();
					foreach ($ejecutivos as $index => $ejecutivo) {
						$opciones_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
					}
					// Obtengo estatus grles y armo opciones del select
					$estatus 		= $this->estatusGeneralModel->get(array('id_estatus', 'descripcion'));
					$opciones_estatus = array();
					foreach ($estatus as $index => $valor) {
						$opciones_estatus[$valor->id_estatus] = ucfirst($valor->descripcion);
					}
					$this->data['tarea'] = $tarea;
					$this->data['opciones_estatus'] = $opciones_estatus;
					$this->data['opciones_ejecutivo'] = $opciones_ejecutivos;
					$this->_vista_completa('tarea/edita-tarea');
				} else {
					echo '<h1>No existe esta tarea.</h1>';
				}
			break;
			case 'notas':
				$this->load->model('notastareaModel');
				$notas = $this->notastareaModel->get('*', array('id_tarea' => $id_tarea));
				$this->data['notas'] = $notas;
				$this->_vista_completa('tarea/notas-modal');
				break;
		}
	}

	/**
	 * Funcion para obtener las tareas de manera de JSON
	 * con formato para el DataTable
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json_tareas($id_ejecutivo = null)
	{
		$id_ejecutivo	= (is_null($id_ejecutivo)) ? $this->usuario_activo['id'] : $id_ejecutivo;
		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		$total			=  $this->tareaModel->get('COUNT(*) as total', array('id_ejecutivo' =>$id_ejecutivo), null, 1);

		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
		                		'id_tarea',
		                		'id_caso',
	                			'caso.folio_cotizacion',
	                			'caso.id_cliente',
						'caso.id',
						'clientes.razon_social',
						'ejecutivos.primer_nombre',
						'ejecutivos.apellido_paterno',
						'lider.primer_nombre as nombre_lider',
						'lider.apellido_paterno as apellido_lider',
						'tareas.id_estatus',
						'tareas.fecha_inicio',
						'fecha_finaliza',
						'tarea',
						'avance');
		$joins 			= array('caso', 'clientes', 'estatus_general', 'ejecutivos');
		$like 			= $search['value'];
		$orderBy 		= $columns[$order[0]['column']]['data'];
		$orderForm 	= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$tareas	= $this->tareaModel->get_tareas_ejecutivo_table(
		                                                           	   $id_ejecutivo,
		                                                                     $campos,
		                                                                     $joins,
		                                                                     $like,
		                                                                     $orderBy,
		                                                                     $orderForm,
		                                                                     $limit,
		                                                                     $offset);
		// var_dump($tareas);

		$proceso	= array();
		$this->load->helper('formatofechas');
		//$this->load->model('comentariosCotizacionModel');
		foreach ($tareas as $index => $tarea) {
			//$total_comentario 		= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $tarea->folio), null, 'ASC', 1);
			//$total_comentario_sinver 	= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $tarea->folio, 'visto' => 0), null, 'ASC', 1);
			$p = array(
				'DT_RowId'			=> $tarea->id_tarea,
				'folio_cotizacion'	=> $tarea->folio_cotizacion,
				'id_caso'			=> $tarea->id_caso,
				'id_estatus'		=> $tarea->id_estatus,
				'razon_social'		=> $tarea->razon_social,
				'lider'				=> $tarea->nombre_lider.' '.$tarea->apellido_lider,
				'fecha_inicio'		=> fecha_completa($tarea->fecha_inicio),
				'fecha_finaliza'		=> ($tarea->fecha_finaliza=='1000-01-01 00:00:00')? '':fecha_completa($tarea->fecha_finaliza),
				'tarea'				=> $tarea->tarea,
				'avance'			=> $tarea->avance,
				'url'					=> site_url('/tarea/detalles/'.$tarea->id_tarea),
				'url_modal'			=> site_url('/tarea/modal/'.$tarea->id_caso)
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($tareas),
			'recordsFiltered'	=> $total[0]->total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

}

/* End of file tarea.php */
/* Location: ./application/controllers/tarea.php */