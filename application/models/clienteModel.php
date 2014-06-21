<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para la gestion de datos de los clientes
 *
 * @author Diego
 **/
class ClienteModel extends MY_Model {

/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'clientes';

/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */