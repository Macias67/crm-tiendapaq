<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para la gestion de oficinas, departamentos,
 * sistemas contpaq y demas pequeños datos necesarios para el crm
 * @package default
 * @author Diego Rodriguez
 **/
class Gestor extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$this->_vista('principal');
	}
 public function add()
 {

 }
}

/* End of file gestorGeneral.php */
/* Location: ./application/controllers/gestorGeneral.php */