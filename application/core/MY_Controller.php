<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

/**
 * Controlador abstracto
 *
 * @author Luis Macias
 **/
abstract class AbstractController extends CI_Controller
{
	
	/**
	 * Variable para mostrar valores
	 * en las vistas
	 *
	 * @var array
	 **/
	public $data = [];
	
	/**
	 * Variable para saber que privilegios
	 * tiene el usuario activo
	 *
	 * @var string
	 **/
	protected $privilegios = 'publico';
	
	/**
	 * Variable para saber que controlador
	 * estoy utilizando, me sirve para dirigir
	 * a la ruta de la vista correspondiente
	 *
	 * @var string
	 **/
	protected $controlador;
	
	/**
	 * Variable con los nombre de los estados
	 * de México
	 *
	 * @var array
	 **/
	
	public $estados = [
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
	];
	
	/**
	 * Patron para el titulo en las vistas
	 *
	 * @var string
	 **/
	const TITULO_PATRON = ' | TiendaPAQ';
	
	/**
	 * Ruta avatar
	 *
	 * @var string
	 **/
	//const RUTA_AVATAR = 'assets/admin/pages/media/profile/';
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->config->load('environment');
		// Variables de entorno
		$this->data['nombre_empresa'] = $this->config->item('nombre_empresa');
		$this->data['logo_app'] = $this->config->item('logo_app');
		$this->data['logo_email'] = $this->config->item('logo_email');
		$this->data['fan_page'] = $this->config->item('fan_page');
		$this->data['youtube_channel'] = $this->config->item('youtube_channel');
		$this->data['email_empresa'] = $this->config->item('email_empresa');
		$this->data['email_empresa_encuesta'] = $this->config->item('email_empresa_encuesta');
		
		$this->data['email_cotizacion_server'] = $this->config->item('email_cotizacion_server');
		$this->data['email_notificacion_server'] = $this->config->item('email_notificacion_server');
		$this->data['email_encuestas_server'] = $this->config->item('email_encuestas_server');
		$this->data['email_recovery_server'] = $this->config->item('email_recovery_server');
		$this->data['email_eventos_server'] = $this->config->item('email_eventos_server');
		//Fijar zona horaria para el momento de obtener fechas y horas
		date_default_timezone_set('America/Mexico_City');
		// global
		$this->data['assets_global_css'] = site_url('assets/global/css') . '/';
		$this->data['assets_global_img'] = site_url('assets/global/img') . '/';
		$this->data['assets_global_plugins'] = site_url('assets/global/plugins') . '/';
		$this->data['assets_global_scripts'] = site_url('assets/global/scripts') . '/';
		// admin/layout
		$this->data['assets_admin_layout'] = site_url('assets/admin/layout') . '/';
		$this->data['assets_admin_layout3'] = site_url('assets/admin/layout3') . '/';
		// admin/pages
		$this->data['assets_admin_pages'] = site_url('assets/admin/pages') . '/';
		// admin/pages
		$this->data['assets_admin_pages_myscripts'] = site_url('assets/admin/pages/myscripts') . '/';
		// Controlador que estoy usando actualmente
		$this->controlador = strtolower(get_class($this));
		$this->data['privilegios'] = $this->privilegios; // Paso que privilegios tiene el usuario al array data para la vista
		$this->data['controlador'] = $this->controlador; // Paso que controlador se usa al array data para la vista
	}
	
	/**
	 * Obtengo la medidas del monitor
	 **/
	public function cookiescreen()
	{
		if ($this->input->is_ajax_request())
		{
			$alto = $this->input->post('alto');
			$ancho = $this->input->post('ancho');
			$domain = substr($this->input->server('SERVER_NAME'), 4);
			// Cargo libreria cookie
			$this->load->helper('cookie');
			$this->input->set_cookie('screen_size', $alto . '-' . $ancho, 0, $domain, '/');
		}
	}
	
	/**
	 * Funcion para mostrar alguna vista completa
	 *
	 * @param  string     $vista Nombre de la vista
	 * @param bool|string $html  Si  retorna el html stng
	 *
	 * @return string
	 */
	protected function _vista_completa($vista, $html = false)
	{
		if ($html)
		{
			$vista = $this->load->view($this->privilegios . '/general/full-pages/' . $vista, $this->data, true);
			
			return $vista;
		}
		else
		{
			$this->load->view($this->privilegios . '/general/full-pages/' . $vista, $this->data);
		}
	}
	
	/**
	 * Funcion para mostrar alguna vista
	 *
	 * @param  string $privilegios Nombre del los privilegios que tenie el usuario
	 * @param  string $controlador El controlador que se esta utilizando
	 * @param  string $vista       Nombre de la vista
	 */
	protected function _vista($vista)
	{
		if ($this->privilegios == 'publico')
		{
			$this->load->view($this->privilegios . '/' . $this->controlador . '/head/head', $this->data);
			$this->load->view($this->privilegios . '/general/header', $this->data);
			$this->load->view($this->privilegios . '/' . $this->controlador . '/container/' . $vista, $this->data);
			$this->load->view($this->privilegios . '/general/pre-footer', $this->data);
			$this->load->view($this->privilegios . '/' . $this->controlador . '/footer/footer', $this->data);
		}
		else
		{
			$this->load->view($this->privilegios . '/' . $this->controlador . '/head/head', $this->data);
			$this->load->view($this->privilegios . '/general/header/header', $this->data);
			$this->load->view($this->privilegios . '/general/sidebar/sidebar', $this->data);
			$this->load->view($this->privilegios . '/' . $this->controlador . '/container/' . $vista, $this->data);
			$this->load->view($this->privilegios . '/general/quick-sidebar/quick-sidebar', $this->data);
			$this->load->view($this->privilegios . '/' . $this->controlador . '/footer/footer', $this->data);
		}
	}
	
	abstract function index();
}

/**
 * Controlador abstracto para el
 * manejo de las vistas antes de ser
 * logueadas.
 */
abstract class AbstractAccess extends AbstractController
{
	
	/**
	 * Variable que almacena los datos
	 * de un usuario logueado en una
	 * sesión
	 *
	 * @var array
	 **/
	protected $usuario_activo;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->usuario_activo = @$this->session->userdata('usuario_activo'); // Asignamos el item 'usuario_activo' a la variable
		$this->privilegios = $this->usuario_activo['privilegios']; // Privilegios del usuario activo
		$this->data['privilegios'] = $this->privilegios; // Paso que privilegios tiene el usuario al array data para la vista
		$this->data['usuario_activo'] = $this->usuario_activo; // Paso los datos del admin al array data para la vista
	}
	
	/**
	 * Funcion llamada antes de cualquier
	 * otra, la utilizo para verficar que exista
	 * una sesion de admin activa y para no guardar la
	 * cache
	 *
	 * @param  [string] [$method] [Nombre del metodo que se llamo]
	 * @param  [array] [$params] [Contiene todos los parametros que se pasan]
	 *
	 * @return [function] [Llama la funcion solicitada]
	 *
	 **/
	public function _remap($method, $params = [])
	{
		if (method_exists($this, $method))
		{
			// SI el metodo ($method) que llamo son difrentes a cualquiera de estos
			// entonces llamos a _admin() para validar que haya una sesion activa
			$this->_admin();
			
			return call_user_func_array([$this, $method], $params);
		}
		else
		{
			redirect('/login');
		}
	}
	
	/**
	 * Valida si se ha iniciado la sesión o no, o si el usuario
	 * logueado esta en el ambito correcto,
	 * redirecionar a login en caso contrario
	 *
	 **/
	private function _isLogin()
	{
		if (!@$this->usuario_activo || $this->usuario_activo['privilegios'] != $this->privilegios)
		{
			redirect('/login');
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
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
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
		//$this->_no_cache();
		$this->_isLogin();
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */