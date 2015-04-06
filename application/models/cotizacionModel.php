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
			$folio = 7100; // valor definido por Eleazar
		} else {
			$folio = (int)$folio->folio;
			$folio++;
		}
		return $folio;
	}

	/**
	 * Funcion para obtener la url de una cotizacion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function get_url_cotizacion($id_cliente, $folio)
	{
		$dir_root	= site_url('/clientes/'.$id_cliente.'/cotizacion').'/';
		$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
		$path		= $dir_root.$name;
		return $path;
	}

	/**
	 * Funcion para obtener los archivos
	 * de una cotizacion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function get_files_cotizacion($id_cliente, $folio)
	{
		$this->load->helper('directory');
		$this->load->helper('file');
		$ruta = '/clientes/'.$id_cliente.'/comprobantes/'.$folio.'/';
		$archivos = directory_map('.'.$ruta, 1);

		$imagenes 	= array();
		$pdfs 		= array();

		// Descarto la carpeta de las thumnail
		foreach ($archivos as $index => $archivo) {
			$tipo = explode("/", get_mime_by_extension($archivos[$index]));
			if ($archivos[$index] != 'thumbnail' && ($tipo[1] == 'png' || $tipo[1] == 'jpeg')) {
				array_push($imagenes, $archivos[$index]);
			} else if($archivos[$index] != 'thumbnail' && $tipo[1] == 'pdf') {
				array_push($pdfs, $archivos[$index]);
			}
		}

		$archivos = array('imagenes' => $imagenes, 'pdfs' => $pdfs);
		return $archivos;
	}

	/**
	 * undocumented function
	 *
	 * @return Array Object
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function get_cotizaciones_cliente($id_cliente, $campos='*', $where=null)
	{
		$this->load->model('estatusCotizacionModel');

		$this->db->select($campos);
		$this->db->join('oficinas', $this->table.'.id_oficina = oficinas.id_oficina', 'inner');
		$this->db->join('observaciones', $this->table.'.id_observaciones = observaciones.id_observacion', 'inner');
		$this->db->join('bancos', $this->table.'.id_banco = bancos.id_banco', 'inner');
		$this->db->join('estatus_cotizacion', $this->table.'.id_estatus_cotizacion = estatus_cotizacion.id_estatus', 'inner');
		if(!empty($where)){
			$this->db->where($where);
		}else{
			$where2 = "id_cliente =".$id_cliente;
			$this->db->where($where2);
		}
		$this->db->order_by("fecha ASC");
		$query = $this->db->get($this->table);
		return $query->result();
	}

	/**
	 * funcion para regresar los datos de una cotizacion del cliente
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function get_cotizacion_cliente($campos, $joins = array('*'), $folio)
	{
		$this->db->select($campos);
		$todos = ($joins[0] == '*' && count($joins) == 1) ? TRUE : FALSE ;
		// Joins de las demas tablas, entre mas mas informacion detallada
		if (in_array('ejecutivos', $joins) || $todos) {
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		}
		if (in_array('clientes', $joins) || $todos) {
			$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		}
		if (in_array('contactos', $joins) || $todos) {
			$this->db->join('contactos', $this->table.'.id_contacto = contactos.id', 'inner');
		}
		if (in_array('oficinas', $joins) || $todos) {
			$this->db->join('oficinas', $this->table.'.id_oficina = oficinas.id_oficina', 'inner');
		}
		if (in_array('observaciones', $joins) || $todos) {
			$this->db->join('observaciones', $this->table.'.id_observaciones = observaciones.id_observacion', 'inner');
		}
		if (in_array('bancos', $joins) || $todos) {
			$this->db->join('bancos', $this->table.'.id_banco = bancos.id_banco', 'inner');
		}
		if (in_array('estatus_cotizacion', $joins) || $todos) {
			$this->db->join('estatus_cotizacion', $this->table.'.id_estatus_cotizacion = estatus_cotizacion.id_estatus', 'inner');
		}
		$this->db->where(array('folio' => $folio));
		$query = $this->db->get($this->table);

		return  $query->row();
	}

	/**
	 * funcion para extraer los datos de las cotizaciones
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function get_cotizaciones($campos, $where=null)
	{
		$this->db->select($campos);
		//$this->db->join('oficinas', $this->table.'.id_oficina = oficinas.id_oficina', 'inner');
		//$this->db->join('observaciones', $this->table.'.id_observaciones = observaciones.id_observacion', 'inner');
		//$this->db->join('bancos', $this->table.'.id_banco = bancos.id_banco', 'inner');
		$this->db->join('estatus_cotizacion', $this->table.'.id_estatus_cotizacion = estatus_cotizacion.id_estatus', 'inner');
		$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		if(!empty($where)){
			$this->db->where($where);
		}
		$query = $this->db->get($this->table);

		return  $query->result();
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

	/**
	 * funcion para regresar los satos de una cotizacion del cliente
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function get_cotizacion_cliente_table($campos, $joins, $like = array(), $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		$todos = ($joins[0] == '*' && count($joins) == 1) ? TRUE : FALSE ;
		// Joins de las demas tablas, entre mas mas informacion detallada
		if (in_array('ejecutivos', $joins) || $todos) {
			$this->db->join('ejecutivos', $this->table.'.id_ejecutivo = ejecutivos.id', 'inner');
		}
		if (in_array('clientes', $joins) || $todos) {
			$this->db->join('clientes', $this->table.'.id_cliente = clientes.id', 'inner');
		}
		if (in_array('contactos', $joins) || $todos) {
			$this->db->join('contactos', $this->table.'.id_contacto = contactos.id', 'inner');
		}
		if (in_array('oficinas', $joins) || $todos) {
			$this->db->join('oficinas', $this->table.'.id_oficina = oficinas.id_oficina', 'inner');
		}
		if (in_array('observaciones', $joins) || $todos) {
			$this->db->join('observaciones', $this->table.'.id_observaciones = observaciones.id_observacion', 'inner');
		}
		if (in_array('bancos', $joins) || $todos) {
			$this->db->join('bancos', $this->table.'.id_banco = bancos.id_banco', 'inner');
		}
		if (in_array('estatus_cotizacion', $joins) || $todos) {
			$this->db->join('estatus_cotizacion', $this->table.'.id_estatus_cotizacion = estatus_cotizacion.id_estatus', 'inner');
		}
		$this->db->or_like($like);
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
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

	/**
	 * funcion para aumentar en 1 el total de comentarios de una cotizacion
	 *
	 * @author Diego Rodriguez
	 **/
	public function incrementa_comentarios($folio)
	{
		$this->db->set('total_comentarios', '`total_comentarios`+1',FALSE);
		$this->db->where('folio', $folio);
		$this->db->update($this->table);
	}
}

/* End of file cotizacionModel.php */
/* Location: ./application/models/cotizacionModel.php */