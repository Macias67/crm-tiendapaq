<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para gestionar los sistemas contpaqi
 *
 * @package default
 * @author Luis Macias
 **/
class SistemasContpaqiModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'sistemas_contpaqi';

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file sistemasTiendapaqi.php */
/* Location: ./application/models/sistemasTiendapaqi.php */