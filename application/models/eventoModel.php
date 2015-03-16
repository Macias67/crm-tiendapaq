<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Modelo para la tabla
	 * de eventos
	 *
	 * @package default
	 * @author Julio Trujillo
	 **/
	class EventoModel extends MY_Model {

		/**
		 * Nombre de la tabla a
		 * conectarse
		 *
		 * @var string
		 **/
		const TABLE = 'eventos';

		/**
		 * Constructor
		 */
		public function __construct()
		{
			parent::__construct();
			$this->table = self::TABLE;
		}

		public function get_evento_revision($campos)
		{

			$this->db->select($campos);
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
			$query = $this->db->get($this->table);

			return $query->result();
		}

/* End of file eventoModel.php */
/* Location: ./application/models/eventoModel.php */