<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador abstracto
 *
 * @author Luis Macias
 **/
abstract class AbstractController extends CI_Controller {

	/**
	 * Variable para mostrar valores
	 * en las vistas
	 *
	 * @var array
	 **/
	public $data = array();

	/**
	 * Variable con los nombre de los estados
	 * de México
	 *
	 * @var array
	 **/

	public $estados = array(
			"Aguascalientes",
			"Baja California",
			"Baja California Sur",
			"Campeche",
			"Chiapas",
			"Chihuahua",
			"Coahuila",
			"Colima",
			"Distrito Federal",
			"Durango",
			"Estado de México",
			"Guanajuato",
			"Guerrero",
			"Hidalgo",
			"Jalisco",
			"Michoacán",
			"Morelos",
			"Nayarit",
			"Nuevo León",
			"Oaxaca",
			"Puebla",
			"Querétaro",
			"Quintana Roo",
			"San Luis Potosí",
			"Sinaloa",
			"Sonora",
			"Tabasco",
			"Tamaulipas",
			"Tlaxcala",
			"Veracruz",
			"Yucatán",
			"Zacatecas"
		);

	/**
	 * Patron para el titulo en las vistas
	 *
	 * @var string
	 **/
	const TITULO_PATRON = ' | TiendaPAQ';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		// global
		$this->data['assets_global_css']		= site_url('assets/global/css').'/';
		$this->data['assets_global_img']		= site_url('assets/global/img').'/';
		$this->data['assets_global_plugins']	= site_url('assets/global/plugins').'/';
		$this->data['assets_global_scripts']	= site_url('assets/global/scripts').'/';
		// admin/layout
		$this->data['assets_admin_layout']		= site_url('assets/admin/layout').'/';
		// admin/pages
		$this->data['assets_admin_pages']		= site_url('assets/admin/pages').'/';
		// admin/pages
		$this->data['assets_admin_pages_myscripts']		= site_url('assets/admin/pages/myscripts').'/';
	}

	/**
	 * Obtengo la medidas del monitor
	 **/
	public function cookiescreen()
	{
		$alto		= $this->input->post('alto');
		$ancho		= $this->input->post('ancho');
		$domain	= substr($this->input->server('SERVER_NAME'), 4);
		// Cargo libreria cookie
		$this->load->helper('cookie');
		$this->input->set_cookie('screen_size', $alto.'-'.$ancho, 0, $domain, '/');
	}

	abstract function index();
}

/**
 * Controlador abstracto para el
 * manejo de las vistas antes de ser
 * logueadas.
 */
abstract class AbstractAccess extends AbstractController {

	/**
	 * Variable que almacena los datos
	 * de un usuario logueado en una
	 * sesión
	 *
	 * @var array
	 **/
	protected $usuario_activo;

	/**
	 * Variable para saber que privilegios
	 * tiene el usuario activo
	 *
	 * @var string
	 **/
	protected $privilegios;

	/**
	 * Variable para saber que controlador
	 * estoy utilizando, me sirve para dirigir
	 * a la ruta de la vista correspondiente
	 *
	 * @var string
	 **/
	protected $controlador;

	/**
	 * Ruta avatar
	 *
	 * @var string
	 **/
	const RUTA_AVATAR = 'assets/admin/pages/media/profile/';


	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		// Asignamos el item 'usuario_activo' a la variable
		$this->usuario_activo = @$this->session->userdata('usuario_activo');
		// Privilegios del usuario activo
		$this->privilegios = $this->usuario_activo['privilegios'];
		// Controlador que estoy usando actualmente
		$this->controlador = strtolower(get_class($this));
		// Paso los datos del admin al array data para la vista
		$this->data['usuario_activo'] = $this->usuario_activo;
		// Paso que privilegios tiene el usuario al array data para la vista
		$this->data['privilegios'] = $this->privilegios;
		// Paso que controlador se usa al array data para la vista
		$this->data['controlador'] = $this->controlador;
	}

	/**
	 * Funcion llamada antes de cualquier
	 * otra, la utilizo para verficar que exista
	 * una sesion de admin activa y para no guardar la
	 * cache
	 *
	 * @param [string] [$method] [Nombre del metodo que se llamo]
	 * @param [array] [$params] [Contiene todos los parametros que se pasan]
	 * @return [function] [Llama la funcion solicitada]
	 *
	 **/
	public function _remap($method, $params = array())
	{
		if (method_exists($this, $method)) {
			// SI el metodo ($method) que llamo son difrentes a cualquiera de estos
			// entonces llamos a _admin() para validar que haya una sesion activa
			if ($method != 'login' && $method != 'validation' && $method != 'cookiescreen') {
				$this->_admin();
			}
			return call_user_func_array(array($this, $method), $params);
		} else {
			redirect('/login',  'refresh');
		}
	}

	/**
	 * Vista del formulario del logueo
	 * @param string $supervisor	Si el login es para cliente, aqui se inica de que supervisor viene.
	 **/
	protected function login()
	{
		// Datos para la vista de logueo
		$this->data['titulo'] 		= 'Bienvenido'.self::TITULO_PATRON;
		$this->data['encabezado']	= 'Bienvenido al Sistema';
		$this->data['descripcion'] 	= 'Administración de Relación con los Clientes.';
		$this->load->view('login/login', $this->data);
	}

	/**
	 * Funcion para cerra la sesion
	 * y redirecciona a login
	 **/
	protected function logout()
	{
		$this->session->unset_userdata('usuario_activo');
		$this->session->sess_destroy();
		redirect('/login',  'refresh');
	}

	/**
	 * Funcion para mostrar alguna vista completa
	 * @param  string $vista Nombre de la vista
	 * @param  string $html Si  retorna el html stng
	 */
	protected function _vista_completa($vista, $html = FALSE)
	{
		if ($html) {
			$vista = $this->load->view($this->privilegios.'/general/full-pages/'.$vista, $this->data, TRUE);
			return $vista;
		} else {
			$this->load->view($this->privilegios.'/general/full-pages/'.$vista, $this->data);
		}
	}

	/**
	 * Funcion para mostrar alguna vista
	 * @param  string $privilegios Nombre del los privilegios que tenie el usuario
	 * @param  string $controlador El controlador que se esta utilizando
	 * @param  string $vista Nombre de la vista
	 */
	protected function _vista($vista)
	{
		$this->load->view($this->privilegios.'/'.$this->controlador.'/head/head', $this->data);
		$this->load->view($this->privilegios.'/general/header/header', $this->data);
		$this->load->view($this->privilegios.'/general/sidebar/sidebar', $this->data);
		$this->load->view($this->privilegios.'/'.$this->controlador.'/container/'.$vista, $this->data);
		$this->load->view($this->privilegios.'/general/quick-sidebar/quick-sidebar', $this->data);
		$this->load->view($this->privilegios.'/'.$this->controlador.'/footer/footer', $this->data);
	}

	/**
	 * Funcion que recibe los valores desde AJAX (metodo POST)
	 * y hace la funcion de validación y logeo
	 *
	 **/
	protected function validation()
	{
		// Recibo varibles desde el AJAX
		$usuario	= $this->input->post('usuario');
		$password	= $this->input->post('password');
		$remember= $this->input->post('remember');
		// Si usuario y password no vienen nulas
		if (isset($usuario) && isset($password)) {
			$this->load->model('ejecutivoModel');
			$this->load->model('clienteModel');

			$ejecutivo = $this->ejecutivoModel->get(array(
				'id',
				'primer_nombre',
				'segundo_nombre',
				'apellido_paterno',
				'apellido_materno',
				'usuario','password',
				'privilegios'),
				array('usuario' => $usuario),null,'ASC',1);

			$cliente = $this->clienteModel->get_where(array('usuario' => $usuario));
			if($ejecutivo || $cliente)
			{
				// Validamos primero si ejectivo existe
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
						$dataUser = (array) $ejecutivo;
						//le añado la ruta de las imagenes a usuario activo
						$dataUser['ruta_imagenes'] = site_url(self::RUTA_AVATAR.$dataUser['id']).'/';
						// Añadimos los datos del Admin a 'usuario_activo' y los pasamos a la sesión
						$this->session->set_userdata('usuario_activo', $dataUser);
						$respuesta	= TRUE;
						$mensaje	= 'Bienvenido, espera unos segundos...';
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
						// Valido que los datos sean correcto
						if ($cliente->usuario == $usuario && $cliente->password == $password)
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
							$dataUser = (array) $cliente;
							// le añadimos el privilegio
							$dataUser['privilegios']="cliente";
							// le añado la ruta de las imagenes a usuario activo
							$dataUser['ruta_imagenes'] = site_url(self::RUTA_AVATAR.'cliente').'/';
							// Añadimos los datos del Admin a 'usuario_activo' y los pasamos a la sesión
							$this->session->set_userdata('usuario_activo', $dataUser);
							$respuesta	= TRUE;
							$mensaje	= 'Bienvenido, espera unos segundos...';
						}else
						{
							$respuesta	= FALSE;
							$mensaje	= 'La contraseña es incorrecta';
						}
					}
				}
			}else{
				$respuesta	= FALSE;
				$mensaje	= 'El usuario no existe';
			}
		}

		// Imprimo la respuesta
		echo json_encode(array('respuesta' => $respuesta, 'mensaje' => $mensaje));
	}

	/**
	 * Valida si se ha iniciado la sesión o no, o si el usuario
	 * logueado esta en el ambito correcto,
	 * redirecionar a login en caso contrario
	 *
	 **/
	private function _isLogin()
	{
		if (!@$this->usuario_activo || $this->usuario_activo['privilegios'] != $this->privilegios) {
			log_message('error','me redirecciona a login');
			log_message('error',$this->usuario_activo['privilegios']);
			log_message('error',$this->privilegios);
			redirect('/login',  'refresh');
		}
	}

	/**
	 * Establecemos cabezeras para evitar el almacenamiento en cache,
	 * esto debido a que despues de un logout() no queremos
	 * que la seccion de admin este guardada en cache y
	 * poder mirarla con el boton 'regreso' del navegador
	 *
	 */
	private function _no_cache()
	{
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
	}

	/**
	 * Funcion para validar y no
	 * guardar cache, usada en casi todos
	 * las funciones de la clase Admin
	 *
	 **/
	private function _admin()
	{
		$this->_no_cache();
		$this->_isLogin();
	}

	/*
	* FUNCIONES ABSTRACTAS
	 */
	abstract function add();
}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */