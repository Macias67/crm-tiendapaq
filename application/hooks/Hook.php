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

	public function caducidadEvento()
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
					$this->ci->eventomodel->update($update, array('id_evento' => $evento->id_evento));
				}
			}
		} else {
			// Comparo
			if($eventos_pendientes->fecha_limite <= date('Y-m-d H:i:s', time())) {
				$update = array('id_estatus' => $this->ci->estatusgeneralmodel->CERRADO);
				$this->ci->eventomodel->update($update, array('id_evento' => $eventos_pendientes->id_evento));
			}
		}
	}

	public function caducidadEncuesta()
	{
		$this->ci->load->model('encuestamodel');
		$this->ci->load->model('casomodel');
		$this->ci->load->model('cotizacionmodel');

		$encuestas 	= $this->ci->encuestamodel->get_where(array('fecha_respuesta' => NULL));

		// Si hay eventos
		if (is_array($encuestas)) {
			foreach ($encuestas as $index => $encuesta) {

				$fecha_mas_15dias = strtotime($encuesta->fecha_enviado)+(60*60*24*15);
				$caso 	= $this->ci->casomodel->get_where(array('id' => $encuesta->id_caso));

				// Si tiene cotizacion
				if ($caso->folio_cotizacion != NULL) {
					$this->ci->load->model('estatuscotizacionmodel');
					$cotizacion = $this->ci->cotizacionmodel->get_where(array('folio' => $caso->folio_cotizacion));
					//Si la cotizacion esta pagada
					if ($cotizacion->id_estatus_cotizacion == $this->ci->estatuscotizacionmodel->PAGADO) {
						// Comparo, si la fecha actual es mayor igual a la fecha enviada mas 15 dias,
						// cierro caso si la cotizacion esta pagada
						if(date('Y-m-d H:i:s', time()) >= date('Y-m-d H:i:s', $fecha_mas_15dias)) {
							$this->ci->load->model('estatusgeneralmodel');
							$update = array('id_estatus_general' => $this->ci->estatusgeneralmodel->CERRADO);
							$this->ci->casomodel->update($update, array('id' => $encuesta->id_caso));
						}
					}
				} else {
					// Si no tiene cotizacion, entonces solo cierro caso
					if(date('Y-m-d H:i:s', time()) >= date('Y-m-d H:i:s', $fecha_mas_15dias)) {
						$this->ci->load->model('estatusgeneralmodel');
						$update = array('id_estatus_general' => $this->ci->estatusgeneralmodel->CERRADO);
						$this->ci->casomodel->update($update, array('id' => $encuesta->id_caso));
					}
				}
			}
		} else {
			$fecha_mas_15dias = strtotime($encuestas->fecha_enviado)+(60*60*24*15);
			$caso 	= $this->ci->casomodel->get_where(array('id' => $encuestas->id_caso));

			// Si tiene cotizacion
			if ($caso->folio_cotizacion != NULL) {
				$this->ci->load->model('estatuscotizacionmodel');
				$cotizacion = $this->ci->cotizacionmodel->get_where(array('folio' => $caso->folio_cotizacion));
				//Si la cotizacion esta pagada
				if ($cotizacion->id_estatus_cotizacion == $this->ci->estatuscotizacionmodel->PAGADO) {
					// Comparo, si la fecha actual es mayor igual a la fecha enviada mas 15 dias,
					// cierro caso si la cotizacion esta pagada
					if(date('Y-m-d H:i:s', time()) >= date('Y-m-d H:i:s', $fecha_mas_15dias)) {
						$this->ci->load->model('estatusgeneralmodel');
						$update = array('id_estatus_general' => $this->ci->estatusgeneralmodel->CERRADO);
						$this->ci->casomodel->update($update, array('id' => $encuestas->id_caso));
					}
				}
			} else {
				// Si no tiene cotizacion, entonces solo cierro caso
				if(date('Y-m-d H:i:s', time()) >= date('Y-m-d H:i:s', $fecha_mas_15dias)) {
					$this->ci->load->model('estatusgeneralmodel');
					$update = array('id_estatus_general' => $this->ci->estatusgeneralmodel->CERRADO);
					$this->ci->casomodel->update($update, array('id' => $encuestas->id_caso));
				}
			}
		}
	}
}