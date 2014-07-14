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

 public function oficinas($accion=null)
 {
 	switch ($accion) {
 		case 'editar':
			$oficina_editada = json_decode(stripslashes($_POST['oficina_editada']));

			$respuesta = array(
				'exito'		=> TRUE,
				'msg'	=> $oficina_editada
			);

			$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode($respuesta));
 		break;
 		case 'eliminar':

 		break;
 		default:

 			break;
 	}
 }
}

/* End of file gestorGeneral.php */
/* Location: ./application/controllers/gestorGeneral.php */