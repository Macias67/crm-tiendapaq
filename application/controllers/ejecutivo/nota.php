<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('notastareaModel');
	}

	public function index()
	{}

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
			$id_tarea		= $this->input->post('id_tarea');
			$nota			= $this->input->post('nota');
			$privacidad		= $this->input->post('privacidad');

			$nueva_nota = array(
				'id_tarea'		=> $id_tarea,
				'privacidad'		=> $privacidad,
				'fecha_registro'=> date('Y-m-d H:i:s'),
				'nota'			=> ucfirst(strtolower($nota))
			);

			$id_nota 	= $this->notastareaModel->get_last_id_after_insert($nueva_nota);
			$msg 		= (!$id_nota) ? 'No se insertó en la base de datos.' : '';
			$response 	= array('exito' => TRUE, 'errores' => $msg);

			if (!empty($_FILES)) {
				// Armo las rutas y nombres de la imagen segun usuario activo
				$ruta	= 'assets/admin/pages/media/tareas/'.$id_tarea.'/'.$id_nota;
				//Si no existe directorio lo creo
				if (!is_dir($ruta))
				{
					mkdir($ruta, 0777, TRUE);
				}

				//Configuracion para la subida del archivo
				$config_upload['upload_path']		= $ruta;
				$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG|pdf';
				$config_upload['overwrite'] 		= TRUE;
				$config_upload['max_size']			= 2048;
				$config_upload['remove_spaces']	= TRUE;
				$this->load->library('upload', $config_upload);

				if (!$this->upload->do_upload('archivo')) {
					$response['errores']	= $this->upload->display_errors('', '<br>');
					$response['exito'] 		= FALSE;
				}
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

	public function edita()
	{
		if($this->input->is_ajax_request()) {
			$id_tarea		= $this->input->post('id_tarea');
			$id_nota		= $this->input->post('id_nota');
			$nota			= $this->input->post('nota');
			$privacidad		= $this->input->post('privacidad');

			$edita_nota = array(
				'id_nota'		=> $id_nota,
				'privacidad'		=> $privacidad,
				'nota'			=> ucfirst(strtolower($nota))
			);

			$update 	= $this->notastareaModel->update($edita_nota, array('id_nota' => $id_nota));
			$msg 		= (!$update) ? 'No se insertó en la base de datos.' : '';
			$response 	= array('exito' => TRUE, 'errores' => $msg);

			if (!empty($_FILES)) {
				// Armo las rutas y nombres de la imagen segun usuario activo
				$ruta	= 'assets/admin/pages/media/tareas/'.$id_tarea.'/'.$id_nota;
				//Si no existe directorio lo creo
				if (!is_dir($ruta))
				{
					mkdir($ruta, 0777, TRUE);
				}
				// Borro todo lo que haya
				$this->load->helper('file');
				delete_files($ruta);

				//Configuracion para la subida del archivo
				$config_upload['upload_path']		= $ruta;
				$config_upload['allowed_types']	= 'jpg|JPG|jpeg|JPEG|png|PNG|pdf';
				// $config_upload['file_name'] 		= 'nota';
				$config_upload['overwrite'] 		= TRUE;
				$config_upload['max_size']			= 2048;
				$config_upload['remove_spaces']	= TRUE;
				$this->load->library('upload', $config_upload);

				if (!$this->upload->do_upload('archivo')) {
					$response['errores']	= $this->upload->display_errors('', '<br>');
					$response['exito'] 		= FALSE;
				}
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}

	public function elimina()
	{
		$id_nota = $this->input->post('id');
		if ($nota = $this->notastareaModel->get_where(array('id_nota' => $id_nota))) {

			$exito = $this->notastareaModel->delete(array('id_nota' => $id_nota));
			if ($exito) {
				$this->load->helper('file');
				$dir = 'assets/admin/pages/media/tareas/'.$nota->id_tarea.'/'.$nota->id_nota;
				if (is_dir($dir)) {
					$exito = delete_files($dir, TRUE);
					rmdir($dir);
				}
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('exito' => $exito)));
		}
	}

	public function dropimagen()
	{
		$url = $this->input->post('url');
		$exito = FALSE;
		if (file_exists($url)) {
			$bye_file = unlink($url);
			$dir = pathinfo($url);
			$bye_dir = rmdir($dir['dirname']);
			$exito = $bye_file && $bye_dir;
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('exito' => $exito)));
	}

	public function modal($accion)
	{
		$id_nota = $this->uri->segment(4);
		if ($nota = $this->notastareaModel->get_where(array('id_nota' => $id_nota))) {
			switch ($accion) {
				case 'editar':
					$this->load->helper('formatofechas');

					$dir = 'assets/admin/pages/media/tareas/'.$nota->id_tarea.'/'.$nota->id_nota;
					if (is_dir($dir)) {
						$this->load->helper('directory');
						$map = directory_map($dir, 1);
						$this->data['imagen'] = $dir.'/'.$map[0];
					}
					$nota->privacidad = ($nota->privacidad == 'privada') ? 'checked' : '';
					$this->data['nota'] = $nota;
					$this->_vista_completa('nota/modal-edita-nota');
					break;
				default:
					# code...
					break;
			}
		}
	}
}

/* End of file notas.php */
/* Location: ./application/controllers/notas.php */