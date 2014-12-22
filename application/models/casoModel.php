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

}

/* End of file casoModel.php */
/* Location: ./application/models/casoModel.php */