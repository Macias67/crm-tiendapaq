<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para llevar acabo la cotizacion
 * a un cliente
 *
 * @author Luis Macias
 **/
class Cotizador extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('productoModel');
	}

	public function index()
	{
		$this->_vista('index');
	}

	public function add()
	{}

	/**
	 * Metodo para mostrar las empresas
	 * de menera de JSON
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json($codigo = null)
	{
		if (is_null($codigo)) {
			$query	= $this->input->post('q');
			$limit 	= $this->input->post('page_limit');
			if (!empty($query) && !empty($limit)) {
				$resultados = $this->productoModel->get_like(
					array('codigo','nombre'),
					'nombre',
					$query,
					'nombre',
					'ASC',
					$limit);
				$res = array();
				if (!empty($resultados)) {
					foreach ($resultados as $value) {
						array_push($res, array("id" => $value->codigo, "text" => $value->nombre));
					}
				} else {
					$res = array("id"=>"0","text"=>"No se encontraron resultados...");
				}
			}
		} else {
			$res = $this->productoModel->get_like(
					array('*'),
					'codigo',
					$codigo,
					'nombre',
					'ASC',
					1);
			$res = $res[0];
		}

		// Muestro la salida
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($res));
	}
}

/* End of file cotizador.php */
/* Location: ./application/controllers/cotizador.php */