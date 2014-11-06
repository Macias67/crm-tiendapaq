<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para menenjar las cotizaciones
 * del lado del cliente
 *
 * @package default
 * @author Luis Macias
 **/
class Cotizacion extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cotizacionModel');
	}

	public function index()
	{

	}

	public function detalles($folio)
	{
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($folio)) {
			$this->data['cotizacion'] = $cotizacion;
			$this->_vista_completa('detalle-cotizacion');
		} else {
			show_404();
		}
	}

	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function previapdf()
	{
		$folio =$this->input->post('folio');

		if ($existe = $this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('/clientes/'.$this->usuario_activo['id'].'/cotizacion').'/';
			$name		= 'cotizacion-'.$folio.'.pdf';
			$path		= $dir_root.$name;
			$response 	= array('existe' => $existe, 'ruta' => $path);
		} else {
			$response 	= array('existe' => $existe);
		}
		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function comprobante($folio)
	{
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($folio)) {
			$this->load->model('estatusCotizacionModel');
			$this->data['cotizacion'] = $cotizacion;
			if ($cotizacion->id_estatus_cotizacion == $this->estatusCotizacionModel->PORPAGAR)
			{
				$this->_vista('formulario');
			} else
			{
				$this->load->helper('directory');
				$archivos = directory_map('./clientes/'.$this->usuario_activo['id'].'/comprobantes/'.$folio.'/', 1);
				// Descarto la carpeta de las thumnail
				foreach ($archivos as $index => $archivo) {
					if ($archivos[$index] == 'thumbnail') {
						unset($archivos[$index]);
					}
				}
				$this->data['archivos'] = $archivos;
				$this->_vista('archivos');
			}
		} else {
			show_404();
		}
	}

	public function ajax($cliente, $folio)
	{
		error_reporting(E_ALL | E_STRICT);
		$params = array(
			'script_url' 			=> site_url('cotizacion/ajax/'.$cliente.'/'.$folio),
			'upload_dir' 		=> dirname($this->input->server('SCRIPT_FILENAME')).'/clientes/'.$cliente.'/comprobantes/'.$folio.'/',
			'upload_url' 		=> site_url('clientes/'.$cliente.'/comprobantes/'.$folio).'/',
			'max_number_of_files' 	=> 3,
			'accept_file_types'		=> '/\.(gif|jpe?g|png|pdf)$/i',
			'image_file_types'		=> '/\.(gif|jpe?g|png)$/i',
			'min_width'				=> 1024,
			'min_height'			=> 768,
			'image_versions'	=> array(
				'' => array(
					'auto_orient'	=> true,
					'crop' 			=> false,
					'max_width'	=> 1024,
					'max_height'	=> 768
				),
				// 'medium' => array(
				// 	'crop' 			=> true,
				// 	'max_width'	=> 1024,
				// 	'max_height'	=> 768
				// ),
				'thumbnail' => array(
					'auto_orient'	=> true,
					'crop' 			=> true,
					'max_width'	=> 200,
					'max_height'	=> 150
				)
			)
		);
		$this->load->library("UploadHandler", $params);
	}

	public function estado()
	{
		$this->load->model('estatusCotizacionModel');
		$this->load->helper('directory');

		$folio = $this->input->post('folio');

		$archivos = directory_map('./clientes/'.$this->usuario_activo['id'].'/comprobantes/'.$folio.'/');

		if (empty($archivos))
		{
			$response = array('exito' => FALSE, 'msj' => 'Tienes que agregar mínimo un archivo para comprobar tu pago.');
		} else
		{
			if ($this->cotizacionModel->exist(
				array('folio' => $folio, 'id_estatus_cotizacion' => $this->estatusCotizacionModel->PORPAGAR)))
			{
				$exito = $this->cotizacionModel->update(
					array('id_estatus_cotizacion' => $this->estatusCotizacionModel->REVISION),
					array('folio' => $folio));
				$response = array('exito' => $exito);
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));

	}

	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function descarga($folio)
	{
		$this->load->helper('download');

		if ($this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('/clientes/'.$this->usuario_activo['id'].'/cotizacion').'/';
			$name		= 'cotizacion-'.$folio.'.pdf';
			$path 	= $dir_root.$name;
			force_download($name, file_get_contents($path));
		}
	}
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */