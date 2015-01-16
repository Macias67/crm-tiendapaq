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
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function get_cotizaciones_cliente($id_cliente, $campos='*')
	{
		$this->load->model('estatusCotizacionModel');

		$this->db->select($campos);
		$this->db->join('oficinas', $this->table.'.id_oficina = oficinas.id_oficina', 'inner');
		$this->db->join('observaciones', $this->table.'.id_observaciones = observaciones.id_observacion', 'inner');
		$this->db->join('bancos', $this->table.'.id_banco = bancos.id_banco', 'inner');
		$this->db->join('estatus_cotizacion', $this->table.'.id_estatus_cotizacion = estatus_cotizacion.id_estatus', 'inner');
		$where = "id_cliente =".$id_cliente;
		//$this->db->where(array('id_cliente' => $id_cliente, $this->table.'.id_estatus_cotizacion' => $id_estatus));
		$this->db->where($where);
		$this->db->order_by("fecha ASC");
		$query = $this->db->get($this->table);
		return $query->result();
	}

	/**
	 * funcion para regresar los satos de una cotizacion del cliente
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function get_cotizacion_cliente($folio)
	{
		$this->db->select(array('cotizacion.folio','cotizacion.id_cliente','cotizacion.id_estatus_cotizacion','clientes.razon_social'));
		//$this->db->join('oficinas', $this->table.'.id_oficina = oficinas.id_oficina', 'inner');
		//$this->db->join('observaciones', $this->table.'.id_observaciones = observaciones.id_observacion', 'inner');
		//$this->db->join('bancos', $this->table.'.id_banco = bancos.id_banco', 'inner');
		//$this->db->join('estatus_cotizacion', $this->table.'.id_estatus_cotizacion = estatus_cotizacion.id_estatus', 'inner');
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->where(array('folio' => $folio));
		$query = $this->db->get($this->table);
		// Parseo el JSON
		$cotizacion =  $query->row();

		return  $query->row();
	}

	/**
	 * funcion para extraer los datos de las cotizaciones
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function get_cotizaciones($campos)
	{
		# code...
	}

/**
 * funcion que retorna los datos de las cotizaciones que estan en estatus de revision
 *
 * @author Diego Rodriguez
 **/
	public function get_cotizacion_revision($campos)
	{
		$this->db->select($campos);
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		//$this->db->join('estatus as estado', $this->table.'.id_estatus = estado.estatus', 'inner');
		$this->db->where(array($this->table.'.id_estatus_cotizacion' => 2));

		$query = $this->db->get($this->table);

		return $query->result();
	}

}

/* End of file cotizacionModel.php */
/* Location: ./application/models/cotizacionModel.php */