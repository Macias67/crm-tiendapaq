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

	/**
	 * Funcion para obtener las tarea de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function get_tarea($id_tarea)
	{
		$this->db->select('*');
		$this->db->where(array($this->table.'.id_tarea' => $id_tarea));
		$query = $this->db->get($this->table);
		return $query->row();
	}

	/**
	 * funcion para regresar las tareas de un ejecutivo
	 * en el plugin datatable
	 *
	 * @author Luis Macias
	 **/
	public function get_tareas_ejecutivo_table($id_ejecutivo, $campos, $joins, $like, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		$todos = ($joins[0] == '*' && count($joins) == 1) ? TRUE : FALSE ;
		// Joins de las demas tablas, entre mas mas informacion detallada
		if (in_array('caso', $joins) || $todos) {
			$this->db->join('caso', $this->table.'.id_caso = caso.id', 'inner');
		}
		if (in_array('clientes', $joins) || $todos) {
			$this->db->join('clientes', 'caso.id_cliente = clientes.id', 'inner');
		}
		if (in_array('estatus_general', $joins) || $todos) {
			$this->db->join('estatus_general', $this->table.'.id_estatus = estatus_general.id_estatus', 'inner');
		}
		// Joins de las demas tablas, entre mas mas informacion detallada
		if (in_array('ejecutivos', $joins) || $todos) {
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
			$this->db->join('ejecutivos as lider', 'caso.id_lider = lider.id', 'inner');
		}
		//$this->db->or_like($like);
		$this->db->where(array($this->table.'.id_ejecutivo' => $id_ejecutivo));
		$this->db->where("(`caso`.`folio_cotizacion`  LIKE '%".$like."%' OR  `caso`.`id`  LIKE '%".$like."%' OR  `clientes`.`razon_social`  LIKE '%".$like."%' OR  `ejecutivos`.`primer_nombre`  LIKE '%".$like."%' OR  `ejecutivos`.`apellido_paterno`  LIKE '%".$like."%' OR  `estatus_general`.`descripcion`  LIKE '%".$like."%' OR  `tareas`.`fecha_inicio`  LIKE '%".$like."%' OR  `fecha_finaliza`  LIKE '%".$like."%' OR  `avance`  LIKE '%".$like."%')");
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		$this->db->order_by('fecha_inicio', 'ASC');
		if ($limit && !$offset)
		{
			$this->db->limit($limit);
		}
		elseif ($limit && $offset)
		{
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get($this->table);
		return  $query->result();
	}

}

/* End of file tareamodel.php */
/* Location: ./application/models/tareamodel.php */