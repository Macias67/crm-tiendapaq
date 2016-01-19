<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Ticket extends AbstractController
{

	function index($id_evento = 4)
	{
		$this->load->model('eventomodel');
		$this->load->helper('directory');
		if ($evento = $this->eventomodel->get_where(['id_evento' => $id_evento]))
		{
			$this->load->model('participantesmodel');
			$participantes = $this->participantesmodel->get_where(['id_evento' => $evento->id_evento]);
			$participantes = count($participantes);

			// Valido cupo del evento
			// fecha
			if (($evento->max_participantes == 0) || ($evento->max_participantes >= $participantes))
			{
				$this->load->model('sesionmodel');
				$this->load->helper('formatofechas');
				$sesiones = $this->sesionmodel->get('*', ['id_evento' => $id_evento]);

				// Foto
				$archivo = directory_map('assets/admin/pages/media/eventos/' . $id_evento . '/');

				$this->data['sesiones'] = $sesiones;
				$this->data['evento'] = $evento;
				$this->data['temario_url'] = site_url('assets/admin/pages/media/eventos/' . $id_evento . '/' . $archivo[0]);
				$this->_vista('form-abre-ticket');
			}
			else
			{
				show_error('El evento esta a tope');
			}
		}
		else
		{
			show_404();
		}
	}
}