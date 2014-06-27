<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EquiposComputoModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'equipos_computo';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $contacto_clientes
	 **/
	private $equipos_cliente;

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
		$this->equipos_cliente = new stdClass();

		$this->equipos_cliente->id_cliente 				= $id_cliente;
		$this->equipos_cliente->nombre_equipo 		= $data['nombre_equipo'];
		$this->equipos_cliente->sistema_operativo = $data['sistema_operativo'];
		$this->equipos_cliente->arquitectura 			= $data['arquitectura'];
		$this->equipos_cliente->maquina_virtual 	= $data['maquina_virtual'];
		$this->equipos_cliente->memoria_ram 			= $data['memoria_ram'];
		$this->equipos_cliente->sql_server 				= $data['sql_server'];
		$this->equipos_cliente->sql_management 		= $data['sql_management'];
		$this->equipos_cliente->instancia_sql 		= $data['instancia_sql'];
		$this->equipos_cliente->password_sql 			= $data['password_sql'];

		return $this->equipos_cliente;
	}

}

/* End of file equiposComputoModel.php */
/* Location: ./application/models/equiposComputoModel.php */