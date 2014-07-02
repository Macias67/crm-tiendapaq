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
		// Cargo modelo
		$this->load->model('pendienteModel');
	}

	public function index()
	{
		
	}

	/**
	 * Método para agregar un pendiente a la BD
	 *
	 * @author Luis Macias
	 **/
	public function add()
	{
		$this->form_validation->set_rules('ejecutivo', 'Ejecutivo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|require|xss_clean');
		$this->form_validation->set_rules('actividad', 'Actividad', 'trim|required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|min_length[5]|max_length[140]|xss_clean');

		if ($this->form_validation->run() === FALSE)
		{
			// SI es FALSO, vuelvo a mostrar vista
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
			// Captruo los datos en un array
			$data = array(
				'id_ejecutivo'	=> $this->input->post('ejecutivo'),
				'id_creador'	=> $this->usuario_activo['id'],
				'id_empresa'	=>$this->input->post('razon_social'),
				'actividad'		=> $this->input->post('actividad'),
				'estatus'		=> 0,
				'descripcion'	=> $this->input->post('descripcion')
			);
			// Transfomo arreglo a objeto
			$objeto_pendiente = $this->pendienteModel->arrayToObject($data);
			// Si se inserta correctamente a la bd
			if ($this->pendienteModel->insert($objeto_pendiente)) {

				// Cargo modelo ejecutivos
				$this->load->model('ejecutivoModel');
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
}

/* End of file pendiente.php */
/* Location: ./application/controllers/pendiente.php */