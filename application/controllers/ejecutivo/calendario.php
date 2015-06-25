<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para el manejar
 * el calendario
 *
 * @author Luis Macias
 **/
class Calendario extends AbstractAccess {

	/*
	* Vista principal donde muestra
	* el calendario de todos los ejecutivos
	 */
	public function index()
	{
		$this->data['titulo'] = 'hola';
		$this->_vista('calendario');
	}

}

/* End of file calendario.php */
/* Location: ./application/controllers/calendario.php */