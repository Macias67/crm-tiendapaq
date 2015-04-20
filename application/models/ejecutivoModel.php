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

}

/* End of file ejecutivoModel.php */
/* Location: ./application/models/ejecutivoModel.php */