<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de ejecutivos y sus funciones
 *
 * @author Diego Rodriguez
 **/
class Ejecutivo extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ejecutivoModel');
		$this->load->model('casoModel');
		$this->load->model('pendienteModel');
		//Helper
		$this->load->helper('formatofechas');
		$this->data['pendientes_usuario'] = $this->pendienteModel->getPendientes(
												array('id_pendiente',
												'actividades_pendiente.actividad',
												'clientes.razon_social',
												'fecha_origen',
												'id_estatus_general'),
												$this->usuario_activo['id']);
	}

	/**
	 * Metodo que se ejecuta al entrar al controlador ejecutivo
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//cargo los modelos a usar
		$this->load->model('departamentoModel');
		$this->load->model('oficinasModel');
		//cargo los helpers a usar
		$this->load->helper('formatofechas_helper');
		//cargamos los datos completos del usuario para mostrarlos en el perfil
		$usuario_temp	= (array)$this->ejecutivoModel->get_where(array('id' => $this->usuario_activo['id']));
		$usuario_temp['ruta_imagenes']	= site_url('assets/admin/pages/media/profile/'.$this->usuario_activo['id']).'/';
		$this->data['usuario_activo']		=$usuario_temp;
		// Variable vacia para mostrar errores de subida
		$this->data['upload_error']			= '';
		//variables precargadas para mostrar datos el los selects del formulario de edicion
		$this->data['tabladepartamentos']	= $this->departamentoModel->get(array('area'));
		$this->data['tablaoficinas']			= $this->oficinasModel->get(array('ciudad_estado'));
		// ID del ejecutivo activo
		$this->data['id_ejecutivo'] = $this->usuario_activo['id'];
		//mandamos la vista principal
		$this->_vista('perfil');
	}

	/**
	 * Funcion para obtener los pendientes de manera de JSON
	 * con formato para el DataTable
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json_pendientes($id_ejecutivo)
	{
		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		$total			=  $this->pendienteModel->get('COUNT(*) as total', array('id_ejecutivo' =>$id_ejecutivo), null, 1);

		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
					'id_pendiente',
					'actividades_pendiente.actividad',
					'clientes.razon_social',
					'fecha_origen',
					'estatus_general.descripcion');
		$joins 			= array('clientes', 'actividades_pendiente', 'estatus_general');
		$like 			= $search['value'];
		$orderBy 		= $columns[$order[0]['column']]['data'];
		$orderForm 	= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$pendientes	= $this->pendienteModel->get_pendiente_ejecutivo_table(
		                                                           	   $id_ejecutivo,
		                                                                     $campos,
		                                                                     $joins,
		                                                                     $like,
		                                                                     $orderBy,
		                                                                     $orderForm,
		                                                                     $limit,
		                                                                     $offset);
		//var_dump($pendientes);

		$proceso	= array();
		$this->load->helper('formatofechas');
		//$this->load->model('comentariosCotizacionModel');
		foreach ($pendientes as $index => $pendiente) {
			//$total_comentario 		= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $pendiente->folio), null, 'ASC', 1);
			//$total_comentario_sinver 	= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $pendiente->folio, 'visto' => 0), null, 'ASC', 1);
			$p = array(
				'DT_RowId'					=> $pendiente->id_pendiente,
				'id_pendiente'				=> $pendiente->id_pendiente,
				'actividad'					=> $pendiente->actividad,
				'razon_social'				=> ($pendiente->razon_social) ? $pendiente->razon_social : '---',
				'fecha_origen'				=> fecha_completa($pendiente->fecha_origen),
				'descripcion'				=> ucfirst($pendiente->descripcion),
				'url'							=> site_url('/pendiente/detalles/'.$pendiente->id_pendiente)
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($pendientes),
			'recordsFiltered'	=> $total[0]->total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	/**
	 * Funcion mostrar las vistas de gestion de ejecutivos
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function gestionar($accion=null, $id_ejecutivo=null)
	{
		//cargo los modelos a usar
		$this->load->model('privilegiosModel');
		$this->load->model('departamentoModel');
		$this->load->model('oficinasModel');

		switch ($accion)
		{
			case 'nuevo':
				// Titulo header
				$this->data['titulo']	= $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'].self::TITULO_PATRON;
				//se extraen las filas de la bd que se mostraran en selects en el formulario de agregar usuario
				$this->data['tablaprivilegios']		= $this->privilegiosModel->get(array('privilegios'));
				$this->data['tabladepartamentos']	= $this->departamentoModel->get(array('area'));
				$this->data['tablaoficinas'] 			= $this->oficinasModel->get(array('ciudad_estado'));
				//se muestra el formulario
				$this->_vista('form-nuevo-ejecutivo');
			break;
			case 'editar':
				//obtenemos los datos del ejecutivo a ejecutar
				$ejecutivo = $this->ejecutivoModel->get_where(array('id' => $id_ejecutivo));
				if (!empty($ejecutivo))
				{
					// Datos a enviar a la vista
					$this->data['ejecutivo']			= $ejecutivo;
					$this->data['tablaprivilegios']		= $this->privilegiosModel->get(array('privilegios'));
					$this->data['tabladepartamentos']	= $this->departamentoModel->get(array('area'));
					$this->data['tablaoficinas']      		= $this->oficinasModel->get(array('ciudad_estado'));
					//Vista de formulario a mostrar
					$this->_vista('editar-ejecutivo');
				} else
				{
					show_error('No existe este ejecutivo.', 404);
				}
			break;
			case 'eliminar':
				$id = $this->input->post('id');
				// Si existe ejecutivo
				if ($this->ejecutivoModel->exist(array('id' => $id)) ) {
					//Si no es el mismo quien esta logueado
					if($id!=$this->usuario_activo['id']){
						// NO tiene casos y pendientes creados o asignados
						if (!$this->pendienteModel->exist(array('id_creador' => $id, 'id_ejecutivo' => $id)) && !$this->casoModel->exist(array('id_lider' => $id)))
						{
							if($this->ejecutivoModel->delete(array('id' => $id))) {
								// Liberia para eliminar la carpeta correspondiente
								$this->load->helper('directory');
								$dir = './assets/admin/pages/media/profile/'.$id.'/';
								$files_avatar = directory_map($dir);
								$c = count($files_avatar);
								// Si hay archivos, elmino uno por uno
								if ($c > 0) {
									for ($i=0; $i < $c; $i++) {
										unlink($dir.$files_avatar[$i]);
									}
								}
								rmdir($dir);
								$response = array('exito' => TRUE, 'msg' => '<h4>El ejecutivo se eleminó del sistema.<h4>');
							}
						} else {
							$response = array('exito' => FALSE, 'msg' => '<h4>El ejecutivo NO se puede eliminar, tiene algún pendiente o caso creado/asignado.<h4>');
						}
					}else{
						$response = array('exito' => FALSE, 'msg' => '<h4>No puedes eliminarte a ti mismo del sistema.<h4>');
					}
				}

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
			break;

			default:
				$this->data['ejecutivos'] = $this->ejecutivoModel->get(array('*'));
				$this->_vista('gestionar');
			break;
		}
	}

	/**
	 * funcion para mostrar el catalogo de los ejecutivos y
	 * sus perfiles esten disponobles para otros ejecutivos
	 *
	 * @author Diego Rodriguez
	 **/

	public function catalogo($id_ejecutivo=null)
	{
		if(empty($id_ejecutivo)){
			$this->data['ejecutivos'] = $this->ejecutivoModel->get(array('*'));
			$this->_vista('catalogo');
		}else{
			$this->data['ejecutivo'] = $this->ejecutivoModel->get(array('*'), array('id' => $id_ejecutivo), null, 'ASC', 1);
			$this->data['ejecutivo']->ruta_img_ejecutivo = site_url('assets/admin/pages/media/profile').'/'.$id_ejecutivo.'/';
			$this->data['casos'] = $this->casoModel->get_casos_ejecutivo($id_ejecutivo, array(
									'caso.id as id_caso',
									'caso.id_estatus_general',
									'estatus_general.descripcion',
									'clientes.razon_social',
									'clientes.id as id_cliente',
									'caso.folio_cotizacion',
									'caso.fecha_inicio',
									'caso.fecha_final'));
			$this->data['pendientes_ejecutivo'] = $this->pendienteModel->getPendientes('*',$id_ejecutivo);
			$this->data['id_ejecutivo'] = $id_ejecutivo;
			$this->_vista('perfil_ejecutivo');
		}
	}


	/**
	 * Funcion para mostrar el formulario para crear
	 * un nuevo ejecutivo o procesar la informacion
	 * segun el parametro que se envie
	 *
	 * @author Diego Rodriguez
	 **/
	public function nuevo()
	{
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		//Se establecen las reglas de validacion
		//Datos Personales
		$this->form_validation->set_rules('primer_nombre', 'Primer Nombre', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('segundo_nombre', 'Segundo Nombre', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|max_length[50]|xss_clean|callback_email_check');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[14]|xss_clean');
		//Datos del Sistema
		$this->form_validation->set_rules('oficina', 'Oficina', 'trim|required|xss_clean');
		$this->form_validation->set_rules('privilegios', 'Privilegios', 'trim|required|xss_clean');
		$this->form_validation->set_rules('departamento', 'Departamento', 'trim|required|xss_clean');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|max_length[20]|xss_clean|callback_usuario_check');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|max_length[20]|xss_clean');
		//se ejecutan las reglas para ver si se cumplen
		if ($this->form_validation->run() === FALSE)
		{
			// SI es FALSO, guardo la respuesta y el error para mostrarlo
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
			// Array con la informacion
			$data = array(
				//Datos Personales
				'primer_nombre'	=> $this->input->post('primer_nombre'),
				'segundo_nombre'	=> $this->input->post('segundo_nombre'),
				'apellido_paterno'	=> $this->input->post('apellido_paterno'),
				'apellido_materno'	=> $this->input->post('apellido_materno'),
				'email'				=> $this->input->post('email'),
				'telefono'			=> $this->input->post('telefono'),
				//Datos del Sistema
				'oficina'			=> $this->input->post('oficina'),
				'privilegios'			=> $this->input->post('privilegios'),
				'departamento'	=> $this->input->post('departamento'),
				'usuario'			=> $this->input->post('usuario'),
				'password'			=> $this->input->post('password')
			);
			//convierto array a objeto e inserto en la bd
			$ejecutivo_nuevo	= $this->ejecutivoModel->arrayToObject($data);
			$exito_ejecutivo	= $this->ejecutivoModel->insert($ejecutivo_nuevo);
			//armo la respuesta
			$respuesta = array(
				'exito'		=> $exito_ejecutivo,
				'ejecutivo'	=> $ejecutivo_nuevo
			);
		}

		//si la insercion fue correcta creamos una imagen por defecto para el nuevo usuario
		if($respuesta['exito'])
		{
			//armo la ruta completa donde se guardaran las imagenes y creo el directorio
			$id_nuevo			= $this->ejecutivoModel->get_where(array('usuario' => $ejecutivo_nuevo->usuario));
			$ruta				= './assets/admin/pages/media/profile/';
			$ruta_completa	= $ruta.$id_nuevo->id.'/';
			if (!is_dir($ruta_completa)) {
				mkdir($ruta_completa, 0777, TRUE);
			}

			// Se copian las imagenes de la carpeta cliente a la capeta del nuevo usuario
			$this->load->helper('directory');
			$dir = './assets/admin/pages/media/profile/cliente/';
			$files_avatar = directory_map($dir);
			$c = count($files_avatar);
			if ($c > 0) {
				for ($i=0; $i < $c; $i++) {
					copy($dir.$files_avatar[$i], $ruta_completa.$files_avatar[$i]);
				}
			}

			//reglas para crear la imagen de perfil
			// $config_perfil['image_library']	= 'gd2';
			// $config_perfil['source_image']	= $ruta.'default.jpg';
			// $config_perfil['x_axis']			= 0;
			// $config_perfil['y_axis']			= 0;
			// $config_perfil['new_image']	= $ruta_completa.'perfil.jpg';

			// //reglas para crear la imagen de bloqueo de sesion
			// $config_block['image_library']	= 'gd2';
			// $config_block['source_image']	= $ruta_completa.'perfil.jpg';
			// $config_block['maintain_ratio']	= FALSE;
			// $config_block['width']			= 366;
			// $config_block['height']			= 281;
			// $config_block['x_axis']			= 0;
			// $config_block['y_axis']			= 0;
			// $config_block['maintain_ratio']	= FALSE;
			// $config_block['new_image']	= $ruta_completa.'block.jpg';

			// //reglas para la creacion de la imagen miniatura
			// $config_miniatura['image_library']	= 'gd2';
			// $config_miniatura['source_image']	= $ruta_completa.'block.jpg';
			// $config_miniatura['width']			= 29;
			// $config_miniatura['height']		= 29;
			// $config_miniatura['new_image']	= $ruta_completa.'mini.jpg';

			// //reglas para la creacion de la imagen de chat
			// $config_chat['image_library']	= 'gd2';
			// $config_chat['source_image']	= $ruta_completa.'block.jpg';
			// $config_chat['width']			= 45;
			// $config_chat['height']			= 45;
			// $config_chat['new_image']		= $ruta_completa.'chat.jpg';

			// //inicio las reglas de imagen de perfil
			// $this->image_lib->initialize($config_perfil);
			// //corto la imagen de perfil y creo las demas
			// $this->image_lib->crop();
			// //limpio las reglas para leer nuevas
			// $this->image_lib->clear();
			// //creo las demas imagenes banado en las reglas definidas arriba
			// $this->image_lib->initialize($config_block);
			// $this->image_lib->crop();
			// $this->image_lib->clear();
			// $this->image_lib->initialize($config_miniatura);
			// $this->image_lib->resize();
			// $this->image_lib->clear();
			// $this->image_lib->initialize($config_chat);
			// $this->image_lib->resize();
			// $this->image_lib->clear();
		}
		// Muestro la salida
		$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion para editar los datos un ejecutivo
	 * respectivamente info general, contraseñas o imagenes
	 * en su perfil e insertarlo a la BD
	 *
	 * @author Diego Rodriguez | Luis Macias
	 **/
	public function editar($accion=null)
	{
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//variables que contienen ls valores de la bd para mostrarlo en los select en caso de editar
		$usuario_temp	= (array)$this->ejecutivoModel->get_where(array('id' => $this->usuario_activo['id']));
		$usuario_temp['ruta_imagenes']	= site_url('assets/admin/pages/media/profile/'.$this->usuario_activo['id']).'/';
		$this->data['usuario_activo']	=$usuario_temp;
		// Variable vacia para mostrar errores de subida
		$this->data['upload_error'] = '';
		switch ($accion)
		{
			case 'info-personal': //en caso de que editen la informacion basica propia
				//Datos Personales
				$this->form_validation->set_rules('primer_nombre', 'Primer Nombre', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('segundo_nombre', 'Segundo Nombre', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[14]|xss_clean');
				//Datos del Sistema
				$this->form_validation->set_rules('oficina', 'Oficina', 'trim|required|xss_clean');
				$this->form_validation->set_rules('departamento', 'Departamento', 'trim|required|xss_clean');

				if ($this->form_validation->run() === FALSE)
				{
					// SI es FALSO, guardo la respuesta
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					// Array con la informacion
					$data = array(
						//Datos Personales
						'primer_nombre'	=> $this->input->post('primer_nombre'),
						'segundo_nombre'	=> $this->input->post('segundo_nombre'),
						'apellido_paterno'	=> $this->input->post('apellido_paterno'),
						'apellido_materno'	=> $this->input->post('apellido_materno'),
						'email'				=> $this->input->post('email'),
						'telefono'			=> $this->input->post('telefono'),
						//Datos del Sistema
						'oficina'			=> $this->input->post('oficina'),
						'departamento'	=> $this->input->post('departamento'),
						'mensaje_personal'	=> $this->input->post('mensaje_personal')
					);
					//el parametro TRUE indica al metodo del modelo ejecutivoModel que se trata de una actualizacion no de un nuevo registro para crear el objeto
					$ejecutivo_editado = $this->ejecutivoModel->arrayToObject($data, TRUE);
					//Extraigo el id para saber donde actualizar los datos en la bd
					$id = $this->data['usuario_activo']['id'];

					if(!$this->ejecutivoModel->update($ejecutivo_editado,array('id' => $id))){
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisala consola o la base de datos.');
					}else{
						//actualizo la variable usuario_activo con los nuevos datos
						$ejecutivo_actualizado = $this->ejecutivoModel->get_where(array('id' => $id));
						$ejecutivo_actualizado = (array)$ejecutivo_actualizado;
						//se vuelve a añadir la variable con la ruta de las imagenes ya que no viene desde la bd
						$ejecutivo_actualizado['ruta_imagenes'] = site_url('assets/admin/pages/media/profile/'.$id).'/';
						$this->session->set_userdata('usuario_activo', $ejecutivo_actualizado);
						//armo la respuesta
						$respuesta = array(
							'exito'		=> TRUE,
							'ejecutivo'	=> $ejecutivo_editado,
							'id'			=> $id
						);
					}
				}
				// Muestro la salida
				$this->output
						 ->set_content_type('application/json')
						 ->set_output(json_encode($respuesta));
			break;

			case 'info-ejecutivo': //en caso de que editen la informacion de un ejecutivo (solo modo admin)
				//Datos Personales
				$this->form_validation->set_rules('primer_nombre', 'Primer Nombre', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('segundo_nombre', 'Segundo Nombre', 'trim|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|strtolower|ucwords|max_length[20]|xss_clean');
				$this->form_validation->set_rules('email', 'Email', 'trim|strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[14]|xss_clean');
				//Datos del Sistema
				$this->form_validation->set_rules('oficina', 'Oficina', 'trim|required|xss_clean');
				$this->form_validation->set_rules('privilegios', 'Privilegios', 'trim|xss_clean');
				$this->form_validation->set_rules('departamento', 'Departamento', 'trim|required|xss_clean');
				$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean|callback_usuario_check');
				$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');

				if ($this->form_validation->run() === FALSE)
				{
					// SI es FALSO, guardo la respuesta
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					// Array con la informacion
					$ejecutivo_editado = array(
						//Datos Personales
						'primer_nombre'	=> $this->input->post('primer_nombre'),
						'segundo_nombre'	=> $this->input->post('segundo_nombre'),
						'apellido_paterno'	=> $this->input->post('apellido_paterno'),
						'apellido_materno'	=> $this->input->post('apellido_materno'),
						'email'				=> $this->input->post('email'),
						'telefono'			=> $this->input->post('telefono'),
						//Datos del Sistema
						'oficina'			=> $this->input->post('oficina'),
						'privilegios'			=> $this->input->post('privilegios'),
						'departamento'	=> $this->input->post('departamento'),
						'usuario'	=> $this->input->post('usuario'),
						'password'	=> $this->input->post('password')

					);
					//el parametro TRUE indica al metodo del modelo ejecutivoModel que se trata de una actualizacion no de un nuevo registro para crear el objeto
					//$ejecutivo_editado = $this->ejecutivoModel->arrayToObject($data, TRUE);
					//Extraigo el id para saber donde actualizar los datos en la bd
					$id = $this->input->post('id');

					if($this->ejecutivoModel->update($ejecutivo_editado, array('id' => $id))){
						//actualizo la variable usuario_activo con los nuevos datos si es que se edito el mismo
						if($id == $this->usuario_activo['id']){
								$ejecutivo_actualizado = $this->ejecutivoModel->get_where(array('id' => $id));
								$ejecutivo_actualizado = (array)$ejecutivo_actualizado;
								//se vuelve a añadir la variable con la ruta de las imagenes ya que no viene desde la bd
								$ejecutivo_actualizado['ruta_imagenes'] = site_url('assets/admin/pages/media/profile/'.$id).'/';
								$this->session->set_userdata('usuario_activo', $ejecutivo_actualizado);
						}
						//armo la respuesta
						$respuesta = array(
							'exito'		=> TRUE,
							'ejecutivo'	=> $ejecutivo_editado,
							'id'			=> $id
						);
					}else{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisala consola o la base de datos.');
					}
				}

				// Muestro la salida
				$this->output
						 ->set_content_type('application/json')
						 ->set_output(json_encode($respuesta));
			break;

			case 'img':
				// Cargo libreria manejo de imagen
				$this->load->library('image_lib');
				//cargo los modelos a usar
				$this->load->model('departamentoModel');
				$this->load->model('oficinasModel');
				//variables precargadas para mostrar datos el los selects del formulario de edicion
				$this->data['tabladepartamentos']	= $this->departamentoModel->get(array('area'));
				$this->data['tablaoficinas']			= $this->oficinasModel->get(array('ciudad_estado'));
				// Reglas de validacion
				$this->form_validation->set_rules('userfile', 'El archivo',
					'file_required|file_size_min[10KB]|file_size_max[2MB]|file_allowed_type[imagen]|file_image_mindim[299,299]|file_image_maxdim[1601,1601]');
				// Validacion
				if ($this->form_validation->run() === FALSE)
				{
					// La forma de mostrar los errores
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error de validación: </strong>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
						' <b><a href="'.site_url('ejecutivo/editar/img#cambiar_imagen').'" style="color:red">(Intentar de nuevo)</a></b></div>');
					// Muestro vista con errores
					$this->_vista('perfil');
				}
				else
				{
					// Armo las rutas y nombres de la imagen segun usuario activo
					$id_activo			= $this->usuario_activo['id'];
					$ruta				= 'assets/admin/pages/media/profile/';
					$ruta_completa	= $ruta.$id_activo.'/';
					//Si no existe directorio lo creo
					if (!is_dir($ruta_completa))
					{
						mkdir($ruta_completa, 0777, TRUE);
					}
					//Configuracion para la subida del archivo
					$config_upload['upload_path']		= $ruta_completa;
					$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG';
					$config_upload['overwrite'] 		= TRUE;
					$config_upload['file_name']		= 'perfil.jpg';
					$config_upload['max_size']			= 2048;
					$config_upload['remove_spaces']	= TRUE;
					// Cargo la libreria upload y paso configuracion
					$this->load->library('upload', $config_upload);
					//SI NO se sube la imagen
					if (!$this->upload->do_upload())
					{
						// Envio a la variable los errores de subida
						$this->data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger"><strong>Error de subida: </strong>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
							' <b><a href="'.site_url('ejecutivo/editar/img#cambiar_imagen').'" style="color:red">(Intentar de nuevo)</a></b></div>');
						// Muestro vista con errores de subida
						$this->_vista('perfil');
					} else
					{
						// Paso datos de la subida del archivo
						$upload_data = $this->upload->data();
						// Si la imagen es mas de 800px se redimenciona
						if ($upload_data['image_width'] > 800 || $upload_data['image_height'] > 800)
					  	{
							// Configuracion para el recorte
							$config_resize['image_library']		= 'gd2';
							$config_resize['source_image']	= $upload_data['full_path'];
							$config_resize['maintain_ratio']	= TRUE;
							$config_resize['width']				= 800;
							$config_resize['height']			= 800;
							$this->image_lib->clear();
							$this->image_lib->initialize($config_resize);
							$this->image_lib->resize();
						}
						//mando a la vista de recorte de imagen
						$this->_vista('recortar-imagen');
					}
				}
			break;

			case 'password':
				//reglas para cambiar usuario y password
				$this->form_validation->set_rules('usuario_actual', 'Usuario Actual','trim|max_length[20]|xss_clean');
				$this->form_validation->set_rules('usuario_nuevo', 'Usuario Nuevo', 'trim|max_length[20]|xss_clean|callback_usuario_check');
				$this->form_validation->set_rules('password_actual',  'Contraseña Actual', 'trim|required|max_length[20]|xss_clean|callback_password_check');
				$this->form_validation->set_rules('password_nuevo_1', 'Contraseña Nueva', 'trim|required|max_length[20]|xss_clean|callback_confirmacion_check');
				$this->form_validation->set_rules('password_nuevo_2', 'Confirmacion de Contraseña Nueva','trim|required|max_length[20]|xss_clean');

				if ($this->form_validation->run() === FALSE)
				{
					// SI es FALSO, guardo la respuesta
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					// Array con la informacion
					$data = array(
						'password'			 => $this->input->post('password_nuevo_1'),
						'usuario'	  		 => $this->input->post('usuario_nuevo')
					);

					//se extrae el id del usuario para saber a quien se actualizara en la bd
					$id = $this->data['usuario_activo']['id'];
					$usuario_actual = $this->input->post('usuario_actual');

					//filtros para saber que hacer en caso de que no cambien de usuario y solo de contraseña
					//si no escribieron nuevo usuario o el usuario es el mismo, solo cambio la contraseña
					if($data['usuario'] == "" || ($data['usuario']==$usuario_actual))
					{
						$exito_editado = $this->ejecutivoModel->update(array('password' => $data['password']), array('id' => $id));
						$respuesta = array('exito' => TRUE);
					}else
					{
						//si cambiaron usuario y contraseña verifico que el usuario no este repetido en la db
						if(!$this->usuario_check($data['usuario']))
						{
							$respuesta = array('exito' => FALSE, 'msg' => 'El nuevo usuario ya esta en uso, intenta con otro');
						}else
						{
							//si el usuario no esta repetido inserto todo en la bd
							$exito_editado = $this->ejecutivoModel->update($data, array('id' => $id));
							$respuesta = array('exito' => TRUE);
						}
					}
					//actualizo la variable usuario_activo con los nuevos datos
					$ejecutivo_actualizado = $this->ejecutivoModel->get_where(array('id' => $id));
					$ejecutivo_actualizado = (array)$ejecutivo_actualizado;
					//se vuelve a añadir la variable con la ruta de las imagenes ya que no viene desde la bd
					$ejecutivo_actualizado['ruta_imagenes'] = site_url('assets/admin/pages/media/profile/'.$id).'/';
					$this->session->set_userdata('usuario_activo', $ejecutivo_actualizado);
				}

				$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode($respuesta));
			break;

			default:
			break;
		}
	}

	/**
	 * Funcion recortar la imagen de
	 * perfil del ejecutivo
	 *
	 * @author Diego Rodriguez | Luis Macias
	 **/
	public function recortar()
	{
		//cargo la libreria
		$this->load->library('image_lib');
		//obtengo la ruta donde se encuentra la imagen base para crear las demas
		//$ruta = $this->input->server('DOCUMENT_ROOT');
		$src = 'assets/admin/pages/media/profile/'.$this->usuario_activo['id'].'/perfil.jpg';

		//obtengo los puntos claves del recorte
		$pos_x	= $this->input->post('x');
		$pos_y	= $this->input->post('y');
		$ancho	= $this->input->post('w');
		$alto	= $this->input->post('h');

		//armo la ruta completa donde se guardaran las imagenes
		$id_activo			= $this->usuario_activo['id'];
		$ruta				= 'assets/admin/pages/media/profile/';
		$ruta_completa	= $ruta.$id_activo.'/';

		//reglas para crear la imagen de bloqueo de sesion
		$config_block['image_library']	= 'gd2';
		$config_block['source_image']	= $src;
		$config_block['width']			= $alto;
		$config_block['height']			= $ancho;
		$config_block['x_axis']			= $pos_x;
		$config_block['y_axis']			= $pos_y;
		$config_block['maintain_ratio']	= FALSE;
		$config_block['new_image']	= $ruta_completa.'block.jpg';
		//reglas para la creacion de la imagen miniatura
		$config_miniatura['image_library']	= 'gd2';
		$config_miniatura['source_image']	= $ruta_completa.'block.jpg';
		$config_miniatura['width']			= 29;
		$config_miniatura['height']		= 29;
		$config_miniatura['new_image']	= $ruta_completa.'mini.jpg';
		//reglas para la creacion de la imagen de chat
		$config_chat['image_library']	= 'gd2';
		$config_chat['source_image']	= $ruta_completa.'block.jpg';
		$config_chat['width']			= 45;
		$config_chat['height']			= 45;
		$config_chat['new_image']		= $ruta_completa.'chat.jpg';

		//inicio las reglas de imagen de block
		$this->image_lib->initialize($config_block);
		//ejecuto el recorte y guardo el booleano
		$exito_block = $this->image_lib->crop();
		//limpio las reglas para hacer los redimencionados
		$this->image_lib->clear();
		$this->image_lib->initialize($config_miniatura);
		$exito_mini = $this->image_lib->resize();

		$this->image_lib->clear();
		$this->image_lib->initialize($config_chat);
		$exito_chat = $this->image_lib->resize();

		$this->image_lib->clear();

		if(!$exito_block || !$exito_mini || !$exito_chat)
		{
			echo $this->image_lib->display_errors();
		}else
		{
			redirect('ejecutivo',  'refresh');
		}
	}

	/**
	 * funcion para cambiar a el ejecutivo que tiene permiso
	 * para asignar los casos
	 * @return json
	 * @author Diego Rodriguez
	 **/
	public function asignador()
	{
		$id_ejecutivo = $this->input->post('id');

		//CODIGO CON EL CAMBIO DE EJECUTIVO ASIGNADOR
		if($this->ejecutivoModel->elimina_asignadores() && $this->ejecutivoModel->update(array('asignador_casos' => 'si'), array('id' => $id_ejecutivo))){
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>Asignador de casos actualizado con éxito.<h4>');
		}else{
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error al cambiar de asignador.<h4>');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Callback para revisar que no se repitan usuarios
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function usuario_check($usuario_nuevo)
	{
		$this->load->model('clienteModel');

		//obtenemos el di del ejecutivo desde el input hidden
		$id = $this->input->post('id');
		//obtenemos el nombre de usuario que tiene registrado ese ejecutivo
		$usuario_actual = $this->ejecutivoModel->get(array('usuario'), array('id' => $id));
		//si no hay usuario actual es porque ejecutivo es nuevo
		if($usuario_actual != null)
		{
			$usuario_actual = $usuario_actual[0]->usuario;
		}

		//verificamos que el nuevo nombre de usuario no este repetido
		if (($this->ejecutivoModel->exist(array('usuario' => $usuario_nuevo))
			   && $usuario_nuevo != $usuario_actual)
			   || $this->clienteModel->exist(array('usuario' => $usuario_nuevo)))
		{
			$this->form_validation->set_message('usuario_check', 'El nombre de usuario ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Callback para revisar que no se repitan los emails
	 * @param  string $email correo a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function email_check($email)
	{
		if ($this->ejecutivoModel->exist(array('email' => $email)))
		{
			$this->form_validation->set_message('email_check', 'El email ya está registrado.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * revisa que la contraseña actual sea correcta para poder cambiar de contraseña y usuario
	 * en el apartado de editar usuario y contraseña del perfil de usuario
	 * @param  string $password contraseña a revisar
	 * @return boolean
	 * @author Diego Rodriguez
	 **/
	public function password_check($password)
	{
		$usuario = $this->input->post('usuario_actual');
		if (!$this->ejecutivoModel->exist(array('usuario' => $usuario,'password' => $password)))
		{
			$this->form_validation->set_message('password_check', 'Tu contraseña actual es incorrecta');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * revisa que la contraseña nueva y su confirmacion sean iguales
	 * @param  string $password1 password a revisar el otro se obtiene por post
	 * @return boolean
	 * @author Diego Rodriguez
	 **/
	public function confirmacion_check($password1)
	{
		$password2 = $this->input->post('password_nuevo_2');
		if ($password1 != $password2)
		{
			$this->form_validation->set_message('confirmacion_check', 'La contraseña nueva no coincide!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

/* End of file ejecutivos.php */
/* Location: ./application/controllers/ejecutivos.php */