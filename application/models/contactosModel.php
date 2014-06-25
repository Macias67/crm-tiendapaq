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
	private $contacto_cliente;

	public function __construct()
	{
		parent::__construct();
	}

	public function arrayToObject($id_cliente, $data)
	{
		$this->cliente = new stdClass();

		$this->contacto_cliente->id_cliente 		   = $id_cliente;
		$this->contacto_cliente->nombre_contacto 	 = $data['nombre_contacto'];
		$this->contacto_cliente->email_comtacto 	 = $data['email_comtacto'];
		$this->contacto_cliente->telefono_contacto = $data['telefono_contacto'];
		$this->contacto_cliente->puesto_contacto	 = $data['puesto_contacto'];

		return $this->contacto_cliente;
	}

}

/* End of file contactosModel.php */
/* Location: ./application/models/contactosModel.php */