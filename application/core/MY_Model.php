<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo abstracto
 */
class MY_Model extends CI_Model
{

	/**
	 * Nombre de la tabla a usar
	 *
	 * @var string
	 **/
	protected $table;

	/**
	 * Objecto del resultado de una query
	 *
	 * @var string
	 **/
	private $query;

	/**
	 * Prefijo de la tabla a usar
	 *
	 * @var string
	 **/
	private $prefijo;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Establezco prefijo de tabla
	 * @param string $prefijo El prefijo de la tabla
	 */
	public function set_prefijo($prefijo)
	{
		$this->prefijo = $prefijo;
		$this->table = $this->prefijo.'_'.$this->table;
	}

	public function get_table_name()
	{
		return $this->table;
	}

	/**
	 * Inserta un nuevo registro
	 * @param  string|object $data El objeto a insertar
	 * @return boolean         TRUE si es exitoso
	 *
	 */
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	/**
	 * Obtiene todos los datos registrados
	 * en la base de datos
	 *
	 * @param array $campos Los campos que se desean extraer
	 * @param array $where Condición de la búsqueda
	 * @param string $orderBy Ordenar por este campo
	 * @param string $orderForm La forma en ordenar
	 * @param int $limit El limite del resultado
	 * @param int $offset El limite del resultado
	 * @return object|array Devuelve un array de objetos o vacio
	 *
	 **/
	public function get($campos = array('*'), $where = null, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		if ($where)
		{
			$this->db->where($where);
		}
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
		return ($limit === 1) ? $query->row() : $query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param array $campos Los campos que se desean extraer
	 * @param  [string] $campo [nombre del campo de la tabla]
	 * @param  [string] $array [valores a encontrar]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function where_in($campos = array('*'), $campo, $array, $orderBy = null)
	{
		$this->db->select($campos);
		$this->db->where_in($campo, $array);
		if($orderBy)
		{
			$this->db->order_by($orderBy);
		}
		$this->query = $this->db->get($this->table);
		return ($this->query->num_rows() === 1) ? $this->query->row() : $this->query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param  [array] $where [Array con los datos]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function get_where($where)
	{
		$this->query = $this->db->get_where($this->table, $where);
		return ($this->query->num_rows() === 1) ? $this->query->row() : $this->query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param array $campos Array con los campos a extraer
	 * @param string $where String con el campo a hacer where
	 * @param string $like String con el valor o patron a extraer
	 * @return [object|array]        [Datos devueltos]
	 */
	public function get_like($campos = array('*'), $where, $like, $orderBy = null, $orderForm = 'ASC', $limit = null)
	{
		$this->db->select($campos);
		$this->db->like($where, $like);
		if($orderBy)
		{
			$this->db->order_by($orderBy, $orderForm);
		}
		if ($limit)
		{
			$this->db->limit($limit);
		}
		$this->query = $this->db->get($this->table);
		return $this->query->result();
	}

	/**
	 * Obtener datos segun parametros
	 * @param  [array] $like [Array con los datos]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function get_like_offset($campos = array('*'), $where, $like, $orderBy = null, $orderForm = 'ASC', $limit = null, $offset = null)
	{
		$this->db->select($campos);
		if ($where && $like)
		{
			$this->db->like($where, $like);
		}
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
		return ($limit === 1) ? $query->row() : $query->result();
	}

	/**
	 * Verfica si un registro existe segun parametros
	 * @param  [array] $where [Array con los datos]
	 * @return [object|array]        [Datos devueltos]
	 */
	public function exist($where)
	{
		$result = $this->get_where($where);
		return ($result) ? TRUE : FALSE;
	}

	public function update($array_campos, $array_where, $scape = TRUE)
	{
		$this->db->where($array_where);
		$this->db->set($array_campos, null, $scape);
		return $this->db->update($this->table);
	}

	public function delete($where)
	{
		return $this->db->delete($this->table, $where);
	}

	public function count()
	{
		return $this->db->count_all($this->table);
	}
}

/**
*
*/
class TxtManager extends MY_Model {

	/**
	 * Archivo TXT usado para comparar
	 *
	 * @var string
	 **/
	protected $file_txt;

	/**
	 * Este metodo solo sera usado unicamente si
	 * es la primera vez que se llenara la base de datos
	 * @param  array $array_objetos El array de todos los objetos cliente
	 * @return boolean Si se guardo exitosamente retorna TRUE
	 */
	public function nuevaInfo($array_objetos)
	{
		$total = count($array_objetos);
		$exitos = 0;
		foreach ($array_objetos as $objecto) {
			if ($this->insert($objecto)) {
				$exitos++;
			}
		}
		return ($exitos == $total) ? TRUE : FALSE;
	}

	/**
	 * Este metodo solo sera usado unicamente si
	 * es la primera vez que se llenara la base de datos
	 * @param  array $array_objetos El array de todos los objetos cliente
	 * @return boolean Si se guardo exitosamente retorna TRUE
	 */
	public function insertBatch($array_objetos)
	{
		return $this->db->insert_batch($this->table, $array_objetos);
	}

	/**
	 * Compara datos de un txt con los de la BD. Esto es para saber
	 * si hay nuevos objetos o modificaciones en productos o lcientes.
	 *
	 * @param  array $array_objectos Array de objetos
	 */
	public function compararDatos($array_objectos)
	{
		// Hago la peticion a la BD
		$query = $this->db->get($this->table);
		// Si la peticion arroja mas de 0 resultados
		if ($query->num_rows() > 0) {
			// Asigno a variable un array de objetos
			$array_bd				= $query->result();
			// Array para guardar nuevos o modificados
			$array_modificados	= array();
			// Ciclo para extraer todos los modificados y nuevos
			$totalObjetos = count($array_objectos);
			for ($i=0; $i < $totalObjetos; $i++) {
				// Si no existe o esta modificado
				if (!in_array($array_objectos[$i], $array_bd)) {
					// Añado clientes nuevos o modificados
					array_push($array_modificados, $array_objectos[$i]);
				}
			}
			// Si hay nuevos o modificados
			if ($total_modificados = count($array_modificados)) {
				// Variables de apoyo
				$array_codigos_db	= array();
				$modificado			= 0;
				$insertado				= 0;
				$total_bd 				= count($array_bd);
				// Ciclo para extraer los codigos de los clientes de la BD
				for ($i=0; $i < $total_bd; $i++) {
					// Añado los codigos de la BD al array
					array_push($array_codigos_db, $array_bd[$i]->codigo);
				}
				// Ciclo para añadir o modifiar los clientes en la BD
				for ($i=0; $i < $total_modificados; $i++) {
					if (in_array($array_modificados[$i]->codigo, $array_codigos_db)) {
						// Update
						$this->db->where('codigo', $array_modificados[$i]->codigo);
						if($this->db->update($this->table, $array_modificados[$i])) {
							$modificado++;
						}
					} else {
						// Insert
						if($this->db->insert($this->table, $array_modificados[$i])) {
							$insertado++;
						}
					}
				}
				return ($total_modificados == ($modificado+$insertado)) ? TRUE : FALSE;
			}
		}
	}

	/**
	 * Funcion que limpia, organiza y acomoda la info
	 * del TXT de forma adecuada. Esta funcion es para
	 * CLIENTES y PRODUCTOS
	 *
	 * @param  string $path_txt Todo la informacion leida del TXT
	 * @param string $tipo El tipo de elemento a procesar (cliente o producto)
	 * @return array $array_info El array con toda la informacion procesada
	 */
	public function cleanData($path_txt, $tipo)
	{
		// Cargo helper file
		$this->load->helper('file');
		$this->load->helper('text');
		// Leo el archivo y almaceno en variable
		$data_file = read_file($path_txt);
		// Convierte en array linea por linea del texto
		$lines = explode("\n", $data_file);
		// FIltro array de lineas extrayendo solo valores a usar
		// (Quito las 3 primeras lineas que no me sirven)
		$lines = array_slice($lines, 3);
		// Array que guardara objetos (variable a retornar)
		$array_info = array();
		//Total de lineas
		$totalLineas = count($lines);
		// Ciclo para filtrar linea por linea
		for ($i=0; $i < $totalLineas; $i++) {
			// Asigno una linea a una variable
			$line = entities_to_ascii(ascii_to_entities($lines[$i]));
			// Si la linea no esta vacia
			if (!empty($line)) {
				// La linea la transformo a un array,
				// tomando solo los elementos a trabajar
				$line_explode = explode("\t", $line);
				// Elimino la ultima posicion del array (No me sirve)
				array_pop($line_explode);
				// Total de elementos
				$totalElementos = count($line_explode);
				// Segun el tipo a procesar
				if ($tipo === 'cliente') {
					for ($j=0; $j < $totalElementos; $j++) {
						// Elimino los espacion en blanco del inicio y final
						// de cada elemento del array
						$line_explode[$j] = trim($line_explode[$j]);
					}
					// Si los elementos son de 15 elementos
					if ($totalElementos == 15) {
						// Agrego al array de clientes los objetos
						// correspondientes de cada cliente creado
						array_push($array_info, $line_explode);
					}
				} elseif ($tipo === 'producto') {
					// Array de los elementos finales
					$elementos = array();
					for ($j=0; $j < $totalElementos; $j++) {
						// Elimino los espacios en blanco del inicio y final
						// de cada elemento del array
						$line_explode[$j] = trim($line_explode[$j]);
						// Si hay espacios en blanco entre los campos lo quito
						if (!empty($line_explode[$j])) {
							array_push($elementos, $line_explode[$j]);
						}
					}
					/**
					 *  Si los elementos son de 7 elementos (uso count de $elementos porque si uso
					 *  $totalElementos puede variar su tamaño, en la linea 258 valoro si hay
					 *  campo vacios al cual ya solo me debe reducir a 7 campos)
					 */
					if (count($elementos) == 7) {
						// Agrego al array de elementos del producto
						array_push($array_info, $elementos);
					}
				}
			}
		}
		return $array_info;
	}

	/**
	 * Funcion para comprobar si un archivo
	 * tiene el mismo patron requerido
	 * para el procesamiento de datos.
	 * @param  array $file_txt Array del archivo a subir
	 * @return boolean           Si el patron es correcto, retorna TRUE
	 */
	public function pattern_check($file_txt)
	{
		// Cargo helper file
		$this->load->helper('file');
		// Leo el archivo y almaceno en variable
		$data_file			= read_file($file_txt['tmp_name']);
		$data_pattern		= read_file('assets/patterns/'.$this->file_txt.'.txt');
		// Convierte en array linea por linea del texto
		$lines_file			= explode("\n", $data_file);
		$lines_pattern		= explode("\n", $data_pattern);
		// Extraigo las 3 primeras lineas del archivo a comprobar
		$lines_file			= array_slice($lines_file, 0, 3);
		// Convierte a strings los arreglos
		$str_file			= implode($lines_file);
		$str_pattern		= implode($lines_pattern);
		log_message('error', $str_file);
		log_message('error', $str_pattern);
		log_message('error', strlen($str_file).' - '.strlen($str_pattern));
		// Comparo strings
		return ($str_file == $str_pattern) ? TRUE : FALSE;
	}
}

/* End of file MY_Model.php */
/* Location: ./application/models/MY_Model.php */