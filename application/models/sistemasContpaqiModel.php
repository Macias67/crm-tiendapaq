<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemasContpaqiModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'sistemas_contpaqi';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $sistemas_clientes
	 **/
	private $sistema_contpaqi;

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

}

/* End of file sistemasTiendapaqi.php */
/* Location: ./application/models/sistemasTiendapaqi.php */