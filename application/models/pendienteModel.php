<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla de pendientes
 *
 * @package default
 * @author Luis Macias | Diego Rodriguez
 **/
class PendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'pendientes';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $basica_clientes
	 **/
	private $pendiente;

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
	 * con sus atributos
	 * @param array $data Arreglo a trasformar
	 * @return object
	 * @author Luis Macias
	 **/
	public function arrayToObject($data)
	{
		$this->pendiente = new stdClass();

		$this->pendiente->id_creador								= $data['id_creador'];
		$this->pendiente->id_ejecutivo							= $data['id_ejecutivo'];
		$this->pendiente->id_cliente								= $data['id_cliente'];
		$this->pendiente->id_actividad_pendiente		= $data['id_actividad_pendiente'];
		$this->pendiente->id_estatus_general				= $data['id_estatus_general'];
		$this->pendiente->descripcion								= $data['descripcion'];
		$this->pendiente->fecha_origen							= $data['fecha_origen'];

		return $this->pendiente;
	}

	/**
	 * Retorna los pendientes que hay
	 * regisrados en la tabla de la base de datos
	 *
	 * @return array object
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function getPendientes($campos, $id_ejecutivo, $controlador = '')
	{
		$this->load->model('estatusGeneralModel');

		$this->db->select($campos);
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'left');
		$this->db->join('actividades_pendiente', $this->table.'.id_actividad_pendiente = actividades_pendiente.id_actividad', 'inner');
		if(!empty($controlador)){
			$where = "id_ejecutivo =".$id_ejecutivo." AND id_estatus_general=".$this->estatusGeneralModel->PENDIENTE." OR id_ejecutivo =".$id_ejecutivo." AND id_estatus_general=".$this->estatusGeneralModel->REASIGNADO;
			$this->db->where($where);
		} else {
			$this->db->where(array('id_ejecutivo' => $id_ejecutivo));
		}
		$query = $this->db->get($this->table);

		return $query->result();
	}

	/**
	 * Retorna el pendiente que hay
	 * regisrado en la tabla de la base de datos
	 *
	 * @return object
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function getPendiente($id_pendiente,$campos)
	{
		$this->load->model('estatusGeneralModel');

		$this->db->select($campos);
		$this->db->join('ejecutivos as creador', $this->table.'.id_creador = creador.id', 'inner');
		$this->db->join('ejecutivos as ejecutivo', $this->table.'.id_ejecutivo = ejecutivo.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'left');
		$this->db->join('actividades_pendiente', $this->table.'.id_actividad_pendiente = actividades_pendiente.id_actividad', 'inner');
		$this->db->where(array('id_pendiente' => $id_pendiente));
		$query = $this->db->get($this->table);

		return $query->row();
	}

	/**
	 * Retorna los pendientes de los demas usuarios
	 *
	 * @return object
	 * @author Diego Rodriguez
	 **/
	public function get_pendientes_generales($campos,$id_ejecutivo)
	{
		$this->db->select($campos);
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'left');
		$this->db->join('actividades_pendiente', $this->table.'.id_actividad_pendiente = actividades_pendiente.id_actividad', 'inner');
		$where = "id_estatus_general = ".$this->estatusGeneralModel->PENDIENTE." OR id_estatus_general = ".$this->estatusGeneralModel->REASIGNADO;
		$this->db->where($where);

		$query = $this->db->get($this->table);

		return $query->result();
	}

	/**
	 * Retorna el folio del ultimo pendiente
	 *
	 * @return int
	 * @author Luis Macias
	 **/
	public function getIDUltimoPendiente()
	{
		$pendiente = $this->get('id_pendiente', null, 'id_pendiente', 'DESC', 1);
		if (empty($pendiente))
		{
			$id_pendiente = 1;
		} else
		{
			$id_pendiente = (int)$pendiente->id_pendiente;
		}
		return $id_pendiente;
	}

	/**
	 * funcion para regresar los pendientes de un ejecutico
	 * en el plugin datatable
	 *
	 * @author Luis Macias
	 **/
	public function get_pendiente_ejecutivo_table($id_ejecutivo, $campos, $joins, $like, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		$todos = ($joins[0] == '*' && count($joins) == 1) ? TRUE : FALSE ;
		// Joins de las demas tablas, entre mas mas informacion detallada
		if (in_array('clientes', $joins) || $todos) {
			$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'left');
		}
		if (in_array('actividades_pendiente', $joins) || $todos) {
			$this->db->join('actividades_pendiente', $this->table.'.id_actividad_pendiente = actividades_pendiente.id_actividad', 'inner');
		}
		if (in_array('estatus_general', $joins) || $todos) {
			$this->db->join('estatus_general', $this->table.'.id_estatus_general = estatus_general.id_estatus', 'inner');
		}
		$this->db->where(array($this->table.'.id_ejecutivo' => $id_ejecutivo));
		$this->db->where("(`id_pendiente`  LIKE '%".$like."%' OR  `actividades_pendiente`.`actividad` LIKE '%".$like."%' OR `clientes`.`razon_social`  LIKE '%".$like."%' OR  `estatus_general`.`descripcion`  LIKE '%".$like."%')");
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		$this->db->order_by('fecha_origen', 'ASC');
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

/* End of file pendienteModel.php */
/* Location: ./application/models/pendienteModel.php */