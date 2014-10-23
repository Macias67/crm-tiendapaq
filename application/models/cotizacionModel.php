<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla de cotizacion
 */
class CotizacionModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'cotizacion';

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	/**
	 * Funcion para obtener el folio
	 * siguiente apartir del último
	 * folio de la base de datos
	 *
	 * @return int $folio
	 * @author Luis Macias
	 **/
	public function getSiguienteFolio()
	{
		$folio = $this->cotizacionModel->get('folio', null, 'folio', 'DESC', 1);
		if (empty($folio)) {
			$folio = 1;
		} else {
			$folio = (int)$folio->folio;
			$folio++;
		}
		return $folio;
	}

	/**
	 * undocumented function
	 *
	 * @return Array Object
	 * @author Luis Macias
	 **/
	public function get_cotizaciones_cliente($id_cliente)
	{
		$this->db->select('*');
		$this->db->join('oficinas', $this->table.'.oficina = oficinas.id_oficina', 'inner');
		$this->db->join('observaciones', $this->table.'.observaciones = observaciones.id_observacion', 'inner');
		$this->db->join('bancos', $this->table.'.banco = bancos.id_banco', 'inner');
		$this->db->join('estatus_cotizacion', $this->table.'.estatus = estatus_cotizacion.id_estatus', 'inner');
		$this->db->where(array('cliente' => $id_cliente));
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_cotizacion_cliente($folio)
	{
		$this->db->select('*');
		$this->db->join('oficinas', $this->table.'.oficina = oficinas.id_oficina', 'inner');
		$this->db->join('observaciones', $this->table.'.observaciones = observaciones.id_observacion', 'inner');
		$this->db->join('bancos', $this->table.'.banco = bancos.id_banco', 'inner');
		$this->db->join('estatus_cotizacion', $this->table.'.estatus = estatus_cotizacion.id_estatus', 'inner');
		$this->db->where(array('folio' => $folio));
		$query = $this->db->get($this->table);
		// Parseo el JSON
		$cotizacion =  $query->row();
		$cotizacion->cotizacion = json_decode($cotizacion->cotizacion);
		return $cotizacion;
	}

}

/* End of file cotizacionModel.php */
/* Location: ./application/models/cotizacionModel.php */