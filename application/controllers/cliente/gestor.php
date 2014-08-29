<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para la gestion de la informacion relacionada con el cliente
 *
 * @package default
 * @author Diego
 **/
class Gestor extends AbstractAccess {

	public function index(){}

	public function add(){}

	/**
	 * Funcion para gestionar la informacion basica de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function basica()
	{
		$this->_vista("informacion_basica");
		var_dump($this->data);
	}

	/**
	 * Funcion para gestionar llos contactos de los clientes
	 * @return void
	 * @author Diego
	 **/
	public function contactos()
	{
		$this->_vista("contactos");
		var_dump($this->data);
	}

	/**
	 * Funcion para gestionar los sistemas contpaqi de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function sistemas()
	{
		$this->_vista("sistemas_contpaqi");
		var_dump($this->data);
	}

	/**
	 * Funcion para gestionar los equipos de computo de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function equipos()
	{
		$this->_vista("equipos_computo");
		var_dump($this->data);
	}

}

/* End of file gestor.php */
/* Location: ./application/controllers/gestor.php */