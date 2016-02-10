<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket  extends AbstractAccess
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
			array(
				'tickets.id_ticket',
				'clientes.razon_social',
				'contactos.nombre_contacto',
				'contactos.apellido_paterno',
				'contactos.email_contacto',
				'clientes.telefono1'
			));

		//var_dump($this->data['tickets_revision']);
		$this->_vista('tickets-revision');
	}

	public function revision($id_ticket)
	{
		if($ticket = $this->ticketmodel->get(['*'], ['id_ticket' => $id_ticket])) {
			$this->data['ticket'] = $ticket[0];
			$this->_vista('detalles');
		}
	}
}