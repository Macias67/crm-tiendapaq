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
	protected $data = array();

	/**
	 * Patron para el titulo en las vistas
	 *
	 * @var string
	 **/
	const TITULO_PATRON = ' | Metronic v 3.1.0';

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
	 * Nombre del controlador, lo uso
	 * para la redireccion
	 *
	 * @var string
	 **/
	protected $controller;

	/**
	 * Nombre de usuario con
	 * el que se identifica el admin.
	 *
	 * @var string
	 **/
	const USUARIO = 'tiendapaq';

	/**
	 * Password de usuario con
	 * el que se identifica el admin.
	 *
	 * @var string
	 **/
	const PASSWORD = 'gtsts1000';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		// Consigo nombre de la clase
		$this->controller = strtolower(get_class($this));
		// Asignamos el item 'usuario_activo' a la variable
		$this->usuario_activo = @$this->session->userdata('usuario_activo');
		// Paso los datos del admin al array data para la vista
		$this->data['usuario_activo'] = $this->usuario_activo;
		// Nombre del controlador
		$this->data['controlador'] = $this->controller;
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
			if ($method != 'login' && $method != 'validation' && $method != 'cookiescreen') {
				$this->_admin();
			}
			// Si es cliente y esta iniciada la sesion
			if ($this->controller == 'cliente' && isset($this->usuario_activo['codigo']) && !$this->usuario_activo['activo']) {
				if ($method != 'offline' && $method != 'logout') {
					redirect($this->controller.'/offline', 'refresh');
				}
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
	protected function login($supervisor = null)
	{
		switch ($this->controller) {
			case 'admin':
				$titulo			= 'Bienvenido'.self::TITULO_PATRON;
				$encabezado	= 'Bienvenido al Sistema';
				$descripcion	= 'Administración de Relación con los Clientes.';
				break;
			case 'supervisor':
				$titulo 		= 'Supervisor'.self::TITULO_PATRON;
				$encabezado	= 'Supervisión del Sistema';
				$descripcion	= '<i class="icon-warning-sign"></i> Solo acceso a personal <b>autorizado</b>.';
				break;
			case 'cliente':
				$titulo 		= 'Bienvenido'.self::TITULO_PATRON;
				$encabezado	= 'Bienvenido al Sistema';
				$descripcion	= 'Aplicación web para la elaboración de pedidos en línea.';
				$this->load->model('supervisormodel');
				// Si no existe tabla supervisores la creo
				if(!$this->supervisormodel->supervisorTableExists()) {
					$this->supervisormodel->createTableSupervisores();
				}
				// Si el paramatro $supervisor es NULL
				if (is_null($supervisor)) {
					// Obtengo empresas
					$empresas = $this->supervisormodel->get('empresa');
					// SI el array es vacio
					if(empty($empresas)) {
						// Redirecciona a admin login
						redirect('admin/login?i=1', 'refresh');
					} else {
						// Muestro empresas
						$this->data['empresas'] = $empresas;
					}
				} else {
					if($empresa = $this->supervisormodel->get('empresa', array('url_name' => $supervisor), null, null, 1)) {
						$this->data['empresa'] = $empresa->empresa;
					} else {
						show_404();
					}
				}
				break;
		}
		// Datos para la vista de logueo
		$this->data['titulo'] 		= $titulo;
		$this->data['encabezado']	=  $encabezado;
		$this->data['descripcion'] 	= $descripcion;
		$this->_vista_completa('login');
	}

	/**
	 * Funcion para cerra la sesion
	 * y redirecciona a login
	 **/
	protected function logout()
	{
		$this->session->unset_userdata('usuario_activo');
		$this->session->sess_destroy();
		redirect($this->controller.'/login',  'refresh');
	}

	/**
	 * Funcion para mostrar alguna vista
	 * @param  string $vista Nombre de la vista
	 * @param  string $html Si  retorna el html stng
	 */
	protected function _vista_completa($vista, $html = FALSE)
	{
		if ($html) {
			$vista = $this->load->view('admin/full-pages/'.$vista, $this->data, $html);
			return $vista;
		} else {
			$this->load->view('admin/full-pages/'.$vista, $this->data);
		}
	}

	/**
	 * Funcion para mostrar alguna vista
	 * @param  string $vista Nombre de la vista
	 * @param  string $folder Nombre del directorio de la vista
	 */
	protected function _vista($folder = '', $vista)
	{
		$this->load->view($folder.'/head/head', $this->data);
		$this->load->view($folder.'/header/header', $this->data);
		$this->load->view($folder.'/container/sidebar/sidebar', $this->data);
		$this->load->view($folder.'/container/content/'.$vista, $this->data);
		$this->load->view($folder.'/container/quick-sidebar/quick-sidebar', $this->data);
		$this->load->view($folder.'/footer/footer', $this->data);
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
		// Si existe el admin
		if ($usuario == self::USUARIO && $password == self::PASSWORD) {
			// Si selecciona recordar, agrego cookie para recordar el usuario
			if ($remember == 'true') {
				/*
				* APRUEBA PARA LA COOKIE DE RECUERDAME
				 */
				// $tiempo	= time()+60*60*24*30*6; // 6 Meses de duracion de la cookie
				// $this->session->sess_expiration = $tiempo;
				// $this->session->sess_expire_on_close = FALSE;
			}
			// Añadimos los datos del Admin a 'usuario_activo' y los pasamos a la sesión
			$this->session->set_userdata('usuario_activo', array('tipo' => $this->controller));
			$respuesta	= TRUE;
			$mensaje	= 'Bienvenido, espera unos segundos...';
		} else {
			$respuesta = FALSE;
			$mensaje 	= 'Usuario o contraseña inválidos.';
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
		if (!@$this->usuario_activo || $this->usuario_activo['tipo'] != $this->controller) {
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
}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */