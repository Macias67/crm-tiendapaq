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
	}

	/**
	 * Vista Principal
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->load->model('cotizacionModel');
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
		$this->load->model('cotizacionModel');
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

}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */