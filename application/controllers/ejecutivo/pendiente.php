<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para manejar metodos de
 * un pendiente.
 *
 * @author Luis Macias
 **/
class Pendiente extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//cargo la libreria de las validaciones
		$this->load->library('form_validation');
		// Cargo modelos
		$this->load->model('pendienteModel');
		$this->load->model('estatusModel');
		$this->load->model('actividadPendienteModel');
	}

	public function index()
	{}

	/**
	 * Método para agregar un pendiente a la BD
	 *
	 * @author Luis Macias
	 **/
	public function nuevo()
	{
		// Reglas de validacion
		$this->form_validation->set_rules('ejecutivo', 'Ejecutivo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|require|xss_clean');
		$this->form_validation->set_rules('actividad', 'Actividad', 'trim|required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|min_length[5]|max_length[140]|xss_clean');

		// Valido formulario
		if ($this->form_validation->run() === FALSE)
		{
			// SI es FALSO, vuelvo a mostrar vista
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
			$razon_social = $this->input->post('razon_social');
			// Captruo los datos en un array
			$data = array(
				'id_ejecutivo'	=> $this->input->post('ejecutivo'),
				'id_empresa'	=> (empty($razon_social)) ? NULL : $razon_social,
				'actividad'		=> $this->input->post('actividad'),
				'estatus'		=> $this->estatusModel->PENDIENTE,
				'descripcion'	=> $this->input->post('descripcion')
			);
			// Transfomo arreglo a objeto
			$objeto_pendiente = $this->pendienteModel->arrayToObject($data);
			// Si se inserta correctamente a la bd
			if ($this->pendienteModel->insert($objeto_pendiente)) {

				// Cargo modelo ejecutivos
				$this->load->model('ejecutivoModel');
				$this->load->model('creaPendienteModel');

				$id_pendiente_nuevo = $this->pendienteModel->getIDUltimoPendiente();

				$this->creaPendienteModel->insert(array(
										'id_creador'	=> $this->usuario_activo['id'],
										'id_pendiente'	=> $id_pendiente_nuevo));

				$ejecutivo_asignado = $this->ejecutivoModel->get(
					array('primer_nombre', 'apellido_paterno', 'email'),
					array('id' => $objeto_pendiente->id_ejecutivo),
					null,
					'ASC',
					1);

				/*
				* BLOQUE PARA LA PROGRAMACION DE ENVIO DE CORREO
				* ELECTRONICO QUE NOTIFICA AL EJECUTIVO DE NUEVO
				* PENDIENTE ASIGNADO
				 */

				$nombre_asignado = $ejecutivo_asignado->primer_nombre.' '.$ejecutivo_asignado->apellido_paterno;

				// Armo la respuesta para el JSON
				$respuesta = array(
					'exito'		=> TRUE,
					'nombre'	=> $nombre_asignado);
			} else {
				// Armo la respuesta para el JSON
				$respuesta = array(
					'exito'	=> FALSE,
					'msg'	=> 'No se inserto cliente en la BD');
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	public function detalles($id_pendiente)
	{
		// Cargo modelos
		$this->load->model('creaPendienteModel');
		$this->load->model('estatusModel');
		$this->load->model('ejecutivoModel');
		//Helper
		$this->load->helper('formatofechas');

		$creador					= $this->creaPendienteModel->getCreadorPendiente($id_pendiente);
		$pendiente					= $this->pendienteModel->getPendiente($id_pendiente);
		$pendiente->creador		= $creador->primer_nombre.' '.$creador->apellido_paterno;
		$this->data['pendiente']	= $pendiente;
		$this->data['estatus']	= $this->estatusModel->get('*');
		$this->data['ejecutivos'] = $this->ejecutivoModel->get(array('id','primer_nombre','apellido_paterno'));

		// SI la actividad es COTIZAR
		if ($pendiente->id_actividad == $this->actividadPendienteModel->SOLICITA_COTIZACION) {
			$this->data['url_cotiza']= anchor('cotizador/'.$pendiente->id_pendiente, 'Cotizar', 'class="btn red"');
		}

		$this->_vista_completa('detalle-pendiente');
	}

	/**
	 * Funcion para cambiar el estado de los pendientes
	 * @author Diego Rodriguez
	 **/
	public function actualizar()
	{
		$id_pendiente 						= $this->input->post('id_pendiente');
		$estatus 									= $this->input->post('estatus');
		$estatus_text						  = $this->input->post('estatus_text');
		$id_ejecutivo_destino   	= $this->input->post('id_ejecutivo_destino');
		$ejecutivo_destino_text 	= $this->input->post('ejecutivo_destino_text');
		$id_ejecutivo_origen 			= $this->usuario_activo['id'];

		if (empty($id_ejecutivo_destino)) {
				if($this->pendienteModel->update(array('estatus' => $estatus), array('id_pendiente' => $id_pendiente))){
					$respuesta = array('exito' => TRUE, 'estatus' => $estatus_text);
				}else{
					$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consla o la base de datos');
			}
		}else{
			$this->load->model('reasignarPendienteModel');
			$this->load->helper('formatofechas');
			date_default_timezone_set('America/Mexico_City');

			$reasignacion = array(
				'id_pendiente' => $id_pendiente,
				'id_ejecutivo_origen' => $id_ejecutivo_origen,
				'id_ejecutivo_destino' => $id_ejecutivo_destino,
				'fecha' => fecha_completa(date('Y-m-d H:i:s'))
				);

			if($this->reasignarPendienteModel->insert($reasignacion) && 
				 $this->pendienteModel->update(array('id_ejecutivo' => $id_ejecutivo_destino, 'estatus' => 7), array('id_pendiente' => $id_pendiente)))
			{
				$respuesta = array('exito' => TRUE, 'id_ejecutivo_destino' => $ejecutivo_destino_text);
			}else{
				$respuesta = array('exito' => TRUE, 'msj' => 'No se reasigno, revisa la consola o la base de datos.');
			}
		}

		$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode($respuesta));
	}
}

/* End of file pendiente.php */
/* Location: ./application/controllers/pendiente.php */