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

		/**
		 * Función para convertir un arreglo asociativo a un objeto
		 * con sus atributos
		 * @param array $data Arreglo para transformar
		 * @author Julio Trujillo
		 **/
		public function arrayToObject($data)
		{
			$this->eventos = new stdClass();

			$this->eventos->id_evento		= $data['id_evento'];
			$this->eventos->id_ejecutivo	= $data['id_ejecutivo'];
			$this->eventos->titulo			= $data['titulo'];
			$this->eventos->descripcion		= $data['descripcion'];
			$this->eventos->temario			= $data['temario'];
			$this->eventos->sesiones		= $data['sesiones'];
			$this->eventos->fecha			= $data['fecha'];
			$this->eventos->hora			= $data['hora'];
			$this->eventos->duracion		= $data['duracion'];
			$this->eventos->costo			= $data['costo'];

			return $this->eventos;
		}

		public function get_evento_revision($campos)
		{
			$this->db->select($campos);
			$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
			//$this->db->where(array($this->table.'.id_estatus_cotizacion' => 2));

			$query = $this->db->get($this->table);

			return $query->result();
		}

}

/* End of file eventoModel.php */
/* Location: ./application/models/eventoModel.php */