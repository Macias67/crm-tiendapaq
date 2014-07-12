<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la gestion de datos de los clientes
 *
 * @author Diego Rodriguez
 **/
class ClienteModel extends TxtManager {

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
	* funcion para convertir un arreglo asociativo a un objeto
	* con sus atributos
	*
	* @return $basica clientes
	* @author Diego Rodriguez | Luis Macias
	**/
	public function arrayToObject($data, $tipo = null)
	{
		$this->basica_cliente = new stdClass();

		$this->basica_cliente->codigo			= date('dmHis');
		$this->basica_cliente->razon_social	= $data['razon_social'];
		$this->basica_cliente->email			= $data['email'];
		$this->basica_cliente->tipo			= "prospecto";
		$this->basica_cliente->calle			= $data['calle'];
		$this->basica_cliente->ciudad			= $data['ciudad'];
		$this->basica_cliente->estado			= $data['estado'];
		$this->basica_cliente->telefono1		= $data['telefono1'];

		// Si el cliente es diferente a prospecto, capturo todos los datos
		if ($tipo != 'prospecto') {
			$this->basica_cliente->rfc				= $data['rfc'];
			$this->basica_cliente->tipo			= $data['tipo'];
			$this->basica_cliente->no_exterior	= $data['no_exterior'];
			$this->basica_cliente->no_interior		= $data['no_interior'];
			$this->basica_cliente->colonia			= $data['colonia'];
			$this->basica_cliente->codigo_postal	= $data['codigo_postal'];
			$this->basica_cliente->municipio		= $data['municipio'];
			$this->basica_cliente->pais			= $data['pais'];
			$this->basica_cliente->telefono2		= $data['telefono2'];
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
		$data		= $this->cleanData($pathTXT);
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
			$cliente->codigo			= $data_cliente[0];
			$cliente->razon_social		= $data_cliente[1];
			$cliente->rfc				= $data_cliente[2];
			$cliente->email			= $this->uniqueEmail($data_cliente[3]);
			$cliente->tipo				= "normal";
			$cliente->calle				= $data_cliente[4];
			$cliente->no_exterior		= $data_cliente[5];
			$cliente->no_interior		= $data_cliente[6];
			$cliente->colonia			= $data_cliente[7];
			$cliente->codigo_postal	= $data_cliente[8];
			$cliente->ciudad			= $data_cliente[9];
			$cliente->municipio		= $data_cliente[10];
			$cliente->estado			= $data_cliente[11];
			$cliente->pais				= $data_cliente[12];
			$cliente->telefono_1		= $data_cliente[13];
			$cliente->telefono_2		= $data_cliente[14];
			$cliente->usuario			= $data_cliente[0];
			$cliente->password		= $this->password();
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
			$cliente['codigo']			= $data_cliente[0];
			$cliente['razon_social']		= $data_cliente[1];
			$cliente['rfc']				= $data_cliente[2];
			$cliente['email']			= $this->uniqueEmail($data_cliente[3]);
			$cliente['tipo']				= "normal";
			$cliente['calle']				= $data_cliente[4];
			$cliente['no_exterior']		= $data_cliente[5];
			$cliente['no_interior']		= $data_cliente[6];
			$cliente['colonia']			= $data_cliente[7];
			$cliente['codigo_postal']	= $data_cliente[8];
			$cliente['ciudad']			= $data_cliente[9];
			$cliente['municipio']		= $data_cliente[10];
			$cliente['estado']			= $data_cliente[11];
			$cliente['pais']				= $data_cliente[12];
			$cliente['telefono_1']		= $data_cliente[13];
			$cliente['telefono_2']		= $data_cliente[14];
			$cliente['usuario']			= $data_cliente[0];
			$cliente['password']		= $this->password();
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
		$usuario		= (count($nombre_array) > 1) ? substr($nombre_array[0], 0, 3).
			substr($nombre_array[1], 0, 3).'_'.date('s') : substr($nombre_array[0], 0, 3).'_'.date('s');
		return $usuario;
	}

	public function password()
	{
		$this->load->library('encrypt');
		$encrypt_string	= $this->encrypt->encode(date('d/m/Y H:i:s'));
		$encrypt_string	= sha1(substr($encrypt_string, 0,32));
		$var_final			= $this->encrypt->encode($encrypt_string);
		$password			= substr($var_final, 0, rand(8,10));
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
			$email	= explode(" ", $dataEmail);
			$email	= $email[0];
			return $email;
		} else {
			return $dataEmail;
		}
	}
}//Class End

/* End of file clienteModel.php */
/* Location: ./application/models/clienteModel.php */