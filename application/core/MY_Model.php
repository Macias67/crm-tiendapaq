<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo abstracto
 */
class MY_Model extends CI_Model
{

	/**
	 * Nombre de la tabla a usar
	 *
	 * @var string
	 **/
	protected $table;

	/**
	 * Objecto del resultado de una query
	 *
	 * @var string
	 **/
	private $query;

	/**
	 * Prefijo de la tabla a usar
	 *
	 * @var string
	 **/
	private $prefijo;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Establezco prefijo de tabla
	 * @param string $prefijo El prefijo de la tabla
	 */
	public function set_prefijo($prefijo)
	{
		$this->prefijo = $prefijo;
		$this->table = $this->prefijo.'_'.$this->table;
	}

	public function get_table_name()
	{
		return $this->table;
	}

	/**
	 * Inserta un nuevo registro
	 * @param  string|object $data El objeto a insertar
	 * @return boolean         TRUE si es exitoso
	 *
	 */
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	/**
	 * Obtiene todos los datos registrados
	 * en la base de datos
	 *
	 * @param array $campos Los campos que se desean extraer
	 * @param array $where Condición de la búsqueda
	 * @param string $orderBy Ordenar por este campo
	 * @param string $orderForm La forma en ordenar
	 * @param int $limit El limite del resultado
	 * @param int $offset El limite del resultado
	 * @return object|array Devuelve un array de objetos o vacio
	 *
	 **/
	public function get($campos = array('*'), $where = null, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		if ($where)
		{
			$this->db->where($where);
		}
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		if ($limit && !$offset)
		{
			$this->db->limit($limit);
		}
		elseif ($limit && $offset)
		{
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get($this->table);
		return ($limit === 1) ? $query->row() : $query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param  [array] $where [Array con los datos]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function get_where($where)
	{
		$this->query = $this->db->get_where($this->table, $where);
		return ($this->query->num_rows() === 1) ? $this->query->row() : $this->query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param array $campos Array con los campos a extraer
	 * @param string $where String con el campo a hacer where
	 * @param string $like String con el valor o patron a extraer
	 * @return [object|array]        [Datos devueltos]
	 */
	public function get_like($campos = array('*'), $where, $like, $orderBy = null, $orderForm = 'ASC', $limit = null)
	{
		$this->db->select($campos);
		$this->db->like($where, $like);
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		if ($limit)
		{
			$this->db->limit($limit);
		}
		$this->query = $this->db->get($this->table);
		return $this->query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param  [array] $like [Array con los datos]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function get_like_offset($campos = array('*'), $where, $like, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		if ($where && $like)
		{
			$this->db->like($where, $like);
		}
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		if ($limit && !$offset)
		{
			$this->db->limit($limit);
		}
		elseif ($limit && $offset)
		{
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get($this->table);
		return ($limit === 1) ? $query->row() : $query->result();
	}

	/**
	 * Verfica si un registro existe segun parametros
	 * @param  [array] $where [Array con los datos]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function exist($where)
	{
		$result = $this->get_where($where);
		return ($result) ? TRUE : FALSE;
	}

	public function update($array_campos, $array_where, $scape = TRUE)
	{
		$this->db->where($array_where);
		$this->db->set($array_campos, null, $scape);
		return $this->db->update($this->table);
	}

	public function delete($where)
	{
		return $this->db->delete($this->table, $where);
	}

	public function count()
	{
		return $this->db->count_all($this->table);
	}
}

/* End of file MY_Model.php */
/* Location: ./application/models/MY_Model.php */