<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PrivilegiosModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'privilegios';

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file privilegioaModel.php */
/* Location: ./application/models/privilegioaModel.php */