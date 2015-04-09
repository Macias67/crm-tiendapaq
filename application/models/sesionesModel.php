<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para trabajar con la tabla oficinas de la bd
 *
 * @author Julio Trujillo
 **/
class SesionesModel extends MY_Model {
	/**
	 * Nombre de la tabla a
	 * conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'sesiones';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	public function fecha_inicio($campos)
	{
		$this->db->select($campos);
		$this->db->select_min('fecha','fecha_inicio');
		$this->db->group_by('id_evento');

		$query = $this->db->get($this->table);

		return $query->result();
	}
}

/* End of file sesionesModel.php */
/* Location: ./application/models/sesionesModel.php */