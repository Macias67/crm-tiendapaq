<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para gestionar la informacion respecto a los casos
 *
 * @package default
 * @author Diego Rodriguez
 **/

class Caso extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('casoModel');
	}
	/**
	 * Funcion de inicio para asignar casos
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->load->model('clienteModel');
		$this->load->helper('formatofechas_helper');

		$id_cliente = $this->data['usuario_activo']['id'];
		$campos = array('caso.id as id_caso',
										'caso.id_estatus_general',
			              'clientes.razon_social',
			              'ejecutivos.primer_nombre',
			              'ejecutivos.apellido_paterno',
			              'estatus_general.descripcion',
			              'caso.id_cliente','caso.folio_cotizacion',
			              'caso.fecha_inicio','caso.fecha_final');

		$this->data['casos_cliente'] = $this->casoModel->get_casos_cliente($campos,$id_cliente);

		$this->_vista('casos_cliente');
	}

	/**
	 * Funcion para mostrar los detalles de un caso
	 *
	 * @author Diego Rodriguez
	 **/
	public function detalles($id_caso)
	{
		$this->load->helper('formatofechas_helper');

		//verificamos si el caso un no tiene lider para saber como hacer la consulta en eñl model
		$lider = $this->casoModel->get(array('id_lider'), array('id' => $id_caso), null, 'ASC', 1);

		if(empty($lider->id_lider)){
			$this->data['caso'] = $this->casoModel->get_caso_detalles($id_caso, 'vacio');
			$this->data['caso']->primer_nombre = 'SIN';
			$this->data['caso']->apellido_paterno = ' LIDER';

		}else{
			$this->data['caso'] = $this->casoModel->get_caso_detalles($id_caso);
		}

		$this->_vista_completa('caso/modal-detalles-caso');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */