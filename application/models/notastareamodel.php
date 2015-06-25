<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotasTareaModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'notas_tarea';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	/**
	 * Total de comentario de una tarea
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function total_notas($id_tarea)
	{
		$this->db->select('*');
		$this->db->where(array($this->table.'.id_tarea' => $id_tarea));
		$query = $this->db->get($this->table);
		return count($query->result());
	}

	public function get_notas_tarea()
	{
		$this->db->select('*');
		// $this->db->where(array($this->table.'.id_tarea' => $id_tarea));
		$this->db->order_by('id_nota','desc');
		$query = $this->db->get($this->table);
		return $query->result();
	}
}

/* End of file notasTareaModel.php */
/* Location: ./application/models/notasTareaModel.php */