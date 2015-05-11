<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tareaModel');
	}

	public function index()
	{
		$id_ejecutivo = $this->usuario_activo['id'];
		$this->_vista('listado-tareas');
	}

	/**
	 * Funcion para mostrar la vista que
	 * detalla la tarea que tiene
	 * un ejecutivo
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function detalles($id_tarea)
	{
		if ($tarea = $this->tareaModel->get_where(array('id_tarea' => $id_tarea))) {
			$this->load->model('cotizacionModel');
			$this->load->model('estatusGeneralModel');
			$this->load->model('ejecutivoModel');
			$this->load->model('casoModel');
			$this->load->model('notastareaModel');
			$this->load->helper('formatofechas');
			$this->load->helper('cotizacion');
			$this->load->helper('estatus');
			$this->load->helper('form');

			// Obtengo Caso
			$caso 	=  $this->casoModel->get_caso_detalles($tarea->id_caso);
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
				$this->data['estatus_caso'] 		= id_estatus_gral_to_class_html($caso->id_estatus_general);
				$this->data['estatus_cotizacion'] 	= id_estatus_to_class_html($cotizacion->id_estatus_cotizacion);
			}
			// Obtengo estatus grles y armo opciones del select
			$estatus 		= $this->estatusGeneralModel->get(array('id_estatus', 'descripcion'));
			$opciones_estatus = array();
			foreach ($estatus as $index => $valor) {
				$opciones_estatus[$valor->id_estatus] = ucfirst($valor->descripcion);
			}

			$notas = $this->notastareaModel->get('*', array('id_tarea' => $tarea->id_tarea), 'fecha_registro');

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

			$this->data['opciones_estatus'] = $opciones_estatus;
			$this->data['tarea'] 		= $tarea;
			$this->data['notas'] 		= $notas;
			$this->data['ejecutivos'] 	= $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
			$this->data['caso'] 			= $caso;
			$this->_vista('detalle-tarea');
		}
	}

	/**
	 * Funcion para crear una nueva
	 * tarea de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function nueva()
	{
		if($this->input->is_ajax_request()) {
			$this->load->model('estatusGeneralModel');
			$this->load->model('casoModel');

			$id_caso		= $this->input->post('id_caso');
			$ejecutivo		= $this->input->post('ejecutivo');
			$tarea			= $this->input->post('tarea');
			$descripcion	= $this->input->post('descripcion');

			$caso 	=  $this->casoModel->get_caso_detalles($id_caso);

			if ($caso->id_estatus_general != $this->estatusGeneralModel->CERRADO) {
				$tarea = array(
						'id_caso'		=> $id_caso,
						'id_ejecutivo'	=> $ejecutivo,
						'id_estatus'	=> $this->estatusGeneralModel->PENDIENTE,
						'fecha_inicio'	=> date('Y-m-d H:i:s'),
						'tarea'			=> ucfirst(strtolower($tarea)),
						'descripcion'	=> ucfirst(strtolower($descripcion))
						);

				$exito 	= $this->tareaModel->insert($tarea);
				$msg 	= (!$exito) ? 'No se inserto en la base de datos' : '';
				$response = array('exito' => $exito, 'msg' => $msg);

			} else {
				$response = array('exito' => FALSE, 'msg' => 'El caso esta cerrado, no pueden asignarse más tareas.');
			}
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));

		}
	}

	/**
	 * Funcion para editar una editar
	 * tarea de un caso
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function edita()
	{
		if($this->input->is_ajax_request()) {
			$this->load->model('estatusGeneralModel');
			$this->load->model('casoModel');

			$id_tarea		= $this->input->post('id_tarea');
			$id_caso		= $this->input->post('id_caso');
			$ejecutivo		= $this->input->post('ejecutivo');
			$tarea			= $this->input->post('tarea');
			$descripcion	= $this->input->post('descripcion');
			$estatus		= $this->input->post('estatus');
			$avance		= $this->input->post('avance');

			$update_tarea = array(
					'id_ejecutivo'	=> $ejecutivo,
					'id_estatus'	=> $estatus,
					'tarea'			=> ucfirst(strtolower($tarea)),
					'descripcion'	=> ucfirst(strtolower($descripcion)),
					'avance'		=> $avance
				);

			$exito = FALSE;
			if ($estatus == $this->estatusGeneralModel->CERRADO && $avance != 100) {
				$msg 	='No puedes cerrar la tarea hasta marcar el avance al 100%.';
			} else if($estatus != $this->estatusGeneralModel->CERRADO && $avance == 100) {
				$msg 	='No puedes marcar al 100% si la tarea no esta CERRADO.';
			} else {
				// Obtengo Caso
				$caso 	=  $this->casoModel->get_caso_detalles($id_caso);

				if ($caso->id_estatus_general == $this->estatusGeneralModel->CERRADO) {
					$msg 	='No puedes cambiar el estatus de una tarea si el caso esta cerrado.';
				} else {
					// Verifico tarea a modificar antes sus avances y estatus
					$tarea = $this->tareaModel->get_tarea($id_tarea);
					if ( ($tarea->avance == 100 && $avance < 100) || ($tarea->id_estatus == $this->estatusGeneralModel->CERRADO && $estatus != $this->estatusGeneralModel->CERRADO) ) {
						$msg 	='No puedes cambiar el estatus  o disminuir avance de una tarea que ya está cerrada.';
					} else {
						// Actualizo info de tarea
						$exito 	= $this->tareaModel->update($update_tarea, array('id_tarea' => $id_tarea));
						$msg 	= (!$exito) ? 'No se actualizo en la base de datos' : '';
					}
				}

				// Si la tarea va con estatus DIFERNTE a CERRADO
				if ($estatus != $this->estatusGeneralModel->CERRADO) {
					// Cambio status del caso
					 if ($caso->id_estatus_general == $this->estatusGeneralModel->PENDIENTE || $caso->id_estatus_general == $this->estatusGeneralModel->SUSPENDIDO) {
						$this->casoModel->update(array('id_estatus_general' => $this->estatusGeneralModel->PROCESO), array('id' => $id_caso));
					}

					// Revision de tareas suspendidos
					if($estatus == $this->estatusGeneralModel->SUSPENDIDO) {
						// Verifico si todas las tareas ya estan cerradas
						$tareas 		= $this->tareaModel->get_tareas_caso($id_caso);
						$suspendidos 	= TRUE;
						foreach ($tareas as $index => $tarea) {
							if ($tarea->id_estatus != $this->estatusGeneralModel->SUSPENDIDO) {
								$suspendidos = FALSE;
								break;
							}
						}
						// SI TODOS ESTAN SUSPENDIDOS, supendo caso
						if ($suspendidos) {
							$this->casoModel->update(
									array('id_estatus_general' 	=> $this->estatusGeneralModel->SUSPENDIDO),
									array('id' => $id_caso));
						}
					}
				// Si la tarea va para cerrado
				} else if($estatus == $this->estatusGeneralModel->CERRADO) {
					// Verifico si todas las tareas ya estan cerradas
					$tareas = $this->tareaModel->get_tareas_caso($id_caso);
					$cerrados = TRUE;
					foreach ($tareas as $index => $tarea) {
						if ($tarea->id_estatus != $this->estatusGeneralModel->CERRADO) {
							$cerrados = FALSE;
							break;
						}
					}
					// SI TODOS ESTAN CERRADOS, cierro caso
					if ($cerrados) {
						$this->casoModel->update(
												array(
												      'id_estatus_general' 	=> $this->estatusGeneralModel->CERRADO,
												      'fecha_final' 			=> date('Y-m-d H:i:s')
												      ),
												array('id' => $id_caso));
					}
				}
			}

			$response = array('exito' => $exito, 'msg' => $msg);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

	public function avances()
	{
		if($this->input->is_ajax_request()) {
			$this->load->model('estatusGeneralModel');
			$this->load->model('casoModel');

			$avance 	= $this->input->post('avance');
			$estatus 	= $this->input->post('estatus'	);
			$id_tarea 	= $this->input->post('id_tarea'	);
			$id_caso 	= $this->input->post('id_caso');

			$update_tarea = array(
						'id_estatus'	=> $estatus,
						'avance'		=> $avance
					);

			$exito = FALSE;
			if ($estatus == $this->estatusGeneralModel->CERRADO && $avance != 100) {
				$msg 	='No puedes cerrar la tarea hasta marcar el avance al 100%.';
			} else if($estatus != $this->estatusGeneralModel->CERRADO && $avance == 100) {
				$msg 	='No puedes marcar al 100% si la tarea no esta CERRADO.';
			} else {
				// Obtengo Caso
				$caso 	=  $this->casoModel->get_caso_detalles($id_caso);

				if ($caso->id_estatus_general == $this->estatusGeneralModel->CERRADO) {
					$msg 	='No puedes cambiar el estatus de una tarea si el caso esta cerrado.';
				} else {
					// Verifico tarea a modificar antes sus avances y estatus
					$tarea = $this->tareaModel->get_tarea($id_tarea);
					if ( ($tarea->avance == 100 && $avance < 100) || ($tarea->id_estatus == $this->estatusGeneralModel->CERRADO && $estatus != $this->estatusGeneralModel->CERRADO) ) {
						$msg 	='No puedes cambiar el estatus  o disminuir avance de una tarea que ya está cerrada.';
					} else {
						// Actualizo info de tarea
						$exito 	= $this->tareaModel->update($update_tarea, array('id_tarea' => $id_tarea));
						$msg 	= (!$exito) ? 'No se actualizo en la base de datos' : '';
					}
				}

				// Si la tarea va con estatus DIFERNTE a CERRADO
				if ($estatus != $this->estatusGeneralModel->CERRADO) {
					// Cambio status del caso
					if ($caso->id_estatus_general == $this->estatusGeneralModel->PENDIENTE) {
						$this->casoModel->update(
												array('id_estatus_general' => $this->estatusGeneralModel->PROCESO),
												array('id' => $id_caso));
					}
					// Revsion de tareas suspendido
					if($estatus == $this->estatusGeneralModel->SUSPENDIDO) {
						// Verifico si todas las tareas ya estan cerradas
						$tareas 		= $this->tareaModel->get_tareas_caso($id_caso);
						$suspendidos 	= TRUE;
						foreach ($tareas as $index => $tarea) {
							if ($tarea->id_estatus != $this->estatusGeneralModel->SUSPENDIDO) {
								$suspendidos = FALSE;
								break;
							}
						}
						// SI TODOS ESTAN SUSPENDIDOS, supendo caso
						if ($suspendidos) {
							$this->casoModel->update(
									array('id_estatus_general' 	=> $this->estatusGeneralModel->SUSPENDIDO),
									array('id' => $id_caso));
						}
					}
				// Si la tarea va para cerrado
				} else if($estatus == $this->estatusGeneralModel->CERRADO) {
					// Verifico si todas las tareas ya estan cerradas
					$tareas = $this->tareaModel->get_tareas_caso($id_caso);
					$cerrados = TRUE;
					foreach ($tareas as $index => $tarea) {
						if ($tarea->id_estatus != $this->estatusGeneralModel->CERRADO) {
							$cerrados = FALSE;
							break;
						}
					}

					// SI TODOS ESTAN CERRADOS, cierro caso
					if ($cerrados) {
						$this->casoModel->update(
												array(
												      'id_estatus_general' 	=> $this->estatusGeneralModel->CERRADO,
												      'fecha_final' 			=> date('Y-m-d H:i:s')
												      ),
												array('id' => $id_caso));
					}
				}
			}

			$response = array('exito' => $exito, 'msg' => $msg);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

	public function modal($accion)
	{
		$id_tarea = $this->uri->segment(4);
		switch ($accion) {
			case 'editar':
				if ($tarea = $this->tareaModel->get_tarea($id_tarea)) {
					$this->load->model('casoModel');
					$this->load->model('ejecutivoModel');
					$this->load->model('estatusGeneralModel');
					$this->load->helper('form');

					// Obtengo Caso
					$caso 	=  $this->casoModel->get_caso_detalles($tarea->id_caso);
					// Obtengo ejecutivos y armo opciones del select
					$ejecutivos 			= $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
					$opciones_ejecutivos 	= array();
					foreach ($ejecutivos as $index => $ejecutivo) {
						$opciones_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
					}
					// Obtengo estatus grles y armo opciones del select
					$estatus 		= $this->estatusGeneralModel->get(array('id_estatus', 'descripcion'));
					$opciones_estatus = array();
					foreach ($estatus as $index => $valor) {
						$opciones_estatus[$valor->id_estatus] = ucfirst($valor->descripcion);
					}
					$this->data['tarea'] 	= $tarea;
					$this->data['caso'] 		= $caso;
					$this->data['opciones_estatus'] = $opciones_estatus;
					$this->data['opciones_ejecutivo'] = $opciones_ejecutivos;
					$this->_vista_completa('tarea/edita-tarea');
				} else {
					echo '<h1>No existe esta tarea.</h1>';
				}
			break;
			case 'notas':
				$this->load->model('notastareaModel');
				$this->load->helper('formatofechas_helper');

				$notas = $this->notastareaModel->get('*', array('id_tarea' => $id_tarea));
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
				$this->data['notas'] = $notas;
				$this->_vista_completa('tarea/notas-modal');
			break;
		}
	}

	/**
	 * Funcion para obtener las tareas de manera de JSON
	 * con formato para el DataTable
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json_tareas($id_ejecutivo = null)
	{
		$id_ejecutivo	= (is_null($id_ejecutivo)) ? $this->usuario_activo['id'] : $id_ejecutivo;
		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		$total			=  $this->tareaModel->get('COUNT(*) as total', array('id_ejecutivo' =>$id_ejecutivo), null, 1);

		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
		                		'id_tarea',
		                		'id_caso',
	                			'caso.folio_cotizacion',
	                			'caso.id_cliente',
						'caso.id',
						'clientes.razon_social',
						'ejecutivos.primer_nombre',
						'ejecutivos.apellido_paterno',
						'lider.primer_nombre as nombre_lider',
						'lider.apellido_paterno as apellido_lider',
						'tareas.id_estatus',
						'tareas.fecha_inicio',
						'fecha_finaliza',
						'tarea',
						'avance');
		$joins 			= array('caso', 'clientes', 'estatus_general', 'ejecutivos');
		$like 			= $search['value'];
		$orderBy 		= $columns[$order[0]['column']]['data'];
		//$orderBy		= ('lider') ? '`caso`.`id_lider`' : $orderBy;
		$orderForm 	= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$tareas	= $this->tareaModel->get_tareas_ejecutivo_table(
		                                                           	   $id_ejecutivo,
		                                                                     $campos,
		                                                                     $joins,
		                                                                     $like,
		                                                                     $orderBy,
		                                                                     $orderForm,
		                                                                     $limit,
		                                                                     $offset);
		// var_dump($tareas);

		$proceso	= array();
		$this->load->helper('formatofechas');
		//$this->load->model('comentariosCotizacionModel');
		foreach ($tareas as $index => $tarea) {
			//$total_comentario 		= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $tarea->folio), null, 'ASC', 1);
			//$total_comentario_sinver 	= $this->comentariosCotizacionModel->get(array('COUNT(*) AS total_coment'), array('folio' => $tarea->folio, 'visto' => 0), null, 'ASC', 1);
			$p = array(
				'DT_RowId'			=> $tarea->id_tarea,
				'folio_cotizacion'	=> $tarea->folio_cotizacion,
				'id_caso'			=> $tarea->id_caso,
				'id_estatus'		=> $tarea->id_estatus,
				'razon_social'		=> $tarea->razon_social,
				'lider'				=> $tarea->nombre_lider.' '.$tarea->apellido_lider,
				'fecha_inicio'		=> fecha_completa($tarea->fecha_inicio),
				'fecha_finaliza'		=> ($tarea->fecha_finaliza=='1000-01-01 00:00:00')? '':fecha_completa($tarea->fecha_finaliza),
				'tarea'				=> $tarea->tarea,
				'avance'			=> $tarea->avance,
				'url'					=> site_url('/tarea/detalles/'.$tarea->id_tarea),
				'url_modal'			=> site_url('/tarea/modal/'.$tarea->id_caso)
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($tareas),
			'recordsFiltered'	=> $total[0]->total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

}

/* End of file tarea.php */
/* Location: ./application/controllers/tarea.php */