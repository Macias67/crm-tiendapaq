<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ejecutivo extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//cargo los modelos a usar
		$this->load->model('privilegiosModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('departamentoModel');
	}
	public function index()
	{}

	public function nuevo()
	{
		// Titulo header
		$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
		//Vista de formulario a mostrar
		$this->data['tablaprivilegios']= $this->privilegiosModel->get(array('privilegios'));
		$this->data['tabladepartamentos']= $this->departamentoModel->get(array('area'));
		$this->_vista('form-nuevo-ejecutivo');
	}


	public function add()
	{
		//Se establecen las reglas de validacion
		//Datos Personales
		$this->form_validation->set_rules('primer_nombre', 'Primer Nombre', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('segundo_nombre', 'Segundo Nombre', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|max_length[50]|xss_clean|callback_email_check');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[14]|xss_clean');
		//Datos del Sistema
		$this->form_validation->set_rules('oficina', 'Oficina', 'trim|required|xss_clean');
		$this->form_validation->set_rules('privilegios', 'Privilegios', 'trim|required|xss_clean');
		$this->form_validation->set_rules('departamento', 'Departamento', 'trim|required|xss_clean');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|max_length[20]|xss_clean|callback_usuario_check');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|max_length[20]|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			// SI es FALSO, guardo la respuesta
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else {
			// Array con la informacion
				$data = array(
					//Datos Personales
					'primer_nombre'  	 => $this->input->post('primer_nombre'),
					'segundo_nombre'	 => $this->input->post('segundo_nombre'),
					'apellido_paterno' => $this->input->post('apellido_paterno'),
					'apellido_materno' => $this->input->post('apellido_materno'),
					'email'				     => $this->input->post('email'),
					'telefono'       	 => $this->input->post('telefono'),
					//Datos del Sistema
					'oficina'	      => $this->input->post('oficina'),
					'privilegios'		=> $this->input->post('privilegios'),
					'departamento'	=> $this->input->post('departamento'),
					'usuario'				=> $this->input->post('usuario'),
					'password'			=> $this->input->post('password')
				);

				$ejecutivo_nuevo = $this->ejecutivoModel->arrayToObject($data);
				$exito_ejecutivo = $this->ejecutivoModel->insert($ejecutivo_nuevo);


				$respuesta = array(
						'exito' => $exito_ejecutivo,
						'ejecutivo' => $ejecutivo_nuevo);

		}

		// Muestro la salida
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
	}

	public function edit()
	{
		echo 'hola kokin';
	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Callback para revisar que no se repitan registros
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function usuario_check($usuario)
	{
		// SI el frc y la razon social se repiten
		if ($this->ejecutivoModel->exist(array('usuario' => $usuario))) {
			$this->form_validation->set_message('usuario_check', 'El nombre de usuario ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function email_check($email)
	{
		// SI el frc y la razon social se repiten
		if ($this->ejecutivoModel->exist(array('email' => $email))) {
			$this->form_validation->set_message('email_check', 'El email ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

/* End of file ejecutivos.php */
/* Location: ./application/controllers/ejecutivos.php */