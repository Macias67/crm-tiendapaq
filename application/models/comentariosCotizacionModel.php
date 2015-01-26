<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla comentarios_cotizacion
 *
 * @author Diego Rodriguez
 */
class ComentariosCotizacionModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'comentarios_cotizacion';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	/**
	 * undocumented function
	 *
	 * @return Array Object
	 * @author Diego Rodriguez
	 **/
	public function get_comentarios($folio)
	{

		$this->db->select(array(
			                      'comentarios_cotizacion.folio','comentarios_cotizacion.fecha',
			                      'comentarios_cotizacion.tipo', 'comentarios_cotizacion.comentario',
			                      'ejecutivos.id as id_ejecutivo',
			                      'ejecutivos.primer_nombre as nombre_ejecutivo',
			                      'ejecutivos.apellido_paterno as apellido_ejecutivo'));
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$where = "folio =".$folio;
		$this->db->where($where);
		$this->db->order_by("fecha ASC");
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function marcar_comentarios_visto($folio)
	{
		$this->db->where(array('folio' => $folio));
		$this->db->set(array('visto' => 1));
		return $this->db->update($this->table);
	}

}

/* End of file bancoModel.php */
/* Location: ./application/models/bancoModel.php */