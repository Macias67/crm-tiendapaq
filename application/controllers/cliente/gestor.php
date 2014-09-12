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
		$this->load->model('sistemasOperativosModel');
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
				$respuesta = array('exito' => TRUE, 'razon_social' => "KOKIN");

				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
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
			//Caso para actualizar las versiones en el select dependiendo el sistemas seleccionado en la ventana modal para añadir un nuevo sistema
			case 'versiones':
				$sistema=$this->input->post('sistema');
				$versiones=$this->sistemasContpaqiModel->get(array('versiones'),array('sistema' => $sistema));

				$versiones_array=explode(',',$versiones[0]->versiones);
				$num_versiones=count($versiones_array);

				$respuesta = array('exito' => TRUE, 'versiones' => $versiones_array, 'num_versiones' => $num_versiones);

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
			break;
			case 'nuevo':
			//datos a insertar obtenidos del formulario
			$sistema_cliente = array(
				'id_cliente'	=> $this->data['usuario_activo']['id'],
				'sistema'     => $this->input->post('sistema'),
				'version'     => $this->input->post('version'),
				'no_serie'    => $this->input->post('no_serie')
			 );

				if(!$this->sistemasClienteModel->insert($sistema_cliente)){
					$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
				}else{
					$respuesta = array('exito' => TRUE, 'sistema' => $sistema_cliente['sistema'].' versión '.$sistema_cliente['version']);
				}

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
			break;

			case 'editar':
				# code.
			break;

			case 'eliminar':
				$id = $this->input->post('id');
				$sistema = $this->input->post('sistema');
				$version = $this->input->post('version');

				if(!$this->sistemasClienteModel->delete(array('id' => $id))){
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
				}else
				{
					$respuesta = array('exito' => TRUE, 'sistema' => $sistema.' versión '.$version);
				}

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
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
		$this->data['equipos_computo']=$this->equiposComputoModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));
		$this->data['sistemas_operativos']=$this->sistemasOperativosModel->get(array('*'));

		switch ($accion) {
			case 'nuevo':
				//reglas de contactos
				$this->form_validation->set_rules('nombre_equipo', 'Nombre del Equipo', 'trim|required|strtoupper|max_length[20]|xss_clean');
				$this->form_validation->set_rules('sistema_operativo', 'Sistema Operativo', 'trim|required|xss_clean');
				$this->form_validation->set_rules('arquitectura', 'Arquitectura', 'trim|required|xss_clean');
				$this->form_validation->set_rules('maquina_virtual', 'Maquina Virtual', 'trim|required|xss_clean');
				$this->form_validation->set_rules('memoria_ram', 'Memoria RAM', 'trim|required|xss_clean');
				$this->form_validation->set_rules('sql_server', 'SQL Server', 'trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('sql_management', 'SQL Management', 'trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('instancia_sql', 'Instancia SQL', 'trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('password_sql', 'Contraseña SQL', 'trim|max_length[50]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$equipo = array(
						'id_cliente'				=> $this->data['usuario_activo']['id'],
						'nombre_equipo' 	  => $this->input->post('nombre_equipo'),
						'sistema_operativo' => $this->input->post('sistema_operativo'),
						'arquitectura' 	    => $this->input->post('arquitectura'),
						'maquina_virtual' 	=> $this->input->post('maquina_virtual'),
						'memoria_ram'       => $this->input->post('memoria_ram'),
						'sql_server' 	      => $this->input->post('sql_server'),
						'sql_management' 	  => $this->input->post('sql_management'),
						'instancia_sql' 	  => $this->input->post('instancia_sql'),
						'password_sql' 	    => $this->input->post('password_sql')
					);
					//inserto en la bd
					if(!$this->equiposComputoModel->insert($equipo))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'equipo' => $equipo['nombre_equipo']);
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));


			break;

			case 'editar':
				# code...
			break;

			case 'eliminar':
				$id = $this->input->post('id');
				$nombre_equipo = $this->input->post('nombre_equipo');

				if(!$this->equiposComputoModel->delete(array('id' => $id))){
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
				}else
				{
					$respuesta = array('exito' => TRUE, 'equipo' => $nombre_equipo);
				}

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
			break;

			default:
				$this->_vista("equipos_computo");
				//var_dump($this->data);
			break;
		}
	}

}

/* End of file gestor.php */
/* Location: ./application/controllers/gestor.php */