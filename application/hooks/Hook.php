<?php if (!defined( 'BASEPATH')) exit('No direct script access allowed');
/**
* Revisar los eventos cadudados
*/
class Hook
{
	private $ci;
	function __construct()
	{
		$this->ci =& get_instance();
	}

	public function caducidad()
	{
		$this->ci->load->model('estatusgeneralmodel');
		$this->ci->load->model('eventomodel');
		$eventos_pendientes = $this->ci->eventomodel->get_where(array('id_estatus' => $this->ci->estatusgeneralmodel->PENDIENTE));
		// Si hay eventos
		if (is_array($eventos_pendientes)) {
			foreach ($eventos_pendientes as $index => $evento) {
				// Comparo
				if($evento->fecha_limite <= date('Y-m-d H:i:s', time())) {
					$update = array('id_estatus' => $this->ci->estatusgeneralmodel->CERRADO);
					$exito = $this->ci->eventomodel->update($update, array('id_evento' => $evento->id_evento));
				}
			}
		} else {
			// Comparo
			if($eventos_pendientes->fecha_limite <= date('Y-m-d H:i:s', time())) {
				$update = array('id_estatus' => $this->ci->estatusgeneralmodel->CERRADO);
				$exito = $this->ci->eventomodel->update($update, array('id_evento' => $eventos_pendientes->id_evento));
			}
		}
	}
}