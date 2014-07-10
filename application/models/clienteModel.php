<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la gestion de datos de los clientes
 *
 * @author Diego Rodriguez
 **/
class ClienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'clientes';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $basica_clientes
	 **/
	private $basica_cliente;

	/**
	 * Archivo TXT usado para comparar
	 *
	 * @var string
	 **/
	protected $file_txt;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
		$this->file_txt		= self::TABLE;
	}

	/**
	* funcion para convertir un arreglo asociativo a un objeto
	* con sus atributos
	*
	* @return $basica clientes
	* @author Diego Rodriguez | Luis Macias
	**/
	public function arrayToObject($data, $tipo = null)
	{
		$this->basica_cliente = new stdClass();

		$this->basica_cliente->codigo			  = date('dmHis');
		$this->basica_cliente->razon_social	= $data['razon_social'];
		$this->basica_cliente->email			  = $data['email'];
		$this->basica_cliente->tipo		    	= "prospecto";
		$this->basica_cliente->calle	 		  = $data['calle'];
		$this->basica_cliente->ciudad			  = $data['ciudad'];
		$this->basica_cliente->estado			  = $data['estado'];
		$this->basica_cliente->telefono1		= $data['telefono1'];

		// Si el cliente es diferente a prospecto, capturo todos los datos
		if ($tipo != 'prospecto') {
			$this->basica_cliente->rfc				   = $data['rfc'];
			$this->basica_cliente->tipo			     = $data['tipo'];
			$this->basica_cliente->no_exterior	 = $data['no_exterior'];
			$this->basica_cliente->no_interior	 = $data['no_interior'];
			$this->basica_cliente->colonia			 = $data['colonia'];
			$this->basica_cliente->codigo_postal = $data['codigo_postal'];
			$this->basica_cliente->municipio		 = $data['municipio'];
			$this->basica_cliente->pais			     = $data['pais'];
			$this->basica_cliente->telefono2		 = $data['telefono2'];
		}

		return $this->basica_cliente;
	}

	/**
	 * Funcion para comprobar si un archivo
	 * tiene el mismo patron requerido
	 * para el procesamiento de datos
 * @author Diego Rodriguez | Luis Macias
	 * @param  array $file_txt Array del archivo a subir
	 * @return boolean Si el patron es correcto, retorna TRUE
	 */
	public function pattern_check($file_txt)
	{
		// Cargo helper file
		$this->load->helper('file');
		// Leo el archivo y almaceno en variable
		$data_file			= read_file($file_txt['tmp_name']);
		$data_pattern	= read_file('assets/admin/patterns/'.$this->file_txt.'.txt');
		// Convierte en array linea por linea del texto
		$lines_file			= explode("\n", $data_file);
		$lines_pattern	= explode("\n", $data_pattern);
		// Extraigo las 3 primeras lineas del archivo a comprobar
		$lines_file			= array_slice($lines_file, 0, 3);
		// Convierte a strings los arreglos
		$str_file			= implode($lines_file);
		$str_pattern		= implode($lines_pattern);
		// Comparo strings
		return ($str_file == $str_pattern) ? TRUE : FALSE;
	}

	/**
	 * Metodo para transforma un archivo txt
	 * a un tipo de datos seleccionado, ya sea a objeto
	 * o array asociativo.
 	 * @author Diego Rodriguez | Luis Macias
	 * @param  string $pathTXT  La ruta del txt a transformar
	 * @param  string $dataType El tipo de dato a transformar 'objeto' o 'array'
	 * @return array            El array convertido a su dato correspondiente
	 */
	public function transformTXT($pathTXT, $dataType)
	{
		$data			 = $this->cleanData($pathTXT);
		$total_info	= count($data);
		$transform	= array();
		if ($dataType === 'objeto') {
			for ($i=0; $i < $total_info; $i++) {
				array_push($transform, $this->setObjectCliente($data[$i]));
			}
		} elseif ($dataType === 'array') {
			for ($i=0; $i < $total_info; $i++) {
				array_push($transform, $this->setArrayAssocCliente($data[$i]));
			}
		}
		return $transform;
	}

		/**
	 * Funcion que limpia, organiza y acomoda la info
	 * del TXT de forma adecuada. Esta funcion es para
	 * CLIENTES y PRODUCTOS
	 * @author Diego Rodriguez | Luis Macias
	 * @param  string $path_txt Todo la informacion leida del TXT
	 * @param string $tipo El tipo de elemento a procesar (cliente o producto)
	 * @return array $array_info El array con toda la informacion procesada
	 */
	public function cleanData($path_txt)
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
				// Elementos a procesar
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
			}
		}
		return $array_info;
	}

	/**
	 * Funcion para devolver los datos de
	 * un cliente en forma de objeto con sus
	 * atributos:
	 *
	 *  0 => string codigo
	 *  1 => string razon
	 *  2 => string rfc
	 *  3 => string email
	 *  4 => string calle
	 *  5 => string no_exterior
	 *  6 => string no_interior
	 *  7 => string colonia
	 *  8 => string codigo_postal
	 *  9 => string ciudad
	 *  10 => string municipio
	 *  11 => string estado
	 *  12 => string pais
	 *  13 => string telefono_1
	 *  14 => string telefono_2
	 *
	 * @author Diego Rodriguez | Luis Macias
	 * @param array $data_cliente Array con la info del cliente
	 * @return object El objeto del cliente con sus atributos
	 */
	private function setObjectCliente($data_cliente)
	{
		if (count($data_cliente) == 15) {
			// Creacion del objeto cliente
			$cliente = new stdClass();
			// Atributos
			$cliente->codigo      	  = $data_cliente[0];
			$cliente->razon_social    = $data_cliente[1];
			$cliente->rfc           	= $data_cliente[2];
			$cliente->email           = $this->uniqueEmail($data_cliente[3]);
			$cliente->tipo						= "normal";
			$cliente->calle         	= $data_cliente[4];
			$cliente->no_exterior   	= $data_cliente[5];
			$cliente->no_interior   	= $data_cliente[6];
			$cliente->colonia       	= $data_cliente[7];
			$cliente->codigo_postal 	= $data_cliente[8];
			$cliente->ciudad        	= $data_cliente[9];
			$cliente->municipio    		= $data_cliente[10];
			$cliente->estado        	= $data_cliente[11];
			$cliente->pais          	= $data_cliente[12];
			$cliente->telefono_1    	= $data_cliente[13];
			$cliente->telefono_2    	= $data_cliente[14];
			$cliente->usuario       	= $data_cliente[0];
			$cliente->password      	= $this->password();
		} else {
			$cliente = null;
		}
		return $cliente;
	}

	/**
	 * Funcion para devolver los datos de
	 * un cliente en forma de objeto con sus
	 * atributos:
	 *
	 *  0 => string codigo
	 *  1 => string razon
	 *  2 => string rfc
	 *  3 => string email
	 *  4 => string calle
	 *  5 => string no_exterior
	 *  6 => string no_interior
	 *  7 => string colonia
	 *  8 => string codigo_postal
	 *  9 => string ciudad
	 *  10 => string municipio
	 *  11 => string estado
	 *  12 => string pais
	 *  13 => string telefono_1
	 *  14 => string telefono_2
	 *
	 * @author Diego Rodriguez | Luis Macias
	 * @param array $data_cliente Array con la info del cliente
	 * @return object El objeto del cliente con sus atributos
	 */
	private function setArrayAssocCliente($data_cliente)
	{
		if (count($data_cliente) == 15) {
			$cliente = array();
			// Atributos
			$cliente['codigo']      	= $data_cliente[0];
			$cliente['razon_social']  = $data_cliente[1];
			$cliente['rfc']           = $data_cliente[2];
			$cliente['email']         = $this->uniqueEmail($data_cliente[3]);
			$cliente['tipo']					= "normal";
			$cliente['calle']        	= $data_cliente[4];
			$cliente['no_exterior']   = $data_cliente[5];
			$cliente['no_interior']   = $data_cliente[6];
			$cliente['colonia']       = $data_cliente[7];
			$cliente['codigo_postal'] = $data_cliente[8];
			$cliente['ciudad']        = $data_cliente[9];
			$cliente['municipio']    	= $data_cliente[10];
			$cliente['estado']       	= $data_cliente[11];
			$cliente['pais']         	= $data_cliente[12];
			$cliente['telefono_1']   	= $data_cliente[13];
			$cliente['telefono_2']    = $data_cliente[14];
			$cliente['usuario']      	= $data_cliente[0];
			$cliente['password']    	= $this->password();
		} else {
			$cliente = null;
		}
		return $cliente;
	}

	/**
	 * Funciones para generar usuarios y contraseñas
	 *
	 * @return $usuario, $password
	 * @author Luis Macias
	 **/

	public function usuario($nombre)
	{
		$nombre_array	= explode(" ", strtolower($nombre));
		$usuario			= (count($nombre_array) > 1) ? substr($nombre_array[0], 0, 3).
			substr($nombre_array[1], 0, 3).'_'.date('s') :
			substr($nombre_array[0], 0, 3).'_'.date('s');
		return $usuario;
	}

	public function password()
	{
		$this->load->library('encrypt');
		$encrypt_string  = $this->encrypt->encode(date('d/m/Y H:i:s'));
		$encrypt_string	 = sha1(substr($encrypt_string, 0,32));
		$var_final			 = $this->encrypt->encode($encrypt_string);
		$password 		   = substr($var_final, 0, rand(8,10));
		return $password;
	}

	/**
	 * Extraigo un solo email en caso de de contener dos
	 * @author Luis Macias
	 * @param  string $dataEmail El string con la info de los clientes
	 * @return String            Un solo direccion de email
	 */
	private function uniqueEmail($dataEmail)
	{
		if (!empty($dataEmail)) {
			$email = explode(" ", $dataEmail);
			$email = $email[0];
			return $email;
		} else {
			return $dataEmail;
		}
	}

	/**
	 * Este metodo solo sera usado unicamente si
	 * es la primera vez que se llenara la base de datos en los clientes
	 * @author Luis Macias
	 * @param  array $array_objetos El array de todos los objetos cliente
	 * @return boolean Si se guardo exitosamente retorna TRUE
	 */
	public function insertBatch($array_objetos)
	{
	  return $this->db->insert_batch($this->table, $array_objetos);
	}

}//Class End

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */