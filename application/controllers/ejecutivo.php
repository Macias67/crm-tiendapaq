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
		// Variable vacia para mostrar errores de subida
		$this->data['upload_error'] = '';
	}

	/**
	 * Metodo que se ejecuta al entrar al controlador ejecutivo
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->_vista('perfil');
	}

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

	/**
	 * Funcion para mostrar el formulario para crear
	 * un nuevo ejecutivo
	 *
	 * @author Diego Rodriguez
	 **/
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
		$this->form_validation->set_rules('primer_nombre',    'Primer Nombre',    'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('segundo_nombre',   'Segundo Nombre',   'trim|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('email',            'Email',            'trim|strtolower|valid_email|max_length[50]|xss_clean|callback_email_check');
		$this->form_validation->set_rules('telefono',         'Teléfono',         'trim|required|max_length[14]|xss_clean');
		//Datos del Sistema
		$this->form_validation->set_rules('oficina',      'Oficina',      'trim|required|xss_clean');
		$this->form_validation->set_rules('privilegios',  'Privilegios',  'trim|required|xss_clean');
		$this->form_validation->set_rules('departamento', 'Departamento', 'trim|required|xss_clean');
		$this->form_validation->set_rules('usuario',      'Usuario',      'trim|required|max_length[20]|xss_clean|callback_usuario_check');
		$this->form_validation->set_rules('password',     'Contraseña',   'trim|required|max_length[20]|xss_clean');
		//se ejecutan las reglas para ver si se cumplen
		if ($this->form_validation->run() === FALSE)
		{
			// SI es FALSO, guardo la respuesta y el error para mostrarlo
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
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
				//convierto array a objeto e inserto en la bd
				$ejecutivo_nuevo = $this->ejecutivoModel->arrayToObject($data, FALSE);
				$exito_ejecutivo = $this->ejecutivoModel->insert($ejecutivo_nuevo);
				//armo la respuesta
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
	 * respectivamente info general, contraseñas o imagenes
	 * en su perfil e insertarlo a la BD
	 *
	 * @author Diego Rodriguez | Luis Macias
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

				if ($this->form_validation->run() === FALSE) 
				{
					// SI es FALSO, guardo la respuesta
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
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
							'oficina'	     	   => $this->input->post('oficina'),
							'departamento'		 => $this->input->post('departamento'),
							'mensaje_personal' => $this->input->post('mensaje_personal')
						);
						//el parametro TRUE indica al metodo del modelo ejecutivoModel que se trata de una actualizacion no de un nuevo registro
						//Extraigo el usuario para saber donde actualizar los datos en la bd
						$ejecutivo_editado = $this->ejecutivoModel->arrayToObject($data, TRUE);
						$usuario = $this->data['usuario_activo']['usuario'];
						//actualizo en la bd y guardo la respuesta
						$exito_editado = $this->ejecutivoModel->update($ejecutivo_editado,array('usuario' => $usuario));
						//actualizo la variable usuario_activo con los nuevos datos
						$ejecutivo_actualizado = $this->ejecutivoModel->get_where(array('usuario' => $usuario));
						$ejecutivo_actualizado = (array)$ejecutivo_actualizado;
						$this->session->set_userdata('usuario_activo', $ejecutivo_actualizado);
						//armo la respuesta
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

			///////////////////////IMAGENES////////////////////////

			case 'img':
				// Reglas de validacion
				$this->form_validation->set_rules('userfile', 'El archivo',
					'file_required|file_min_size[10KB]|file_max_size[2MB]|file_allowed_type[imagen]|file_image_mindim[200,200]|file_image_maxdim[1600,1600]');
				// Validacion
				if ($this->form_validation->run() === FALSE)
				{
					// La forma de mostrar los errores
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error: </strong>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
						' <b><a href="'.site_url('ejecutivo/perfil#cambiar_imagen').'" style="color:red">(Intentar de nuevo)</a></b></div>');
					// Muestro vista con errores
					$this->_vista('perfil');
				}
				else
				{
					// Armo las rutas y nombres de la imagen segun usuario activo
					$usuario_activo	= $this->usuario_activo['usuario'];
					$ruta						= 'assets/admin/pages/media/profile/';
					$ruta_completa	= $ruta.$usuario_activo.'/';
					//Si no existe directorio lo creo
					if (!is_dir($ruta_completa))
					{
						mkdir($ruta_completa, 0777, TRUE);
					}
					//Configuracion para la subida del archivo
					$config_upload['upload_path']		= $ruta_completa;
					$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG';
					$config_upload['overwrite'] 		= TRUE;
					$config_upload['file_name']			= 'perfil.jpg';
					$config_upload['max_size']			= 2048;
					$config_upload['remove_spaces']	= TRUE;
					// Cargo la libreria upload y paso configuracion
					$this->load->library('upload', $config_upload);
					//SI NO se sube la imagen
					if (!$this->upload->do_upload())
					{
						// Envio a la variable los errores de subida
						$this->data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger"><strong>Error: </strong>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
							' <b><a href="'.site_url('ejecutivo/perfil#cambiar_imagen').'" style="color:red">(Intentar de nuevo)</a></b></div>');
						// Muestro vista con errores de subida
						$this->_vista('perfil');
					} else
					{
						// Paso datos de la subida del archivo
						$upload_data = $this->upload->data();
						// Si la imagen es mas de 800px se redimenciona
						if ($upload_data['image_width'] > 800 || $upload_data['image_height'] > 800)
					  {
							// Configuracion para el recorte
							$config_resize['image_library']		= 'gd2';
							$config_resize['source_image']	  = $upload_data['full_path'];
							$config_resize['maintain_ratio']	= TRUE;
							$config_resize['width']				    = 800;
							$config_resize['height']			    = 800;
							$this->load->library('image_lib', $config_resize);
							$this->image_lib->resize();
						}
						// DEBUG info del archivo subido ANTES DE RECORTARLO
						//$this->data['detalles_img']=$upload_data;
						$this->data['ruta_img'] = $ruta_completa.$upload_data['file_name'];
						//mando a la vista de recorte de imagen
						$this->_vista('recortar-imagen');
					}
			}
			break;
			case 'password':
				echo "hola kokin ;) aditando contraseña";
			break;

			default:
			break;
		}
	}

	/**
	 * Funcion recortar la imagen de
	 * perfil del ejecutivo
	 *
	 * @author Diego Rodriguez | Luis Macias
	 **/
		public function recortar()
		{
			//cargo la libreria
			$this->load->library('image_lib');
			//obtengo la ruta donde se encuentra la imagen base para crear las demas
			$src = $this->input->post('ruta_img');

			//obtengo los puntos claves del recorte
			$pos_x = $this->input->post('x');
			$pos_y = $this->input->post('y');
			$ancho = $this->input->post('w');
			$alto  = $this->input->post('h');

			//armo la ruta completa donde se guardaran las imagenes
			$usuario_activo	= $this->usuario_activo['usuario'];
			$ruta						= 'assets/admin/pages/media/profile/';
			$ruta_completa	= $ruta.$usuario_activo.'/';

			//reglas para crear la imagen de bloqueo de sesion
			$config_block['image_library'] = 'gd2';
			$config_block['source_image']  = $src;
			$config_block['width'] 				 = $alto;
			$config_block['height'] 			 = $ancho;
			$config_block['x_axis']        = $pos_x;
			$config_block['y_axis']        = $pos_y;
			$config_block['maintain_ratio']= FALSE;
			$config_block['new_image']     = $ruta_completa.'block.jpg';
			//reglas para la creacion de la imagen miniatura
			$config_miniatura['image_library'] = 'gd2';
			$config_miniatura['source_image']  = $ruta_completa.'block.jpg';
			$config_miniatura['width'] 				 = 29;
			$config_miniatura['height'] 			 = 29;
			$config_miniatura['new_image']    		 = $ruta_completa.'mini.jpg';
			//reglas para la creacion de la imagen de chat
			$config_chat['image_library'] = 'gd2';
			$config_chat['source_image']  = $ruta_completa.'block.jpg';
			$config_chat['width'] 				 = 45;
			$config_chat['height'] 			 = 45;
			$config_chat['new_image']    		 = $ruta_completa.'chat.jpg';

			//inicio las reglas de imagen de block
			$this->image_lib->initialize($config_block);
			//ejecuto el recorte y guardo el booleano
			$exito_block = $this->image_lib->crop();
			//limpio las reglas para hacer los redimencionados
			$this->image_lib->clear();
			$this->image_lib->initialize($config_miniatura);
			$exito_mini = $this->image_lib->resize();
			$this->image_lib->clear();
			$this->image_lib->initialize($config_chat);
			$exito_chat = $this->image_lib->resize();

			if(!$exito_block || !$exito_mini || !$exito_chat)
			{
				echo $this->image_lib->display_errors();
			}else
			{
				redirect('/ejecutivo/perfil', 'refresh');
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