<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para gestionar la tabla de los
 * sistemas del cliente
 *
 * @package default
 * @author Diego Rodriguez
 **/
class SistemasClienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'sistemas_clientes';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $sistemas_clientes
	 **/
	private $sistemas_cliente;

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	/**
	 * funcion para convertir un arreglo asociativo a un objeto
	 * con sus metodos
	 *
	 * @return $basica clientes
	 * @author Diego Rodriguez
	 **/
	public function arrayToObject($id_cliente, $data)
	{
		$this->sistemas_cliente = new stdClass();

		$this->sistemas_cliente->id_cliente		= $id_cliente;
		$this->sistemas_cliente->sistema		= $data['sistema'];
		$this->sistemas_cliente->version		= $data['version'];
		$this->sistemas_cliente->no_serie		= $data['no_serie'];

		return $this->sistemas_cliente;
	}

}

/* End of file sistemasModel.php */
/* Location: ./application/models/sistemasModel.php */