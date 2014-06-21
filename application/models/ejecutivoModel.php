<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EjecutivoModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'ejecutivos';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file ejecutivoModel.php */
/* Location: ./application/models/ejecutivoModel.php */