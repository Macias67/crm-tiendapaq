<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo con informacion con los
 * tipos de actividades que se pueden hacer
 * generando un pendiente.
 *
 * @author Luis Macias
 */
class ActividadPendienteModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = '	actividades_pendiente';

	/*
	* Actividades disponibles
	 */
	var $SOLICITA_COTIZACION		= '1';
	var $ASESORIA_ESPECIFICA		= '2';
	var $ASESORIA_DIAGNOSTICO	= '3';
	var $SOLICITA_INFO				= '4';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}
}

/* End of file actividadPendienteModel.php */
/* Location: ./application/models/actividadPendienteModel.php */