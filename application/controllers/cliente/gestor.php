<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para la gestion de la informacion relacionada con el cliente
 *
 * @package default
 * @author Diego
 **/
class Gestor extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//modelos a utilizar
		$this->load->model('contactosModel');
		$this->load->model('sistemasClienteModel');
		$this->load->model('equiposComputoModel');
	}

	public function index(){}

	public function add(){}

	/**
	 * Funcion para gestionar la informacion basica de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function basica($accion=null)
	{
		switch ($accion) {
			case 'nuevo':
				# code...
			break;

			case 'editar':
				# code...
			break;

			case 'eliminar':
				# code...
			break;

			default:
				$this->_vista("informacion_basica");
				//var_dump($this->data);
			break;
		}
	}

	/**
	 * Funcion para gestionar llos contactos de los clientes
	 * @return void
	 * @author Diego
	 **/
	public function contactos($accion=null)
	{
		//se cargan los contactos del cliente y se manda a llamar la vista
		$this->data['contactos_cliente']=$this->contactosModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));

		switch ($accion) {
			case 'nuevo':
				# code...
			break;

			case 'editar':
				# code...
			break;

			case 'eliminar':
				# code...
			break;

			default:
				$this->_vista("contactos");
				//var_dump($this->data);
			break;
		}
	}

	/**
	 * Funcion para gestionar los sistemas contpaqi de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function sistemas($accion=null)
	{
		//se cargan los sistemas contpaqui del cliente y se manda a llamar la vista
		$this->data['sistemas_contpaqi']=$this->sistemasClienteModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));

		switch ($accion) {
			case 'nuevo':
				# code...
			break;

			case 'editar':
				# code...
			break;

			case 'eliminar':
				# code...
			break;

			default:
				$this->_vista("sistemas_contpaqi");
				//var_dump($this->data);
			break;
		}
	}

	/**
	 * Funcion para gestionar los equipos de computo de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function equipos($accion=null)
	{
		//se cargan los equipos de computo del cliente y se manda a llamar la vista
		$this->data['equipo_computo']=$this->equiposComputoModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));

		switch ($accion) {
			case 'nuevo':
				# code...
			break;

			case 'editar':
				# code...
			break;

			case 'eliminar':
				# code...
			break;

			default:
				$this->_vista("equipos_computo");
				var_dump($this->data);
			break;
		}
	}

}

/* End of file gestor.php */
/* Location: ./application/controllers/gestor.php */