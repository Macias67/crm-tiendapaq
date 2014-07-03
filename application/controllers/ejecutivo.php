<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de ejecutivos y sus funciones
 *
 * @author Diego Rodriguez
 **/
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

		//cargamos la lista de departamentos para mostrarla en un select en la vista perfil
		$this->data['tabladepartamentos']= $this->departamentoModel->get(array('area'));
	}

	public function index()
	{}

	/**
	 * Funcion para mostrar el perfil del usuario
	 *
	 * @author Diego Rodriguez
	 **/
	public function perfil()
	{
		$this->_vista('perfil');
		//var_dump($this->data);
	}

	public function nuevo()
	{
		// Titulo header
		$this->data['titulo'] = $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
		//Vista de formulario a mostrar
		$this->data['tablaprivilegios']= $this->privilegiosModel->get(array('privilegios'));
		$this->data['tabladepartamentos']= $this->departamentoModel->get(array('area'));
		$this->_vista('form-nuevo-ejecutivo');
	}

	/**
	 * Funcion para añadir un nuevo
	 * ejecutivo a la BD
	 *
	 * @author Diego Rodriguez
	 **/
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

				$ejecutivo_nuevo = $this->ejecutivoModel->arrayToObject($data, FALSE);
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

	/**
	 * Funcion para editar los datos un ejecutivo
	 * respectivamente info general, contraseñas o imegenes
	 * en su perfil e insertarlo a la BD
	 *
	 * @author Diego Rodriguez
	 **/
	public function edit($accion=null)
	{
		switch ($accion) {

			case 'info':
				//Se establecen las reglas de validacion
				//Datos Personales
				$this->form_validation->set_rules('primer_nombre', 'Primer Nombre', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('segundo_nombre', 'Segundo Nombre', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[14]|xss_clean');
				//Datos del Sistema
				$this->form_validation->set_rules('oficina', 'Oficina', 'trim|required|xss_clean');

				$this->form_validation->set_rules('departamento', 'Departamento', 'trim|required|xss_clean');
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
							'oficina'	     	  => $this->input->post('oficina'),
							'departamento'		=> $this->input->post('departamento'),
							'mensaje_personal' => $this->input->post('mensaje_personal')
						);

						$ejecutivo_editado = $this->ejecutivoModel->arrayToObject($data, TRUE);
						$usuario = $this->data['usuario_activo']['usuario'];

						$exito_editado = $this->ejecutivoModel->update($ejecutivo_editado,array('usuario' => $usuario));

						$ejecutivo_actualizado = $this->ejecutivoModel->get_where(array('usuario' => $usuario));
						$ejecutivo_actualizado = (array)$ejecutivo_actualizado;
						$this->session->set_userdata('usuario_activo', $ejecutivo_actualizado);

						$respuesta = array(
								'exito' => $exito_editado,
								'ejecutivo' => $ejecutivo_editado,
								'usuario' => $usuario);
				}

				// Muestro la salida
				$this->output
						->set_content_type('application/json')
						->set_output(json_encode($respuesta));
			break;

			//IMAGENES

			case 'img':

				// Reglas de validacion
				$this->form_validation->set_rules('userfile', 'Avatar',
					'file_required|file_min_size[10KB]|file_max_size[2MB]|file_allowed_type[image]|file_image_mindim[100,100]|file_image_maxdim[1200,1200]');
				// Validacion
				if ($this->form_validation->run() === FALSE)
				{
					// La forma de mostrar los errores
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error: </strong>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
						' <b><a href="'.site_url('perfil#avatar').'" style="color:red">(Intentar de nuevo)</a></b></div>');
					// Muestro vista con errores
					$this->_vista('perfil');
				}
				else
				{
				// 	// Cargo helper form
				// 	$this->load->helper('form');
				// 	//establecemos las rutas para guardar la imagen
				// 	$users		= 'users';
				// 	$Dir		= $this->data['usuario_activo']['usuario'].'_img';
				// 	$imgDir	= $users.'/'.$Dir.'/';
				// 	// Si no existe la carpeta la creamos
				// 	if (!is_dir($imgDir)) {
				// 		mkdir($imgDir, 0777, TRUE);
				// 	}
				// 	//Configuracion para la subida del archivo
				// 	$config_upload['upload_path']		= $imgDir;
				// 	$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG';
				// 	$config_upload['overwrite'] 		= TRUE;
				// 	$config_upload['remove_spaces']	= TRUE;
				// 	$config_upload['max_size']      = 1024;
				// 	$config_upload['file_name']     = 'img_perfil.jpg';
				// 	// Cargo libreria upload
				// 	$this->load->library('upload', $config_upload);
				// 	// Si no es exitosa la subida
				// 	if (!$this->upload->do_upload()) {
				// 		// Formato para mostrar los mensajes de error
				// 		$this->data['upload_error'] = $this->upload->display_errors('<p>',
				// 			'</p>');
				// 		// Muestro vista de nuevo con errores de subida
				// 		//var_dump($this->data['upload_error']);
				// 		$respuesta = array(
				// 				'exito' => FALSE,
				// 				'msg' => $this->data['upload_error']);
				// 	} else {
				// 		$respuesta = array(
				// 				'exito' => TRUE,
				// 				'usuario' => $this->data['usuario_activo']['usuario']);
				// 	}

				// 	//Muestro la salida
				// $this->output
				// 		->set_content_type('application/json')
				// 		->set_output(json_encode($respuesta));}
			}
			break;
			case 'password':
				echo "hola kokin ;)";
			break;

			default:
			break;
		}
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