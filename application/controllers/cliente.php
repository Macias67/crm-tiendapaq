<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clienteModel');
	}

	public function index()
	{
	}

	public function add()
	{
		//cargo la libreria
		$this->load->library('form_validation');
		//Reglas de formularios
		//Datos basicos
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required|strtolower|ucwords|max_length[80]|xss_clean');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|strtoupper|max_length[13]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|xss_clean');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		//Datos del domicilio
		$this->form_validation->set_rules('calle', 'Calle', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|strtolower|xss_clean');
		$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|strtolower|xss_clean');
		$this->form_validation->set_rules('colonia', 'Colonia', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('codigo_postal', 'Código Postal', 'trim|max_length[7]|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('minucipio', 'Municipio', 'trim|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|required|strtolower|ucwords|max_length[30]|xss_clean');
		$this->form_validation->set_rules('pais', 'País', 'trim|required|xss_clean');
		//Telefonos
		$this->form_validation->set_rules('telefono_1', 'Teléfono 1', 'trim|max_length[14]|xss_clean');
		$this->form_validation->set_rules('telefono_2', 'Teléfono 2', 'trim|max_length[14]');
		//Contacto
		$this->form_validation->set_rules('nombre_contacto', 'Nombre', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email_comtacto', 'Email', 'trim|strtolower|valid_email|max_length[30]|xss_clean');
		$this->form_validation->set_rules('telefono_contacto', 'Teléfono', 'trim|max_length[14]|xss_clean');
		$this->form_validation->set_rules('puesto_contacto', 'Puesto', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
		//Sistema Contpaq
		$this->form_validation->set_rules('sistema', 'Sistema', 'trim|xss_clean');
		$this->form_validation->set_rules('version', 'Versión', 'trim|xss_clean');
		$this->form_validation->set_rules('no_serie', 'No. de Serie', 'trim|xss_clean');
		//Info del equipo
		$this->form_validation->set_rules('nombre_equipo', 'Nombre del Equipo', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('sistema_operativo', 'Sistema Operativo', 'trim|xss_clean');
		$this->form_validation->set_rules('arquitectura', 'Arquitectura', 'trim|xss_clean');
		$this->form_validation->set_rules('maquina_virtual', 'Máquina Virtual', 'trim|xss_clean');
		$this->form_validation->set_rules('memoria_ram', 'Memoria RAM', 'trim|xss_clean');
		$this->form_validation->set_rules('sql_server', 'SQL Server', 'trim|xss_clean');
		$this->form_validation->set_rules('sql_management', 'SQL Server Management', 'trim|xss_clean');
		$this->form_validation->set_rules('instancia_sql', 'Instancia SQL', 'trim|max_length[50]|xss_clean');
		$this->form_validation->set_rules('password_sql', 'Contraseña SQL', 'trim|max_length[10]|xss_clean');
		// Validamos formulario
		if ($this->form_validation->run() === FALSE) {
			// SI es FALSO, vuelvo a mostrar vista
			echo json_encode(array('exito' => FALSE, 'msg' => validation_errors()));
		} else {
			// Array con la informacion
				$data = array(
					'razon_social'	=> $this->input->post('razon_social'),
					'rfc'			      => $this->input->post('rfc'),
					'email'			    => $this->input->post('email'),
					'tipo'			    => $this->input->post('tipo'),
					'calle'		      => $this->input->post('calle'),
					'no_exterior'		=> $this->input->post('no_exterior'),
					'no_interior'		=> $this->input->post('no_interior'),
					'colonia'		    => $this->input->post('colonia'),
					'codigo_postal'	=> $this->input->post('codigo_postal'),
					'ciudad'		    => $this->input->post('ciudad'),
					'minucipio'	  	=> $this->input->post('minucipio'),
					'estado'		    => $this->input->post('estado'),
					'pais'	        => $this->input->post('pais'),
					'telefono_1'		=> $this->input->post('telefono_1'),
					'telefono_2'		=> $this->input->post('telefono_2')
				);
				// convierto en arreglo de objetos
				$cliente = $this->clienteModel->toObject($data);
				// mando la insercion y extraigo el id
				// mando las demas inserciones

				echo json_encode(array('exito' => TRUE, 'cliente' => $cliente));
		//$this->_vista($this->privilegios, $this->controlador,'form-nuevo-cliente');
			}

	}
}

/* End of file cliente.php */
/* Location: ./application/controllers/cliente.php */