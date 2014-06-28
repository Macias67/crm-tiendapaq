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
	 * @var $basica_clientes
	 **/
	private $basica_cliente;

/**
	 * Constructor
	 */
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
	public function arrayToObject($data, $tipo = null)
	{
		$this->basica_cliente = new stdClass();

			$this->basica_cliente->codigo 			 = date('dmHis');
			$this->basica_cliente->razon_social  = $data['razon_social'];
			$this->basica_cliente->email 				 = $data['email'];
			$this->basica_cliente->tipo 				 = "prospecto";
			$this->basica_cliente->calle 				 = $data['calle'];
			$this->basica_cliente->ciudad 			 = $data['ciudad'];
			$this->basica_cliente->estado 			 = $data['estado'];
			$this->basica_cliente->telefono1     = $data['telefono1'];

		if (!$tipo) {
				$this->basica_cliente->rfc 					 = $data['rfc'];
				$this->basica_cliente->tipo 				 = $data['tipo'];
				$this->basica_cliente->no_exterior 	 = $data['no_exterior'];
				$this->basica_cliente->no_interior 	 = $data['no_interior'];
				$this->basica_cliente->colonia 			 = $data['colonia'];
				$this->basica_cliente->codigo_postal = $data['codigo_postal'];
				$this->basica_cliente->municipio     = $data['municipio'];
				$this->basica_cliente->pais 				 = $data['pais'];
				$this->basica_cliente->telefono2     = $data['telefono2'];
		}

		return $this->basica_cliente;
	}

}

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */