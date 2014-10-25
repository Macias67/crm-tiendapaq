<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para menenjar las cotizaciones
 * del lado del cliente
 *
 * @package default
 * @author Luis Macias
 **/
class Cotizacion extends AbstractAccess {

	public function index()
	{
		
	}

	public function detalles($folio)
	{
		$this->load->model('cotizacionModel');
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
		$this->load->model('productoModel');
		$this->load->model('cotizacionModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('clienteModel');

		$folio = $this->cotizacionModel->getSiguienteFolio();

		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$data_cliente[0]->id.'/cotizacion/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}
		$name		= 'cotizacion-'.$folio.'.pdf';
		$path 		= $dir_root.$name;

	}

	public function comprobante($folio)
	{
		$this->load->model('cotizacionModel');
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($folio)) {
			$this->data['cotizacion'] = $cotizacion;
			$this->_vista('formulario');
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
			// 'min_width'			=> 1024,
			// 'min_height'		=> 768,
			// 'image_versions'	=> array(
			// 	'' => array(
			// 		'auto_orient' => true
			// 	),
			// 	'medium' => array(
			// 		'crop' 			=> true,
			// 		'max_width'	=> 1024,
			// 		'max_height'	=> 768
			// 	),
			// 	'thumbnail' => array(
			// 		'crop' 			=> true,
			// 		'max_width'	=> 270,
			// 		'max_height'	=> 180
			// 	)
			// )
		);
		$this->load->library("UploadHandler", $params);
	}
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */