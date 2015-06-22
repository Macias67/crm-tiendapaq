<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para ver el listado de cotizaciones
 *
 * @author Diego Rodriguez | Luis Macias
 **/
class Cotizacion extends AbstractAccess {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('cotizacionModel');
		$this->load->helper('formatofechas_helper');
		$this->load->model('casomodel');
	}

	/**
	 * Vista Principal
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
	}

	/**
	 * muestra la vista para cotizaciones con pendiente de revisar pago
	 *
	 * @author Diego Rodriguez
	 **/
	public function revisar()
	{
		$this->data['cotizaciones_revision'] = $this->cotizacionModel->get_cotizacion_revision(
			array(
				'cotizacion.folio',
				'clientes.razon_social',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'cotizacion.fecha',
				'cotizacion.vigencia',
				'cotizacion.id_estatus_cotizacion'
			));
		$this->_vista('cotizaciones-revision');
	}

	/**
	 * muestra la vista del catalogo de cotizaciones
	 * Este método talvez no se usa ya***?
	 *
	 * @author Diego Rodriguez
	 **/
	public function catalogo()
	{
		$this->load->model('estatusCotizacionModel');
		//codigo para revisar cotizaciones vencidas
		$campos = array(
			'cotizacion.folio',
			'cotizacion.fecha',
			'cotizacion.vigencia',
			'cotizacion.id_estatus_cotizacion'
		);
		$where = array('cotizacion.id_estatus_cotizacion' => $this->estatusCotizacionModel->PORPAGAR);
		//obtengo las cotizaciones por pagar para revisar si estan vencidas
		$cotizaciones = $this->cotizacionModel->get_cotizaciones($campos, $where);
		//ciclo para revisar que no esten vencidas
		$fecha_actual = date('Y-m-d H:i:s');
		foreach ($cotizaciones as $cotizacion) {
			if($fecha_actual > $cotizacion->vigencia){
				$this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->VENCIDO), array('folio' => $cotizacion->folio));
			}
		}
		//despues de la revision de muestra la vista
		$this->_vista('cotizaciones-catalogo');
	}

	/**
	 * Metodo consultado para el plugin
	 * dataTable del archivo table-managed.cotizacion
	 * que es la tabla vía ajax
	 *
	 * @return json
	 * @author Luis Macias
	 **/
	public function table()
	{
		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		$total			=  $this->cotizacionModel->count();
		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
				'cotizacion.folio',
				'cotizacion.fecha',
				'cotizacion.vigencia',
				'cotizacion.total_comentarios',
				'cotizacion.visto',
		              'clientes.razon_social',
		              'clientes.id as id_cliente',
		              'ejecutivos.primer_nombre',
		              'ejecutivos.segundo_nombre',
		              'ejecutivos.apellido_paterno',
		              'ejecutivos.apellido_materno',
		              'estatus_cotizacion.descripcion');
		$joins = array('clientes', 'ejecutivos', 'estatus_cotizacion');
		$like = array(
			'folio'					=> $search['value'],
			'clientes.razon_social'		=> $search['value'],
			'ejecutivos.primer_nombre'		=> $search['value'],
		       'ejecutivos.segundo_nombre' 		=> $search['value'],
			'ejecutivos.apellido_paterno' 	=> $search['value'],
			'ejecutivos.apellido_materno' 	=> $search['value'],
			'fecha'					=> $search['value'],
			'vigencia'				=> $search['value'],
			'estatus_cotizacion.descripcion' 	=> $search['value']
		);
		$orderBy 		= $columns[$order[0]['column']]['data'];
		$orderForm 		= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$cotizaciones	= $this->cotizacionModel->get_cotizacion_cliente_table(
		                                                                     $campos,
		                                                                     $joins,
		                                                                     $like,
		                                                                     $orderBy,
		                                                                     $orderForm,
		                                                                     $limit,
		                                                                     $offset);
		$proceso	= array();

		$this->load->helper('formatofechas');
		// // Si existe la carpeta factura del cliente
		// $dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cliente['id'].'/cotizacion/';
		// if (!is_dir($dir_root)) {

		// }
		//$this->load->model('comentariosCotizacionModel');
		foreach ($cotizaciones as $index => $cotizacion) {
			//$total_comentario 		= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $cotizacion->folio), null, 'ASC', 1);
			//$total_comentario_sinver 	= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $cotizacion->folio, 'visto' => 0), null, 'ASC', 1);
			$p = array(
				'DT_RowId'				=> $cotizacion->folio,
				'folio'					=> $cotizacion->folio,
				'id_cliente'				=> $cotizacion->razon_social,
				'id_ejecutivo'				=> $cotizacion->primer_nombre.' '.$cotizacion->apellido_paterno,
				'fecha'					=> fecha_completa($cotizacion->fecha),
				'vigencia'				=> fecha_completa($cotizacion->vigencia),
				'id_estatus_cotizacion'		=> ucwords($cotizacion->descripcion),
				'total_comentarios'			=> $cotizacion->total_comentarios,
				'visto'					=> ($cotizacion->visto) ? TRUE : FALSE,
				'facturado'				=> is_dir('clientes/'.$cotizacion->id_cliente.'/factura/'.$cotizacion->folio.'/')
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($cotizaciones),
			'recordsFiltered'		=> $total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes desde el cotizador
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function previapdf()
	{
		$folio =$this->input->post('folio');
		$idcliente  =$this->input->post('idcliente');

		if ($existe = $this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('/clientes/'.$idcliente.'/cotizacion').'/';
			$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
			$path		= $dir_root.$name;
			$response 	= array('existe' => $existe, 'ruta' => $path);
		} else {
			$response 	= array('existe' => $existe);
		}
		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

		/**
	 * Funcion para previsualizar un pdf con una factura
	 * para los clientes desde el cotizador
	 *
	 * @author Luis Macias | Diego Rodriguez | Julio Trujillo
	 **/
	public function previapdffactura()
	{
		$folio =$this->input->post('folio');
		$name =$this->input->post('name');
		$cotizacion = $this->cotizacionModel->get_cotizacion_cliente(array('id_cliente'), array(''), $folio);

		if ($existe = $this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('clientes/'.$cotizacion->id_cliente.'/factura/'.$folio).'/';
			$path		= $dir_root.$name;
			$response 	= array('existe' => $existe, 'ruta' => $path);
		} else {
			$response 	= array('existe' => $existe);
		}
		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes desde otras secciones ya con la cotizacion creada
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function previa()
	{
		$folio =$this->input->post('folio');

		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente(array('id_cliente'), array(''), $folio))
		{
			$dir_root	= site_url('/clientes/'.$cotizacion->id_cliente.'/cotizacion').'/';
			$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
			$path		= $dir_root.$name;
			$response 	= array('existe' => TRUE, 'ruta' => $path);
		} else {
			$response 	= array('existe' => FALSE);
		}
		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	/**
	 * Funcion para mostrar la vista de revisión
	 * de una cotización
	 *
	 * @param  [int] $folio [Folio de la ctizacion]
	 */
	public function revision($folio)
	{
		$campos = array(
			'cotizacion.folio',
			'cotizacion.id_cliente',
			'cotizacion.id_estatus_cotizacion',
			'cotizacion.tipo',
			'clientes.razon_social');
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($campos, array('clientes'), $folio)) {
			// Marco como VISTO el campo de la tabla en cotizaciones y
			// los comentarios respectivos
			$this->load->model('comentariosCotizacionModel');
			$this->load->helper('form');
			$this->comentariosCotizacionModel->marcar_comentarios_visto($folio, 'c');
			$this->cotizacionModel->update(array('visto' => 1), array('folio' => $folio));

			$this->load->model('estatusCotizacionModel');
			$this->load->helper('directory');
			$this->load->helper('file');
			$ruta_factura = 'clientes/'.$cotizacion->id_cliente.'/factura/'.$folio.'/';
			$facturas = directory_map($ruta_factura);
			$ruta = '/clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$folio.'/';
			$archivos = directory_map('.'.$ruta, 1);

			$imagenes 	= array();
			$pdfs 		= array();

			// Descarto la carpeta de las thumnail
			foreach ($archivos as $index => $archivo) {
				$tipo = explode("/", get_mime_by_extension($archivos[$index]));
				if ($archivos[$index] != 'thumbnail' && ($tipo[1] == 'png' || $tipo[1] == 'jpeg')) {
					array_push($imagenes, $archivos[$index]);
				} else if($archivos[$index] != 'thumbnail' && $tipo[1] == 'pdf') {
					array_push($pdfs, $archivos[$index]);
				}
			}
			$this->load->helper('formatofechas_helper');

			$this->data['cotizacion'] 	= $cotizacion;

			$this->data['imagenes'] 	= $imagenes;
			$this->data['pdfs'] 			= $pdfs;
			$this->data['ruta_pdf']		= $ruta;
			$this->data['factura']			=$facturas;
			$this->data['comentarios'] = $this->comentariosCotizacionModel->get_comentarios($folio);
			$this->_vista('archivos');
		} else {
			show_404();
		}
	}

	/**
	 * funcion para la apertura de un caso dada una cotizacion por
	 * pagada o con un pago parcial, de modo contrario se notifica al
	 * cliente de su irregularidad
	 *
	 * @return void
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function apertura()
	{
		$folio 				= $this->input->post('folio');
		$tipo 				= $this->input->post('tipo');
		$cxc 				= $this->input->post('cxc');
		$cuentaporcobrar 	= $this->input->post('cuentaporcobrar');
		$valoracion	 		= $this->input->post('valoracion');

		$this->load->model('estatusCotizacionModel');
		$this->load->model('estatusGeneralModel');
		$this->load->model('encuestamodel');

		$caso = $this->casomodel->get_where(array('folio_cotizacion'=>$folio));
		$encuesta = $this->encuestamodel->get_where(array('id_caso' =>$caso->id));

		$response = array('exito' => FALSE, 'msg' => 'Error, revisa la consola para mas información.');

		// Verificamos que la cotización sea cuenta por cobrar (CXC), si no es una cotización "NORMAL".
		if ($cuentaporcobrar == $this->estatusCotizacionModel->CXC)
		{
			if ($valoracion == "aceptado") // Verifica que la cotización CXC sea aceptada.
			{
				if ($encuesta->id_caso != NULL) // Si la encuesta existe
				{
					if (($encuesta->fecha_respuesta != null) && ($encuesta->calificacion >= 80))
					{
						if(//La encuesta fue contestada y tiene una calificación mayor a 80 pts. se cierra el caso y se valida el pago.
							($this->casomodel->update(		array('id_estatus_general' => $this->estatusGeneralModel->CERRADO),
												array('id'=>$caso->id))) &&
							($this->cotizacionModel->update(	array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO),
												array('folio' => $folio))))
						{
							$response = array('exito' => TRUE, 'msg' => '<h3>Cotización pagada.</h3>');
						}
					}else{	//La encuesta fue contestada y tiene una calificación menor a 80 pts. se valida el pago, y modificamos estatus de cotizacion.
						if(($this->cotizacionModel->update(	array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO),
											array('folio' => $folio))))
						{
							$response = array('exito' => TRUE, 'msg' => '<h3>Cotización pagada.</h3>');
						}
					}
				}else{ //Si no existe la encuesta
					//Si la encuesta no existe , simplemente se valida el pago y se espera que el caso sea cerrado por encuesta o manualmente.
					if ($this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO),
						array('folio' => $folio)))
					{
						$response = array('exito' => TRUE, 'msg' => '<h3>Cotización pagada.</h3>');
					}
				}
			}

			if ($valoracion == "irregular")
			{
				//ENVÍO DE PDF PARA SITUACIÓN IRREGULAR
				$cotizacion = $this->cotizacionModel->get_cotizacion_cliente(
						array(
							'cotizacion.id_cliente',
							'cotizacion.folio',
							'cotizacion.fecha',
							'cotizacion.vigencia',
							'contactos.nombre_contacto',
							'contactos.apellido_paterno',
							'contactos.apellido_materno',
							'contactos.email_contacto',
							'clientes.razon_social',
							'clientes.email',
							'clientes.usuario',
							'clientes.password',
							'estatus_cotizacion.descripcion'
						),
						array('clientes', 'contactos', 'estatus_cotizacion'),
						$folio);

				$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cotizacion->id_cliente.'/cotizacion/';
				$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
				$path 		= $dir_root.$name;

				if (!LOCAL)
				{
					$this->load->helper('formatofechas');
					$this->load->library('email');

					$contacto = $cotizacion->nombre_contacto.' '.$cotizacion->apellido_paterno.' '.$cotizacion->apellido_materno;

					//Envio Email con el PDF
					$this->email->set_mailtype('html');
					$this->email->from('cotizacion@moz67.com', 'Ventas - TiendaPAQ');
					$this->email->to($cotizacion->email_contacto);
					$this->email->subject('Pago irregular de cotización folio #'.$cotizacion->folio);

					// Contenido del correo
					$this->data['usuario'] 		= $cotizacion->usuario;
					$this->data['password'] 	= $cotizacion->password;
					$this->data['folio'] 		= $cotizacion->folio;
					$this->data['fecha'] 		= fecha_completa($cotizacion->fecha);
					$this->data['vigencia'] 		= fecha_completa($cotizacion->vigencia);
					$this->data['contacto'] 		= $contacto;
					$this->data['estatus'] 		= ucwords($cotizacion->descripcion);
					$this->data['irregular']		= 1;
					$html = $this->load->view('./admin/general/full-pages/email/email_envio_cotizacion.php', $this->data,TRUE);
					$this->email->message($html);

					// Adjunto PDF
					$this->email->attach($path);
					$this->email->send();
					$response = array('exito' => TRUE, 'msg' => '<h3>Se le ha notificado al cliente de su irregularidad en el pago.</h3>');
				}
			}
		}
		else
		{
			if ($tipo == 'evento') {
				if ($valoracion == "aceptado") {
					// Cambio estatus de la cotización a PAGADO
					if ($this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO),
						array('folio' => $folio)))
					{
						$this->load->model('participantesmodel');
						$this->load->model('eventomodel');

						// INSERTAR CONTACTO A TABLA DE PARTICIPANTES
						$cotizacion 	= $this->cotizacionModel->get_where(array('folio' => $folio));
						$evento 	= $this->eventomodel->get_where(array('id_evento' => $cotizacion->id_evento));
						$particpantes 	= $this->participantesmodel->get_where(array('id_evento' => $cotizacion->id_evento));

						// Validar si el total de participantes no ha llegado al límite
						if (count($particpantes) < $evento->max_participantes) {
							$participante = array(
									'id_evento' 	=> $cotizacion->id_evento,
									'id_contacto' 	=> $cotizacion->id_contacto);
							// Inserto participante en la tabla
							if ($exito = $this->participantesmodel->insert($participante)) {
								$msj = '<h3>Se ha registrado el contacto a la lista de participantes de este curso.</h3>';
								// ENVIO DE EMAIL
								/*CODIGO PARA ENVIO DE CORREO COTIZACIÓN*/
								if (!LOCAL) {
									$this->load->library('email');
									$this->load->helper('formatofechas');
									$this->load->model('sesionmodel');
									$this->load->model('oficinasmodel');
									$this->load->model('contactosModel');
									$this->load->model('clienteModel');

									// Datos del contacto
									// Extraigo info del participante (contacto)
									$contacto = $this->contactosModel->get_where(array('id' => $cotizacion->id_contacto));
									// Extraigo usuario y contraseña del cliente
									$cliente = $this->clienteModel->get(array('usuario', 'password'), array('id' => $contacto->id_cliente), null, 'ASC', 1);

									//Extracción de la BD de las sesiones
									if ($this->sesionmodel->get('*', array('id_evento' => $cotizacion->id_evento)) > 1) {
										$sesiones = $this->sesionmodel->get('*', array('id_evento' => $cotizacion->id_evento));
									}else
									{
										$sesiones = $this->sesionmodel->get_where(array('id_evento' => $cotizacion->id_evento));
									}

									$this->email->set_mailtype('html');
									$this->email->from('eventos@moz67.com', 'Eventos TiendaPAQ');
									$this->email->to($contacto->email_contacto);

									$this->email->subject('Su pago al curso ha sido aceptado - TiendaPAQ');
									// Contenido del correo
									$this->data['titulo'] 		= $evento->titulo;
									$this->data['descripcion'] 	= $evento->descripcion;
									$this->data['modalidad'] 	= $evento->modalidad;
									// Modalidad
									if ($evento->modalidad == 'online') {
										$this->data['ubicacion'] = $evento->link;
									}else{
										if ($evento->modalidad == 'otro') {
											$this->data['ubicacion'] = $evento->direccion;
										}else{
											$oficina = $this->oficinasmodel->get_where(array('id_oficina'=>$evento->id_oficina));
											$this->data['ubicacion'] = $oficina->calle.' '.$oficina->numero.', Col.'.$oficina->colonia.', '.$oficina->ciudad_estado;
										}
									}
									// Costo
									$this->data['costo']		= 0; // Para que mueste el link
									$this->data['sesiones'] 	= $sesiones;
									//Datos de logueo
									$this->data['usuario'] 		=$cliente->usuario;
									$this->data['password'] 	= $cliente->password;
									$html = $this->load->view('./publico/general/full-pages/email/email_detalle_evento.php', $this->data, TRUE);
									$this->email->message($html);
									$this->email->send();
								}
							} else {
								$msj = 'No se pudo registra en la BD.';
							}
						} else {
							// COTIZACIÓN CANCELADA
							$exito = $this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->CANCELADA), array('folio' => $folio));
							$msj 	= '<h3>Se llegó al cupo máximo de participantes, este cliente ya no estará registrado. Se cancelará la cotización.</h3>';
						}

						$response = array('exito' => $exito, 'msg' => $msj);
					}
				}

				if ($valoracion == "irregular") {
					$cotizacion 	= $this->cotizacionModel->get_where(array('folio' => $folio));
					$evento 	= $this->eventomodel->get_where(array('id_evento' => $cotizacion->id_evento));
					if ($this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->IRREGULAR),
						array('folio' => $folio)))
					{
						if (!LOCAL) {
							$this->load->model('sesionmodel');
							$this->load->model('oficinasmodel');
							$this->load->model('contactosModel');
							$this->load->model('clienteModel');
							$this->load->library('email');

							// Datos del contacto
							$contacto = $this->contactosModel->get_where(array('id' => $cotizacion->id_contacto));
							// Extraigo usuario y contraseña del cliente
							$cliente = $this->clienteModel->get(array('usuario', 'password'), array('id' => $contacto->id_cliente), null, 'ASC', 1);
							//Extracción de la BD de las sesiones
							if ($this->sesionmodel->get('*', array('id_evento' => $cotizacion->id_evento)) > 1) {
								$sesiones = $this->sesionmodel->get('*', array('id_evento' => $cotizacion->id_evento));
							}else
							{
								$sesiones = $this->sesionmodel->get_where(array('id_evento' => $cotizacion->id_evento));
							}

							$this->email->set_mailtype('html');
							$this->email->from('eventos@moz67.com', 'Eventos TiendaPAQ');
							$this->email->to($contacto->email_contacto);

							$this->email->subject('Pago irregular de evento - TiendaPAQ');
							// Contenido del correo
							$this->data['titulo'] 		= $evento->titulo;
							$this->data['descripcion'] 	= $evento->descripcion;
							$this->data['modalidad'] 	= $evento->modalidad;
							// Modalidad
							if ($evento->modalidad == 'online') {
								$this->data['ubicacion'] = $evento->link;
							}else{
								if ($evento->modalidad == 'otro') {
									$this->data['ubicacion'] = $evento->direccion;
								}else{
									$oficina = $this->oficinasmodel->get_where(array('id_oficina'=>$evento->id_oficina));
									$this->data['ubicacion'] = $oficina->calle.' '.$oficina->numero.', Col.'.$oficina->colonia.', '.$oficina->ciudad_estado;
								}
							}
							// Costo
							$this->data['costo']		= 0; // Para que muestre el link
							$this->data['sesiones'] 		= $sesiones;
							//Datos de logueo
							$this->data['usuario'] 		=$cliente->usuario;
							$this->data['password'] 	= $cliente->password;
							$this->data['irregular']		= 1;
							$html = $this->load->view('./publico/general/full-pages/email/email_detalle_evento.php', $this->data, TRUE);
							$this->email->message($html);
							$this->email->send();
							$response = array('exito' => TRUE, 'msg' => '<h3>Se le ha notificado al cliente de su irregularidad en el pago.</h3>');
						}
					}
				}
			}
			elseif ($tipo == 'normal') {
				if ($valoracion == "aceptado"){
					// Cambio estatus de la cotización a PAGADO
					if ($this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO),
						array('folio' => $folio)))
					{
						$cotizacion = $this->cotizacionModel->get(array('id_cliente'), array('folio' => $folio), null, 'ASC', 1);
						$caso = array(
						    	'id_lider' 			=> NULL,
							'id_estatus_general' 		=> $this->estatusGeneralModel->PORASIGNAR,
							'id_cliente' 			=> $cotizacion->id_cliente,
							'folio_cotizacion'		=> $folio,
							'fecha_inicio' 			=> date('Y-m-d H:i:s'));

						// Abro un nuevo CASO
						if ($this->casomodel->insert($caso))
						{
							$response = array('exito' => TRUE, 'msg' => '<h3>Cotización pagada, nuevo caso abierto en espera de asignación.</h3>');
						}
					}
				}

				if ($valoracion == "irregular") {
					//Cambio estatus de cotización a irregular.
					$res = $this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->IRREGULAR),
										array('folio' => $folio));
					if ($res)
					{
						//ENVÍO DE PDF PARA SITUACIÓN IRREGULAR
						$cotizacion = $this->cotizacionModel->get_cotizacion_cliente(
								array(
									'cotizacion.id_cliente',
									'cotizacion.folio',
									'cotizacion.fecha',
									'cotizacion.vigencia',
									'contactos.nombre_contacto',
									'contactos.apellido_paterno',
									'contactos.apellido_materno',
									'contactos.email_contacto',
									'clientes.razon_social',
									'clientes.email',
									'clientes.usuario',
									'clientes.password',
									'estatus_cotizacion.descripcion'
								),
								array('clientes', 'contactos', 'estatus_cotizacion'),
								$folio);

						$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cotizacion->id_cliente.'/cotizacion/';
						$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
						$path 		= $dir_root.$name;

						if (!LOCAL) {
							$this->load->helper('formatofechas');
							$this->load->library('email');

							$contacto = $cotizacion->nombre_contacto.' '.$cotizacion->apellido_paterno.' '.$cotizacion->apellido_materno;
							//Envio Email con el PDF
							$this->email->set_mailtype('html');
							$this->email->from('cotizacion@moz67.com', 'Ventas - TiendaPAQ');
							$this->email->to($cotizacion->email_contacto);

							$this->email->subject('Pago irregular de cotización folio #'.$cotizacion->folio);
							// Contenido del correo
							$this->data['usuario'] 		= $cotizacion->usuario;
							$this->data['password'] 	= $cotizacion->password;
							$this->data['folio'] 		= $cotizacion->folio;
							$this->data['fecha'] 		= fecha_completa($cotizacion->fecha);
							$this->data['vigencia'] 	= fecha_completa($cotizacion->vigencia);
							$this->data['contacto'] 	= $contacto;
							$this->data['estatus'] 		= ucwords($cotizacion->descripcion);
							$this->data['irregular']	= 1;
							$html = $this->load->view('./admin/general/full-pages/email/email_envio_cotizacion.php', $this->data,TRUE);
							$this->email->message($html);
							// Adjunto PDF
							$this->email->attach($path);
							$this->email->send();
							$response = array('exito' => TRUE, 'msg' => '<h3>Se le ha notificado al cliente de su irregularidad en el pago.</h3>');
						}
					}
				}

				if ($valoracion == "parcial"){
					// Cambie estatus de la cotizacion a PARCIAL
					if ($this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PARCIAL),
						array('folio' => $folio)))
					{
						$this->load->model('casomodel');

						$cotizacion = $this->cotizacionModel->get(array('id_cliente'), array('folio' => $folio), null, 'ASC', 1);
						$caso = array(
							'id_estatus_general' => $this->estatusGeneralModel->PORASIGNAR,
							'id_cliente' => $cotizacion->id_cliente,
							'folio_cotizacion' => $folio,
							'fecha_inicio' => date('Y-m-d H:i:s'));
						// Abro un nuevo CASO
						if ($this->casomodel->insert($caso))
						{
							$response = array('exito' => TRUE, 'msg' => '<h3>Cotización con pago parcial, nuevo caso abierto en espera de asignación.</h3>');
						}
					}
				}
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	/**
	 * Funcion para reenvio de de cotizaciones
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function reenvio($folio)
	{
		//si no hay id de contacto lanzo la vista con la lista de contactos
		if(empty($_POST)){
			$this->load->model('contactosModel');

			$id_cliente 				= $this->cotizacionModel->get(array('id_cliente'),array('folio' => $folio),null,'ASC',1);
			$this->data['contactos'] 	= $this->contactosModel->get(array('*'), array('id_cliente' => $id_cliente->id_cliente));
			$this->data['folio'] 			= $folio;

			$this->_vista_completa('cotizacion/modal-reenviar-cotizacion');
		} else{
			//si hay id de contacto, extraigo el correo del contacto y reenvio la cotizacion
			$email = $this->input->post('email');

			$cotizacion = $this->cotizacionModel->get_cotizacion_cliente(
							array(
								'cotizacion.id_cliente',
								'cotizacion.folio',
								'cotizacion.fecha',
								'cotizacion.vigencia',
								'contactos.nombre_contacto',
								'contactos.apellido_paterno',
								'contactos.apellido_materno',
								'clientes.razon_social',
								'clientes.email',
								'clientes.usuario',
								'clientes.password',
								'estatus_cotizacion.descripcion'
							),
							array('clientes', 'contactos', 'estatus_cotizacion'),
							$folio);

			$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cotizacion->id_cliente.'/cotizacion/';
			$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
			$path 		= $dir_root.$name;

			$enviado = TRUE;
			if (!LOCAL) {
				$this->load->helper('formatofechas');
				$this->load->library('email');

				$contacto = $cotizacion->nombre_contacto.' '.$cotizacion->apellido_paterno.' '.$cotizacion->apellido_materno;
				//Envio Email con el PDF
				$this->email->set_mailtype('html');
				$this->email->from('cotizacion@moz67.com', 'Reenvio/Cotización - TiendaPAQ');
				$this->email->to($email);
				//$this->email->cc('another@example.com');
				//$this->email->bcc('and@another.com');
				$this->email->subject('Envío de Cotización TiendaPAQ');
				// Contenido del correo
				$this->data['usuario'] 		= $cotizacion->usuario;
				$this->data['password'] 	= $cotizacion->password;
				$this->data['folio'] 			= $cotizacion->folio;
				$this->data['fecha'] 		= fecha_completa($cotizacion->fecha);
				$this->data['vigencia'] 		= fecha_completa($cotizacion->vigencia);
				$this->data['contacto'] 	= $contacto;
				$this->data['estatus'] 		= ucwords($cotizacion->descripcion);
				$html = $this->load->view('admin/general/full-pages/email/email_envio_cotizacion.php', $this->data,TRUE);
				$this->email->message($html);
				// Adjunto PDF
				$this->email->attach($path);
				$enviado= $this->email->send();
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('exito' => $enviado)));
		}
	}

	public function factura($folio)
	{
		$this->load->helper('file');
		$cotizacion = $this->cotizacionModel->get_cotizacion_cliente(array('id_cliente'), array(''), $folio);
		// Armo la ruta donde guardare la imagen a subir
		$ruta = 'clientes/'.$cotizacion->id_cliente.'/factura/'.$folio.'/';
		delete_files($ruta);
		//Si el directorio de $ruta no existe es creado
		if (!is_dir($ruta))
		{
			mkdir($ruta, 0777, TRUE);
		}
		//Configuración para la subida del archivo
		$config_upload['upload_path']		= $ruta;
		$config_upload['allowed_types']		= 'pdf|PDF';
		$config_upload['overwrite'] 		= TRUE;
		$config_upload['remove_spaces']		= TRUE;

		// Cargo la librería upload y paso la configuración
		$this->load->library('upload', $config_upload);

		if ($this->upload->do_upload()) {
			 redirect('cotizaciones/revision/'.$folio);
		}else
		{
			echo $this->upload->display_errors();
			show_404();
		}

	}

	/**
	 * funcion para cancelar una cotizacion
	 *
	 * @author Diego Rodriguez
	 **/
	public function cancelar()
	{
		$this->load->model('estatusCotizacionModel');
		$folio = $this->input->post('folio');
		if($this->input->is_ajax_request()) {
			if($this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->CANCELADA), array('folio' => $folio))) {
				$respuesta = array('exito' => TRUE, 'msg' => '<h4>La cotización fue cancelada.</h4>' );
			}else{
				$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! Revisa la consola para más información.</h4>' );
			}
			//mando la repuesta
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}

 	/**
	 * Funcion para guardar los comentarios de la cotizacion
	 * @author Diego Rodriguez
	 **/
	public function comentarios()
	{
		$comentario = array(
			'folio'      	 	=> $this->input->post('folio'),
			'fecha'      	 	=> date('Y-m-d H:i:s'),
			'tipo' 	     	 	=> 'E',
			'id_ejecutivo' 	=> $this->input->post('id_ejecutivo'),
			'comentario' 	=> $this->input->post('comentario'),
		);

		$this->load->model('comentariosCotizacionModel');

		if($this->comentariosCotizacionModel->insert($comentario)){
			//notifico que hay mensajes no vistos e incremento el numero de mensajes
			$this->load->model('cotizacionModel');
			$this->cotizacionModel->incrementa_comentarios($comentario['folio']);

			$respuesta = array('exito' => TRUE);
		}else{
			$respuesta = array('exito' => FALSE);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion para mostrar una vista solo con los detalles
	 * de una cotizacion
	 *
	 * @author Diego Rodriguez
	 **/
	public function detalles($folio)
	{
		$this->load->model('comentariosCotizacionModel');

		// Marco como VISTO el campo de la tabla en cotizaciones y
		// los comentarios respectivos
		$this->load->model('comentariosCotizacionModel');
		$this->comentariosCotizacionModel->marcar_comentarios_visto($folio, 'c');
		$this->cotizacionModel->update(array('visto' => 1), array('folio' => $folio));

		$campos = array(
		               'cotizacion.folio',
		               'cotizacion.id_cliente',
		               'cotizacion.id_estatus_cotizacion',
		               'clientes.razon_social');
		$cotizacion = $this->cotizacionModel->get_cotizacion_cliente($campos, array('clientes'), $folio);

		$this->load->helper('directory');
		$this->load->helper('file');
		$ruta = '/clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$folio.'/';
		$archivos = directory_map('.'.$ruta, 1);

		$imagenes 	= array();
		$pdfs 		= array();

		// SI hay archivos en la variable
		if($archivos) {
			// Descarto la carpeta de las thumnail
			foreach ($archivos as $index => $archivo) {
				$tipo = explode("/", get_mime_by_extension($archivos[$index]));
				if ($archivos[$index] != 'thumbnail' && ($tipo[1] == 'png' || $tipo[1] == 'jpeg')) {
					array_push($imagenes, $archivos[$index]);
				} else if($archivos[$index] != 'thumbnail' && $tipo[1] == 'pdf') {
					array_push($pdfs, $archivos[$index]);
				}
			}
		}

		$this->data['cotizacion'] 	= $cotizacion;
		$this->data['imagenes'] 	= $imagenes;
		$this->data['pdfs'] 			= $pdfs;
		$this->data['ruta_pdf']		= $ruta;
		$this->data['comentarios'] = $this->comentariosCotizacionModel->get_comentarios($folio);

		$this->_vista('detalles');
	}

	/**
	 * Modal para mostrar archivos
	 * de una cotizacion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function archivos($folio)
	{
		$campos = array(
			'cotizacion.id_cliente',
			'cotizacion.id_estatus_cotizacion',
			'clientes.razon_social');
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($campos, array('clientes'), $folio)) {
			$archivos 				= $this->cotizacionModel->get_files_cotizacion($cotizacion->id_cliente, $folio);
			$this->data['archivos'] 	= $archivos;
			$this->_vista_completa('cotizacion/modal-archivos-cotizacion');
		} else {
			show_404();
		}
	}
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */