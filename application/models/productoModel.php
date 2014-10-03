<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para gestionar la tabla productos
 * y funciones para procesar la informacion
 *
 * @package default
 * @author Luis Macias
 **/
class ProductoModel extends TxtManager {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'productos';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table		= self::TABLE;
		$this->file_txt		= self::TABLE;
	}

	/**
	 * Metodo para transforma un archivo txt
	 * a un tipo de datos seleccionado, ya sea a objeto
	 * o array asociativo.
	 * @param  string $pathTXT  La ruta del txt (vista cliente o producto) a transformar
	 * @param  string $dataType El tipo de dato a transformar 'objeto' o 'array'
	 * @return array           El array convertido a su dato correspondiente
	 */
	public function transformTXT($pathTXT, $dataType)
	{
		$data		= $this->cleanData($pathTXT, 'producto');
		$total_info	= count($data);
		$transform	= array();
		if ($dataType === 'objeto') {
			for ($i=0; $i < $total_info; $i++) {
				array_push($transform, $this->setObjectProducto($data[$i]));
			}
		} elseif ($dataType === 'array') {
			for ($i=0; $i < $total_info; $i++) {
				array_push($transform, $this->setArrayAssocProducto($data[$i]));
			}
		}
		return $transform;
	}

	/**
	 * Funcion para devolver los datos de
	 * un producto en forma de objeto con sus
	 * atributos:
	 *
	 *  0 => string codigo
	 *  1 => string nombre
	 *  2 => string precio
	 *  3 => string impuesto1
	 *  4 => string impuesto2
	 *  5 => string retencion1
	 *  6 => string retencion2
	 *
	 * @param array $data_producto Array con la info del producto
	 * @return object El objeto del producto con sus atributos
	 */
	private function setObjectProducto($data_producto)
	{
		if (count($data_producto) == 7) {
			// Creacion del objeto producto
			$producto = new stdClass();
			// Atributos
			$producto->codigo		= $data_producto[0];
			$producto->descripcion	= mb_strtoupper($data_producto[1]);
			$producto->precio			= (float) $data_producto[2];
			$producto->impuesto1	= (float) $data_producto[3];
			$producto->impuesto2	= (float) $data_producto[4];
			$producto->retencion1	= (float) $data_producto[5];
			$producto->retencion2	= (float) $data_producto[6];
		} else {
			$producto = null;
		}
		return $producto;
	}

	/**
	 * Funcion para devolver los datos de
	 * un producto en forma de array asociativo con sus
	 * atributos:
	 *
	 *  0 => string codigo
	 *  1 => string nombre
	 *  2 => string precio
	 *  3 => string impuesto1
	 *  4 => string impuesto2
	 *  5 => string retencion1
	 *  6 => string retencion2
	 *
	 * @param array $data_producto Array con la info del producto
	 * @return object El objeto del producto con sus atributos
	 */
	private function setArrayAssocProducto($data_producto)
	{
		if (count($data_producto) == 7) {
			// Creacion del array producto
			$producto = array();
			// Atributos
			$producto['codigo']			= $data_producto[0];
			$producto['descripcion']		= mb_strtoupper($data_producto[1]);
			$producto['precio']			= (float) $data_producto[2];
			$producto['impuesto1']		= (float) $data_producto[3];
			$producto['impuesto2']		= (float) $data_producto[4];
			$producto['retencion1']		= (float) $data_producto[5];
			$producto['retencion2']		= (float) $data_producto[6];
		} else {
			$producto = null;
		}
		return $producto;
	}

	/**
	 * Metodo para seleccionar un producto
	 * en la parte de la cotizacion segun
	 * el nombre o codigo del producto.
	 *
	 * @param array $campos los campos que se necesitan
	 * @param string $like la query a buscar
	 * @param string $limit el limite a extraer
	 * @return array object
	 **/
	public function get_select_query($campos = array('*'), $like, $limit)
	{
		$this->db->select($campos);
		$this->db->like('codigo', $like);
		$this->db->or_like('descripcion', $like);
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($limit);
		$this->query = $this->db->get($this->table);
		return $this->query->result();
	}
}

/* End of file productoModel.php */
/* Location: ./application/models/productoModel.php */