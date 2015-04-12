<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para la seccion
 * de eventos y funciones
 * para el mismo.
 *
 * @author Julio Trujillo
 **/
class Evento extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		// Cargo libreria manejo de imagen
		$this->load->library('image_lib');
		$this->load->library('form_validation');
		$this->load->model('eventoModel');
		$this->load->helper('formatofechas_helper');
		$this->load->model('ejecutivoModel');
		$this->load->model('sesionesModel');
		$this->load->helper('date');
		$this->load->model('oficinasModel');
	}

	// public function index()
	// {
	// $this->load->model('ejecutivoModel');
	// // Nombre de ejecutivos
	// $this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
	// 	array('id','primer_nombre', 'apellido_paterno'),
	// 	'privilegios',
	// 	array('soporte', 'admin'),
	// 	'primer_nombre');

	// $this->_vista('form-nuevo-evento');
	// }

	private function _crearFecha($fecha_editar)
	{
		// creo la fecha a inserta en la base de datos
		if ($fecha_editar[fecha]!=null) {
			$mostrar1= explode(" ", $fecha_editar[fecha]);
			switch ($mostrar1[1]) {
				case 'January':
				$mes="01";
				break;
				case 'February':
				$mes="02";
				break;
				case 'March':
				$mes="03";
				break;
				case 'April':
				$mes="04";
				break;
				case 'May':
				$mes="05";
				break;
				case 'June':
				$mes="06";
				break;
				case 'July':
				$mes="07";
				break;
				case 'August':
				$mes="08";
				break;
				case 'September':
				$mes="09";
				break;
				case 'October':
				$mes="10";
				break;
				case 'November':
				$mes="11";
				break;
				case 'December':
				$mes="12";
				break;
				default:
				# code...
				break;
			}
			$fecha1=$mostrar1[2]."-".$mes."-".$mostrar1[0]." ".$mostrar1[4].":00";
			return $fecha1;
		}else{
			# code...
		}
	}

	public function index()
	{
		$this->_vista('form-nuevo-evento');
	}

	/**
	 * Muestra la vista para los
	 * eventos
	 * @author Julio Trujillo
	 **/
	public function revisar()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_creacion'
			));
		$this->_vista('administrar');
	}

	/**
	 * Función para mostrar ventana modal
	 * con informacion detallada
	 * sobre un evento.
	 * @author  Julio Trujillo
	 **/
	public function detalles($id_evento)
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['evento'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_evento',
				'eventos.fecha_creacion',
				'eventos.descripcion',
				'eventos.temario',
				'eventos.sesiones',
				'eventos.hora',
				'eventos.duracion',
				'eventos.costo',
			));

		$this->_vista_completa('evento/modal-detalles-evento');
	}

	/**
	 * funcion para crear
	 * y gestionar
	 * eventos
	 * @author  David
	 **/
	public function gestionar($accion=null, $id_evento=null)
	{
		switch ($accion)
		{
			case 'nuevo':
				$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
				array('id','primer_nombre', 'apellido_paterno'));

				$this->data['oficinas'] = $this->oficinasModel->where_in(
				array('id_oficina','ciudad_estado', 'ciudad', 'estado',
				 'colonia', 'calle', 'numero', 'email', 'telefono'));
				$this->_vista('form-nuevo-evento');
			break;

			case 'editar':
				$evento 	= $this->eventoModel->get_where(array('id_evento' => $id_evento));
				if (!empty($evento))
				{
					// Datos a enviar a la vista
					$this->data['evento']				= $evento;
					$this->data['ejecutivos'] = $this->ejecutivoModel->where_in(
					array('id','primer_nombre', 'apellido_paterno'),
					'privilegios',
					array('soporte', 'admin'),
					'primer_nombre');
					$this->_vista('editar-evento');
				} else
				{
					show_error('No existe este evento.', 404);
				}
			break;

			case 'eliminar':
				$id = $this->input->post('id');
				/**
				 * Si exsite una cotizacion o pendiente ligada a este ID de cliente entonces
				 * NO procede a eliminarse, solo a desactivar su identidad
				 * en la aplicacion y en las busquedas
				 */
				$this->load->model('cotizacionModel');
				$this->load->model('pendienteModel');
				// Si NO hay cotizacion
				if (!$this->pendienteModel->exist(array('id_cliente' => $id)) || !$this->cotizacionModel->exist(array('id_cliente' => $id))) {
					if ($this->clienteModel->delete(array('id' => $id))) {
						$response = array('exito' => TRUE, 'mensaje' => 'El cliente se ha eliminado de la base de datos.');
					}
				} else {
					$response = array('exito' => FALSE, 'mensaje' => 'El cliente tiene pendientes o cotizaciones ligadas, por lo tanto solo será desactivado.');
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
				break;

			case 'activar':
				$id 			= $this->input->post('id');
				$selected 	= $this->input->post('selected');
				$activo 	= ($selected == 'true') ? 1 : 0;
				$mensaje	= ($selected == 'true') ? '<h4>El cliente podrá acceder al sistema y aparecerá en los buscadores.</h4>' : '<h4>El cliente ya <b>NO</b> podrá acceder al sistema y desaparecerá de los buscadores del sistema.</h4>';
				if ($this->clienteModel->update(array('activo' => $activo), array('id' => $id))) {
					$response = array('exito' => TRUE, 'mensaje' => $mensaje);
				}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
				break;

			default:
				$this->data['clientes'] = $this->clienteModel->get(array('*'));
				$this->_vista('gestionar');
			break;
		}
	}

	public function nuevo ()
	{
		//reglas de evento
		$this->form_validation->set_rules('ejecutivos', 'Ejecutivo', 'strtolower|xss_clean');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required|max_length[65536]|xss_clean');
		// $this->form_validation->set_rules('temario', 'Temario', 'required|max_length[65536]|xss_clean');
		$this->form_validation->set_rules('costo', 'Costo', 'max_length[6]|xss_clean');
		$this->form_validation->set_rules('sesion_1', 'Sesion1', 'xss_clean');
		$this->form_validation->set_rules('sesion_2', 'Sesion2', 'xss_clean');
		$this->form_validation->set_rules('sesion_3', 'Sesion3', 'xss_clean');
		$this->form_validation->set_rules('sesion_4', 'Sesion4', 'xss_clean');

		if($this->form_validation->run() === FALSE)
		{
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
			$hoy = getdate();
			$hoy = date("Y:m:d H:i:s");
			if ($this->input->post('url')!=null) {
				$modalidad="online";
			}
			if ($this->input->post('oficina2')!=null) {
				$modalidad="sucursal";
			}
			if ($this->input->post('direccion')!=null) {
				$modalidad="otro";
			}
			if ($this->input->post('url')!=null) {
				//si las reglas son correctas preparo los datos para insertar
				$evento = array(
					'id_evento'				=>$this->input->post(''),
					'id_ejecutivo'			=> $this->input->post('ejecutivo'),
					'titulo'				=> $this->input->post('titulo'),
					'descripcion'			=> $this->input->post('descripcion'),
					'fecha_creacion'		=> $hoy,
					'costo'					=> $this->input->post('costo'),
					'max_participantes'		=> $this->input->post('max_participantes'),
					'sesiones'				=> $this->input->post(''),
					'modalidad'				=> $modalidad,
					'link'					=> $this->input->post('url'),
					'total_participantes'	=> $this->input->post('')
				);
			}
			if ($this->input->post('oficina2')!=null) {
				//si las reglas son correctas preparo los datos para insertar
				$evento = array(
					'id_evento'				=>$this->input->post(''),
					'id_ejecutivo'			=> $this->input->post('ejecutivo'),
					'id_oficina'			=> $this->input->post('oficina2'),
					'titulo'				=> $this->input->post('titulo'),
					'descripcion'			=> $this->input->post('descripcion'),
					'fecha_creacion'		=> $hoy,
					'costo'					=> $this->input->post('costo'),
					'max_participantes'		=> $this->input->post('max_participantes'),
					'sesiones'				=> $this->input->post(''),
					'modalidad'				=> $modalidad,
					'total_participantes'	=> $this->input->post('')
				);
			}
			if ($this->input->post('direccion')!=null) {
				//si las reglas son correctas preparo los datos para insertar
				$evento = array(
					'id_evento'				=>$this->input->post(''),
					'id_ejecutivo'			=> $this->input->post('ejecutivo'),
					'titulo'				=> $this->input->post('titulo'),
					'descripcion'			=> $this->input->post('descripcion'),
					'fecha_creacion'		=> $hoy,
					'costo'					=> $this->input->post('costo'),
					'max_participantes'		=> $this->input->post('max_participantes'),
					'sesiones'				=> $this->input->post(''),
					'modalidad'				=> $modalidad,
					'total_participantes'	=> $this->input->post(''),
					'direccion'				=> $this->input->post('direccion')
				);
			}
			//Inserto en la BD el nuevo evento
			if($this->eventoModel->insert($evento))
			{
				$respuesta = array('exito' => TRUE, 'msg' => '<h4>Nuevo evento añadido con éxito.</h4>.');
			} else
			{
				$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, error en la insercion de evento, revisa la consola o la base de datos para detalles');
			}
			// 	obtengo el ultimo id_evento insertado
			// 	comprueba cual es el id_evento mas grande insertado
			// 	la variable id guarda el id_evento.
			$rs = mysql_query("SELECT MAX(id_evento) AS id FROM eventos");
			if ($row = mysql_fetch_row($rs)) {
				$id = trim($row[0]);
			}
			// // el temario sera una imagen
			// // creare un directorio para guardar
			// // las imagenes, cada
			// // evento (id_evento) tendra su propia carpeta
			// // la ruta sera construida con lo antes mensionado.
			// // if (file_exists("C:/wamp/www/crm-tiendapaq/eventos")) {
			// // 	} else {
			// // 		mkdir("C:/wamp/www/crm-tiendapaq/eventos", 0777, TRUE);
			// // 	}
			// // 	if (file_exists("C:/wamp/www/crm-tiendapaq/eventos/$id")) {
			// // 	} else {
			// // 		mkdir("C:/wamp/www/crm-tiendapaq/eventos/$id", 0777, TRUE);
			// // 	}
			// 	// $id_activo			= $id;
			// 	// $ruta				= 'C:/wamp/www/crm-tiendapaq/eventos/';
			// 	// $ruta_completa	= $ruta.$id_activo.'/';
			// 	// $config_upload['upload_path']		= $ruta_completa;
			// 	// $config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG';
			// 	// $config_upload['overwrite'] 		= TRUE;
			// 	// $config_upload['file_name']		= $id.'perfil.jpg';
			// 	// $config_upload['max_size']			= 2048;
			// 	// $config_upload['remove_spaces']	= TRUE;
			// 	// // Cargo la libreria upload y paso configuracion
			// 	// $this->load->library('upload', $config_upload);
			// 	// $this->upload->do_upload();

			$sesiones1=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'			=>$this->input->post('sesion_1'),
				'duracion'		=>$this->input->post('duracion_1')
			);
			$sesiones2=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'			=>$this->input->post('sesion_2'),
				'duracion'		=>$this->input->post('duracion_2')
			);
			$sesiones3=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'			=>$this->input->post('sesion_3'),
				'duracion'		=>$this->input->post('duracion_3')
			);
			$sesiones4=array(
				'id_sesiones'	=>$this->input->post(''),
				'id_evento'		=>$id,
				'fecha'			=>$this->input->post('sesion_4'),
				'duracion'		=>$this->input->post('duracion_4')
			);

			if ($sesiones1[fecha]!=null)
			{
				$sesiones1[fecha]=$this->_crearFecha($sesiones1);
				$this->sesionesModel->insert($sesiones1);
			}
			if ($sesiones2[fecha]!=null)
			{
				$sesiones2[fecha]=$this->_crearFecha($sesiones2);
				$this->sesionesModel->insert($sesiones2);
			}
			if ($sesiones3[fecha]!=null)
			{
				$sesiones3[fecha]=$this->_crearFecha($sesiones3);
				$this->sesionesModel->insert($sesiones3);
			}
			if ($sesiones4[fecha]!=null)
			{
				$sesiones4[fecha]=$this->_crearFecha($sesiones4);
				$this->sesionesModel->insert($sesiones4);
			}

			//mando la repuesta
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}
}
?>