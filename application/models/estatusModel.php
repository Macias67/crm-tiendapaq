<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Modelo para estatus de los casos
 * y pendientes.
 *
 * @package default
 * @author Luis Macias | Diego Rodriguez
 **/
class estatusModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'estatus';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	var $CANCELADA	= 1;
	var $CERRADA		= 2;
	var $PENDIENTE	= 3;
	var $PRECIERRE	= 4;
	var $PROCESO		= 5;
	var $SUSPENDIDA	= 6;
	var $SUSTITUIDA	= 7;
}

/* End of file estatusModel.php */
/* Location: ./application/models/estatusModel.php */