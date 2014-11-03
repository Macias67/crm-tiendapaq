<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para ver el listado de cotizaciones
 *
 * @author Diego Rodriguez
 **/
class Cotizacion extends AbstractAccess {


	// public function __construct()
	// {
	// 	parent::__construct();
	// }

	/**
	 * Vista Principal
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->_vista('cotizaciones');
	}

}

/* End of file cotizador.php */
/* Location: ./application/controllers/cotizador.php */