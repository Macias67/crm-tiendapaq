<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla que guarda el registro
 * de quien creo un pendiente
 *
 * @package default
 * @author Luis Macias
 **/
class creaPendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'crea_pendiente';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	/**
	 * Retorna el nombre del creador
	 * del pendiente
	 *
	 * @return object
	 * @author Luis Macias
	 **/
	public function getCreadorPendiente($id_pendiente)
	{
		$this->db->select(array('ejecutivos.id','ejecutivos.primer_nombre','ejecutivos.apellido_paterno'));
		$this->db->join('ejecutivos', $this->table.'.id_creador = ejecutivos.id', 'inner');
		$this->db->where(array('id_pendiente' => $id_pendiente));
		$query = $this->db->get($this->table);

		return $query->row();
	}
}

/* End of file creaPendienteModel.php */
/* Location: ./application/models/creaPendienteModel.php */