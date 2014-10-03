<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla de ejecutivos
 *
 * @package default
 * @author Luis Macias
 **/
class EjecutivoModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'ejecutivos';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $ejecutivo
	 **/
	private $ejecutivo;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	/**
	* funcion para convertir un arreglo asociativo a un objeto
	* con sus metodos
	*
	* @param array $data Datos del ejecutivo
	* @param boolean $edirtado Esta variable es falsa si el ejecutivo es nuevo
	*                          y es verdadera el el ejecutivo se esta editando para
	*                          que datos agregar en el objeto
	* @return object $basica clientes
	* @author Diego Rodriguez | Luis Macias
	**/
	public function arrayToObject($data, $editado)
	{
		$this->ejecutivo = new stdClass();

		$this->ejecutivo->primer_nombre		= $data['primer_nombre'];
		$this->ejecutivo->segundo_nombre	= $data['segundo_nombre'];
		$this->ejecutivo->apellido_paterno	= $data['apellido_paterno'];
		$this->ejecutivo->apellido_materno	= $data['apellido_materno'];
		$this->ejecutivo->email				= $data['email'];
		$this->ejecutivo->telefono			= $data['telefono'];
		$this->ejecutivo->oficina				= $data['oficina'];
		$this->ejecutivo->departamento		= $data['departamento'];
		$this->ejecutivo->mensaje_personal	= "Bienenido a CRM Tiendapaq";

		if($editado==FALSE)
		{
			$this->ejecutivo->privilegios	= $data['privilegios'];
			$this->ejecutivo->usuario		= $data['usuario'];
			$this->ejecutivo->password	= $data['password'];
		}

		if($editado==TRUE)
		{
			$this->ejecutivo->mensaje_personal	= $data['mensaje_personal'];
		}

		return $this->ejecutivo;
	}

}

/* End of file ejecutivoModel.php */
/* Location: ./application/models/ejecutivoModel.php */