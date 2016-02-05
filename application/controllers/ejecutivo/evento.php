<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('eventoModel');
		$this->load->model('sesionesModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('oficinasModel');
		$this->load->model('oficinasmodel');
	}

	/**
	 * Funcion para mostrar la vista que
	 * organiza los eventos por haber
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function index() {
		$this->_vista('administrar');
	}

	/**
	 * Funcion que muestra la vista
	 * del formulario nuevo
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function nuevo($exito = null)
	{
		$this->load->model('ejecutivoModel');
		$this->load->model('oficinasModel');
		$this->load->helper('form');
		// Creo options de ejecutivos
		$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
		// $options_ejecutivos = array('' => '');
		foreach ($ejecutivos as $index => $ejecutivo) {
			$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
		}
		// Creo options de oficinas
		$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
		// $options_oficinas = array('' => '');
		foreach ($oficinas as $index => $oficina) {
			$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
		}

		$this->data['options_ejecutivos'] 	= $options_ejecutivos;
		$this->data['options_oficinas'] 	= $options_oficinas;
		$this->data['exito'] 				= (!is_null($exito) && $exito == 'exito') ? TRUE : FALSE;
		$this->_vista('nuevo-evento');
	}

	/**
	 * Funcion para agregar a la BD y manipular
	 * el archivo que se subio
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function create()
	{
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		//Datos basicos
		$this->form_validation->set_rules('ejecutivo', 'Ejecutivo', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|strtolower|ucfirst|max_length[100]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|xss_clean');
		$this->form_validation->set_rules('costo', 'Costo', 'trim|required|decimal|xss_clean');
		$this->form_validation->set_rules('cupo', 'Max. Cupo', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('lugar', 'Lugar', 'trim|required|xss_clean');

		$lugar 	= $this->input->post('lugar');

		if ($lugar == 'online')
		{
			$this->form_validation->set_rules('link', 'Link', 'trim|required|strtolower|valid_url|prep_url|xss_clean');
		} else if($lugar == 'sucursal')
		{
			$this->form_validation->set_rules('sucursal', 'Oficinas', 'trim|required|integer|xss_clean');
		} else if($lugar == 'otro')
		{
			$this->form_validation->set_rules('otro', 'Dirección', 'trim|required|strtolower|ucfirst|xss_clean');
		}

		$this->form_validation->set_rules('userfile', 'Temario', 'file_required|file_size_min[10KB]|file_size_max[2048KB]|file_allowed_type[imagen]|file_image_mindim[299,299]|file_image_maxdim[1921,1201]');
		$this->form_validation->set_rules('sesion1', 'Sesión 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dsesion1', 'Duración Sesion 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sesion2', 'Sesión 2', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion2', 'Duración Sesion 2', 'trim|xss_clean');
		$this->form_validation->set_rules('sesion3', 'Sesión 3', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion3', 'Duración Sesion 3', 'trim|xss_clean');
		$this->form_validation->set_rules('sesion4', 'Sesión 4', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion4', 'Duración Sesion 1', 'trim|xss_clean');

		// Validamos formulario
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->model('ejecutivoModel');
			$this->load->model('oficinasModel');
			$this->load->helper('form');
			// Creo options de ejecutivos
			$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
			// $options_ejecutivos = array('' => '');
			foreach ($ejecutivos as $index => $ejecutivo) {
				$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
			}
			// Creo options de oficinas
			$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
			// $options_oficinas = array('' => '');
			foreach ($oficinas as $index => $oficina) {
				$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
			}

			$this->data['options_ejecutivos'] 	= $options_ejecutivos;
			$this->data['options_oficinas'] 	= $options_oficinas;
			$this->_vista('nuevo-evento');
		} else {
			// Preparo informacion de sesiones
			$sesion1 = $this->input->post('sesion1');
			$sesion2 = $this->input->post('sesion2');
			$sesion3 = $this->input->post('sesion3');
			$sesion4 = $this->input->post('sesion4');
			$sesiones = array($sesion1,$sesion2,$sesion3,$sesion4);
			$total_sesiones = array();
			for ($i=0; $i < count($sesiones); $i++) {
				if (!empty($sesiones[$i])) {
					$sesion = array();
					$rango 	= explode('-', $sesiones[$i]);
					$inicio 	= explode(' ', $rango[0]);
					$fin 	= explode(' ', trim($rango[1]));
					$fecha_inicio 	=  explode('/', $inicio[0]);
					$fecha_inicio 	=  $fecha_inicio[2].'/'.$fecha_inicio[1].'/'.$fecha_inicio[0];
					$hora_inicio 	=  $inicio[1].':00 '.$inicio[2];
					$inicio 			= $fecha_inicio.' '.$hora_inicio;
					$inicio		= date('Y-m-d H:i:s',strtotime($inicio));

					$fecha_fin 		=  explode('/', $fin[0]);
					$fecha_fin 		=  $fecha_fin[2].'/'.$fecha_fin[1].'/'.$fecha_fin[0];
					$hora_fin 		=  $fin[1].':00 '.$fin[2];
					$fin 			= $fecha_fin.' '.$hora_fin;
					$fin			= date('Y-m-d H:i:s',strtotime($fin));
					$sesion = array(
									'fecha_inicio' 	=> $inicio,
									'fecha_final' 	=> $fin,
									'duracion' 		=> $this->input->post('dsesion'.($i+1)));
					array_push($total_sesiones, $sesion);
				}
			}
			// Preparo informacion del evento
			$evento = array(
			              'id_ejecutivo' 		=> $this->input->post('ejecutivo'),
			              'titulo' 				=> $this->input->post('titulo'),
			              'descripcion' 		=> $this->input->post('descripcion'),
			              'fecha_creacion' 	=> date('Y-m-d H:i:s'),
			              'fecha_limite' 		=> $this->limite($sesion1),
			              'costo' 				=> (float)$this->input->post('costo'),
			              'max_participantes' => (int)$this->input->post('cupo'),
			              'sesiones' 			=> count($total_sesiones),
			              'modalidad' 			=> $this->input->post('lugar'),
			);

			$modalidad = $this->input->post('lugar');
			if ($modalidad == 'online') {
				$evento['link'] = $this->input->post('link');
			} else if($modalidad == 'sucursal') {
				$evento['id_oficina'] = $this->input->post('sucursal');
			} else if($modalidad == 'otro') {
				$evento['direccion'] = $this->input->post('otro');
			}

			// Armo la ruta donde guardare la imagen a subir
			$ruta = 'assets/admin/pages/media/eventos/tmp/';
			//Si no existe directorio lo creo
			if (!is_dir($ruta))
			{
				mkdir($ruta, 0777, TRUE);
			}
			//Configuracion para la subida del archivo
			$config_upload['upload_path']		= $ruta;
			$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG';
			$config_upload['overwrite'] 		= TRUE;
			// $config_upload['file_name']		= $tmp_name;
			$config_upload['max_size']			= 2048;
			$config_upload['max_width']		= 0;
			$config_upload['max_height']		= 0;
			$config_upload['remove_spaces']	= TRUE;
			// Cargo la libreria upload y paso configuracion
			$this->load->library('upload', $config_upload);
			//SI NO se sube la imagen
			if (!$this->upload->do_upload())
			{
				$this->load->model('oficinasModel');
				$this->load->helper('form');
				// Creo options de ejecutivos
				$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
				$options_ejecutivos = array('' => '');
				foreach ($ejecutivos as $index => $ejecutivo) {
					$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
				}
				// Creo options de oficinas
				$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
				// $options_oficinas = array('' => '');
				foreach ($oficinas as $index => $oficina) {
					$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
				}

				$this->data['options_ejecutivos'] 	= $options_ejecutivos;
				$this->data['options_oficinas'] 	= $options_oficinas;
				// Envio a la variable los errores de subida
				$this->data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger"><strong>Error de subida: </strong>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>','</div>');
				$this->load->model('ejecutivoModel');
				$this->_vista('nuevo-evento');
			} else
			{
				// Cargo libreria manejo de imagen
				$this->load->library('image_lib');
				// Paso datos de la subida del archivo
				$upload_data = $this->upload->data();
				// Si la imagen es mas de 1000px se redimenciona
				if ($upload_data['image_width'] > 1000 || $upload_data['image_height'] > 1000)
			  	{
					// Configuracion para el recorte
					$config_resize['image_library']		= 'gd2';
					$config_resize['source_image']	= $upload_data['full_path'];
					$config_resize['maintain_ratio']	= TRUE;
					$config_resize['width']				= 1000;
					$config_resize['height']			= 1000;
					$this->image_lib->clear();
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
				}
				// Empiezo a escribir en la base de datos
				// Evento
				$id_evento = $this->eventoModel->get_last_id_after_insert($evento);
				// Muevo imagen de temario
				$ruta_nueva = 'assets/admin/pages/media/eventos/'.$id_evento.'/';
				//Si no existe directorio lo creo
				if (!is_dir($ruta_nueva))
				{
					mkdir($ruta_nueva, 0777, TRUE);
				}
				$this->load->helper('string');
				rename($ruta.$upload_data['orig_name'], $ruta_nueva.strip_accents($upload_data['client_name']));

				// Sesiones
				$this->load->model('sesionmodel');
				foreach ($total_sesiones as $index => $sesion) {
					$sesion['id_evento'] = $id_evento;
					$this->sesionmodel->insert($sesion);
				}
				redirect('evento/nuevo/exito');
			}
		}
	}

	/**
	 * Funcion que muestra la vista
	 * del formulario editar
	 *
	 * @return void
	 * @author
	 **/
	public function editar($id_evento, $exito=null)
	{
		// Helper para dropdown menu
		$this->load->helper('form');
		$this->load->helper('directory');
		// Helper de fechas
		$this->load->helper('formatofechas');

		$evento 	= $this->eventoModel->get_where(array('id_evento' => $id_evento));
		$sesiones 	= $this->sesionesModel->get_where(array('id_evento' => $id_evento));
		$duracion 	= $this->sesionesModel->get(array('duracion','id_sesion'),array('id_evento' => $id_evento));
		$archivo	= directory_map('assets/admin/pages/media/eventos/'.$id_evento);
		if (count($archivo) == 1) {
			$ruta_temario 					= 'assets/admin/pages/media/eventos/'.$id_evento.'/'.$archivo[0];
			$this->data['ruta_temario']	= $ruta_temario;
		}

		// Creo options de ejecutivos
		$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
		// $options_ejecutivos = array('' => '');
		foreach ($ejecutivos as $index => $ejecutivo) {
			$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
		}

		// Creo options de oficinas
		$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
		// $options_oficinas = array('' => '');
		foreach ($oficinas as $index => $oficina) {
			$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
		}

		// creo arreglo para manejo de sesiones
		$sesiones_str = array();
		if (count($sesiones)>1) {
			foreach ($sesiones as $key) {
			array_push($sesiones_str,date('d/m/Y h:i A', strtotime($key->fecha_inicio))." - ".date('d/m/Y h:i A', strtotime($key->fecha_final)));
		}
		}else{
			array_push($sesiones_str,date('d/m/Y h:i A', strtotime($sesiones->fecha_inicio))." - ".date('d/m/Y h:i A', strtotime($sesiones->fecha_final)));
		}

		switch ($evento->modalidad) {
			case 'sucursal':
				$online=array('name'=>'lugar','value'=>'online','id'=>'lugar4','checked'=>FALSE);
				$sucursal=array('name'=>'lugar','value'=>'sucursal','id'=>'lugar5','checked'=>TRUE);
				$otro=array('name'=>'lugar','value'=>'otro','id'=>'lugar6','checked'=>FALSE);
				break;
			case 'online':
				$online=array('name'=>'lugar','value'=>'online','id'=>'lugar4','checked'=>TRUE);
				$sucursal=array('name'=>'lugar','value'=>'sucursal','id'=>'lugar5','checked'=>FALSE);
				$otro=array('name'=>'lugar','value'=>'otro','id'=>'lugar6','checked'=>FALSE);
				break;
			case 'otro':
				$online=array('name'=>'lugar','value'=>'online','id'=>'lugar4','checked'=>FALSE);
				$sucursal=array('name'=>'lugar','value'=>'sucursal','id'=>'lugar5','checked'=>FALSE);
				$otro=array('name'=>'lugar','value'=>'otro','id'=>'lugar6','checked'=>TRUE);
				break;
		}

		$this->data['options_ejecutivos'] 	= form_dropdown('ejecutivo', $options_ejecutivos, $evento->id_ejecutivo, 'class="form-control"');
		$this->data['options_oficinas'] 	= $options_oficinas;
		$this->data['evento'] 				= $evento;
		$this->data['sucursal']				= $sucursal;
		$this->data['online']				= $online;
		$this->data['otro']					= $otro;
		$this->data['sesiones_str']			= $sesiones_str;
		$this->data['sesion'] 				= $duracion;
		$this->data['exito'] 				= (!is_null($exito) && $exito == 'exito') ? TRUE : FALSE;
		$this->_vista('editar-evento');
	}

	/**
	 * Funcion para agregar a la BD y manipular
	 * el archivo que se subio
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function edit()
	{
		// Helper para dropdown menu
		$this->load->helper('form');
		$this->load->helper('formatofechas');
		$this->load->helper('directory');
		// Cargo la librería de las validaciones
		$this->load->library('form_validation');
		// Obtenemos el id del evento a modificar
		$id_evento = $this->input->post('id_evento');

		//Datos básicos
		$this->form_validation->set_rules('ejecutivo', 'Ejecutivo', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|strtolower|ucfirst|max_length[100]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|xss_clean');
		$this->form_validation->set_rules('costo', 'Costo', 'trim|required|decimal|xss_clean');
		$this->form_validation->set_rules('cupo', 'Max. Cupo', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('lugar', 'Lugar', 'trim|required|xss_clean');

		$lugar 	= $this->input->post('lugar');

		if ($lugar == 'online')
		{
			$this->form_validation->set_rules('link', 'Link', 'trim|required|strtolower|valid_url|prep_url|xss_clean');
		} else if($lugar == 'sucursal')
		{
			$this->form_validation->set_rules('sucursal', 'Oficinas', 'trim|required|integer|xss_clean');
		} else if($lugar == 'otro')
		{
			$this->form_validation->set_rules('otro', 'Dirección', 'trim|required|strtolower|ucfirst|xss_clean');
		}

		if ($_FILES['userfile']['name'] != '') {
			$this->form_validation->set_rules('userfile', 'Temario', 'file_required|file_size_min[10KB]|file_size_max[2048KB]|file_allowed_type[imagen]|file_image_mindim[299,299]|file_image_maxdim[1921,1201]');
		}
		$this->form_validation->set_rules('sesion1', 'Sesión 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dsesion1', 'Duración Sesion 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sesion2', 'Sesión 2', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion2', 'Duración Sesion 2', 'trim|xss_clean');
		$this->form_validation->set_rules('sesion3', 'Sesión 3', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion3', 'Duración Sesion 3', 'trim|xss_clean');
		$this->form_validation->set_rules('sesion4', 'Sesión 4', 'trim|xss_clean');
		$this->form_validation->set_rules('dsesion4', 'Duración Sesion 1', 'trim|xss_clean');

		// Validamos formulario
		if ($this->form_validation->run() === FALSE)
		{
			// En caso de que las validaciones fallen:
			// Obtenemos el evento mediante id
			$evento 	= $this->eventoModel->get_where(array('id_evento' => $id_evento));
			// Obtenemos la duración por id de evento
			$duracion 	= $this->sesionesModel->get(array('duracion'),array('id_evento' => $id_evento));
			// Creamos la ruta de la imagen a mostrar
			$archivo = directory_map('assets/admin/pages/media/eventos/'.$id_evento);
			$ruta_nueva = 'assets/admin/pages/media/eventos/'.$id_evento.'/'.$archivo[0];

			switch ($evento->modalidad) {
				case 'sucursal':
					$online		=array('name'=>'lugar','value'=>'online','id'=>'lugar4','checked'=>FALSE);
					$sucursal	=array('name'=>'lugar','value'=>'sucursal','id'=>'lugar5','checked'=>TRUE);
					$otro		=array('name'=>'lugar','value'=>'otro','id'=>'lugar6','checked'=>FALSE);
					break;
				case 'online':
					$online		=array('name'=>'lugar','value'=>'online','id'=>'lugar4','checked'=>TRUE);
					$sucursal	=array('name'=>'lugar','value'=>'sucursal','id'=>'lugar5','checked'=>FALSE);
					$otro		=array('name'=>'lugar','value'=>'otro','id'=>'lugar6','checked'=>FALSE);
					break;
				case 'otro':
					$online		=array('name'=>'lugar','value'=>'online','id'=>'lugar4','checked'=>FALSE);
					$sucursal	=array('name'=>'lugar','value'=>'sucursal','id'=>'lugar5','checked'=>FALSE);
					$otro		=array('name'=>'lugar','value'=>'otro','id'=>'lugar6','checked'=>TRUE);
					break;
			}

			// Creo options de ejecutivos
			$ejecutivos = $this->ejecutivoModel->get(array('id', 'primer_nombre', 'apellido_paterno'), null, 'primer_nombre', 'ASC');
			$options_ejecutivos = array('' => '');
			foreach ($ejecutivos as $index => $ejecutivo) {
				$options_ejecutivos[$ejecutivo->id] = $ejecutivo->primer_nombre.' '.$ejecutivo->apellido_paterno;
			}

			// Creo options de oficinas
			$oficinas 	= $this->oficinasModel->get(array('id_oficina', 'ciudad_estado', 'calle', 'numero'), null, 'calle', 'ASC');
			// $options_oficinas = array('' => '');
			foreach ($oficinas as $index => $oficina) {
				$options_oficinas[$oficina->id_oficina] = $oficina->calle.' '.$oficina->numero.', '.$oficina->ciudad_estado;
			}

			// Creo arreglo para manejo de sesiones
			$sesiones 	= $this->sesionesModel->get_where(array('id_evento' => $id_evento));
			$sesiones_str = array();
			if (count($sesiones)>1) {
				foreach ($sesiones as $key) {
				array_push($sesiones_str,date('d/m/Y h:i A', strtotime($key->fecha_inicio))." - ".date('d/m/Y h:i A', strtotime($key->fecha_final)));
			}
			}else{
				array_push($sesiones_str,date('d/m/Y h:i A', strtotime($sesiones->fecha_inicio))." - ".date('d/m/Y h:i A', strtotime($sesiones->fecha_final)));
			}

			// Mandamos llamar a la vista con sus datos.
			$this->data['options_ejecutivos'] 	= form_dropdown('ejecutivo', $options_ejecutivos, $evento->id_ejecutivo, 'class="form-control"');
			$this->data['evento'] 				= $evento;
			$this->data['sucursal']				= $sucursal;
			$this->data['online']				= $online;
			$this->data['otro']					= $otro;
			$this->data['ruta_nueva']			= $ruta_nueva;
			$this->data['sesiones_str']			= $sesiones_str;
			$this->data['sesion'] 				= $duracion;
			$this->data['options_oficinas'] 	= $options_oficinas;
			$this->_vista('editar-evento');
		} else
		{
			// Preparo informacion de sesiones
			$sesion1 = $this->input->post('sesion1');
			$sesion2 = $this->input->post('sesion2');
			$sesion3 = $this->input->post('sesion3');
			$sesion4 = $this->input->post('sesion4');

			$id_sesion1 = $this->input->post('idsesion1');
			$id_sesion2 = $this->input->post('idsesion2');
			$id_sesion3 = $this->input->post('idsesion3');
			$id_sesion4 = $this->input->post('idsesion4');

			$sesiones 			= array($sesion1,$sesion2,$sesion3,$sesion4);
			$id_sesiones 		= array($id_sesion1,$id_sesion2,$id_sesion3,$id_sesion4);
			$total_sesiones 	= array();
			for ($i=0; $i < count($sesiones); $i++) {
				if (!empty($sesiones[$i])) {
					$sesion = array();
					$rango 	= explode('-', $sesiones[$i]);
					$inicio 	= explode(' ', $rango[0]);
					$fin 	= explode(' ', trim($rango[1]));
					$fecha_inicio 	=  explode('/', $inicio[0]);
					$fecha_inicio 	=  $fecha_inicio[2].'/'.$fecha_inicio[1].'/'.$fecha_inicio[0];
					$hora_inicio 	=  $inicio[1].':00 '.$inicio[2];
					$inicio 			= $fecha_inicio.' '.$hora_inicio;
					$inicio		= date('Y-m-d H:i:s',strtotime($inicio));

					$fecha_fin 		=  explode('/', $fin[0]);
					$fecha_fin 		=  $fecha_fin[2].'/'.$fecha_fin[1].'/'.$fecha_fin[0];
					$hora_fin 		=  $fin[1].':00 '.$fin[2];
					$fin 			= $fecha_fin.' '.$hora_fin;
					$fin			= date('Y-m-d H:i:s',strtotime($fin));
					$sesion = array(
									'id_evento'		=> $id_evento,
									'id_sesion'		=> $id_sesiones[$i],
									'fecha_inicio' 	=> $inicio,
									'fecha_final' 	=> $fin,
									'duracion' 		=> $this->input->post('dsesion'.($i+1)));
					array_push($total_sesiones, $sesion);
				}
			}

			// Preparo la información del evento
			$evento = array(
			              'id_ejecutivo' 		=> $this->input->post('ejecutivo'),
			              'titulo' 				=> $this->input->post('titulo'),
			              'descripcion' 		=> $this->input->post('descripcion'),
			              'fecha_creacion' 		=> date('Y-m-d H:i:s'),
			              'fecha_limite' 		=> $this->limite($sesion1),
			              'costo' 				=> (float)$this->input->post('costo'),
			              'max_participantes' 	=> (int)$this->input->post('cupo'),
			              'sesiones' 			=> count($total_sesiones),
			              'modalidad' 			=> $this->input->post('lugar'),
			);

			$modalidad = $this->input->post('lugar');
			if ($modalidad == 'online') {
				$evento['link'] 		= $this->input->post('link');
				$evento['id_oficina']	= null;
				$evento['direccion']	= null;
			} else if($modalidad == 'sucursal') {
				$evento['link']			= null;
				$evento['id_oficina']	= $this->input->post('sucursal');
				$evento['direccion']	= null;
			} else if($modalidad == 'otro') {
				$evento['link']			= null;
				$evento['id_oficina']	= null;
				$evento['direccion']	= $this->input->post('otro');
			}

			if ($_FILES['userfile']['name'] != '') {
				$this->load->helper('file');
				// Armo la ruta donde guardaré la imagen a subir
				$ruta = 'assets/admin/pages/media/eventos/'.$id_evento;
				// Borro todo antes
				delete_files($ruta);
				//Configuracion para la subida del archivo
				$config_upload['upload_path']		= $ruta;
				$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG';
				$config_upload['overwrite'] 		= TRUE;
				// $config_upload['file_name']		= $tmp_name;
				$config_upload['max_size']			= 2048;
				$config_upload['max_width']		= 0;
				$config_upload['max_height']		= 0;
				$config_upload['remove_spaces']	= TRUE;
				// Cargo la libreria upload y paso configuracion
				$this->load->library('upload', $config_upload);
				//SI NO se sube la imagen
				$this->upload->do_upload();
				// Cargo libreria manejo de imagen
				$this->load->library('image_lib');
				// Paso datos de la subida del archivo
				$upload_data = $this->upload->data();
				// Si la imagen es mas de 1000px se redimenciona
				if ($upload_data['image_width'] > 1000 || $upload_data['image_height'] > 1000)
			  	{
					// Configuracion para el recorte
					$config_resize['image_library']		= 'gd2';
					$config_resize['source_image']	= $upload_data['full_path'];
					$config_resize['maintain_ratio']	= TRUE;
					$config_resize['width']				= 1000;
					$config_resize['height']			= 1000;
					$this->image_lib->clear();
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
				}
			}

			// Empiezo a escribir en la base de datos
			// Evento
			$this->eventoModel->update($evento,array('id_evento' => $id_evento));

			// Sesiones
			foreach ($total_sesiones as $index => $sesion) {
				$existe = $this->sesionesModel->get_where(array('id_sesion'=>$sesion['id_sesion']));
				if (empty($existe)) {
					$sesion['id_evento'] = $id_evento;
					$this->sesionesModel->insert($sesion);
				}else{
					$this->sesionesModel->update($sesion,array('id_evento'=>$sesion['id_evento'],'id_sesion'=>$sesion['id_sesion']));
				}
			}
			redirect('evento/editar/'.$id_evento.'/exito');
		}
	}

	public function eliminaSesion()
	{
		$id_sesion = $this->input->post('id_sesion');

		if ($this->input->is_ajax_request()) {
			if($this->sesionesModel->delete(array('id_sesion'=>$id_sesion))) {
				$respuesta = array('exito' => TRUE, 'msg' => '<h4>La sesión fue borrada.</h4>' );
			}else{
				$respuesta = array('exito' => FALSE, 'msg' => '<h4>¡Error! Revisa la consola para más información.</h4>' );
			}
			//mando la repuesta
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}

	/**
	 * Función para obtener los eventos de manera de JSON
	 * con formato para el DataTable
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json_eventos()
	{
		$draw			= $this->input->post('draw');
		$start			= $this->input->post('start');
		$length		= $this->input->post('length');
		$order			= $this->input->post('order');
		$columns		= $this->input->post('columns');
		$search		= $this->input->post('search');
		$total			=  $this->eventoModel->get('COUNT(*) as total', null, null, 1);

		if($length == -1)
		{
			$length	= null;
			$start		= null;
		}
		$campos = array(
	                			'distinct(eventos.id_evento) as id_event',
						'id_ejecutivo',
						'id_oficina',
						'titulo',
						'modalidad',
						'eventos.id_estatus as estatus',
						'(SELECT COUNT(`participantes`.`id`) from `participantes`  where `participantes`.`id_evento` = `eventos`.`id_evento`) AS `participantes`',
						// ejecutivos
						'ejecutivos.primer_nombre as ejecutivo',
						'ejecutivos.apellido_paterno',
						// sesion
						'(SELECT MIN(`sesiones`.`fecha_inicio`) from `sesiones` where `sesiones`.`id_evento` = `eventos`.`id_evento`) AS `primera_sesion`'
						);
		$joins 			= array('ejecutivos', 'sesiones', 'estatus_general');
		$like 			= $search['value'];
		$orderBy 		= $columns[$order[0]['column']]['data'];
		$orderForm 	= $order[0]['dir'];
		$limit 			= $length;
		$offset 		= $start;
		$eventos		= $this->eventoModel->get_eventos_table(
							$campos,
							$joins,
							$like,
							$orderBy,
							$orderForm,
							$limit,
							$offset);
		// var_dump($eventos);
		$proceso	= array();
		$this->load->model('estatusGeneralModel');
		$this->load->helper('formatofechas');
		$this->load->helper('estatus');
		foreach ($eventos as $index => $evento) {
			$p = array(
				'DT_RowId'					=> $evento->id_event,
				'id_event'					=> $evento->id_event,
				'ejecutivo'					=> $evento->ejecutivo.' '.$evento->apellido_paterno,
				'modalidad'					=> ucfirst($evento->modalidad),
				'titulo'						=> $evento->titulo,
				'fecha_inicio'				=> fecha_completa($evento->primera_sesion),
				'url'							=> site_url('cursos/inscripcion/'.$evento->id_event),
				'participantes'				=> $evento->participantes,
				'estatus'					=> id_estatus_gral_to_class_html($evento->estatus),
				'url_modal_participantes'	=> site_url('/evento/modal/participantes/'.$evento->id_event),
				'url_editar'					=> site_url('/evento/editar/'.$evento->id_event),
			       );
			array_push($proceso, $p);
		}
		$data = array(
			'draw'				=> $draw,
			'recordsTotal'		=> count($eventos),
			'recordsFiltered'	=> $total[0]->total,
			'data'				=> $proceso);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function modal($accion)
	{
		$id_evento = $this->uri->segment(4);
		switch ($accion) {
			case 'participantes':
				$this->load->model('participantesmodel');
				$participantes 					= $this->participantesmodel->mostrar_participantes($id_evento);
				$this->data['participantes'] 	= $participantes;
				$this->data['id_evento']		= $id_evento;
				$this->_vista_completa('evento/participantes');
				break;
		}
	}

	/**
	 * Función que se encarga de enviar los emails
	 * a todos los participantes de algún
	 * evento.
	 **/
	public function modal_recordar($id_evento='')
	{
		// Enviar email recordatorio a todos los participantes del evento
		if ($this->input->is_ajax_request()) {
			$this->load->model('participantesmodel');
			if($participantes = $this->participantesmodel->mostrar_participantes($id_evento)) {
				$bandera=TRUE;
				if (!LOCAL) {
					// Librerías y helpers a utilizar para envío de email
					$this->load->library('email');
					$this->load->helper('directory');
					$this->load->helper('formatofechas');

					// Modelos a utilizar
					$this->load->model('sesionmodel');
					$this->load->model('clienteModel');
					$this->load->model('eventomodel');
					$this->load->model('contactosmodel');
					foreach ($participantes as $key => $participante) {
						// Limpiar las variables y los adjuntos con TRUE
						$this->email->clear(TRUE);
						// Extraigo evento
						$evento = $this->eventomodel->get_where(array('id_evento' => $id_evento));
						// Extraigo usuario y contraseña del cliente
						$cliente = $this->clienteModel->get(array('usuario', 'password'), array('id' => $participante->id_cliente), null, 'ASC', 1);

						// Extracción de la BD de las sesiones
						if ($this->sesionmodel->get('*', array('id_evento' => $id_evento)) > 1) {
							$sesiones = $this->sesionmodel->get('*', array('id_evento' => $id_evento));
						}else{
							$sesiones = $this->sesionmodel->get_where(array('id_evento' => $id_evento));
						}

						// Configuración del email
						$this->email->set_mailtype('html');
						$this->email->from('eventos@soipaq.com', 'Eventos TiendaPAQ');
						$this->email->to($participante->email_contacto);
						$this->email->subject('Recordatorio del evento: "'.$evento->titulo.'"');

						// Contenido del correo
						$this->data['titulo'] 		= $evento->titulo;
						$this->data['descripcion'] 	= $evento->descripcion;
						$this->data['modalidad'] 	= $evento->modalidad;

						// Modalidad
						if ($evento->modalidad == 'online') {
							$this->data['ubicacion'] = $evento->link;
						}else{
							if ($evento->modalidad == 'otro') {
								$this->data['ubicacion'] = $evento->direccion;
							}else{
								$oficina = $this->oficinasmodel->get_where(array('id_oficina'=>$evento->id_oficina));
								$this->data['ubicacion'] = $oficina->calle.' '.$oficina->numero.', Col.'.$oficina->colonia.', '.$oficina->ciudad_estado;
							}
						}

						// Sesiones y variable para recordatorio en rojo
						$this->data['sesiones'] 	= $sesiones;
						$this->data['recordar'] 	= 1;

						// Datos de logueo
						$this->data['usuario'] 		=$cliente->usuario;
						$this->data['password'] 	= $cliente->password;
						$html = $this->load->view('admin/general/full-pages/email/email_recordar_evento.php', $this->data, TRUE);
						$this->email->message($html);

						// Imagen a enviar adjunta
						$path 		= 'assets/admin/pages/media/eventos/'.$evento->id_evento.'/';
						$file 		= directory_map($path);
						$imagen 	= $path.$file[0];
						if (count($file) == 1 && is_file($imagen)) {
							$this->email->attach($imagen);
						}

						// Enviamos el email
						$this->email->send();
					}
					$respuesta = array('exito' => TRUE, 'msg' => '<h4>Se han reenviado los correos a los participantes.</h4>');
				}
			}else{
				$respuesta = array('exito' => FALSE, 'msg' => '<h4>¡Error! Revisa la consola para más información.</h4>' );
			}

		// Mando la repuesta al JS
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
		}
	}

	/**
	 * Calculo la duracion de horas
	 * en una sesion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function duracion()
	{
		if($this->input->is_ajax_request()) {
			$rango 	= $this->input->post('rango');
			$rango 	= explode('-', $rango);
			$inicio 	= explode(' ', $rango[0]);
			$fin 	= explode(' ', trim($rango[1]));

			$fecha_inicio 	=  explode('/', $inicio[0]);
			$fecha_inicio 	=  $fecha_inicio[2].'/'.$fecha_inicio[1].'/'.$fecha_inicio[0];
			$hora_inicio 	=  $inicio[1].':00 '.$inicio[2];
			$inicio 			= $fecha_inicio.' '.$hora_inicio;

			$fecha_fin 		=  explode('/', $fin[0]);
			$fecha_fin 		=  $fecha_fin[2].'/'.$fecha_fin[1].'/'.$fecha_fin[0];
			$hora_fin 		=  $fin[1].':00 '.$fin[2];
			$fin 			= $fecha_fin.' '.$hora_fin;

			$diferencia		= strtotime($fin) - strtotime($inicio);
			$horas			= floor($diferencia/(60*60)); // horas
			$minutos		= floor(($diferencia%(60*60))/60); // minutos
			$minutos		= ($minutos == 0) ? '00': $minutos;
			$duracion 		= ($horas == 1 && $minutos == '00') ? $horas.':'.$minutos.' hora aprox.' : $horas.':'.$minutos.' horas aprox.';

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array(
				             'duracion' 	=> $duracion,
				              'valor' 		=> $horas.':'.$minutos
				             )));
		}
	}

	/**
	 * Calcula el limite de inscipcion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function limite($rango = null)
	{
		$this->load->helper('formatofechas');
		if($this->input->is_ajax_request()) {
			$rango 	= $this->input->post('rango');
			$rango 	= explode('-', $rango);
			$fecha = limite_inscripcion_evento($rango[0]);
			$limite 	= fecha_completa($fecha);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('limite' => $limite)));
		} else {
			if (!is_null($rango)) {
				$rango 	= explode('-', $rango);
				$fecha = limite_inscripcion_evento($rango[0]);

				return $fecha;
			}
		}
	}
}

/* End of file evento.php */
/* Location: ./application/controllers/evento.php */