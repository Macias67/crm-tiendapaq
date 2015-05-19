<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends AbstractController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventomodel');
	}

	public function index($filtro = null)
	{
		$this->load->model('oficinasmodel');
		$this->load->model('sesionmodel');
		$this->load->model('estatusgeneralmodel');
		$this->load->helper('formatofechas');

		$eventos = $this->eventomodel->get('*',array('id_estatus' => $this->estatusgeneralmodel->PENDIENTE), 'fecha_limite', 'ASC');
		// Clasifico segun modalidad
		$otro 		= array();
		$sucursal	= array();
		$online 	= array();
		foreach ($eventos as $index => $evento) {
			$primera_sesion = $this->sesionmodel->get("MIN(fecha_inicio) as primera_sesion",array('id_evento' => $evento->id_evento), null, 'ASC', 1);
			$evento->primera_sesion = $primera_sesion->primera_sesion;

			if ($evento->modalidad == 'online') {
				array_push($online, $evento);
			} else if ($evento->modalidad == 'sucursal')
			{
				$oficina = $this->oficinasmodel->get('ciudad_estado', array('id_oficina' => $evento->id_oficina), null, 'ASC', 1);
				$evento->oficina = $oficina->ciudad_estado;
				array_push($sucursal, $evento);
			} else if ($evento->modalidad == 'otro')
			{
				array_push($otro, $evento);
			}
		}

		$this->data['online'] 	= $online;
		$this->data['sucursal'] 	= $sucursal;
		$this->data['otro'] 		= $otro;
		$this->_vista('listado-eventos');
	}

	/**
	 * Vista para mostrar detalles
	 * a un evento
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function detalles($id_evento)
	{
		if ($evento = $this->eventomodel->get_where(array('id_evento' => $id_evento))) {
			$this->load->model('sesionmodel');
			$this->load->helper('formatofechas');

			$lugar = '';
			if ($evento->modalidad != 'online' && !is_null($evento->id_oficina)) {
				$this->load->model('oficinasmodel');
				$oficina 	= $this->oficinasmodel->get('*', array('id_oficina' => $evento->id_oficina), null, 'ASC', 1);
				$lugar 		= $oficina->calle.' '.$oficina->numero.', Col. '.$oficina->colonia.', '.$oficina->ciudad_estado;
			} else if ($evento->modalidad != 'online' && !is_null($evento->direccion)) {
				$lugar = $evento->direccion;
			}

			$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));
			$this->data['temario_url'] 	= site_url('assets/admin/pages/media/eventos/'.$id_evento.'/temario.jpg');
			$this->data['sesiones'] 	= $sesiones;
			$this->data['evento'] 		= $evento;
			$this->data['lugar'] 		= $lugar;
			$this->_vista('detalles');
		} else {
			show_404();
		}
	}

	/**
	 * Vista para mostrar el formulario de inscripcion
	 * a un evento
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function inscripcion($id_evento)
	{
		if ($evento = $this->eventomodel->get_where(array('id_evento' => $id_evento))) {
			$this->load->model('participantesmodel');
			$participantes = $this->participantesmodel->get_where(array('id_evento' => $evento->id_evento));
			$participantes = count($participantes);

			// Valido cupo del evento
			// fecha
			if (($evento->max_participantes == 0) || ($evento->max_participantes >= $participantes))  {
				$this->load->model('sesionmodel');
				$this->load->helper('formatofechas');
				$this->load->helper('directory');
				$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));

				// Foto
				$archivo = directory_map('assets/admin/pages/media/eventos/'.$id_evento.'/');

				$this->data['sesiones'] 	= $sesiones;
				$this->data['evento'] 		= $evento;
				$this->data['temario_url'] 	= site_url('assets/admin/pages/media/eventos/'.$id_evento.'/'.$archivo[0]);
				$this->_vista('form-inscripcion');
			} else {
				show_error('El evento esta a tope');
			}
		} else {
			show_404();
		}
	}

	public function registro()
	{
		if ($this->input->is_ajax_request()) {
			$id_evento 		= $this->input->post('id_evento');
			$id_cliente 	= $this->input->post('id_cliente');
			$id_contacto 	= $this->input->post('id_contacto');

			/*Cliente*/
			$rfc 			= $this->input->post('rfc');
			$razon_social 	= $this->input->post('razon_social');
			$email 			= $this->input->post('email');
			$tipo 			= $this->input->post('tipo');
			$calle 			= $this->input->post('calle');
			$no_exterior 	= $this->input->post('no_exterior');
			$no_interior 	= $this->input->post('no_interior');
			$colonia 		= $this->input->post('colonia');
			$codigo_postal = $this->input->post('codigo_postal');
			$ciudad 		= $this->input->post('ciudad');
			$municipio 		= $this->input->post('municipio');
			$estado 		= $this->input->post('estado');
			$pais 			= $this->input->post('pais');
			$telefono1 	= $this->input->post('telefono1');
			$telefono2 	= $this->input->post('telefono2');
			$usuario 		= $this->input->post('usuario');
			$password 		= $this->input->post('password');

			/*Contacto*/
			$nombre_contacto 	= $this->input->post('nombre_contacto');
			$apellido_paterno 		= $this->input->post('apellido_paterno');
			$apellido_materno 		= $this->input->post('apellido_materno');
			$email_contacto 		= $this->input->post('email_contacto');
			$telefono_contacto 	= $this->input->post('telefono_contacto');
			$puesto_contacto 		= $this->input->post('puesto_contacto');

			$this->load->model('clientemodel');
			$this->load->model('contactosmodel');

			$data = array(
				//Datos basicos
				'razon_social'	=> $razon_social,
				'rfc'			=> $rfc,
				'email'			=> $email,
				'tipo'			=> $tipo,
				'calle'			=> $calle,
				'no_exterior'	=> $no_exterior,
				'no_interior'	=> $no_interior,
				'colonia'		=> $colonia,
				'codigo_postal'	=> $codigo_postal,
				'ciudad'			=> $ciudad,
				'municipio'		=> $municipio,
				'estado'		=> $estado,
				'pais'			=> $pais,
				'telefono1'		=> $telefono1,
				'telefono2'		=> $telefono2,
				'usuario'  		=> $usuario,
				'password' 		=> $password,
				//Contacto
				'nombre_contacto'		=> $nombre_contacto,
				'apellido_paterno'		=> $apellido_paterno,
				'apellido_materno'		=> $apellido_materno,
				'email_contacto'		=> $email_contacto,
				'telefono_contacto'	=> $telefono_contacto,
				'puesto_contacto'		=> $puesto_contacto,
			);

			// SI son vacios los id's de cliente y contacto, es cliente nuevo
			if (empty($id_cliente) && empty($id_contacto)) {
				//armo objeto de CLIENTE NUEVO e inserto a la BD
				$cliente 		= $this->clientemodel->array_to_object($data, $tipo, TRUE);
				$id_cliente 	= $this->clientemodel->get_last_id_after_insert($cliente);
				//armo objeto de CONTACTO NUEVO e inserto a la BD
				$contacto		= $this->contactosmodel->arrayToObject($id_cliente, $data);
				$id_contacto 	= $this->contactosmodel->get_last_id_after_insert($contacto);
			} else {
				// se crea un objeto con la informacion basica de CLIENTE Y CONTACTO para insertarlo en la tabla clientes
				$cliente 	= $this->clientemodel->array_to_object($data, $tipo);
				$contacto = array(
					'nombre_contacto'		=> trim(ucwords(strtolower($nombre_contacto))),
					'apellido_paterno'		=> trim(ucwords(strtolower($apellido_paterno))),
					'apellido_materno'		=> trim(ucwords(strtolower($apellido_materno))),
					'email_contacto'		=> trim(strtolower($email_contacto)),
					'telefono_contacto'	=> trim($telefono_contacto),
					'puesto_contacto'		=> trim(ucwords(strtolower($puesto_contacto)))
				);
				// Inserto cliente y contacto actualizados
				$this->clientemodel->update($cliente, array('id' => $id_cliente));
				// Verifico si el cliente ya registrado tiene contactos
				$total_contactos = $this->contactosmodel->get_where(array('id_cliente' => $id_cliente));
				// SI ya hay contactos, actualizo mediante el id del contacto
				if (count($total_contactos) > 0) {
					$this->contactosmodel->update($contacto, array('id' => $id_contacto));
				}
				// SI no hay contactos, inserto contacto y extraigo el id_contacto
				else {
					//armo objeto de CONTACTO NUEVO e inserto a la BD
					$contacto		= $this->contactosmodel->arrayToObject($id_cliente, $data);
					$id_contacto 	= $this->contactosmodel->get_last_id_after_insert($contacto);
				}
			}

			// SI exite el evento
			if ($evento = $this->eventomodel->get_where(array('id_evento' => $id_evento))) {
				$this->load->model('participantesmodel');
				$this->load->model('estatusgeneralmodel');
				// Total de participantes
				$participantes = $this->participantesmodel->get_where(array('id_evento' => $evento->id_evento));
				$participantes = count($participantes);
				// Compruebo si ID del contacto ya esta inscrito
				$reg_contacto = $this->participantesmodel->get_where(array(
											'id_evento' 		=> $evento->id_evento,
											'id_contacto' 	=> $id_contacto));

				/*
				* Validar:
				*  1. Fecha Limite
				*  2. Cupo
				*  3. Estatus
				*  4. Contacto registrado
				*  5. Costo
				 */

				$registrado 	= FALSE;
				$mensaje 		= '';
				$msgerror 		= '';

				// Fecha limite adecuado
				if (date('Y-m-d H:i:s') <= $evento->fecha_limite ) {
					// Cupo sin limite o cupo suficiente
					if (($evento->max_participantes == 0) || ($participantes < $evento->max_participantes)) {
						// Estatus adecuado
						if ($evento->id_estatus == $this->estatusgeneralmodel->PENDIENTE) {
							// Compruebo si ID del contacto ya esta inscrito
							if (empty($reg_contacto)) {
								// Verifico si el evento es con costo o sin costo
								if ($evento->costo == 0) {
									$this->load->model('participantesmodel');
									$this->load->model('sesionmodel');
									$participante = array(
													'id_evento' 		=> $id_evento,
													'id_contacto' 	=> $id_contacto);
									$registrado 	= $this->participantesmodel->insert($participante);
									$mensaje 		= 'Te has registrado exitosamente, se te hará llegar un email con todos los detalles del curso. Te agradecemos tu interés.';

									// Extraigo info del participante (contacto)
									$contacto = $this->contactosmodel->get_where(array('id' => $id_contacto));
									// Sesiones del evento
									$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));

									/*CODIGO PARA ENVIO DE CORREOS CON INFO DEL EVENTO*/
									if (!LOCAL) {
										$this->load->library('email');
										$this->load->helper('formatofechas');
										$this->load->helper('directory');

										$this->email->set_mailtype('html');
										$this->email->from('eventos@moz67.com', 'Eventos TiendaPAQ');
										$this->email->to($contacto->email_contacto);

										$this->email->subject('Inscripción a evento: '.$evento->titulo);
										// Contenido del correo
										$this->data['titulo'] 		= $evento->titulo;
										$this->data['descripcion'] 	= $evento->descripcion;
										$this->data['modalidad'] 	= $evento->modalidad;
										// Modalidad
										$this->data['ubicacion'] 	= ($evento->modalidad == 'online') ? $evento->link : $evento->direccion;
										$this->data['sesiones'] 	= $sesiones;
										//Datos de logueo
										$this->data['usuario'] 		= $data['usuario'];
										$this->data['password'] 	= $data['password'];
										$html = $this->load->view('publico/general/full-pages/email/email_detalle_evento.php', $this->data, TRUE);
										$this->email->message($html);

										$path 		= 'assets/admin/pages/media/eventos/'.$evento->id_evento.'/';
										$file 		= directory_map($path);
										$imagen 	= $path.$file[0];
										if (count($file) == 1 && is_file($imagen)) {
											$this->email->attach($imagen);
										}
										$registrado = $this->email->send();
									}
								} else {
									$registrado 	= TRUE;
									$nota 			= '<b>Nota: Tu inscripción quedará confirmada hasta que sea validado tu pago y estará sujeto a disponibilidad. Se hará reembolso en caso de que el curso llegue al límite del curso y no alcances lugar. </b>';
									$mensaje 		= 'Enviamos a tu email la cotización de este curso. Una vez efectuado el pago  envía el comprobante desde la sección de Cotizaciones Pendientes de esta aplicación. <br> <br>'.$nota;

									/*INSERTO COTIZACION EN LA TABLA*/
									$this->load->model('cotizacionmodel');
									$this->load->model('estatuscotizacionmodel');

									// Extraigo info del participante (contacto)
									$contacto = $this->contactosmodel->get_where(array('id' => $id_contacto));
									// Info de la oficina
									//$oficina = $this->oficinasModel->get_where();

									//Evento cotizado
									$info_cot = array(
										array(
										      'codigo' 			=> '',
										      'descripcion' 	=> $evento->titulo,
										      'cantidad' 		=> 1,
										      'precio' 			=> $evento->costo,
										      'neto' 			=> $evento->costo,
										      'descuento'		=> 0,
										      'total' 			=> $evento->costo,
										      'observacion' 	=> $evento->descripcion
										)
									);

									$nueva_cot = array(
										'fecha'      	 			=> date('Y-m-d H:i:s'),
										'vigencia'				=> $evento->fecha_limite,
										'id_ejecutivo'			=> $evento->id_ejecutivo,
										'id_cliente'				=> $id_cliente,
										'id_contacto'			=> $contacto->id,
										'id_oficina'				=> 1, // OCOTLAN
										'cotizacion'				=> json_encode($info_cot),
										'id_observaciones'		=> 1,
										'id_banco'				=> 1,
										'id_evento'				=> $evento->id_evento,
										'id_estatus_cotizacion'	=> $this->estatuscotizacionmodel->PORPAGAR,
										'tipo'					=> 'evento'
										);

									$folio = $this->cotizacionmodel->get_last_id_after_insert($nueva_cot);

									// Datos oficina
									$this->load->model('oficinasmodel');
									$oficina = $this->oficinasmodel->get_where(array('id_oficina' => 1));

									// Datos ejecutivo
									$this->load->model('ejecutivomodel');
									$data_ejecutivo = $this->ejecutivomodel->get(
										array('primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno'),
										array('id' => $evento->id_ejecutivo)
									);
									// Nombre del ejecutivo
									$nombre = 	$data_ejecutivo[0]->primer_nombre.' '.
												$data_ejecutivo[0]->segundo_nombre.' '.
												$data_ejecutivo[0]->apellido_paterno.' '.
												$data_ejecutivo[0]->apellido_materno;

									// COTIZACION
									$cotizacion = array(
										'folio' 		=> $folio,
										'agente' 	=> $nombre);

									// Info del cliente
									$this->load->model('contactosModel');
									$campos = array(
													'clientes.id',
													'clientes.razon_social',
													'contactos.id AS id_contacto',
													'contactos.nombre_contacto',
													'contactos.apellido_paterno',
													'contactos.apellido_materno',
													'contactos.email_contacto',
													'contactos.telefono_contacto');
									$cliente = $this->contactosModel->getClientePorContacto($campos, $id_contacto);

									$cliente  = array(
										'id' 				=> $cliente->id,
										'razon_social' 	=> $cliente->razon_social,
										'id_contacto' 	=> $cliente->id_contacto,
										'contacto' 		=>  $cliente->nombre_contacto.' '.$cliente->apellido_paterno.' '.$cliente->apellido_materno,
										'telefono' 		=> $cliente->telefono_contacto,
										'email' 			=> $cliente->email_contacto
									);

									// Total
									$total = array(
										'subtotal' 	=> $evento->costo,
										'iva' 		=> $evento->costo*.16,
										'total' 		=> ($evento->costo + ($evento->costo*.16))
									);

									// Banco
									$this->load->model('bancoModel');
									$banco = $this->bancoModel->get_where(array('id_banco' => 1));

									// Si no existe la carpeta cotizacion del cliente la creo
									$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cliente['id'].'/cotizacion/';
									if (!is_dir($dir_root)) {
										mkdir($dir_root, DIR_WRITE_MODE, TRUE);
									}
									$name		= 'tiendapaq-cotizacion_'.$cotizacion['folio'].'.pdf';
									$path 		= $dir_root.$name;

									// Si no existe la carpeta comprobantes del cliente la creo
									$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cliente['id'].'/comprobantes/'.$cotizacion['folio'].'/';
									if (!is_dir($dir_root)) {
										mkdir($dir_root, DIR_WRITE_MODE, TRUE);
									}

									// Guardo PDF finals
									$this->_pdf($oficina, $cotizacion, $cliente, $info_cot, $total, $banco, $path);


									$registrado = TRUE;
									/*CODIGO PARA ENVIO DE CORREO COTIZACION*/
									if (!LOCAL) {
										$this->load->library('email');
										$this->load->helper('formatofechas');
										$this->load->helper('directory');
										$this->load->model('sesionmodel');

										//Extracción de la BD de las sesiones
										$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));

										$this->email->set_mailtype('html');
										$this->email->from('eventos@moz67.com', 'Eventos TiendaPAQ');
										$this->email->to($contacto->email_contacto);

										$this->email->subject('Inscripción a evento TiendaPAQ');
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
										$this->data['sesiones'] 	= $sesiones;
										//Datos de logueo
										$this->data['usuario'] 		= $data['usuario'];
										$this->data['password'] 	= $data['password'];
										$html = $this->load->view('publico/general/full-pages/email/email_detalle_evento.php', $this->data, TRUE);
										$this->email->message($html);
										$this->email->attach($path);

										$registrado = $this->email->send();
									}
								}
							} else {
								$msgerror = 'El contacto registrado ya esta inscrito en este curso.';
							}
						} else {
							$msgerror = 'El curso ya está en curso o en algún estatus que no permite registro.';
						}
					} else {
						$msgerror = 'Ya no hay cupo para este curso.';
					}
				} else {
					$msgerror = 'Has pasado la fecha límite de inscripción al curso.';
				}
				$response 		= array('registrado' => $registrado, 'mensaje' => $mensaje, 'msgerror' => $msgerror);
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
			}
		}
	}

	public function existe_cliente()
	{
		if ($this->input->is_ajax_request()) {
			$this->load->model('clientemodel');

			$rfc = $this->input->post('rfc');
			if ($cliente = $this->clientemodel->get_where(array('rfc' => $rfc))) {
				if(is_array($cliente)) {
					$cliente = $cliente[0];
				}
				$this->load->model('contactosmodel');
				$contactos = $this->contactosmodel->get('*', array('id_cliente' => $cliente->id));


				$select = null;
				if (count($contactos) > 0) {
					$this->load->helper('form');
					$options = array('' => '');
					foreach ($contactos as $index => $contacto) {
						$options[$contacto->id] = $contacto->nombre_contacto.' '.$contacto->apellido_paterno.' '.$contacto->apellido_materno;
					}
					$select = form_dropdown('contacto', $options, '', 'class="form-control"');
				}

				$response = array(
						'cliente' 	=> $cliente,
						'contactos' => $select,
						'existe'	 	=> TRUE
						);
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
			}
		}
	}

	public function data_contacto()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');
			$this->load->model('contactosmodel');

			if ($contacto = $this->contactosmodel->get_where(array('id' => $id))) {
				$contacto = (array)$contacto;
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array('contacto' => $contacto)));
			}
		}
	}

	/**
	 * Crea el PDF
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	private function _pdf($oficina, $cotizacion, $cliente, $productos, $total, $banco, $path)
	{
		// Cargo libreria del pdf y numeroaletra
		$this->load->library('pdf');
		$this->load->library('numeroaletra');

		$this->pdf = new PDF();
		$this->pdf->init($oficina, $cotizacion, $cliente, $banco);
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		// Nombre del supervisor
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->Ln(5);
		// Tabla
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->SetDrawColor(160, 160, 160);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15, 5, 'Cantidad', 0, 0,'C', 1);
		$this->pdf->Cell(15, 5, utf8_decode('Código'), 0, 0,'C', 1);
		$this->pdf->Cell(105, 5, utf8_decode('Concepto/Descripción'), 0, 0,'C', 1);
		$this->pdf->Cell(20, 5, 'Valor Unitario', 0, 0,'C', 1);
		$this->pdf->Cell(25, 5, 'Importe', 0, 1,'C', 1);
		// Valores
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(0, 0, 0);

		// Productos
		$total_productos = count($productos);
		for ($i=0; $i < $total_productos; $i++) {
			// SI tiene observacion
			$bool_obs = empty($productos[$i]['observacion']);
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(15, 5, $productos[$i]['cantidad'], 'LBR', 0,'C');
			$this->pdf->Cell(15, 5, $productos[$i]['codigo'], 'BR', 0,'C');
			$this->pdf->Cell(105, 5, utf8_decode($productos[$i]['descripcion']), !$bool_obs ? 'R' : 'BR', 0, 'L');
			$this->pdf->Cell(20, 5, sprintf ('%0.2f', $productos[$i]['precio']), 'BR', 0,'C');
			$this->pdf->Cell(25, 5, sprintf ('%0.2f', $productos[$i]['total']), 'BR', 1,'C');
			// Obervacion
			if (!$bool_obs) {
				$this->pdf->SetFont('Arial','',7);
				//Save the current position
				$x = $this->pdf->GetX();
				$y = $this->pdf->GetY();
				$height = $this->pdf->GetMultiCellHeight(105, 4, $productos[$i]['observacion'], 'BR', 'L');
				$this->pdf->Cell(15, $height, '', 'LBR', 0,'C');
				$this->pdf->Cell(15, $height, '', 'BR', 0,'C');
				$this->pdf->MultiCell(105, 4,  utf8_decode($productos[$i]['observacion']), 'LBR', 'L', TRUE);
				//Put the position to the right of the cell
        			$this->pdf->SetXY($x+(15+15+105),$y);
				$this->pdf->Cell(20, $height, '', 'BR', 0,'C');
				$this->pdf->Cell(25, $height, '', 'BR', 1,'C');
			}
		}
		$this->pdf->Ln(5);
		// Importe con Letra
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(120, 5, 'Importe con letra', 0, 0,'C', 1);
		// Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(150, 150, 150);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10);
		$this->pdf->Cell(25, 5, 'SUBTOTAL:', 1, 0);
		// Valor Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(18, 143, 188);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(25, 5, sprintf ('%0.2f', $total['subtotal']), 1, 1);
		// Valores Importe con Letra
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(0, 0, 0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(120, 5, strtoupper($this->numeroaletra->ValorEnLetras($total['total'], 'PESOS')), 'LBR', 0,'C');
		// Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(150, 150, 150);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10);
		$this->pdf->Cell(25, 5, 'I.V.A.:', 1, 0);
		// Valor Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(18, 143, 188);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(25, 5, sprintf ('%0.2f', $total['iva']), 1, 1);
		// Metodo pago
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(120, 5, utf8_decode('NOTA'), 0, 0,'C', 1);
		// Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(150, 150, 150);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10);
		$this->pdf->Cell(25, 5, 'TOTAL:', 1, 0);
		// Valor Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(18, 143, 188);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(25, 5, sprintf ('%0.2f', $total['total']), 1, 1);
		// Valores
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(0, 0, 0);
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->MultiCell(120, 1, '', 'LR');
		$this->pdf->MultiCell(120, 3, utf8_decode('Las promociones, servicios sin costo, descuentos adicionales o cualquier negociación realizada con el ejecutivo de ventas deberá quedar por escrito en un e-mail adicional a este documento de lo contrario no serán validas.'), 'LBR');
		$this->pdf->Output($path, 'F');
	}

	public function email()
	{
		$this->_vista_completa('email/email_prueba.php');
	}

}

/* End of file evento.php */
/* Location: ./application/controllers/publica/evento.php */