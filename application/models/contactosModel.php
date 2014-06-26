<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactosModel extends MY_Model {

/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'contactos';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $contacto_clientes
	 **/
	private $contactos_cliente;

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	public function arrayToObject($id_cliente, $data)
	{
		$this->contactos_cliente = new stdClass();

		$this->contactos_cliente->id_cliente 		   = $id_cliente;
		$this->contactos_cliente->nombre_contacto 	 = $data['nombre_contacto'];
		$this->contactos_cliente->email_contacto 	 = $data['email_contacto'];
		$this->contactos_cliente->telefono_contacto = $data['telefono_contacto'];
		$this->contactos_cliente->puesto_contacto	 = $data['puesto_contacto'];

		return $this->contactos_cliente;
	}

}

/* End of file contactosModel.php */
/* Location: ./application/models/contactosModel.php */