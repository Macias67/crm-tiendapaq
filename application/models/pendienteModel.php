<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'pendientes';

	/**
	 * variable que sera convertida a sdtClass
	 * y retornada como objeto
	 *
	 * @var $basica_clientes
	 **/
	private $pendiente;

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
	 * con sus atributos
	 * @param array $data Arreglo a trasformar
	 * @return object
	 * @author Luis Macias
	 **/
	public function arrayToObject($data)
	{
		$this->pendiente = new stdClass();

		$this->pendiente->id_ejecutivo	= $data['id_ejecutivo'];
		$this->pendiente->id_creador		= $data['id_creador'];
		$this->pendiente->id_empresa	= $data['id_empresa'];
		$this->pendiente->actividad		= $data['actividad'];
		$this->pendiente->estatus		= $data['estatus'];
		$this->pendiente->descripcion	= $data['descripcion'];

		return $this->pendiente;
	}

}

/* End of file pendienteModel.php */
/* Location: ./application/models/pendienteModel.php */