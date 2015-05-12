<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase para gestionar la informacion respecto a los casos
 *
 * @package default
 * @author Diego Rodriguez
 **/
class Caso extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('casoModel');
	}

	/**
	 * Vista para la asignacion de casos
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->load->model('ejecutivoModel');
		$this->load->helper('formatofechas_helper');

		// Extraigo el campo `asignador_casos` del usuario activo
		$asignador_casos = $this->ejecutivoModel->get(array('asignador_casos'), array('id' => $this->data['usuario_activo']['id']));
		// SI es asignador entonces
		if($asignador_casos[0]->asignador_casos == "si"){
			$campos = array(
						'caso.id as id_caso',
						'clientes.razon_social',
						'estatus_general.descripcion',
						'id_cliente',
						'folio_cotizacion',
						'fecha_inicio',
						'fecha_final'
				              );
			// Mando los casos que esten por asignar
			$this->data['casos_asignacion'] = $this->casoModel->get_casos_asignacion($campos);
			$this->_vista('casos_asignar');
		}else{
			show_404();
		}
	}

	public function casos_ejecutivos()
	{
		$this->data['id_ejecutivo'] = $this->usuario_activo['id'];
		$this->_vista('listado-casos');
	}

	/**
	 * Funcion para obtener los casos de manera de JSON
	 * con formato para el DataTable
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json_casos($id_ejecutivo = null)
	{

		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		if ($id_ejecutivo) {
			$total			=  $this->casoModel->get('COUNT(*) as total', array('id_lider' =>$id_ejecutivo), null, 1);
		} else {
			$total			=  $this->casoModel->get('COUNT(*) as total', null, null, 1);
		}

		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
	                			'caso.id as id_caso',
						'caso.id_estatus_general',
						'clientes.razon_social',
						'estatus_general.descripcion',
						'ejecutivos.primer_nombre',
						'ejecutivos.apellido_paterno',
						'id_cliente',
						'folio_cotizacion',
						'fecha_inicio',
						'fecha_final');
		$joins 			= array('clientes', 'estatus_general', 'ejecutivos');
		$like 			= $search['value'];
		$orderBy 		= $columns[$order[0]['column']]['data'];
		$orderForm 	= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$casos	= $this->casoModel->get_caso_ejecutivo_table(
		                                                           	   $id_ejecutivo,
		                                                                     $campos,
		                                                                     $joins,
		                                                                     $like,
		                                                                     $orderBy,
		                                                                     $orderForm,
		                                                                     $limit,
		                                                                     $offset);
		//var_dump($casos);

		$proceso	= array();
		$this->load->helper('formatofechas');
		//$this->load->model('comentariosCotizacionModel');
		foreach ($casos as $index => $caso) {
			//$total_comentario 		= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $caso->folio), null, 'ASC', 1);
			//$total_comentario_sinver 	= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $caso->folio, 'visto' => 0), null, 'ASC', 1);
			$p = array(
				'DT_RowId'					=> $caso->id_caso,
				'folio_cotizacion'			=> $caso->folio_cotizacion,
				'razon_social'				=> $caso->razon_social,
				'id_lider'					=> $caso->primer_nombre.' '.$caso->apellido_paterno,
				'fecha_inicio'				=> fecha_completa($caso->fecha_inicio),
				'fecha_final'				=> ($caso->fecha_final=='1000-01-01 00:00:00')? 'Sin fecha de fin':fecha_completa($caso->fecha_final),
				'id_estatus_general'		=> $caso->id_estatus_general,
				'url'					=> site_url('/caso/detalles/'.$caso->id_caso),
				'url_modal'					=> site_url('/caso/modal/'.$caso->id_caso)
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($casos),
			'recordsFiltered'	=> $total[0]->total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	/**
	 * Funcion que muestra a detalle
	 * un caso asginado
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function detalles($id_caso)
	{
		$this->load->model('cotizacionModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('notastareaModel');
		$this->load->model('estatusgeneralmodel');
		$this->load->model('tareaModel');
		$this->load->helper('formatofechas_helper');
		$this->load->helper('cotizacion');
		$this->load->helper('estatus');

		$caso 			=  $this->casoModel->get_caso_detalles($id_caso);
		// Si el caso tiene cotizacion
		if (!is_null($caso->folio_cotizacion)) {
			$cotizacion 	= $this->cotizacionModel->get_cotizacion_cliente(array('*'), array('ejecutivos'), $caso->folio_cotizacion);
			// Detalles de la cotizacion/caso
			$detalles_cotizacion = json_decode($cotizacion->cotizacion);
			$detalle_caso = array();
			foreach ($detalles_cotizacion as $key => $listado) {
				array_push(
					$detalle_caso,
					array(
						'descripcion' => $listado->descripcion,
						'observacion' => ucfirst(mb_strtolower($listado->observacion, 'UTF-8'))
					)
				);
			}
			// URL para mostrar cotizacion
			$this->data['url_cotizacion'] 		= $this->cotizacionModel->get_url_cotizacion($cotizacion->id_cliente, $cotizacion->folio);
			$this->data['detalle_caso'] 		= $detalle_caso;
			$this->data['cotizacion'] 			= $cotizacion;
			$this->data['estatus_cotizacion'] 	= id_estatus_to_class_html($cotizacion->id_estatus_cotizacion);
		}

		// Muestra boton tareas
		if ($caso->id_lider != $this->usuario_activo['id'] ||
		    	($caso->id_estatus_general == $this->estatusgeneralmodel->CERRADO ||
		    	$caso->id_estatus_general == $this->estatusgeneralmodel->PORASIGNAR ||
		     	$caso->id_estatus_general == $this->estatusgeneralmodel->PRECIERRE ||
		     	$caso->id_estatus_general == $this->estatusgeneralmodel->CANCELADO)
		) {
			$this->data['boton_tareas'] 		= FALSE;
		} else {
			$this->data['boton_tareas'] 		= TRUE;
		}

		// Muestra boton reasignar
		if ($caso->id_lider != $this->usuario_activo['id'] ||
		    	($caso->id_estatus_general == $this->estatusgeneralmodel->CERRADO ||
		    	$caso->id_estatus_general == $this->estatusgeneralmodel->PORASIGNAR ||
		     	$caso->id_estatus_general == $this->estatusgeneralmodel->PRECIERRE ||
		     	$caso->id_estatus_general == $this->estatusgeneralmodel->CANCELADO ||
		     	$caso->id_estatus_general == $this->estatusgeneralmodel->PROCESO ||
		     	$caso->id_estatus_general == $this->estatusgeneralmodel->SUSPENDIDO)
		    ) {
			$this->data['boton_reasignar'] 		= FALSE;
		} else {
			$this->data['boton_reasignar'] 		= TRUE;
		}

		// Total comentarios por tarea
		$tareas = $this->tareaModel->get_tareas_caso($id_caso);
		foreach ($tareas as $index => $tarea) {
			$tareas[$index]->total_notas = $this->notastareaModel->total_notas($tarea->id_tarea);
		}

		// Notas de las tareas
		$notas = $this->notastareaModel->get_notas_tarea();
		if (count($notas) > 0) {
					foreach ($notas as $index => $nota) {
						$dir = 'assets/admin/pages/media/tareas/'.$nota->id_tarea.'/'.$nota->id_nota;
						if (is_dir($dir)) {
							$this->load->helper('directory');
							$map = directory_map($dir, 1);
							$notas[$index]->imagen = site_url($dir).'/'.$map[0];
						}
					}
				}
		// var_dump($notas);

		$this->data['estatus_caso'] 		= id_estatus_gral_to_class_html($caso->id_estatus_general);
		$this->data['tareas'] 				= $tareas;
		$this->data['ejecutivos'] 			= $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
		$this->data['caso'] 					= $caso;
		$this->data['notas'] 					= $notas;
		$this->_vista('detalle-caso');
	}

	/**
	 * Funcion para mostrar los detalles de un caso
	 *
	 * @author Diego Rodriguez
	 **/
	public function modal($id_caso)
	{
		$this->load->helper('formatofechas_helper');
		//verificamos si el caso aun no tiene lider para saber como hacer la consulta en el model
		$lider = $this->casoModel->get(array('id_lider'), array('id' => $id_caso), null, 'ASC', 1);
		if(empty($lider->id_lider)){
			$this->data['caso'] = $this->casoModel->get_caso_detalles($id_caso);
			$this->data['caso']->primer_nombre = 'SIN';
			$this->data['caso']->apellido_paterno = ' LIDER';
		}else{
			$this->data['caso'] = $this->casoModel->get_caso_detalles($id_caso);
		}
		$this->_vista_completa('caso/modal-detalles-caso');
	}

	/**
	 * Funcion para asignarle un caso a un ejecutivo
	 *
	 * @return json
	 * @author Diego Rodriguez
	 **/
	public function asignar($accion=null, $id_caso=null)
	{
		switch ($accion) {
			// Respuesta JSON cambia la base de datos para asignar caso a un ejecutivo
			case 'asignar':
				$this->load->model('estatusGeneralModel');
				$id_caso 		= $this->input->post('id_caso');
				$id_ejecutivo 	= $this->input->post('id_ejecutivo');

				if($this->casoModel->update(array('id_lider' => $id_ejecutivo, 'id_estatus_general' => $this->estatusGeneralModel->PENDIENTE), array('id' => $id_caso))) {
					//SECCION ENVIAR CORREO A CONTACTO DE COTIZACION NOTIFICANDO QUE SU CASO HA SIDO ABIERTO Y ASIGNADO
					$exito = TRUE;
					if (!LOCAL) {
						$this->load->model('cotizacionModel');
						$this->load->model('contactosModel');
						$this->load->model('clienteModel');
						$this->load->helper('formatofechas');
						$this->load->library('email');

						$caso 				= $this->casoModel->get_where(array('id' => $id_caso));
						$folio_cotizacion 	= $this->casoModel->get(array('folio_cotizacion'), array('id' => $id_caso), null, 'ASC', 1);
						$id_contacto 		= $this->cotizacionModel->get(array('id_contacto'), array('folio' => $folio_cotizacion->folio_cotizacion), null, 'ASC', 1);
						$contacto 			= $this->contactosModel->get('*', array('id' => $id_contacto->id_contacto), null, 'ASC', 1);
						$cliente 			= $this->clienteModel->get(array('usuario','password'),array('id' => $contacto->id_cliente), null, 'ASC', 1);

						$nombre_contacto = $contacto->nombre_contacto.' '.$contacto->apellido_paterno.' '.$contacto->apellido_materno;
						//Envio Email
						$this->email->set_mailtype('html');
						$this->email->from('notificacion@moz67.com', 'Apertura de Caso - TiendaPAQ');
						$this->email->to($contacto->email_contacto);
						//$this->email->cc('another@example.com');
						//$this->email->bcc('and@another.com');
						$this->email->subject('Apertura de Caso - TiendaPAQ');
						//Contenido del correo
						$this->data['usuario'] 		= $cliente->usuario;
						$this->data['password'] 	= $cliente->password;
						$this->data['id_caso'] 		= $caso->id;
						$this->data['fecha'] 		= fecha_completa($caso->fecha_inicio);
						$this->data['folio'] 			= $folio_cotizacion->folio_cotizacion;
						$this->data['contacto'] 	= $nombre_contacto;
						//var_dump($this->data);
						$html = $this->load->view('admin/general/full-pages/email/email_inicio_caso.php', $this->data, TRUE);
						$this->email->message($html);
						// Adjunto PDF
						//$this->email->attach($path);
						$exito = $this->email->send();
					}
					if ($exito) {
						$respuesta = array('exito' => TRUE);
					} else {
						$respuesta = array('exito' => FALSE, 'msg' => '<h4>Nuevo caso asignado, error al enviar el email al cliente</h4>');
					}
				}else{
					$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error, revisa la consola para mas información</h4>');
				}
				$this->output
						->set_content_type('application/json')
						->set_output(json_encode($respuesta));
			break;
			// Muestra la vista para asignar el caso a un ejecutivo
			case 'mostrar':
				$this->load->model('ejecutivoModel');
				$this->data['ejecutivos'] 	= $this->ejecutivoModel->get(array('id','primer_nombre','apellido_paterno'), null, 'primer_nombre');
				$this->data['id_caso'] 		= $id_caso;

				$this->_vista_completa('caso/modal-asignar-ejecutivo');
			break;
		}
	}

	public function reasignar()
	{
		if ($this->input->is_ajax_request()) {
			$this->load->model('reasignarcasomodel');

			$id_caso 	= $this->input->post('id_caso');
			$destino 	= $this->input->post('reasignar');
			$motivo 	= $this->input->post('motivo');

			if ($this->casomodel->exist(array('id' => $id_caso))) {
				$this->load->model('reasignarcasomodel');
				var_dump('hola');
			}
		}
	}

	/**
	 * funcion para abrir un caso de manera directa
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function abrir()
	{
		$this->load->model('estatusGeneralModel');

		// Campos a guardar en la Base de datos
		$caso = array(
				'id_lider'				=> $this->input->post('lider_caso'),
				'id_estatus_general'	=> $this->estatusGeneralModel->PENDIENTE,
				'id_cliente'				=> $this->input->post('razon_social_caso'),
				'fecha_inicio'			=> date('Y-m-d H:i:s'),
				'descripcion'			=> $this->input->post('descripcion_caso')
		 	);

		// Guardo y extraigo el ultimo ID
		if($id_caso = $this->casoModel->get_last_id_after_insert($caso)) {
			if (!LOCAL) {
				$this->load->model('cotizacionModel');
				$this->load->model('contactosModel');
				$this->load->model('clienteModel');
				$this->load->helper('formatofechas');
				$this->load->library('email');

				$cliente 	= $this->clienteModel->get(array('razon_social','email','usuario','password'), array('id' => $caso['id_cliente']), null, 'ASC', 1);
				$caso 		= $this->casoModel->get_where(array('id' => $id_caso));

				//Envio Email
				$this->email->set_mailtype('html');
				$this->email->from('notificacion@moz67.com', 'Apertura de Caso - TiendaPAQ');
				$this->email->to($cliente->email);
				//$this->email->cc('another@example.com');
				//$this->email->bcc('and@another.com');
				$this->email->subject('Apertura de Caso - TiendaPAQ');
				//Contenido del correo
				$this->data['usuario'] 		= $cliente->usuario;
				$this->data['password'] 	= $cliente->password;
				$this->data['id_caso'] 		= $caso->id;
				$this->data['fecha'] 		= fecha_completa($caso->fecha_inicio);
				$this->data['folio'] 			= 'Caso Directo';
				$this->data['contacto'] 	= $cliente->razon_social;
				$html = $this->load->view('admin/general/full-pages/email/email_inicio_caso.php', $this->data, TRUE);
				$this->email->message($html);
				// Adjunto PDF
				//$this->email->attach($path);
				$this->email->send();
			}
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>Caso abierto con éxito.</h4>');
		} else {
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! revisa la consola para mas detalles.</h4>');
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion pra cerrar un caso
	 *
	 * @author Diego Rodriguez
	 **/
	public function cerrar()
	{
		if ($this->input->is_ajax_request()) {
			$id_caso = $this->input->post('id_caso');
			var_dump($id_caso);
			// $this->load->model('estatusGeneralModel');

			// $update = array(
			// 		'id_estatus_general' 	=> $this->estatusGeneralModel->CERRADO,
			// 		'fecha_final' 			=> date('Y-m-d H:i:s')
			// 	);

			// if($this->casoModel->update($update, array('id' => $id_caso))){
			// 	$respuesta = array('exito' => TRUE, 'msg' => '<h4>Caso cerrado con éxito.</h4>');
			// }else{
			// 	$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! revisa la consola para mas detalles.</h4>');
			// }

			// $this->output
			// 	->set_content_type('application/json')
			// 	->set_output(json_encode($respuesta));
		}
	}
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */