<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para la gestion de datos de los clientes
 *
 * @author Diego
 **/
class ClienteModel extends MY_Model {

/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'clientes';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $clientes
	 **/
	private $cliente;

/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
		$this->supervisor = new stdClass();
	}

	public function toObject($data)
	{
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->razon_social = $data['razon_social'];
	}

}

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */