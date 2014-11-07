<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para ver el listado de cotizaciones
 *
 * @author Diego Rodriguez
 **/
class Cotizacion extends AbstractAccess {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('cotizacionModel');
	}

	/**
	 * Vista Principal
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
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
		$this->_vista('cotizaciones');
	}

	public function revision($folio)
	{
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($folio)) {
			//var_dump($cotizacion);
			$this->load->model('estatusCotizacionModel');
			$this->load->helper('directory');
			$archivos = directory_map('./clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$folio.'/', 1);

			// Descarto la carpeta de las thumnail
			foreach ($archivos as $index => $archivo) {
				if ($archivos[$index] == 'thumbnail') {
					unset($archivos[$index]);
				}
			}

			$this->data['cotizacion'] = $cotizacion;
			$this->data['archivos'] = $archivos;
			$this->_vista('archivos');
		} else {
			show_404();
		}
	}

	public function apertura()
	{
		$folio = $this->input->post('folio');
		$valoracion = $this->input->post('valoracion');
		$comentarios = $this->input->post('comentarios');

		$this->load->model('estatusCotizacionModel');
		$response = FALSE;

		if ($valoracion == 'aceptado') {
			$this->load->model('estatusGeneralModel');

			// Cambie estatus de la cotizacion a PAGADO
			if ($this->cotizacionModel->update(
				array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO,
					'observacion_pago' => $comentarios),
				array('folio' => $folio)))
			{
				$this->load->model('casoModel');

				$cotizacion = $this->cotizacionModel->get(array('id_cliente'), array('folio' => $folio), null, 'ASC', 1);

				$caso = array(
					'id_estatus_general' => $this->estatusGeneralModel->PORASIGNAR,
					'id_cliente' => $cotizacion->id_cliente,
					'folio_cotizacion' => $folio,
					'fecha_inicio' => date('Y-m-d H:i:s'));
				// Abro un nuevo CASO
				if ($this->casoModel->insert($caso))
				{
					$response = TRUE;
				}
			}
		} elseif ($valoracion == 'irregular') {
			if ($this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->IRREGULAR,
					'observacion_pago' => $comentarios),
				array('folio' => $folio)))
			{
				$response = TRUE;
			}
		}

		/**
		 * BLOQUE DE ENVIIO DE CORREO
		 */

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('exito' => $response)));
	}

}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */