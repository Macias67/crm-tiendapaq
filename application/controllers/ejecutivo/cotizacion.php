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
		$this->load->helper('formatofechas_helper');
	}

	/**
	 * Vista Principal
	 *
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
	}

	/**
	 * muestra la vista para cotizaciones con pendiente de revisar pago
	 *
	 * @author Diego Rodriguez
	 **/

	public function revisar()
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
		$this->_vista('cotizaciones-revision');
	}

	/**
	 * muestra la vista del catalogo de cotizaciones
	 *
	 * @author Diego Rodriguez
	 **/
	public function catalogo()
	{
		$this->load->model('estatusCotizacionModel');
		//codigo para revisar cotizaciones vencidas
		$campos = array(
								'cotizacion.folio',
								'clientes.razon_social',
								'ejecutivos.primer_nombre',
								'ejecutivos.apellido_paterno',
								'cotizacion.fecha',
								'cotizacion.vigencia',
								'cotizacion.id_estatus_cotizacion',
								'estatus_cotizacion.descripcion'
							);
		$this->data['cotizaciones'] = $this->cotizacionModel->get_cotizaciones($campos);
		$fecha_actual = date('Y-m-d H:i:s');
		foreach ($this->data['cotizaciones'] as $cotizacion) {
			if($fecha_actual > $cotizacion->vigencia){
				$this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->VENCIDO), array('folio' => $cotizacion->folio));
			}
		}

		//despues de la revision de muestra la vista
		$this->data['cotizaciones'] = $this->cotizacionModel->get_cotizaciones($campos);
		$this->_vista('cotizaciones-catalogo');
	}
	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function previapdf()
	{
		$folio =$this->input->post('folio');
		$idcliente  =$this->input->post('idcliente');

		if ($existe = $this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('/clientes/'.$idcliente.'/cotizacion').'/';
			$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
			$path		= $dir_root.$name;
			$response 	= array('existe' => $existe, 'ruta' => $path);
		} else {
			$response 	= array('existe' => $existe);
		}
		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
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
			$this->load->model('comentariosCotizacionModel');
			$this->load->helper('formatofechas_helper');


			$this->data['cotizacion'] = $cotizacion;
			$this->data['archivos'] = $archivos;
			$this->data['comentarios'] = $this->comentariosCotizacionModel->get_comentarios($folio);
			$this->_vista('archivos');
		} else {
			show_404();
		}
	}

	public function apertura()
	{
		$folio = $this->input->post('folio');
		$valoracion = $this->input->post('valoracion');

		$this->load->model('estatusCotizacionModel');
		$response = array('exito' => FALSE, 'msg' => 'Error, revisa la consola para mas información.');

		if ($valoracion == 'aceptado') {
			$this->load->model('estatusGeneralModel');

			// Cambie estatus de la cotizacion a PAGADO
			if ($this->cotizacionModel->update(
				array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PAGADO),
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
					$response = array('exito' => TRUE, 'msg' => '<h3>Cotización pagada, nuevo caso abierto en espera de asignación.</h3>');
				}
			}
		} elseif ($valoracion == 'irregular') {
				if ($this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->IRREGULAR),
					array('folio' => $folio)))
				{
					$response = array('exito' => TRUE, 'msg' => '<h3>Se le ha notificado al cliente de su irregularidad en el pago.</h3>');
				}
			} elseif ($valoracion == 'parcial'){
					$this->load->model('estatusGeneralModel');

					// Cambie estatus de la cotizacion a PARCIAL
					if ($this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->PARCIAL),
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
							$response = array('exito' => TRUE, 'msg' => '<h3>Cotización con pago parcial, nuevo caso abierto en espera de asignación.</h3>');
						}
				}
		}

		/**
		 * BLOQUE DE ENVIIO DE CORREO
		 */

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

 	/**
	 * Funcion para guardar los comentarios de la cotizacion
	 * @author Diego Rodriguez
	 **/
	public function comentarios()
	{
		$comentario = array(
			'folio'      	 => $this->input->post('folio'),
			'fecha'      	 => date('Y-m-d H:i:s'),
			'tipo' 	     	 => 'E',
			'id_ejecutivo' => $this->input->post('id_ejecutivo'),
			'comentario'   => $this->input->post('comentario'),
		);

		$this->load->model('comentariosCotizacionModel');

		if($this->comentariosCotizacionModel->insert($comentario)){
			$respuesta = array('exito' => TRUE);
		}else{
			$respuesta = array('exito' => FALSE);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */