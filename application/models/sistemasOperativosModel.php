<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para gestionar los sistemas operativos
 *
 * @package default
 * @author Diego Rodriguez
 **/
class SistemasOperativosModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'sistemas_operativos';

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file sistemasOperativosModel.php */
/* Location: ./application/models/sistemasOperativosModel.php */