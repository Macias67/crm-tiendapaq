<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Modelo para la reasignacion de pendientes guarde un historial
 *
 * @package default
 * @author  Diego Rodriguez
 **/
class reasignarPendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'reasignacion_pendiente';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	/**
	 * Funcion para obtener el historial de reasignaciones de un pendiente
	 * @author Diego Rodriguez
	 **/
	public function getReasignaciones($id_pendiente, $campos)
	{
		$this->db->select($campos);
		$this->db->join('pendientes', $this->table.'.id_pendiente = pendientes.id_pendiente', 'inner');
		$this->db->join('ejecutivos as origen', $this->table.'.id_ejecutivo_origen = origen.id', 'inner');
		$this->db->join('ejecutivos as destino', $this->table.'.id_ejecutivo_destino = destino.id', 'inner');
		$this->db->where(array('reasignacion_pendiente.id_pendiente' => $id_pendiente));
		$this->db->order_by('reasignacion_pendiente.id', 'ASC');
		$query = $this->db->get($this->table);

		return $query->result();
	}

}

/* End of file estatusModel.php */
/* Location: ./application/models/estatusModel.php */