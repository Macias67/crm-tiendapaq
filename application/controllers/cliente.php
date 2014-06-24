<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de clientes y sus funciones
 *
 * @author Diego Rodriguez | Luis Macias
 **/
class Cliente extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clientemodel');
	}

	public function index()
	{}

	/**
	 * Funcion para añadir un nuevo
	 * cliente a la BD
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function add()
	{
		//Reglas de formularios
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|strtoupper|max_length[15]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|strtolower|valid_email|xss_clean');
		$this->form_validation->set_rules('calle', 'Calle', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('colonia', 'Colonia', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('codigo_postal', 'Código Postal', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('minucipio', 'Municipio', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('pais', 'País', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('telefono_1', 'Teléfono 1', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('telefono_2', 'Teléfono 2', 'trim|required|max_length[14]');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		//$this->_vista($this->privilegios, $this->controlador,'form-nuevo-cliente');
	}

	/**
	 * Metodo para mostrar las empresas
	 * de menera de JSON
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json()
	{
		$query	= $this->input->post('q');
		$limit 	= $this->input->post('page_limit');

		if (isset($query) && isset($limit)) {
			$resultados = $this->clientemodel->get_like(
				array('codigo','razon_social'),
				'razon_social',
				$query,
				'razon_social',
				'ASC',
				$limit);
			$res = array();
			if (!empty($resultados)) {
				foreach ($resultados as $value) {
					array_push($res, array("text" => $value->razon_social, "id" => (int)$value->codigo));
				}
			}
			//add the header here
			header('Content-Type: application/json');
			echo json_encode($res);
		}
	}

}

/* End of file cliente.php */
/* Location: ./application/controllers/cliente.php */