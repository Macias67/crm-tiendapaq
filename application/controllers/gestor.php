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
		//carga de los modelos a usar en el controlador
		$this->load->model('departamentoModel');
		$this->load->model('oficinasModel');
		//carda de las variables con los datos que usaremos
		$this->data['oficinas'] = $this->oficinasModel->get(array('*'));
		$this->data['departamentos'] = $this->departamentoModel->get(array('*'));
	}
	public function index()
	{
		//var_dump($this->data);
		$this->_vista('oficinas_dptos');
	}
 public function add()
 {

 }
}

/* End of file gestorGeneral.php */
/* Location: ./application/controllers/gestorGeneral.php */