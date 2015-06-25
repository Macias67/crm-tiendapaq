<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo para la tabla de ejecutivos
 *
 * @package default
 * @author Luis Macias | Diego Rodriguez
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
	 * funcion para eliminar los asignadores de casos
	 * @return boolean
	 * @author Diego Rodriguez
	 **/
	public function elimina_asignadores()
	{
		$query = 'update '.$this->table.' set asignador_casos ="no"';

		return ($this->db->query($query)) ? TRUE : FALSE;
	}

	/**
	* funcion para convertir un arreglo asociativo a un objeto
	* con sus metodos
	*
	* @return $basica clientes
	* @author Diego Rodriguez | Luis Macias
	**/
	public function arrayToObject($data)
	{
		$this->ejecutivo_nuevo = new stdClass();

		$this->ejecutivo_nuevo->primer_nombre	= $data['primer_nombre'];
		$this->ejecutivo_nuevo->segundo_nombre	= $data['segundo_nombre'];
		$this->ejecutivo_nuevo->apellido_paterno	= $data['apellido_paterno'];
		$this->ejecutivo_nuevo->apellido_materno	= $data['apellido_materno'];
		$this->ejecutivo_nuevo->email			= $data['email'];
		$this->ejecutivo_nuevo->telefono		= $data['telefono'];
		$this->ejecutivo_nuevo->oficina		= $data['oficina'];
		$this->ejecutivo_nuevo->privilegios		= $data['privilegios'];
		$this->ejecutivo_nuevo->departamento	= $data['departamento'];
		$this->ejecutivo_nuevo->usuario		= $data['usuario'];
		$this->ejecutivo_nuevo->password		= $data['password'];

		return $this->ejecutivo_nuevo;
	}

}

/* End of file ejecutivoModel.php */
/* Location: ./application/models/ejecutivoModel.php */