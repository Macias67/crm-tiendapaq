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
		$folio =$this->input->post('folio');

		$dir_root	= site_url('/clientes/'.$this->usuario_activo['id'].'/cotizacion').'/';
		$name		= 'cotizacion-'.$folio.'.pdf';
		$path 	= $dir_root.$name;

		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('ruta' => $path, 'id_cliente' => $this->usuario_activo['id'])));
	}

	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function descargarpdf()
	{
		$this->load->helper('download');

		$folio =$this->input->post('folio');

		$dir_root	= site_url('/clientes/'.$this->usuario_activo['id'].'/cotizacion').'/';
		$name		= 'cotizacion-'.$folio.'.pdf';
		$path 	= $dir_root.$name;

		//force_download($name, file_get_contents($path));
		require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
		$html2pdf = new HTML2PDF('P','LETTER','es');
		$html2pdf->Output($path, 'D');
	// 	//mando la repuesta
	// 	$this->output
	// 		->set_content_type('application/json')
	// 		->set_output(json_encode(array('ruta' => $path, 'folio' => $folio)));
	 }
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */