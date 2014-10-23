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

}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */