 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de clientes y sus funciones
 *
 * @author Diego Rodriguez | Luis Macias
 **/
class Cliente extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//cargo los modelos a usar
		$this->load->model('clienteModel');
		$this->load->model('contactosModel');
		$this->load->model('sistemasClienteModel');
		$this->load->model('equiposComputoModel');
		$this->load->model('sistemasContpaqiModel');
		$this->load->model('sistemasOperativosModel');
	}

	public function index(){}
	public function add(){}

	/**
	 * Funcion mostrar las vistas de gestion de clientes
	 * @return void
	 * @author Diego Rodriguez
	 **/

	public function gestionar($accion=null, $id_cliente=null)
	{
		switch ($accion) {
			case 'nuevo':
				//datos a usar en el formulario de nuevo cliente
				$this->data['sistemascontpaqi']=$this->sistemasContpaqiModel->get(array('id_sistema','sistema'));
				$this->data['sistemasoperativos']=$this->sistemasOperativosModel->get(array('*'), $where = null, $orderBy = 'id_so', $orderForm = 'ASC');
				//Vista de formulario a mostrar
				$this->_vista('form-nuevo-cliente');
			break;

			case 'editar':
				$this->data['cliente'] 					 		= $this->clienteModel->get_where(array('id' => $id_cliente));
				$this->data['contactos'] 				 		= $this->contactosModel->get(array('*'), array('id_cliente' => $id_cliente));
				$this->data['sistemas_contpaqi'] 		= $this->sistemasContpaqiModel->get(array('*'));
				$this->data['sistemas_contpaqi_cliente'] = $this->sistemasClienteModel->get(array('*'), array('id_cliente' => $id_cliente));
				$this->data['equipos'] 					 		= $this->equiposComputoModel->get(array('*'), array('id_cliente' => $id_cliente));
				$this->data['sistemas_operativos']	=$this->sistemasOperativosModel->get(array('*'), $where = null, $orderBy = 'id_so', $orderForm = 'ASC');
				$this->_vista('editar-cliente');
				//var_dump($this->data);
			break;

			case 'eliminar':

			break;

			default:
				$this->data['clientes'] = $this->clienteModel->get(array('*'));
			  //var_dump($this->data);
				$this->_vista('gestionar');
			break;
		}
	}


	/**
	 * Funcion para añadir un nuevo
	 * cliente a la BD que inserta en varias tablas diferentes
	 * referenciando los datoscon el id principal
	 *
	 * @author Diego Rodriguez | Luis Macias
	 **/
	public function nuevo($tipo = null)
	{
		//Datos basicos
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required|strtoupper|max_length[80]|callback_razon_frc_check|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|required|valid_email|xss_clean');
		//Datos del domicilio
		$this->form_validation->set_rules('calle', 'Calle', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|required|xss_clean');
		// Telefonos
		$this->form_validation->set_rules('telefono1', 'Teléfono 1', 'trim|max_length[14]|xss_clean');
		//Contacto
		$this->form_validation->set_rules('nombre_contacto', 'Nombre', 'trim|required|strtolower|ucwords|max_length[30]|xss_clean');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('email_comtacto', 'Email', 'trim|strtolower|valid_email|max_length[30]|xss_clean');
		$this->form_validation->set_rules('telefono_contacto', 'Teléfono', 'trim|max_length[14]|xss_clean');

		// SI ES CLIENTE NORMAL AGREGO MAS REGLAS DE VALIDACION
		if ($tipo == 'normal') {
			//Datos basicos
			$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|strtoupper|max_length[13]|xss_clean');
			$this->form_validation->set_rules('tipo', 'Tipo', 'required|strtolower');
			//Datos del domicilio
			$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|strtoupper|xss_clean');
			$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|strtoupper|xss_clean');
			$this->form_validation->set_rules('colonia', 'Colonia', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
			$this->form_validation->set_rules('codigo_postal', 'Código Postal', 'trim|max_length[7]|xss_clean');
			$this->form_validation->set_rules('municipio', 'Municipio', 'trim|strtolower|ucwords|max_length[50]|xss_clean');
			$this->form_validation->set_rules('pais', 'País', 'trim|required|xss_clean');
			//Telefonos
			$this->form_validation->set_rules('telefono2', 'Teléfono 2', 'trim|max_length[14]');
			//Contacto
			$this->form_validation->set_rules('puesto_contacto', 'Puesto', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
			//Sistema Contpaq
			$this->form_validation->set_rules('sistema', 'Sistema', 'trim|xss_clean');
			$this->form_validation->set_rules('version', 'Versión', 'trim|xss_clean');
			$this->form_validation->set_rules('no_serie', 'No. de Serie', 'trim|xss_clean');
			//Info del equipo
			$this->form_validation->set_rules('nombre_equipo', 'Nombre del Equipo', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
			$this->form_validation->set_rules('sistema_operativo', 'Sistema Operativo', 'trim|xss_clean');
			$this->form_validation->set_rules('arquitectura', 'Arquitectura', 'trim|xss_clean');
			$this->form_validation->set_rules('maquina_virtual', 'Máquina Virtual', 'trim|xss_clean');
			$this->form_validation->set_rules('memoria_ram', 'Memoria RAM', 'trim|xss_clean');
			$this->form_validation->set_rules('sql_server', 'SQL Server', 'trim|xss_clean');
			$this->form_validation->set_rules('sql_management', 'SQL Server Management', 'trim|xss_clean');
			$this->form_validation->set_rules('instancia_sql', 'Instancia SQL', 'trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('password_sql', 'Contraseña SQL', 'trim|max_length[10]|xss_clean');
		}
		// Validamos formulario
		if ($this->form_validation->run() === FALSE) {
			// SI es FALSO, vuelvo a mostrar vista
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else {
			// SI ES CLIENTE NORMAL TRABAJO TODOS LOS DATOS
			if ($tipo == 'normal')
			{
				// Array con la informacion
				$data = array(
					//Datos basicos
					'razon_social'	=> $this->input->post('razon_social'),
					'rfc'						=> $this->input->post('rfc'),
					'email'					=> $this->input->post('email'),
					'tipo'					=> $this->input->post('tipo'),
					'calle'					=> $this->input->post('calle'),
					'no_exterior'		=> $this->input->post('no_exterior'),
					'no_interior'		=> $this->input->post('no_interior'),
					'colonia'				=> $this->input->post('colonia'),
					'codigo_postal'	=> $this->input->post('codigo_postal'),
					'ciudad'				=> $this->input->post('ciudad'),
					'municipio'			=> $this->input->post('municipio'),
					'estado'				=> $this->input->post('estado'),
					'pais'					=> $this->input->post('pais'),
					'telefono1'			=> $this->input->post('telefono1'),
					'telefono2'			=> $this->input->post('telefono2'),
					//Contacto
					'nombre_contacto'		=> $this->input->post('nombre_contacto'),
					'apellido_paterno'	=> $this->input->post('apellido_paterno'),
					'apellido_materno'	=> $this->input->post('apellido_materno'),
					'email_contacto'		=> $this->input->post('email_contacto'),
					'telefono_contacto'	=> $this->input->post('telefono_contacto'),
					'puesto_contacto'		=> $this->input->post('puesto_contacto'),
					//Sistema
					'sistema'		=> $this->input->post('sistema'),
					'version'		=> $this->input->post('version'),
					'no_serie'	=> $this->input->post('no_serie'),
					//Info del equipo
					'nombre_equipo'		  => $this->input->post('nombre_equipo'),
					'sistema_operativo'	=> $this->input->post('sistema_operativo'),
					'arquitectura'			=> $this->input->post('arquitectura'),
					'maquina_virtual'		=> $this->input->post('maquina_virtual'),
					'memoria_ram'			  => $this->input->post('memoria_ram'),
					'sql_server'				=> $this->input->post('sql_server'),
					'sql_management'		=> $this->input->post('sql_management'),
					'instancia_sql'			=> $this->input->post('instancia_sql'),
					'password_sql'			=> $this->input->post('password_sql')
				);
				// se crea un objeto con la informacion basica para insertarlo en la tabla clientes
				$basica_cliente = $this->clienteModel->arrayToObject($data);
				//se inserta el objeto en la bd para generar el id y poder usarlo como llave foranea
				if($this->clienteModel->insert($basica_cliente))
				{
					//se extrae el id
					$id_cliente = $this->clienteModel->get(array('id'), array('razon_social' => $basica_cliente->razon_social, 'rfc' => $basica_cliente->rfc));
					$id = $id_cliente[0]->id;
					//se crean los demas objetos con su respectiva informacion, se le añade la llave foranea y se insertan en sus tablas
					$contactos	= $this->contactosModel->arrayToObject($id, $data);
					$sistemas		= $this->sistemasClienteModel->arrayToObject($id, $data);
					$equipos		= $this->equiposComputoModel->arrayToObject($id, $data);
					// Inserto en las demas tablas
					$exito_contactos	= $this->contactosModel->insert($contactos);
					$exito_sistemas	  = $this->sistemasClienteModel->insert($sistemas);
					$exito_equipos		= $this->equiposComputoModel->insert($equipos);
					// Armo la respuesta para el JSON
					$respuesta = array(
						'exito'			=> ($exito_contactos and $exito_sistemas and $exito_equipos),
						'razon_social'	=> $basica_cliente->razon_social);
				} else
				{
					// Armo la respuesta para el JSON
					$respuesta = array(
						'exito'			=> FALSE,
						'razon_social'	=> $basica_cliente->razon_social);
				}
			} else
			{
				// Array con la informacion
				$data = array(
					//Datos basicos
					'razon_social'	=> $this->input->post('razon_social'),
					'email'					=> $this->input->post('email'),
					'tipo'					=> 'prospecto',
					'calle'					=> $this->input->post('calle'),
					'ciudad'				=> $this->input->post('ciudad'),
					'estado'				=> $this->input->post('estado'),
					'telefono1'			=> $this->input->post('telefono1'),
					//Contacto
					'nombre_contacto'		=> $this->input->post('nombre_contacto'),
					'apellido_paterno'	=> $this->input->post('apellido_paterno'),
					'apellido_materno'	=> $this->input->post('apellido_materno'),
					'email_contacto'		=> $this->input->post('email_contacto'),
					'telefono_contacto'	=> $this->input->post('telefono_contacto'),
				);
				// se crea un objeto con la informacion basica para insertarlo en la tabla clientes
				$basica_cliente = $this->clienteModel->arrayToObject($data, $data['tipo']);
				//se inserta el objeto en la bd para generar el id y poder usarlo como llave foranea
				if($this->clienteModel->insert($basica_cliente))
				{
					//se extrae el id
					$id_cliente = $this->clienteModel->get(array('id'), array('razon_social' => $basica_cliente->razon_social, 'email' => $basica_cliente->email));
					//se crean los demas objetos con su respectiva informacion, se le añade la llave foranea y se insertan en sus tablas
					$contactos_cliente = $this->contactosModel->arrayToObject($id_cliente[0]->id, $data, $data['tipo']);

					$bol_contactos=$this->contactosModel->insert($contactos_cliente);
					// Armo la respuesta para el JSON
					$respuesta = array(
						'exito' => $bol_contactos,
						'razon_social' => $basica_cliente->razon_social);
				} else
				{
					// Armo la respuesta para el JSON
					$respuesta = array(
						'exito' => FALSE,
						'msg' => 'No se inserto cliente en la BD');
				}
			}
		}

		// Muestro la salida
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
	}

	/**
	 * funcion para guardar la informacion editada de un cliente
	 * desde el gestor de clientes en modo admin
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function editado()
	{
		//Datos basicos
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required|strtoupper|max_length[80]|callback_razon_frc_check|xss_clean');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|strtoupper|max_length[13]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|xss_clean');
		$this->form_validation->set_rules('tipo', 'Tipo', 'trim|xss_clean');
		$this->form_validation->set_rules('telefono1', 'Teléfono 1', 'trim|max_length[14]|xss_clean');
		$this->form_validation->set_rules('telefono2', 'Teléfono 2', 'trim|max_length[14]');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|max_length[10]|callback_usuario_check');
		$this->form_validation->set_rules('password', 'contraseña', 'trim|max_length[10]');
		$this->form_validation->set_rules('calle', 'Calle', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|strtoupper|xss_clean');
		$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|strtoupper|xss_clean');
		$this->form_validation->set_rules('colonia', 'Colonia', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('codigo_postal', 'Código Postal', 'trim|max_length[7]|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('municipio', 'Municipio', 'trim|strtolower|ucwords|max_length[50]|xss_clean');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|xss_clean');
		$this->form_validation->set_rules('pais', 'País', 'trim|required|xss_clean');

		if($this->form_validation->run() === FALSE)
		{
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		}else
		{
			//si las reglas son correctas preparo los datos para insertar
			$cliente = array(
				//Datos basicos
				'razon_social'	=> $this->input->post('razon_social'),
				'rfc'						=> $this->input->post('rfc'),
				'email'					=> $this->input->post('email'),
				'tipo'		      => $this->input->post('tipo'),
				'telefono1'			=> $this->input->post('telefono1'),
				'telefono2'			=> $this->input->post('telefono2'),
				'usuario'	      => $this->input->post('usuario'),
				'password'      => $this->input->post('password'),
				'calle'					=> $this->input->post('calle'),
				'no_exterior'		=> $this->input->post('no_exterior'),
				'no_interior'		=> $this->input->post('no_interior'),
				'colonia'				=> $this->input->post('colonia'),
				'codigo_postal'	=> $this->input->post('codigo_postal'),
				'ciudad'				=> $this->input->post('ciudad'),
				'municipio'			=> $this->input->post('municipio'),
				'estado'				=> $this->input->post('estado'),
				'pais'					=> $this->input->post('pais')
			);

			if($cliente['pais']=="Estados Unidos"){
					$cliente['estado']="";
			}
			$id = $this->clienteModel->get(array('id'), array('razon_social' => $cliente['razon_social'] ,'email' => $cliente['email']));
			//inserto en la bd
			if(!$this->clienteModel->update($cliente, array('id' => $id[0]->id)))
			{
				$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
			}else
			{
					$respuesta = array('exito' => TRUE, 'razon_social' => $cliente['razon_social']);
			}
		}

		//mando la repuesta
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion para mostrar las versiones de los sistemas contpaqi
	 * dependiendo la opcion del select
	 *
	 * @author Diego Rodriguez
	 **/
	public function versiones()
	{
		$id_sistema=$this->input->post('id_sistema');
		$versiones=$this->sistemasContpaqiModel->get(array('versiones'),array('id_sistema' => $id_sistema));

		$versiones_array=explode(',',$versiones[0]->versiones);
		$num_versiones=count($versiones_array);

		$respuesta = array('exito' => TRUE, 'versiones' => $versiones_array, 'num_versiones' => $num_versiones);

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion para gestionar los contactos de los clientes desde modo administrador
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function contactos($accion = null)
	{
		switch ($accion) {
			case 'nuevo':
				//reglas de contactos
				$this->form_validation->set_rules('nombre_contacto', 'Nombre', 'trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email_contacto', 'Email', 'trim|required|strtolower|valid_email|max_length[30]|xss_clean');
				$this->form_validation->set_rules('telefono_contacto', 'Teléfono', 'trim|required|max_length[14]|xss_clean');
				$this->form_validation->set_rules('puesto_contacto', 'Puesto', 'trim|strtolower|ucwords|max_length[20]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$contacto = array(
						'id_cliente'				 => $this->input->post('id_cliente'),
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

	 			$id_cliente = $this->input->post('id_cliente');
	 			$cont=count($this->contactosModel->get_where(array('id_cliente' => $id_cliente)));

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
			break;
		}
	}

	/**
	 * Metodo para mostrar las empresas
	 * de menera de JSON
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json()
	{
		$id_cliente = $this->input->post('id_cliente');

		if (empty($id_cliente))
		{
			$query	= $this->input->post('q');
			$limit 	= $this->input->post('page_limit');

			if (isset($query) && isset($limit))
			{
				$resultados = $this->clienteModel->get_like(
					array('id','razon_social'),
					'razon_social',
					$query,
					'razon_social',
					'ASC',
					$limit);

				$res = array();

				if (!empty($resultados))
				{
					foreach ($resultados as $value)
					{
						array_push($res, array("id" => (int)$value->id, "text" => $value->razon_social));
					}
				} else
				{
					$res = array("id"=>"0","text"=>"No se encontraron resultados...");
				}

				// Muestro la salida
				$this->output
						->set_content_type('application/json')
						->set_output(json_encode($res));
			}
		} else
		{
			$cliente		= $this->clienteModel->get_like(array('telefono1'), 'id', $id_cliente);
			$contactos	= $this->contactosModel->get_like(array('*'),'id_cliente', $id_cliente);

			$total_contactos = count($contactos);

			if ($total_contactos > 0)
			{
				$res = array(
					'total_contactos'	=> $total_contactos,
					'contactos'			=> $contactos);

			} else
			{
				$res = array(
					'total_contactos'	=> $total_contactos,
					'msg'				=> 'La empresa no tiene contactos registrados.');
			}
			// Muestro salida
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($res));
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
	public function razon_rfc_check($razon_social)
	{
		// SI el frc y la razon social se repiten
		$rfc = $this->input->post('rfc');
		if ($this->clienteModel->exist(array('razon_social' => $razon_social, 'rfc' => $rfc))) {
			$this->form_validation->set_message('razon_frc_check', 'El cliente de ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Callback para revisar que no se repita el usuario
	 * @param  string $usuario Usuario a revisar
	 * @return boolean
	 * @author Diego Rodriguez 
	 */
	public function usuario_check($usuario)
	{
		// SI el frc y la razon social se repiten
		$razon_social=$this->input->post('razon_social');
		$rfc=$this->input->post('rfc');
		$usuario_actual=$this->clienteModel->get(array('usuario'), array('razon_social' => $razon_social, 'rfc' => $rfc));
		//echo $usuario_actual;
		if($usuario_actual!=null){
			$usuario_actual=$usuario_actual[0]->usuario;
		}
		

		if ($this->clienteModel->exist(array('usuario' => $usuario))  && $usuario!=$usuario_actual) {
			$this->form_validation->set_message('usuario_check', 'El usuario de ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}

/* End of file cliente.php */
/* Location: ./application/controllers/cliente.php */