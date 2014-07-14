<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para trabajar con la tabla oficinas de la bd
 *
 * @author Diego Rodriguez
 **/

class OficinasModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'oficinas';

		/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file oficinaModel.php */
/* Location: ./application/models/oficinaModel.php */