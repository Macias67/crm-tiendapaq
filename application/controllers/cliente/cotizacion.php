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
		$this->data['folio'] = $folio;
		$this->_vista_completa('detalle-cotizacion')
	}

}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */