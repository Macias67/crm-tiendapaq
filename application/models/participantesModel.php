<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ParticipantesModel extends MY_Model {
	/**
	 * Nombre de la tabla a
	 * conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'participantes';

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
	 * con sus metodos
	 *
	 * @return $basica participantes
	 * @author Julio Trujillo
	 **/
	public function arrayToObject($data)
	{
		$this->registro_participantes = new stdClass();

		$this->registro_participantes->id_evento		= $data['id_evento'];
		$this->registro_participantes->id_contacto		= $data['id_contacto'];
		$this->registro_participantes->id_cliente		= $data['id_cliente'];

		return $this->registro_participantes;
	}

	public function get_participantes($campos, $id_evento)
	{
			$this->db->select($campos);
			$this->db->join('contactos', $this->table.'.id_contacto = contactos.id', 'inner');
			$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
			$this->db->where(array($this->table.'.id_evento' => $id_evento));

			$query = $this->db->get($this->table);

			return $query->result();
	}
}

/* End of file participantesModel.php */
/* Location: ./application/models/participantesModel.php */