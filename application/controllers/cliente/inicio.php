<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends AbstractAccess {

	public function index()
	{
		// Cargo modelos
		$this->load->model('cotizacionmodel');
		$this->load->model('estatuscotizacionmodel');
		// Cargo helper
		$this->load->helper('formatofechas');

		//codigo para cambiar cotizaciones a vencidas
		$campos = array(
					'cotizacion.folio',
					'cotizacion.fecha',
					'cotizacion.vigencia',
					'cotizacion.total_comentarios',
					'cotizacion.visto',
					'cotizacion.tipo',
					'oficinas.ciudad_estado',
					'estatus_cotizacion.id_estatus',
					'estatus_cotizacion.descripcion'
				);
		$where = array(
					'id_cliente' => $this->usuario_activo['id'],
					'cotizacion.id_estatus_cotizacion' => $this->estatuscotizacionmodel->PORPAGAR);

		//seccion de codigo para revisar cotizaciones vencidas
		$cotizaciones = $this->cotizacionmodel->get_cotizaciones_cliente($this->usuario_activo['id'], $campos, $where);
		$fecha_actual = date('Y-m-d H:i:s');
		// Recorro cotizacion por cotizacion
		foreach ($cotizaciones as $cotizacion) {
			if($fecha_actual > $cotizacion->vigencia){
				$this->cotizacionmodel->update(array('id_estatus_cotizacion' => $this->estatuscotizacionmodel->VENCIDO), array('folio' => $cotizacion->folio));
			}
		}
		//recargo los datos y mando llamar la vista
		$this->data['cotizaciones'] = $this->cotizacionmodel->get_cotizaciones_cliente($this->usuario_activo['id'], $campos);
		$this->_vista('principal');
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/cliente/inicio.php */