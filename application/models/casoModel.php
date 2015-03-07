<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla caso
 *
 * @author Diego Rodriguez
 */
class CasoModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'caso';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	/**
	 * funcion para obtener los casos que esten por asignar
	 *
	 * @author Diego Rodriguez
	 **/
	public function get_casos_asignacion($campos='*')
	{
		$this->load->model('estatusGeneralModel');

		$this->db->select($campos);
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('estatus_general', $this->table.'.id_estatus_general = estatus_general.id_estatus', 'inner');
		$where = array("caso.id_estatus_general" => $this->estatusGeneralModel->PORASIGNAR);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	/**
	 * funcion para obtener los casos de un ejecutivo en especifico
	 *
	 * @author Diego Rodriguez
	 **/
	public function get_casos_ejecutivo($id_ejecutivo, $campos='*')
	{
		$this->load->model('estatusGeneralModel');

		$this->db->select($campos);
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('estatus_general', $this->table.'.id_estatus_general = estatus_general.id_estatus', 'inner');
		$where = array($this->table.'.id_lider' => $id_ejecutivo);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	/**
	 * Función para obtener todos los
	 * casos de los ejecutivos
	 *
	 * @author Julio Trujillo
	 **/
	public function get_casos_generales($id_lider, $campos='*')
	{
		$this->load->model('estatusGeneralModel');

		$this->db->select($campos);
		$this->db->join('ejecutivos', $this->table.'.id_lider = ejecutivos.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('estatus_general', $this->table.'.id_estatus_general = estatus_general.id_estatus', 'inner');
		$where = "id_estatus_general = ".$this->estatusGeneralModel->PENDIENTE." OR id_estatus_general = ".$this->estatusGeneralModel->REASIGNADO;
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	/**
	 * funcion para obtener los detalles de un casa para la
	 * ventana modal detalles de caso, realiza validacion de
	 * si el caso esta o no asignado a un lider
	 *
	 * @author Diego Rodriguez
	 **/
	public function get_caso_detalles($id_caso,$lider=null)
	{
		//si no hay lider en el caso, no se hacer el inner join con la tabla ejecutivos para no tener error
		if(empty($lider)){
			$this->db->select(array('caso.id as id_caso',
						'caso.id_estatus_general',
				                      	'ejecutivos.primer_nombre',
				                      	'ejecutivos.apellido_paterno',
				                      	'estatus_general.descripcion',
				                      	'clientes.razon_social',
				                      	'clientes.id as id_cliente',
				                      	'caso.folio_cotizacion',
				                      	'caso.fecha_inicio',
				                      	'caso.fecha_final'));

			$this->db->join('ejecutivos', $this->table.'.id_lider = ejecutivos.id', 'inner');
		}else{
			$this->db->select(array('caso.id as id_caso',
															'caso.id_estatus_general',
				                      'estatus_general.descripcion',
				                      'clientes.razon_social',
				                      'clientes.id as id_cliente',
				                      'caso.folio_cotizacion',
				                      'caso.fecha_inicio',
				                      'caso.fecha_final'));
		}

		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('estatus_general', $this->table.'.id_estatus_general = estatus_general.id_estatus', 'inner');
		$where = array($this->table.'.id' => $id_caso);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	/**
	 * funcion para obtener los casos de un cliente en general
	 *
	 * @author Diego Rodriguez
	 **/
	public function get_casos_cliente($campos='*', $id_cliente)
	{
		$this->db->select($campos);
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('ejecutivos', $this->table.'.id_lider = ejecutivos.id', 'inner');
		$this->db->join('estatus_general', $this->table.'.id_estatus_general = estatus_general.id_estatus', 'inner');
		$where = array($this->table.'.id_cliente' => $id_cliente);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->result();
	}
}

/* End of file casoModel.php */
/* Location: ./application/models/casoModel.php */