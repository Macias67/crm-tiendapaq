<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class eventoModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
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
		$this->table	= self::TABLE;
	}

	/**
	 * funcion para regresar los casos de un ejecutivo
	 * en el plugin datatable
	 *
	 * @author Luis Macias
	 **/
	public function get_eventos_table($campos, $joins, $like, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		$todos = ($joins[0] == '*' && count($joins) == 1) ? TRUE : FALSE ;
		// Joins de las demas tablas, entre mas mas informacion detallada
		if (in_array('ejecutivos', $joins) || $todos) {
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		}
		if (in_array('sesiones', $joins) || $todos) {
			$this->db->join('sesiones', $this->table.'.id_evento = sesiones.id_evento', 'inner');
		}
		if (in_array('estatus_general', $joins) || $todos) {
			$this->db->join('estatus_general', $this->table.'.id_estatus = estatus_general.id_estatus', 'inner');
		}
		$this->db->where("`eventos`.`id_evento` LIKE '%".$like."%'
				OR `eventos`.`modalidad` LIKE '%".$like."%'
				OR `eventos`.`titulo` LIKE '%".$like."%'
				OR `ejecutivos`.`primer_nombre` LIKE '%".$like."%'
				OR  `ejecutivos`.`apellido_paterno` LIKE '%".$like."%'
				OR  `estatus_general`.`descripcion` LIKE '%".$like."%'
				");
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		$this->db->order_by('sesiones.fecha_inicio', 'ASC');
		if ($limit && !$offset)
		{
			$this->db->limit($limit);
		}
		elseif ($limit && $offset)
		{
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get($this->table);
		return  $query->result();
	}
}

/* End of file eventomodel.php */
/* Location: ./application/models/eventomodel.php */