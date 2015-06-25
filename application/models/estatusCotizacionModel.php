<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para estatus de las cotizaciones
 *
 * @package default
 * @author Luis Macias | Diego Rodriguez
 **/
class estatusCotizacionModel extends CI_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'estatus_cotizacion';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	var $PORPAGAR		= 1;
	var $REVISION		= 2;
	var $PAGADO		= 3;
	var $IRREGULAR	= 4;
	var $VENCIDO		= 5;
	var $PARCIAL		= 6;
	var $CANCELADA	= 7;
	var $CXC			= 8;

}

/* End of file estatusCotizacionModel.php */
/* Location: ./application/models/estatusCotizacionModel.php */