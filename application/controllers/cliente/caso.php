<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para gestionar la informacion respecto a los casos
 *
 * @package default
 * @author Diego Rodriguez
 **/

class Caso extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('casoModel');
	}
	/**
	 * Funcion de inicio para asignar casos
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->load->model('clienteModel');
		$this->load->helper('formatofechas_helper');

		$id_cliente = $this->data['usuario_activo']['id'];
		$campos = array(
				'caso.id as id_caso',
				'caso.id_estatus_general',
				'clientes.razon_social',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'estatus_general.descripcion',
				'caso.id_cliente','caso.folio_cotizacion',
				'caso.fecha_inicio','caso.fecha_final'
			);

		$this->data['casos_cliente'] = $this->casoModel->get_casos_cliente($campos,$id_cliente);
		$this->_vista('casos_cliente');
	}

	/**
	 * Funcion que muestra a detalle
	 * un caso asginado
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function detalles($id_caso)
	{
		$this->load->model('cotizacionModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('notastareaModel');
		$this->load->model('tareaModel');
		$this->load->helper('formatofechas_helper');
		$this->load->helper('cotizacion');
		$this->load->helper('estatus');

		$caso 			=  $this->casoModel->get_caso_detalles($id_caso);
		// Si el caso tiene cotizacion
		if (!is_null($caso->folio_cotizacion)) {
			$cotizacion 	= $this->cotizacionModel->get_cotizacion_cliente(array('*'), array('ejecutivos'), $caso->folio_cotizacion);
			// Detalles de la cotizacion/caso
			$detalles_cotizacion = json_decode($cotizacion->cotizacion);
			$detalle_caso = array();
			foreach ($detalles_cotizacion as $key => $listado) {
				array_push(
					$detalle_caso,
					array(
						'descripcion' => $listado->descripcion,
						'observacion' => ucfirst(mb_strtolower($listado->observacion, 'UTF-8'))
					)
				);
			}
			// URL para mostrar cotizacion
			$this->data['url_cotizacion'] = $this->cotizacionModel->get_url_cotizacion($cotizacion->id_cliente, $cotizacion->folio);
			$this->data['detalle_caso'] = $detalle_caso;
			$this->data['cotizacion'] 	= $cotizacion;
			$this->data['estatus_caso'] 		= id_estatus_gral_to_class_html($caso->id_estatus_general);
			$this->data['estatus_cotizacion'] = id_estatus_to_class_html($cotizacion->id_estatus_cotizacion);
		}

		// Total comentarios por tarea
		$tareas = $this->tareaModel->get_tareas_caso($id_caso);
		foreach ($tareas as $index => $tarea) {
			$tareas[$index]->total_notas = count($this->notastareaModel->get('*', array('id_tarea' => $tarea->id_tarea, 'privacidad' => 'publica')));
		}

		$this->data['tareas'] 		= $tareas;
		$this->data['ejecutivos'] 	= $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
		$this->data['caso'] 			= $caso;
		$this->_vista('detalle-caso');
	}

	public function notas($id_tarea)
	{
		$this->load->model('notastareaModel');
		$this->load->helper('formatofechas_helper');

		$notas = $this->notastareaModel->get('*', array('id_tarea' => $id_tarea, 'privacidad' => 'publica'));
		$this->data['notas'] = $notas;
		$this->_vista_completa('cotizacion/notas-modal');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */