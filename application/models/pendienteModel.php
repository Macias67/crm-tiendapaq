<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

		$this->pendiente->id_ejecutivo		= $data['id_ejecutivo'];
		$this->pendiente->id_empresa		= $data['id_empresa'];
		$this->pendiente->actividad			= $data['actividad'];
		$this->pendiente->estatus			= $data['estatus'];
		$this->pendiente->descripcion		= $data['descripcion'];

		return $this->pendiente;
	}

	/**
	 * Retorna los pendientes que hay
	 * regisrados en la tabla de la base de datos
	 *
	 * @return array
	 * @author Luis Macias
	 **/
	public function getPendientes($id_ejecutivo)
	{
		$this->load->model('estatusModel');

		$this->db->select('*');
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_empresa = clientes.id', 'left');
		$this->db->join('actividad_pendiente', $this->table.'.actividad = actividad_pendiente.id_actividad', 'inner');
		$this->db->where(array('id_ejecutivo' => $id_ejecutivo, 'estatus' => $this->estatusModel->PENDIENTE));
		$query = $this->db->get($this->table);

		return $query->result();
	}

	/**
	 * Retorna el pendiente que hay
	 * regisrado en la tabla de la base de datos
	 *
	 * @return array
	 * @author Luis Macias
	 **/
	public function getPendiente($id_pendiente)
	{
		$this->load->model('estatusModel');

		$this->db->select('*');
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_empresa = clientes.id', 'left');
		$this->db->join('actividad_pendiente', $this->table.'.actividad = actividad_pendiente.id_actividad', 'inner');
		$this->db->where(array('id_pendiente' => $id_pendiente, 'estatus' => $this->estatusModel->PENDIENTE));
		$query = $this->db->get($this->table);

		return $query->row();
	}

	public function getUltimoPendiente()
	{
		$pendiente = $this->get('id_pendiente', null, 'id_pendiente', 'DESC', 1);
		if (empty($pendiente)) {
			$id_pendiente = 1;
		} else {
			$id_pendiente = (int)$pendiente->id_pendiente;
		}
		return $id_pendiente;
	}

}

/* End of file pendienteModel.php */
/* Location: ./application/models/pendienteModel.php */