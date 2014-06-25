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
	}

	public function arrayToObject($data)
	{
		$this->cliente = new stdClass();

		$this->cliente->razon_social = $data['razon_social'];
		$this->cliente->rfc = $data['rfc'];
		$this->cliente->email = $data['email'];
		$this->cliente->tipo = $data['tipo'];
		$this->cliente->calle = $data['calle'];
		$this->cliente->no_exterior = $data['no_exterior'];
		$this->cliente->no_interior = $data['no_interior'];
		$this->cliente->colonia = $data['colonia'];
		$this->cliente->codigo_postal = $data['codigo_postal'];
		$this->cliente->ciudad = $data['ciudad'];
		$this->cliente->municipio = $data['municipio'];
		$this->cliente->estado = $data['estado'];
		$this->cliente->pais = $data['pais'];
		$this->cliente->telefono1 = $data['telefono1'];
		$this->cliente->telefono2 = $data['telefono2'];

		return $this->cliente;
	}

}

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */