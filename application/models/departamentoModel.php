<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DepartamentoModel extends MY_Model {

		/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'departamento';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file departamentoModel.php */
/* Location: ./application/models/departamentoModel.php */