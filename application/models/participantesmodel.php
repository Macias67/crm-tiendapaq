<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participantesmodel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'participantes';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

}

/* End of file participantesmodel.php */
/* Location: ./application/models/participantesmodel.php */