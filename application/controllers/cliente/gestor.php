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
		//cargamos la libreria
		$this->load->library('form_validation');
		//modelos a utilizar
		$this->load->model('contactosModel');
		$this->load->model('sistemasContpaqiModel');
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
				//reglas de contactos
				$this->form_validation->set_rules('nombre_contacto', 'Nombre', 'trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email_comtacto', 'Email', 'trim|strtolower|valid_email|max_length[30]|xss_clean');
				$this->form_validation->set_rules('telefono_contacto', 'Teléfono', 'trim|max_length[14]|xss_clean');
				$this->form_validation->set_rules('puesto_contacto', 'Puesto', 'trim|strtolower|ucwords|max_length[20]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$contacto = array(
						'id_cliente'				 => $this->data['usuario_activo']['id'],
						'nombre_contacto' 	 => $this->input->post('nombre_contacto'),
						'apellido_paterno' 	 => $this->input->post('apellido_paterno'),
						'apellido_materno' 	 => $this->input->post('apellido_materno'),
						'email_contacto' 	 	 => $this->input->post('email_contacto'),
						'telefono_contacto'  => $this->input->post('telefono_contacto'),
						'puesto_contacto' 	 => $this->input->post('puesto_contacto')
					);
					//inserto en la bd
					if(!$this->contactosModel->insert($contacto))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'contacto' => $contacto['nombre_contacto'].' '.$contacto['apellido_paterno'].' '.$contacto['apellido_materno']);
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
			break;

			case 'editar':
				//reglas de contactos
				$this->form_validation->set_rules('nombre_contacto', 'Nombre', 'trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email_comtacto', 'Email', 'trim|strtolower|valid_email|max_length[30]|xss_clean');
				$this->form_validation->set_rules('telefono_contacto', 'Teléfono', 'trim|max_length[14]|xss_clean');
				$this->form_validation->set_rules('puesto_contacto', 'Puesto', 'trim|strtolower|ucwords|max_length[20]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$contacto = array(
						'nombre_contacto' 	 => $this->input->post('nombre_contacto'),
						'apellido_paterno' 	 => $this->input->post('apellido_paterno'),
						'apellido_materno' 	 => $this->input->post('apellido_materno'),
						'email_contacto' 	 	 => $this->input->post('email_contacto'),
						'telefono_contacto'  => $this->input->post('telefono_contacto'),
						'puesto_contacto' 	 => $this->input->post('puesto_contacto')
					);

					//obtenemos el id para saber donde actualizar
					$id = $this->input->post('id');
					//actualizo en la bd
					if(!$this->contactosModel->update($contacto, array('id' => $id)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'contacto' => $contacto['nombre_contacto'].' '.$contacto['apellido_paterno'].' '.$contacto['apellido_materno']);
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
	 		  //se eliminara con el id, la ciudad y estado es colo para mostrar que oficina se borro mas esteticamente
	 			$id = $this->input->post('id');
	 			$nombre_contacto = $this->input->post('nombre_contacto');
	 			$apellido_paterno = $this->input->post('apellido_paterno');
	 			$apellido_materno = $this->input->post('apellido_materno');

	 			$cont=count($this->contactosModel->get_where(array('id_cliente' => $this->data['usuario_activo']['id'])));
	 			if($cont==1){
	 				$respuesta = array('exito' => FALSE, 'msg' => 'No se puede eliminar, necesitas almenos un contacto');
	 			}else{
	 				if (!$this->contactosModel->delete(array('id' => $id)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
					}else
					{
						$respuesta = array('exito' => TRUE, 'contacto' => $nombre_contacto.' '.$apellido_paterno.' '.$apellido_materno);
					}
	 			}

	      //mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
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
		$this->data['sistemas_contpaqi']=$this->sistemasContpaqiModel->get(array('*'));
		$this->data['sistemas_contpaqi_cliente']=$this->sistemasClienteModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));

		switch ($accion) {
			case 'nuevo':
				# code...
			break;

			case 'editar':
				# code.
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