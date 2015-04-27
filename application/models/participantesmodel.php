<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participantesmodel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'participantes';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	public function mostrar_participantes($id_evento)
	{
		$campos = array(
					'contactos.id',
					'nombre_contacto',
					'apellido_paterno',
					'email_contacto',
					'telefono_contacto',
					'clientes.razon_social'
					);
		$this->db->select($campos);
		$this->db->join('contactos', $this->table.'.id_contacto = contactos.id', 'inner');
		$this->db->join('clientes', 'contactos.id_cliente = clientes.id', 'inner');
		$where = array($this->table.'.id_evento' => $id_evento);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}

}

/* End of file participantesmodel.php */
/* Location: ./application/models/participantesmodel.php */