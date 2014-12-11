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
		$this->load->model('clienteModel');
	}

	public function index(){}

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
				//Datos basicos
				$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required|strtoupper|max_length[80]|xss_clean');
				$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|strtoupper|max_length[13]|callback_rfc_check|xss_clean');
				$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|xss_clean');
				$this->form_validation->set_rules('telefono1', 'Teléfono 1', 'trim|max_length[14]|xss_clean');
				$this->form_validation->set_rules('telefono2', 'Teléfono 2', 'trim|max_length[14]');
				$this->form_validation->set_rules('calle', 'Calle', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
				$this->form_validation->set_rules('usuario', 'Usuario', 'trim|max_length[10]|callback_usuario_check');
				$this->form_validation->set_rules('password', 'contraseña', 'trim|max_length[10]');
				$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|strtoupper|xss_clean');
				$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|strtoupper|xss_clean');
				$this->form_validation->set_rules('colonia', 'Colonia', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('codigo_postal', 'Código Postal', 'trim|max_length[7]|xss_clean');
				$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
				$this->form_validation->set_rules('municipio', 'Municipio', 'trim|strtolower|ucwords|max_length[50]|xss_clean');
				$this->form_validation->set_rules('estado', 'Estado', 'trim|xss_clean');
				$this->form_validation->set_rules('pais', 'País', 'trim|required|xss_clean');

				$this->form_validation->set_error_delimiters('','');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					//si las reglas son correctas preparo los datos para insertar
					$cliente = array(
						//Datos basicos
						'razon_social'	=> $this->input->post('razon_social'),
						'tipo'			=> $this->input->post('tipo'),
						'rfc'			=> $this->input->post('rfc'),
						'email'			=> $this->input->post('email'),
						'telefono1'		=> $this->input->post('telefono1'),
						'telefono2'		=> $this->input->post('telefono2'),
						'usuario'		=> $this->input->post('usuario'),
						'password'		=> $this->input->post('password'),
						'calle'			=> $this->input->post('calle'),
						'no_exterior'	=> $this->input->post('no_exterior'),
						'no_interior'	=> $this->input->post('no_interior'),
						'colonia'		=> $this->input->post('colonia'),
						'codigo_postal'	=> $this->input->post('codigo_postal'),
						'ciudad'			=> $this->input->post('ciudad'),
						'municipio'		=> $this->input->post('municipio'),
						'estado'		=> $this->input->post('estado'),
						'pais'			=> $this->input->post('pais')
					);

					if($cliente['pais'] == "Estados Unidos") {
						$cliente['estado'] = "";
					}

					$id = $this->data['usuario_activo']['id'];
					// se crea un objeto con la informacion basica para insertarlo en la tabla clientes
					$obj_cliente = $this->clienteModel->array_to_object($cliente, null, FALSE);
					//inserto en la bd
					if(!$this->clienteModel->update($cliente, array('id' => $id))) {
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					} else {
						//actualizo la variable usuario_activo con los nuevos datos
						$cliente_actualizado = $this->clienteModel->get_where(array('id' => $id));
						$cliente_actualizado = (array)$cliente_actualizado;
						//se vuelve a añadir la variable con la ruta de las imagenes ya que no viene desde la bd
						$cliente_actualizado['ruta_imagenes'] = site_url('assets/admin/pages/media/profile/cliente').'/';
						$cliente_actualizado['privilegios'] = 'cliente';
						$this->session->set_userdata('usuario_activo', $cliente_actualizado);

						$respuesta = array('exito' => TRUE, 'razon_social' => $cliente['razon_social']);
					}
				}

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
	public function contactos($accion=null, $id=null)
	{
		//se cargan los contactos del cliente y se manda a llamar la vista
		$this->data['contactos_cliente']=$this->contactosModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));

		switch ($accion) {
			case 'nuevo':
				//reglas de contactos
				$this->form_validation->set_rules('nombre_contacto', 'Nombre', 'trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email_contacto', 'Email', 'trim|strtolower|valid_email|max_length[30]|xss_clean');
				$this->form_validation->set_rules('telefono_contacto', 'Teléfono', 'trim|max_length[14]|xss_clean');
				$this->form_validation->set_rules('puesto_contacto', 'Puesto', 'trim|strtolower|ucwords|max_length[20]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$contacto = array(
						'id_cliente'				=> $this->data['usuario_activo']['id'],
						'nombre_contacto'		=> $this->input->post('nombre_contacto'),
						'apellido_paterno'	=> $this->input->post('apellido_paterno'),
						'apellido_materno'	=> $this->input->post('apellido_materno'),
						'email_contacto'		=> $this->input->post('email_contacto'),
						'telefono_contacto'	=> $this->input->post('telefono_contacto'),
						'puesto_contacto'		=> $this->input->post('puesto_contacto')
					);
					//inserto en la bd
					if(!$this->contactosModel->insert($contacto))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'msg' => '<h4>Contacto <b>'.$contacto['nombre_contacto'].' '.$contacto['apellido_paterno'].'</b> añadido.</h4>');
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
						$respuesta = array('exito' => TRUE, 'msg' => '<h4>Contacto <b>'.$contacto['nombre_contacto'].' '.$contacto['apellido_paterno'].'</b> actualizado con éxito.</h4>');
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$id					= $this->input->post('id'); // ID de la empresa
				$id_cliente			= $this->input->post('id_cliente'); // ID del cliente
				$total_contactos	= count($this->contactosModel->get_where(array('id_cliente' => $id_cliente)));

				// Tambien verificar que no este contemplado en una cotizacion si no NO podra eliminarse
	 			if($total_contactos == 1)
	 			{
	 				$respuesta = array('exito' => FALSE, 'msg' => '<h4>No se puede eliminar, necesitas almenos un contacto.</h4>');
	 			} else
	 			{
	 				//IF PARA REVISAR QUE EL CONTACTO SI ESTA RELACIONADO CON ALGUNA COTIZACION NO SE PUEDA ELIMINAR
	 				//$this->load->model('cotizacionModel');
	 				//if(count($this->cotizacionModel->get(array('*'), array('')))!=0){

	 				//}else{
	 					if ($this->contactosModel->delete(array('id' => $id)))
						{
							$respuesta = array('exito' => TRUE, 'msg' => '<h4>Se eliminó el contacto con éxito.</h4>');
						} else {
							$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
						}
	 				//}
	 			}

	      			//mando la repuesta
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'mostrar':
				if ($contacto = $this->contactosModel->get_where(array('id' => $id)))
				{
					$this->data['contacto'] = $contacto;
					$this->_vista_completa('cliente/modal-form-editar-contacto');
				} else
				{
					show_error('No existe este contacto.', 404);
				}
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
					'sistema'	=> $this->input->post('sistema'),
					'version'	=> $this->input->post('version'),
					'no_serie'	=> $this->input->post('no_serie')
				 );

				if(!$this->sistemasClienteModel->insert($sistema_cliente)){
					$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
				}else{
					$respuesta = array('exito' => TRUE, 'msg' => '<h4><b>'.$sistema_cliente['sistema'].'</b> versión <b>'.$sistema_cliente['version'].'</b> añadido con éxito.</h4>');
				}

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$id = $this->input->post('id');
				$sistema = $this->input->post('sistema');
				$version = $this->input->post('version');

				if(!$this->sistemasClienteModel->delete(array('id' => $id))){
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
				}else
				{
					$respuesta = array('exito' => TRUE, 'msg' => '<h4>Sistema eliminado con éxito</h4>');
				}

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
			break;

			default:
				$this->_vista("sistemas_contpaqi");
			break;
		}
	}

	/**
	 * Funcion para gestionar los equipos de computo de los clientes
	 *
	 * @return void
	 * @author Diego
	 **/
	public function equipos($accion=null, $id=null)
	{
		//se cargan los equipos de computo del cliente y se manda a llamar la vista
		$this->data['equipos']=$this->equiposComputoModel->get(array('*'), array('id_cliente' => $this->data['usuario_activo']['id']));
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
				$this->form_validation->set_rules('observaciones', 'Observaciones', 'trim|max_length[200]|xss_clean');

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
						'password_sql' 	    => $this->input->post('password_sql'),
						'observaciones' 	  => $this->input->post('observaciones')
					);
					//inserto en la bd
					if(!$this->equiposComputoModel->insert($equipo))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'msg' => '<h4>Nuevo equipo añadido con éxito.</h4>.');
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));


			break;

			case 'editar':
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
				$this->form_validation->set_rules('observaciones', 'Observaciones', 'trim|max_length[200]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					//si las reglas son correctas preparo los datos para insertar
					$equipo = array(
						'nombre_equipo'		=> $this->input->post('nombre_equipo'),
						'sistema_operativo'	=> $this->input->post('sistema_operativo'),
						'arquitectura'			=> $this->input->post('arquitectura'),
						'maquina_virtual'		=> $this->input->post('maquina_virtual'),
						'memoria_ram'			=> $this->input->post('memoria_ram'),
						'sql_server'				=> $this->input->post('sql_server'),
						'sql_management'		=> $this->input->post('sql_management'),
						'instancia_sql'			=> $this->input->post('instancia_sql'),
						'password_sql'			=> $this->input->post('password_sql'),
						'observaciones'			=> $this->input->post('observaciones')
					);
					//obtenemos el id para saber donde actualizar
					$id = $this->input->post('id');
					$id_cliente = $this->input->post('id_cliente');
					//Actualizo en la BD el  equipo
					if($this->equiposComputoModel->update($equipo, array('id' => $id)))
					{
						$respuesta = array('exito' => TRUE, 'msg' => '<h4>Se actualizo la info del equipo.</h4>');
					} else
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizó, revisa la consola o la base de datos para detalles');
					}
				}
				//mando la repuesta
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$id = $this->input->post('id');

				if(!$this->equiposComputoModel->delete(array('id' => $id))){
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
				}else
				{
					$respuesta = array('exito' => TRUE, 'msg' => '<h4>Equipo eliminado con éxito.</h4>');
				}

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
			break;

			case 'mostrar':
				if ($equipo = $this->equiposComputoModel->get_where(array('id' => $id)))
				{
					$this->load->helper('form');
					// Mando html select con valor seleccionado por default para SO
					$sistemas_operativos	= $this->sistemasOperativosModel->get(array('*'), $where = null, $orderBy = 'id_so', $orderForm = 'ASC');
					$select = array();
					foreach ($sistemas_operativos as $sistema) {
						$select[$sistema->sistema_operativo] = $sistema->sistema_operativo;
					}
					// Radio button de arquitectura
					$r64 = ($equipo->arquitectura == 'x64') ? TRUE : FALSE;
					$r86 = ($equipo->arquitectura == 'x86') ? TRUE : FALSE;
					$radio64 = array(
							'name'		=> 'arquitectura',
							'id'			=> 'arquitectura1',
							'value'		=> 'x64',
							'checked'	=> $r64);

					$radio86 = array(
							'name'		=> 'arquitectura',
							'id'			=> 'arquitectura2',
							'value'		=> 'x86',
							'checked'	=> $r86);

					// Radio button de maquina virtual
					$si = ($equipo->maquina_virtual == 'Si') ? TRUE : FALSE;
					$radioMVsi = array(
							'name'		=> 'maquina_virtual',
							'id'			=> 'maquina_virtual1',
							'value'		=> 'Si',
							'checked'	=> $si);

					$radioMVno = array(
							'name'		=> 'maquina_virtual',
							'id'			=> 'maquina_virtual2',
							'value'		=> 'No',
							'checked'	=> !$si);

					// Mando html select con valor seleccionado por default para SQL Server
					$select_sqlServer = array(
							'' => '',
					              'SQL Server 2005'	=> 'SQL Server 2005',
					              'SQL Server 2008 R2'=> 'SQL Server 2008 R2',
					              'SQL Server 2012'	=> 'SQL Server 2012',
					              'SQL Server 2014'	=> 'SQL Server 2014');

					// Mando html select con valor seleccionado por default para SQL Server
					$select_mgm = array(
					              '' => '',
					              '2005'		=> '2005',
					              '2008 R2'	=> '2008 R2',
					              '2012'		=> '2012',
					              '2014'		=> '2014');

					$this->data['equipo'] 	= $equipo;
					$this->data['select_SO'] = form_dropdown('sistema_operativo', $select, $equipo->sistema_operativo, 'class="form-control"');
					$this->data['radio64'] 	= form_radio($radio64);
					$this->data['radio86'] 	= form_radio($radio86);
					$this->data['radioSi'] 	= form_radio($radioMVsi);
					$this->data['radioNo'] 	= form_radio($radioMVno);
					$this->data['select_SQL'] 	= form_dropdown('sql_server', $select_sqlServer, $equipo->sql_server, 'class="form-control"');
					$this->data['select_mgm'] 	= form_dropdown('sql_management', $select_mgm, $equipo->sql_management, 'class="form-control"');

					$this->_vista_completa('cliente/modal-form-nuevo-equipo');
				} else
				{
					show_error('No existe este equipo de computo.', 404);
				}
			break;

			default:
				$this->_vista("equipos_computo");
			break;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Callback para revisar que no se repitan registros
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function rfc_check($rfc)
	{
		//optenemos el di del cliente desde el input hidden
		$id = $this->input->post('id_cliente');
		$rfc_actual = $this->clienteModel->get(array('rfc'), array('id' => $id));
		//si no hay rfc actual es porque el cliente es prospecto o aun no tiene rfc
		if($rfc_actual != null)
		{
			$rfc_actual = $rfc_actual[0]->rfc;
		}

		if ($this->clienteModel->exist(array('rfc' => $rfc)) && $rfc != $rfc_actual)
		{
			$this->form_validation->set_message('rfc_check', 'El RFC ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Callback para revisar que no se repita el usuario para acceder al sistema
	 * revisando en la tabla clente sy ejecutivos
	 * @param  string $usuario Usuario a revisar
	 * @return boolean
	 * @author Diego Rodriguez
	 */
	public function usuario_check($usuario_nuevo)
	{ //leemos el modelo para comparar con usuarios te tabla ejecutivos
		$this->load->model('ejecutivoModel');

		//obtenemos el di del cliente desde el input hidden
		$id = $this->input->post('id_cliente');
		//obtenemos el nombre de usuario que tiene registrado ede cliente
		$usuario_actual = $this->clienteModel->get(array('usuario'), array('id' => $id));
		//si no hay usuario actual es porque el cliente es prospecto o aun no tiene usuario
		if($usuario_actual != null)
		{
			$usuario_actual = $usuario_actual[0]->usuario;
		}
		//verificamos que el nuevo nombre de usuatio no este repetido
		if (($this->clienteModel->exist(array('usuario' => $usuario_nuevo))
			   && $usuario_nuevo != $usuario_actual)
			   || $this->ejecutivoModel->exist(array('usuario' => $usuario_nuevo)))
		{
			$this->form_validation->set_message('usuario_check', 'El usuario ya está registrado.');
			return FALSE;
		} else
		{
			return TRUE;
		}
	}

}

/* End of file gestor.php */
/* Location: ./application/controllers/gestor.php */