<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TareaModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'tareas';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file tareamodel.php */
/* Location: ./application/models/tareamodel.php */