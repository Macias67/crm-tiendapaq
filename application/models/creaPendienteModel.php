<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class creaPendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'crea_pendiente';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file creaPendienteModel.php */
/* Location: ./application/models/creaPendienteModel.php */