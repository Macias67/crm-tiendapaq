<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Modelo para la tabla
	 * de eventos.
	 *
	 * @package default
	 * @author Julio Trujillo
	 **/
	class EventoModel extends MY_Model {

		/**
		 * Nombre de la tabla a
		 * conectarse.
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

		/**
		 * Función que devuelve todos los
		 * eventos a partir de la
		 * fecha de hoy.
		 *
		 * @return array
		 * @author Julio Trujillo
		 **/
		public function get_evento_revision($campos)
		{
			// Para seleccionar sólo las fechas del día en adelante
			// $date = date_create('today'); // Devuelve un nuevo objeto DateTime.
			// $dia_actual = date_format($date, 'Y-m-d H:i:s'); // Formateo la fecha para compararlas

			$this->db->select($campos);
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
			// $where = array($this->table.'.fecha_creacion >' => $dia_actual);
			// $this->db->where($where);

			$query = $this->db->get($this->table);

			return $query->result();
		}
}

/* End of file eventoModel.php */
/* Location: ./application/models/eventoModel.php */