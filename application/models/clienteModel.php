<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la gestion de datos de los clientes
 *
 * @author Diego Rodriguez | Luis Macias
 **/
class Clientemodel extends TxtManager {

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
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
		$this->file_txt	= self::TABLE;
	}

	/**
	* Funcion para crear un objeto cliente a partir
	* de un arreglo formador por valores de un formulario
	*
	* @return $basica clientes
	* @author Diego Rodriguez | Luis Macias
	**/
	public function array_to_object($data, $tipo = null, $nuevo = FALSE)
	{
		$this->basica_cliente = new stdClass();

		// Si el cliente es NUEVO
		if ($nuevo)
		{
			$this->basica_cliente->codigo			= date('dm-His'); // Definir patron
			$this->basica_cliente->tipo			= 'prospecto';
		}

		$this->basica_cliente->razon_social	= trim(strtoupper($data['razon_social']));
		$this->basica_cliente->email			= trim(strtolower($data['email']));
		$this->basica_cliente->telefono1		= trim($data['telefono1']);
		$this->basica_cliente->usuario			= $data['usuario'];
		$this->basica_cliente->password		= $data['password'];

		// Si el cliente es diferente a prospecto, capturo todos los datos
		if ($tipo != 'prospecto') {
			$this->basica_cliente->rfc				= trim(strtoupper($data['rfc']));
			$this->basica_cliente->tipo			= $data['tipo'];
			$this->basica_cliente->calle			= trim(ucwords(strtolower($data['calle'])));
			$this->basica_cliente->no_exterior	= trim(strtoupper($data['no_exterior']));
			$this->basica_cliente->no_interior		= trim(strtoupper($data['no_interior']));
			$this->basica_cliente->colonia			= trim(ucwords(strtolower($data['colonia'])));
			$this->basica_cliente->codigo_postal	= trim($data['codigo_postal']);
			$this->basica_cliente->ciudad			= trim(ucwords(strtolower($data['ciudad'])));
			$this->basica_cliente->municipio		= trim(ucwords(strtolower($data['municipio'])));
			$this->basica_cliente->estado			= $data['estado'];
			$this->basica_cliente->pais			= $data['pais'];
			$this->basica_cliente->telefono2		=  trim($data['telefono2']);
		}

		return $this->basica_cliente;
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
		$data		= $this->cleanData($pathTXT, 'cliente');
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
	 *  13 => string telefono1
	 *  14 => string telefono2
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
			$cliente->codigo				= $data_cliente[0];
			$cliente->razon_social			= $data_cliente[1];
			$cliente->rfc					= $data_cliente[2];
			$cliente->email				= $this->uniqueEmail($data_cliente[3]);
			$cliente->tipo					= 'normal';
			$cliente->calle					= $data_cliente[4];
			$cliente->no_exterior			= $data_cliente[5];
			$cliente->no_interior			= $data_cliente[6];
			$cliente->colonia				= $data_cliente[7];
			$cliente->codigo_postal		= $data_cliente[8];
			$cliente->ciudad				= $data_cliente[9];
			$cliente->municipio			= $data_cliente[10];
			$cliente->estado				= $data_cliente[11];
			$cliente->pais					= $data_cliente[12];
			$cliente->telefono1			= $data_cliente[13];
			$cliente->telefono2			= $data_cliente[14];
			$cliente->usuario				= $data_cliente[0];
			$cliente->password			= $this->password();
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
			$cliente['codigo']				= $data_cliente[0];
			$cliente['razon_social']			= $data_cliente[1];
			$cliente['rfc']					= $data_cliente[2];
			$cliente['email']				= $this->uniqueEmail($data_cliente[3]);
			$cliente['tipo']					= 'normal';
			$cliente['calle']					= $data_cliente[4];
			$cliente['no_exterior']			= $data_cliente[5];
			$cliente['no_interior']			= $data_cliente[6];
			$cliente['colonia']				= $data_cliente[7];
			$cliente['codigo_postal']		= $data_cliente[8];
			$cliente['ciudad']				= $data_cliente[9];
			$cliente['municipio']			= $data_cliente[10];
			$cliente['estado']				= $data_cliente[11];
			$cliente['pais']					= $data_cliente[12];
			$cliente['telefono1']			= $data_cliente[13];
			$cliente['telefono2']			= $data_cliente[14];
			$cliente['usuario']				= $data_cliente[0];
			$cliente['password']			= $this->password();
		} else {
			$cliente = null;
		}
		return $cliente;
	}

	/**
	 * Funciones para generar usuarios y contraseñas
	 *
	 * @return $usuario
	 * @author Luis Macias
	 **/
	public function usuario($nombre)
	{
		$nombre_array	= explode(" ", strtolower($nombre));
		$usuario		= (count($nombre_array) > 1) ? substr($nombre_array[0], 0, 3).
			substr($nombre_array[1], 0, 3).'_'.date('s') : substr($nombre_array[0], 0, 3).'_'.date('s');
		return $usuario;
	}

	/**
	 * Funciones para generar  contraseñas
	 *
	 * @return $password
	 * @author Luis Macias
	 **/
	public function password()
	{
		// $cadena="[^A-Z0-9]";
		// return substr(
		// 		preg_replace($cadena, "", md5(rand())) .
		// 		preg_replace($cadena, "", md5(rand())) .
		// 		preg_replace($cadena, "", md5(rand())),
		// 		0, rand(8, 10)
		// 	);
		return '12345';
	}

	/**
	 * Extraigo un solo email en caso de de contener dos
	 * @author Luis Macias
	 * @param  string $dataEmail El string con la info de los clientes
	 * @return String            Un solo direccion de email
	 */
	private function uniqueEmail($dataEmail)
	{
		if (!empty($dataEmail))
		{
			$email  = explode(" ", $dataEmail);
			$email	= $email[0];
			return $email;
		} else {
			return $dataEmail;
		}
	}
}

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */