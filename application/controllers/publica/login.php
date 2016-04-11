<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends AbstractController {

	/**
	 * Vista del formulario del logueo
	 * @param string $supervisor	Si el login es para cliente, aqui se inica de que supervisor viene.
	 **/
	public function index()
	{
		// Datos para la vista de logueo
		$this->data['titulo'] 		= 'Bienvenido'.self::TITULO_PATRON;
		$this->data['encabezado']	= 'Bienvenido al Sistema';
		$this->data['descripcion'] 	= 'Administración de Relación con los Clientes.';
		$this->load->view('login/login', $this->data);
	}

	/**
	 * Funcion que recibe los valores desde AJAX (metodo POST)
	 * y hace la funcion de validación y logeo
	 *
	 **/
	public function validation()
	{
		if ($this->input->is_ajax_request()) {
			// Recibo varibles desde el AJAX
			$usuario	= $this->input->post('usuario');
			$password	= $this->input->post('password');
			$remember= $this->input->post('remember');
			// Si usuario y password no vienen nulas
			if (isset($usuario) && isset($password)) {
				$this->load->model('ejecutivomodel');
				$this->load->model('clientemodel');

				$ejecutivo = $this->ejecutivomodel->get_where(array('usuario' => $usuario));
				$cliente = $this->clientemodel->get_where(array('usuario' => $usuario));

				// Verifico si existe cliente o usuario
				if($ejecutivo || $cliente)
				{
					// Validamos primero si ejecutivo existe
					if ($ejecutivo)
					{
						// Valido que los datos sean correcto
						if ($ejecutivo->usuario == $usuario && $ejecutivo->password == $password)
						{
							// Si selecciona recordar, agrego cookie para recordar el usuario
							if ($remember == 'true')
							{
								/*
								* APRUEBA PARA LA COOKIE DE RECUERDAME
								 */
								// $tiempo	= time()+60*60*24*30*6; // 6 Meses de duracion de la cookie
								// $this->session->sess_expiration = $tiempo;
								// $this->session->sess_expire_on_close = FALSE;
								// $time 		= 60*60*24*30*6;
								// $domain 	= substr($this->input->server('SERVER_NAME'), 4);
								// $this->input->set_cookie('remember', 'true', $time, $domain, '/');
							}
							// Parseo objeto a array
							$datauser = (array) $ejecutivo;
							//le añado la ruta de las imagenes a usuario activo
							$datauser['ruta_imagenes'] = site_url('assets/admin/pages/media/profile/'.$datauser['id']).'/';
							// Añadimos los datos del Admin a 'usuario_activo' y los pasamos a la sesión
							$this->session->set_userdata('usuario_activo', $datauser);
							$respuesta	= TRUE;
							$mensaje	= 'Bienvenido, espera unos segundos...';
							$url 		= site_url('/');
						} else
						{
							$respuesta	= FALSE;
							$mensaje	= 'La contraseña es incorrecta';
						}
					} else
					{
						//si no existe ejecutivo validamos si existe cliente
						if($cliente)
						{
							// Valido que los datos sean correcto y QUE SEA CLIENTE ACTIVO
							if ($cliente->usuario == $usuario && $cliente->password == $password && $cliente->activo == 1)
							{
								// Si selecciona recordar, agrego cookie para recordar el usuario
								if ($remember == 'true')
								{
									/*
									* APRUEBA PARA LA COOKIE DE RECUERDAME
									 */
									// $tiempo	= time()+60*60*24*30*6; // 6 Meses de duracion de la cookie
									// $this->session->sess_expiration = $tiempo;
									// $this->session->sess_expire_on_close = FALSE;
									// $time 		= 60*60*24*30*6;
									// $domain 	= substr($this->input->server('SERVER_NAME'), 4);
									// $this->input->set_cookie('remember', 'true', $time, $domain, '/');
								}
								// Parseo objeto a array
								$datauser = (array) $cliente;
								// le añadimos el privilegio
								$datauser['privilegios']="cliente";
								// le añado la ruta de las imagenes a usuario activo
								$datauser['ruta_imagenes'] = site_url('assets/admin/pages/media/profile/cliente').'/';
								// Añadimos los datos del Admin a 'usuario_activo' y los pasamos a la sesión
								$this->session->set_userdata('usuario_activo', $datauser);
								$respuesta	= TRUE;
								$mensaje	= 'Bienvenido, espera unos segundos...';
								$url 		= site_url('/usuario');
							}else
							{
								$respuesta	= FALSE;
								$mensaje	= 'La contraseña es incorrecta ó es usuario desactivado';
							}
						}
					}
				}else{
					$respuesta	= FALSE;
					$mensaje	= 'El usuario no existe';
				}
			}
			// Imprimo la respuesta
			echo json_encode(array('respuesta' => $respuesta, 'mensaje' => $mensaje, 'url' => $url));
		}
	}

	/**
	 * Funcion para cerra la sesion
	 * y redirecciona a login
	 **/
	public function logout()
	{
		$this->session->unset_userdata('usuario_activo');
		$this->session->sess_destroy();
		redirect('/login',  'refresh');
	}

	/**
	 * Funcion que hace envio de un correo electronico
	 *  a un email recordando losdatos de logueo
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function recordar()
	{
		if ($this->input->is_ajax_request()) {
			$email = $this->input->post('email');
			$this->load->model('ejecutivoModel');
			$this->load->model('clienteModel');

			$ejecutivo 	= $this->ejecutivoModel->get_where(array('email' => $email));
			$cliente 	= $this->clienteModel->get_where(array('email' => $email));

			if (!empty($ejecutivo) || !empty($cliente)) {
				// Envio del email
				$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from($this->data['email_recovery_server'], 'Sistema de Recuperación');
				//$this->email->to($ejecutivo->email);
				//$this->email->cc('another@example.com');
				//$this->email->bcc('and@another.com');

				$this->email->subject('Datos de logueo CRM');
				// Contenido del correo dependiendo si fue cliente o ejecutivo
				if(empty($cliente)){
					$this->email->to($ejecutivo->email);
					$this->data['recordar'] = $this->ejecutivoModel->get(array('usuario', 'password'), array('email' => $email), null, 'ASC', 1);
				}else{
					$this->email->to($cliente->email);
					$this->data['recordar'] = $this->clienteModel->get(array('usuario', 'password'), array('email' => $email), null, 'ASC', 1);
				}

				$html = $this->load->view('admin/general/full-pages/email/email_login.php', $this->data,TRUE);
				$this->email->message($html);
				$this->email->send();

				$data = array(
				              'exito' => TRUE,
				              'mensaje' => 'Se ha enviado un correo al email indicado con los datos de logueo.',
				              'debugger' => $this->email->print_debugger());
			} else {
				$data = array('exito' => FALSE, 'mensaje' => 'No existe ningún usuario registrado con este email.');
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/publica/login.php */