<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * clase para la gestion de productos
 * @author Diego Rodriguiez
 **/
class Producto extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//cargamos la libreria
		$this->load->library('form_validation');
		//cargamos modelos a usar
		$this->load->model('productoModel');
		$this->data['productos']=$this->productoModel->get(array('*'));
	}

	public function index()
	{
		//var_dump($this->data);
		$this->_vista('productos');
	}

	public function add()
	{
	}

	/**
 	 * funciona para gestionar los productos y servicios
 	 * @author Diego Rodriguez
 	 **/
 	public function gestor($accion=null)
	{
		switch ($accion) {
			case 'nuevo':
			//reglas de validacion para el producto
				$this->form_validation->set_rules('codigo_new','Código','trim|required|strtoupper|max_length[10]|callback_codigo_check|xss_clean');
				$this->form_validation->set_rules('descripcion','Descripción','trim|required|strtoupper|max_length[100]|xss_clean');
				$this->form_validation->set_rules('precio','Precio','trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('unidad','Unidad','trim|xss_clean');
				$this->form_validation->set_rules('impuesto_1','Impuesto 1','trim|numeric|xss_clean');
				$this->form_validation->set_rules('impuesto_2','Impuesto 2','trim|numeric|xss_clean');
				$this->form_validation->set_rules('retencion_1','Retención 1','trim|numeric|xss_clean');
				$this->form_validation->set_rules('retencion_2','Retención 2','trim|numeric|xss_clean');

				if(!$this->form_validation->run()){
					$respuesta = array('exito' => FALSE,'msg' => validation_errors());
				}else{
					$producto = array(
						'codigo' 	    => $this->input->post('codigo_new'),
						'descripcion' => $this->input->post('descripcion'),
						'precio' 	    => $this->input->post('precio'),
						'unidad' 	    => $this->input->post('unidad'),
						'impuesto1' 	=> $this->input->post('impuesto1'),
						'impuesto2' 	=> $this->input->post('impuesto2'),
						'retencion1' 	=> $this->input->post('retencion1'),
						'retencion2' 	=> $this->input->post('retencion2')
					 );

					if(!$this->productoModel->insert($producto)){
						$respuesta = array('exito' => FALSE,'msg' => "No se agrego, revisa la consola o la base de datos");
					}else{
						$respuesta=array(
		 					'exito' => TRUE,
		 					'producto' => $producto['descripcion']);
					}

				}

				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
			break;

			case 'editar':
				//reglas de validacion para el producto
				$this->form_validation->set_rules('codigo_new','Código','trim|required|strtoupper|max_length[10]|callback_codigo_check|xss_clean');
				$this->form_validation->set_rules('descripcion','Descripción','trim|required|strtoupper|max_length[100]|xss_clean');
				$this->form_validation->set_rules('precio','Precio','trim|numeric|xss_clean');
				$this->form_validation->set_rules('unidad','Unidad','trim|xss_clean');
				$this->form_validation->set_rules('impuesto_1','Impuesto 1','trim|numeric|xss_clean');
				$this->form_validation->set_rules('impuesto_2','Impuesto 2','trim|numeric|xss_clean');
				$this->form_validation->set_rules('retencion_1','Retención 1','trim|numeric|xss_clean');
				$this->form_validation->set_rules('retencion_2','Retención 2','trim|numeric|xss_clean');

				if(!$this->form_validation->run()){
					$respuesta = array('exito' => FALSE,'msg' => validation_errors());
				}else{
					$codigo = $this->input->post('codigo_old');

					$producto = array(
						'codigo' 	    => $this->input->post('codigo_new'),
						'descripcion' => $this->input->post('descripcion'),
						'precio' 	    => $this->input->post('precio'),
						'unidad' 	    => $this->input->post('unidad'),
						'impuesto1' 	=> $this->input->post('impuesto1'),
						'impuesto2' 	=> $this->input->post('impuesto2'),
						'retencion1' => $this->input->post('retencion1'),
						'retencion2' => $this->input->post('retencion2')
						 );

					if(!$this->productoModel->update($producto,array('codigo' => $codigo))){
						$respuesta = array('exito' => FALSE,'msg' => "No se agrego, revisa la consola o la base de datos");
					}else{
						$respuesta=array(
		 					'exito' => TRUE,
		 					'producto' => $producto['descripcion']);
					}
				}

				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$codigo=$this->input->post('codigo');
				$producto=$this->input->post('producto');

				if(!$this->productoModel->delete(array('codigo' => $codigo))){
						$respuesta = array('exito' => FALSE,'msg' => "No se elimino, revisa la consola o la base de datos");
				}else{
				$respuesta=array(
 					'exito' => TRUE,
 					'producto' => $producto);
				}

				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
			break;

			default:
				$this->_vista('productos');
			break;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/
	/**
	 * Callback para revisar el sistema este correctamente añadido
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function codigo_check($codigo)
	{
		// SI el codigo ya existe y no es mismo que ya tenia
		$codigo_old = $this->input->post('codigo_old');
		if ($this->productoModel->exist(array('codigo' => $codigo)) && $codigo!=$codigo_old)
		{
			$this->form_validation->set_message('codigo_check', 'El código ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */