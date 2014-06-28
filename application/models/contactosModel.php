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

/**
 * funcion para convertir un arreglo asociativo a un objeto
 * con sus metodos
 *
 * @return $basica clientes
 * @author Diego Rodriguez
 **/
	public function arrayToObject($id_cliente, $data, $tipo = null)
	{
		$this->contactos_cliente = new stdClass();

			$this->contactos_cliente->id_cliente 		    = $id_cliente;
			$this->contactos_cliente->nombre_contacto   = $data['nombre_contacto'];
			$this->contactos_cliente->apellido_paterno 	= $data['apellido_paterno'];
			$this->contactos_cliente->apellido_materno 	= $data['apellido_materno'];
			$this->contactos_cliente->email_contacto 	  = $data['email_contacto'];
			$this->contactos_cliente->telefono_contacto = $data['telefono_contacto'];

		if (!$tipo) {
			$this->contactos_cliente->puesto_contacto	  = $data['puesto_contacto'];
		}
		return $this->contactos_cliente;
	}

}

/* End of file contactosModel.php */
/* Location: ./application/models/contactosModel.php */