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
				$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));

				$this->data['sesiones'] 	= $sesiones;
				$this->data['evento'] = $evento;
				$this->data['temario_url'] 	= site_url('assets/admin/pages/media/eventos/'.$id_evento.'/temario.jpg');
				$this->_vista('form-inscripcion');
			} else {
				var_dump($participantes);
				var_dump($evento->max_participantes);
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
				$this->contactosmodel->update($contacto, array('id' => $id_contacto));
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
					if (($evento->max_participantes == 0) || ($participantes <= $evento->max_participantes)) {
						// Estatus adecuado
						if ($evento->id_estatus == $this->estatusgeneralmodel->PENDIENTE) {
							// Compruebo si ID del contacto ya esta inscrito
							if (empty($reg_contacto)) {
								// Verifico si el evento es con costo o sin costo
								if ($evento->costo == 0) {
									$this->load->model('participantesmodel');
									$participante = array(
													'id_evento' 		=> $id_evento,
													'id_contacto' 	=> $id_contacto);

									$registrado 	= $this->participantesmodel->insert($participante);
									$mensaje 		= 'Te has registrado exitosamente, se te hará llegar un email con todos los detalles del curso. Te agradecemos tu interés.';

									/*CODIGO PARA ENVIO DE CORREOS CON INFO DEL EVENTO*/
								} else {
									$registrado = TRUE;
									$nota = '<b>Nota: tu registro se hará una vez el pago sea validado y está sujeto a disponibilidad.</b>';
									$mensaje 		= 'Te enviamos a tu email la cotización del curso, puedes utilizar nuestra aplicación para llevar acabo el proceso de la compra. Te agradecemos tu interés. '.$nota;
									/*CODIGO PARA ENVIO DE CORREO COTIZACION*/
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

}

/* End of file evento.php */
/* Location: ./application/controllers/publica/evento.php */