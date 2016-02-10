<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ticketModel extends MY_Model
{
	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'tickets';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	public function get_tickets_pendientes($campos)
	{
		$this->load->model('estatusgeneralmodel');

		$this->db->select($campos);
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('contactos', $this->table.'.id_contacto = contactos.id', 'inner');
		$this->db->where(array($this->table.'.id_estatus' => $this->estatusgeneralmodel->PENDIENTE));

		$query = $this->db->get($this->table);

		return $query->result();
	}
}