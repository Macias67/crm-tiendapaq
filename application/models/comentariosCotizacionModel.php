<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla comentarios_cotizacion
 *
 * @author Diego Rodriguez
 */
class ComentariosCotizacionModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'comentarios_cotizacion';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}


}

/* End of file bancoModel.php */
/* Location: ./application/models/bancoModel.php */