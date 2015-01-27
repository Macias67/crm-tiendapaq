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
								'cotizacion.fecha',
								'cotizacion.vigencia',
								'cotizacion.id_estatus_cotizacion'
							);
		$where = array('cotizacion.id_estatus_cotizacion' => $this->estatusCotizacionModel->PORPAGAR);
		//obtengo las cotizaciones por pagar para revisar si estan vencidas
		$cotizaciones = $this->cotizacionModel->get_cotizaciones($campos, $where);
		//ciclo para revisar que no esten vencidas
		$fecha_actual = date('Y-m-d H:i:s');
		foreach ($cotizaciones as $cotizacion) {
			if($fecha_actual > $cotizacion->vigencia){
				$this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->VENCIDO), array('folio' => $cotizacion->folio));
			}
		}

		//despues de la revision de muestra la vista
		$this->_vista('cotizaciones-catalogo');
	}

	/**
	 * Metodo consultado para el plugin
	 * dataTable del archivo table-managed.cotizacion
	 * que es la tabla vía ajax
	 *
	 * @return json
	 * @author Luis Macias
	 **/
	public function table()
	{
		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		$total			=  $this->cotizacionModel->count();
		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
				'cotizacion.folio',
				'cotizacion.fecha',
				'cotizacion.vigencia',
				'cotizacion.total_comentarios',
				'cotizacion.visto',
		              'clientes.razon_social',
		              'ejecutivos.primer_nombre',
		              'ejecutivos.segundo_nombre',
		              'ejecutivos.apellido_paterno',
		              'ejecutivos.apellido_materno',
		              'estatus_cotizacion.descripcion');
		$joins = array('clientes', 'ejecutivos', 'estatus_cotizacion');
		$like = array(
			'folio'								=> $search['value'],
			'clientes.razon_social'				=> $search['value'],
			'ejecutivos.primer_nombre'		=> $search['value'],
		       'ejecutivos.segundo_nombre' 		=> $search['value'],
			'ejecutivos.apellido_paterno' 		=> $search['value'],
			'ejecutivos.apellido_materno' 		=> $search['value'],
			'fecha'								=> $search['value'],
			'vigencia'							=> $search['value'],
			'estatus_cotizacion.descripcion' 	=> $search['value']
		);
		$orderBy 		= $columns[$order[0]['column']]['data'];
		$orderForm 	= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$cotizaciones	= $this->cotizacionModel->get_cotizacion_cliente_table(
		                                                                     $campos,
		                                                                     $joins,
		                                                                     $like,
		                                                                     $orderBy,
		                                                                     $orderForm,
		                                                                     $limit,
		                                                                     $offset);
		$proceso	= array();

		$this->load->helper('formatofechas');
		//$this->load->model('comentariosCotizacionModel');
		foreach ($cotizaciones as $index => $cotizacion) {
			//$total_comentario 		= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $cotizacion->folio), null, 'ASC', 1);
			//$total_comentario_sinver 	= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $cotizacion->folio, 'visto' => 0), null, 'ASC', 1);
			$p = array(
				'DT_RowId'					=> $cotizacion->folio,
				'folio'						=> $cotizacion->folio,
				'id_cliente'					=> $cotizacion->razon_social,
				'id_ejecutivo'				=> $cotizacion->primer_nombre.' '.$cotizacion->apellido_paterno,
				'fecha'						=> fecha_completa($cotizacion->fecha),
				'vigencia'					=> fecha_completa($cotizacion->vigencia),
				'id_estatus_cotizacion'		=> ucwords($cotizacion->descripcion),
				'total_comentarios'		=> $cotizacion->total_comentarios,
				'visto'							=> ($cotizacion->visto) ? TRUE : FALSE
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($cotizaciones),
			'recordsFiltered'	=> $total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
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

	/**
	 * Funcion para previsualizar un pdf con una cotizacion
	 * para los clientes
	 *
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function previa()
	{
		$folio =$this->input->post('folio');

		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente(array('id_cliente'), array(''), $folio))
		{
			$dir_root	= site_url('/clientes/'.$cotizacion->id_cliente.'/cotizacion').'/';
			$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
			$path		= $dir_root.$name;
			$response 	= array('existe' => TRUE, 'ruta' => $path);
		} else {
			$response 	= array('existe' => FALSE);
		}
		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	/**
	 * Funcion para mostrar la vista de revisión
	 * de una cotización
	 *
	 * @param  [int] $folio [Folio de la ctizacion]
	 */
	public function revision($folio)
	{
		$campos = array(
		               'cotizacion.folio',
		               'cotizacion.id_cliente',
		               'cotizacion.id_estatus_cotizacion',
		               'clientes.razon_social');
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($campos, array('clientes'), $folio)) {

			// Marco como VISTO el campo de la tabla en cotizaciones y
			// los comentarios respectivos
			$this->load->model('comentariosCotizacionModel');
			$this->comentariosCotizacionModel->marcar_comentarios_visto($folio);
			$this->cotizacionModel->update(array('visto' => 1), array('folio' => $folio));

			$this->load->model('estatusCotizacionModel');
			$this->load->helper('directory');
			$archivos = directory_map('./clientes/'.$cotizacion->id_cliente.'/comprobantes/'.$folio.'/', 1);

			// Descarto la carpeta de las thumnail
			foreach ($archivos as $index => $archivo) {
				if ($archivos[$index] == 'thumbnail') {
					unset($archivos[$index]);
				}
			}
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
		$this->load->model('estatusGeneralModel');

		$response = array('exito' => FALSE, 'msg' => 'Error, revisa la consola para mas información.');

		if ($valoracion == "aceptado") {

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
		}

		if ($valoracion == "irregular") {
			if ($this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->IRREGULAR),
				array('folio' => $folio)))
			{
				$response = array('exito' => TRUE, 'msg' => '<h3>Se le ha notificado al cliente de su irregularidad en el pago.</h3>');
			}
		}

		if ($valoracion == "parcial"){
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

	public function reenvio()
	{
		$folio = $this->input->post('folio');

		$cotizacion = $this->load->model('cotizacionModel')->get_cotizacion_cliente(
		                                                                          array('id_cliente', 'clientes.razon_social','clientes.usuario', 'clientes.password'),
		                                                                          array('clientes'),
		                                                                          $folio);

		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cotizacion->id_cliente.'/cotizacion/';
		$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
		$path 		= $dir_root.$name;

		if (!LOCAL) {
			//Envio Email con el PDF
			$this->load->library('email');
			$this->email->set_mailtype('html');
			$this->email->from('cotizacion@sycpaq.com', $cliente['contacto'].' - TiendaPAQ');
			$this->email->to($cliente['email']);
			//$this->email->cc('another@example.com');
			//$this->email->bcc('and@another.com');
			$this->email->subject('Envío de Cotización TiendaPAQ');
			// Contenido del correo
			 $this->data['usuario'] 		= $data_cliente[0]->usuario;
			 $this->data['password'] 	= $data_cliente[0]->password;
			$html = $this->load->view('admin/general/full-pages/email/email_envio_cotizacion.php', $this->data,TRUE);
			$this->email->message($html);
			// Adjunto PDF
			$this->email->attach($path);
			$this->email->send();
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('exito' => TRUE, 'path' => $path)));
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