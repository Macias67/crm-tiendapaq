<?php
if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Ticket extends AbstractAccess
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ticketmodel');
	}

	function index()
	{
		// TODO: Implement index() method.
	}

	public function revisar()
	{
		$this->data['tickets_revision'] = $this->ticketmodel->get_tickets_pendientes(
			[
				'tickets.id_ticket',
				'clientes.razon_social',
				'contactos.nombre_contacto',
				'contactos.apellido_paterno',
				'contactos.email_contacto',
				'clientes.telefono1'
			]);

		$this->_vista('tickets-revision');
	}

	public function revision($id_ticket)
	{
		if ($ticket = $this->ticketmodel->get_where(['id_ticket' => $id_ticket]))
		{
			$this->load->model('clientemodel');
			$this->load->model('contactosmodel');
			$this->load->helper('formatofechas');

			$cliente = $this->clientemodel->get_where(['id' => $ticket->id_cliente]);
			$contacto = $this->contactosmodel->get_where(['id' => $ticket->id_contacto]);

			$this->data['ticket'] = $ticket;
			$this->load->helper('directory');
			$this->load->helper('file');
			$ruta = '/clientes/'.$ticket->id_cliente.'/ticket/'.$ticket->id_ticket.'/';
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

			$this->data['contacto'] 	= $contacto;
			$this->data['cliente'] 	= $cliente;
			$this->data['imagenes'] 	= $imagenes;
			$this->data['pdfs'] 		= $pdfs;
			$this->data['ruta_pdf']	= $ruta;
			$this->_vista('detalles');
		}
	}

	/**
	 * Funcion para asignarle un caso a un ejecutivo
	 *
	 * @return json
	 * @author Luis Macias
	 **/
	public function asignar($accion = null, $id_ticket = null)
	{
		switch ($accion)
		{
			// Respuesta JSON cambia la base de datos para asignar caso a un ejecutivo
			case 'asignar':
				$id_ticket = $this->input->post('id_ticket');
				$id_ejecutivo = $this->input->post('id_ejecutivo');

				if ($ticket = $this->ticketmodel->get_where(['id_ticket' => $id_ticket]))
				{
					$this->load->model('casoModel');
					$this->load->model('estatusGeneralModel');

					$caso = [
						'id_lider'           => $id_ejecutivo,
						'id_estatus_general' => $this->estatusGeneralModel->PENDIENTE,
						'id_cliente'         => $ticket->id_cliente,
						'fecha_inicio'       => date('Y-m-d H:i:s'),
						'descripcion'        => '<i>Origen Ticket: </i>' . $ticket->mensaje
					];

					if ($caso_id = $this->casoModel->get_last_id_after_insert($caso))
					{
						// Cierro el Ticket
						$this->ticketmodel->update(['id_estatus' => $this->estatusGeneralModel->CERRADO],['id_ticket' => $id_ticket]);
						//SECCION ENVIAR CORREO A CONTACTO DE COTIZACION NOTIFICANDO QUE SU CASO HA SIDO ABIERTO Y ASIGNADO
						$exito = true;
						if (!LOCAL)
						{
							$this->load->model('cotizacionModel');
							$this->load->model('contactosModel');
							$this->load->model('clienteModel');
							$this->load->helper('formatofechas');
							$this->load->library('email');

							$caso = $this->casoModel->get_caso_detalles($caso_id);
							$cliente = $this->clienteModel->get(['email', 'usuario', 'password'], ['id' => $ticket->id_cliente], null, 'ASC', 1);

							$lider = $caso->primer_nombre . ' ' . $caso->apellido_paterno;
							//Envio Email
							$this->email->set_mailtype('html');
							$this->email->from('notificacion@soipaq.com', 'Soporte Técnico - TiendaPAQ');
							$this->email->to($cliente->email);
							//$this->email->cc('another@example.com');
							//$this->email->bcc('and@another.com');
							$this->email->subject('Apertura de Caso - Origen Ticket no.' . $id_ticket . ' | TiendaPAQ');
							//Contenido del correo
							$this->data['usuario'] = $cliente->usuario;
							$this->data['password'] = $cliente->password;
							$this->data['id_caso'] = $caso->id_caso;
							$this->data['fecha'] = fecha_completa($caso->fecha_inicio);
							$this->data['folio'] = 'Inicio de Ticket no. '.$id_ticket;
							$this->data['lider'] = $lider;
							//var_dump($this->data);
							$html = $this->load->view('admin/general/full-pages/email/email_inicio_caso.php', $this->data, true);
							$this->email->message($html);
							// Adjunto PDF
							//$this->email->attach($path);
							$exito = $this->email->send();
						}
						if ($exito)
						{
							$respuesta = ['exito' => true];
						}
						else
						{
							$respuesta = ['exito' => false, 'msg' => '<h4>Nuevo caso asignado, error al enviar el email al cliente</h4>'];
						}
					}
					else
					{
						$respuesta = ['exito' => false, 'msg' => '<h4>Error, revisa la consola para mas información</h4>'];
					}
					$this->output
						->set_content_type('application/json')
						->set_output(json_encode($respuesta));

				}

				break;
			// Muestra la vista para asignar el caso a un ejecutivo
			case 'mostrar':
				$this->load->model('ejecutivoModel');
				$this->data['ejecutivos'] = $this->ejecutivoModel->get(['id', 'primer_nombre', 'apellido_paterno'], null, 'primer_nombre');
				$this->data['id_ticket'] = $id_ticket;

				$this->_vista_completa('ticket/modal-asignar-ejecutivo');
				break;
		}
	}
}