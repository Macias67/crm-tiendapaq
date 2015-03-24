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
		 * variable que sera convertida a sdtClass
		 * y retornada como objeto
		 *
		 * @var $ejecutivo
		 **/
		private $evento;

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

		/**
	* funcion para convertir un arreglo asociativo a un objeto
	* con sus metodos
	*
	* @param array $data Datos del evento
	* @param boolean $editado Esta variable es falsa
	*  si el ejecutivo es nuevo y es verdadera
	*  el el ejecutivo se esta editando 
	*  para que datos
	*  agregar en el objeto
	* @return object $basica clientes
	* @author David
	**/
	public function arrayToObject($id_ejecutivo, $data)
	{
		$this->evento = new stdClass();

		$this->evento->id_evento			= $data['id_evento'];
		$this->evento->id_ejecutivo			= $data['id_ejecutivo'];
		$this->evento->titulo				= $data['titulo'];
		$this->evento->descripcion			= $data['descripcion'];
		$this->evento->temario			= $data['temario'];
		$this->evento->fecha_creacion	= $data['fecha_creacion'];
		$this->evento->costo				= $data['costo'];

		return $this->ejecutivo;
	}


}

/* End of file eventoModel.php */
/* Location: ./application/models/eventoModel.php */