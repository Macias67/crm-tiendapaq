<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TareaModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'tareas';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	/**
	 * Funcion para obtener las tareas de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function get_tareas_caso($id_caso)
	{
		$this->db->select('*');
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$this->db->where(array($this->table.'.id_caso' => $id_caso));
		$query = $this->db->get($this->table);
		return $query->result();
	}

}

/* End of file tareamodel.php */
/* Location: ./application/models/tareamodel.php */