<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo para manipular la tabla
 * encuesta
 *
 * @author Luis Macias
 **/
class encuestaModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'encuestas';

	public function __construct() {
		parent::__construct();
		$this->table	= self::TABLE;
	}
}

/* End of file encuestaModel.php */
/* Location: ./application/models/encuestaModel.php */