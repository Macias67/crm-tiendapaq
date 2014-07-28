<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class observacionCotizacionModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'observaciones';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

}

/* End of file observacionModel.php */
/* Location: ./application/models/observacionModel.php */