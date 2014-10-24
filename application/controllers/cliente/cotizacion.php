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
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */