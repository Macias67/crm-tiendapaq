<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesionmodel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'sesiones';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}
}

/* End of file sesionmodel.php */
/* Location: ./application/models/sesionmodel.php */