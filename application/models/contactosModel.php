<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para gestionar la tabla de contactos
 * de los clientes
 *
 * @author Luis Macias | Diego Rodriguez
 */
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
	public function arrayToObject($id_cliente, $data, $tipo = null)
	{
		$this->contactos_cliente = new stdClass();

		$this->contactos_cliente->id_cliente				= $id_cliente;
		$this->contactos_cliente->nombre_contacto		= $data['nombre_contacto'];
		$this->contactos_cliente->apellido_paterno		= $data['apellido_paterno'];
		$this->contactos_cliente->apellido_materno		= $data['apellido_materno'];
		$this->contactos_cliente->email_contacto		= $data['email_contacto'];
		$this->contactos_cliente->telefono_contacto	= $data['telefono_contacto'];

		// Si envio algo, es porque es prospecto, por lo tanto no guardara
		// el puesto que tiene el contacto
		if (!$tipo)
		{
			$this->contactos_cliente->puesto_contacto	  = $data['puesto_contacto'];
		}
		return $this->contactos_cliente;
	}

	/**
	 * Obtener informacion completa de contacto con su
	 * respectiva empresa
	 *
	 * @return object
	 * @author Luis Macias
	 **/
	public function getClientePorContacto($campos, $id_contacto)
	{
		$this->db->select($campos);
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$where = array("contactos.id" => $id_contacto);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->row();
	}
}

/* End of file contactosModel.php */
/* Location: ./application/models/contactosModel.php */