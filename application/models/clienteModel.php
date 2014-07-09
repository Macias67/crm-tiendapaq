<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la gestion de datos de los clientes
 *
 * @author Diego
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
	* con sus metodos
	*
	* @return $basica clientes
	* @author Diego Rodriguez | Luis Macias
	**/
	public function arrayToObject($data, $tipo = null)
	{
		$this->basica_cliente = new stdClass();

		$this->basica_cliente->codigo		  	= 'p_'.date('dmHis');
		$this->basica_cliente->razon_social	= $data['razon_social'];
		$this->basica_cliente->email		  	= $data['email'];
		$this->basica_cliente->tipo			    = "prospecto";
		$this->basica_cliente->calle			  = $data['calle'];
		$this->basica_cliente->ciudad			  = $data['ciudad'];
		$this->basica_cliente->estado			  = $data['estado'];
		$this->basica_cliente->telefono1		= $data['telefono1'];

		// Si el cliente es diferente a prospecto, capturo todos los datos
		if ($tipo != 'prospecto') {
			$this->basica_cliente->rfc				    = $data['rfc'];
			$this->basica_cliente->tipo			      = $data['tipo'];
			$this->basica_cliente->no_exterior	  = $data['no_exterior'];
			$this->basica_cliente->no_interior		= $data['no_interior'];
			$this->basica_cliente->colonia			  = $data['colonia'];
			$this->basica_cliente->codigo_postal	= $data['codigo_postal'];
			$this->basica_cliente->municipio		  = $data['municipio'];
			$this->basica_cliente->pais			      = $data['pais'];
			$this->basica_cliente->telefono2		  = $data['telefono2'];
		}

		return $this->basica_cliente;
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
}

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */