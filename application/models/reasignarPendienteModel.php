<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Modelo para la reasignacion de pendientes guarde un historial
 *
 * @package default
 * @author  Diego Rodriguez
 **/
class reasignarPendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'reasignacion_pendiente';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

}

/* End of file estatusModel.php */
/* Location: ./application/models/estatusModel.php */