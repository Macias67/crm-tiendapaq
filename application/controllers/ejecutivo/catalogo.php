<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase para importar contactos de txt a
 * la bd de crm tiendapar
 *
 * @author Diego Rodriguez
 **/
class Catalogo extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//librerias
		$this->load->helper('form');
		$this->load->library('form_validation');
		// Cargo modelos
		$this->load->model('clienteModel');
		$this->load->model('productoModel');
		//mensajes de errores de subida de archivos
		$this->data['upload_error'] = '';
	}

	public function index()
	{
		$tipo = $this->uri->segment(2);
		if ($tipo === 'clientes' || $tipo === 'productos')
		{
			$this->data['tipo'] = $tipo;
			$this->_vista('principal');
		} else {
			show_404();
		}
	}

	public function add()
	{}

	 /**
	 * Funcion que insertara los clientes a la bd de CRM tiendapaq
	 * basandose en un txt cargado por el ejecutivo
	 * @author Diego Rodriguez
	 **/
	public function importar($tipo)
	{
		if ($tipo === 'clientes' || $tipo === 'productos') {
			// Reglas de validacion
			$this->form_validation->set_rules('userfile',"El archivo", "file_required|file_min_size[5KB]|file_allowed_type[txt]|callback_pattern_check_".$tipo);
			// Valido
			if ($this->form_validation->run() == FALSE)
			{
				// Muestro vista de nuevo con errores
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error: </strong>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
				' <b><a href="'.site_url('catalogo/importar/'.$tipo).'" style="color:red">(Intentar de nuevo)</a></b></div>');
				$this->data['tipo'] = $tipo;
				$this->_vista('principal');
			} else
			{
				$ruta	= 'src/'.$this->usuario_activo['usuario'];
				// Si no existe la carpeta upload
				if (!is_dir($ruta)) {
					mkdir($ruta, 0777, TRUE);
				}

				//Configuracion para la subida del archivo
				$config_upload['upload_path']		= $ruta;
				$config_upload['allowed_types']	= 'txt';
				$config_upload['overwrite'] 		= TRUE;
				$config_upload['remove_spaces']	= TRUE;

				// Cargo libreria upload
				$this->load->library('upload', $config_upload);

				// Si no es exitosa la subida
				if (!$this->upload->do_upload())
				{
					// Formato para mostrar los mensajes de error
					$this->data['upload_error'] = $this->upload->display_errors('<div class="notice error"><i class="icon-remove-sign icon-large"></i>',
					'<a href="#close" class="icon-remove"></a></div>');
					// Muestro vista de nuevo con errores de subida
					$this->_vista('principal');
				} else
				{
					// Asigno el objeto modelo a usar
					$objectModel = ($tipo === 'clientes') ? $this->clienteModel : $this->productoModel;
					// Asigno info de la subida a la variable
					$file_info = $this->upload->data();
					// Si no hay ningun cliente en la BD
					if (!$objectModel->count())
					{
						// Transformo el contenido del TXT a un array de arrays asociativos
						$arrayDataTxt = $objectModel->transformTXT($file_info['full_path'], 'array');
						// Guardo array de todos los clientes en la BD, si es exitoso
						if ($objectModel->insertBatch($arrayDataTxt)) {
							// Borro el archivo que fue subido
							unlink($file_info['full_path']);
							//Borro carpeta
							rmdir($ruta);
							// Cargo vista a pagina principal
							redirect(base_url());
						}
					} else
					{
						// Transformo el contenido del TXT a un array de objetos
						$arrayDataTxt = $objectModel->transformTXT($file_info['full_path'], 'objeto');
						// Comparo datos de la BD con los del TXT
						if($objectModel->compararDatos($arrayDataTxt))
						{
							// Borro el archivo que fue subido
							unlink($file_info['full_path']);
							//Borro carpeta
							rmdir($ruta);
							// Cargo vista successr
							redirect(base_url());
						}
					}
				}
			}
		} else {
			# code...
		}
	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Funcion callback para regla de validacion
	 * comprueba si el archivo a subir tiene
	 * el patron requerido para procesarse
	 * @param  array $file Array del archivo subido
	 * @return boolean Si tiene el patron retorna TRUE
	 */
	public function pattern_check_clientes($file)
	{
		$this->load->model('clienteModel');
		if ($this->clienteModel->pattern_check($file)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('pattern_check_clientes', 'El archivo no tiene el patrón requerido.');
			return FALSE;
		}
	}

	/**
	 * Funcion callback para regla de validacion
	 * comprueba si el archivo a subir tiene
	 * el patron requerido para procesarse
	 * @param  array $file Array del archivo subido
	 * @return boolean       Si tiene el patron retorna TRUE
	 */
	public function pattern_check_productos($file)
	{
		if ($this->productoModel->pattern_check($file)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('pattern_check_productos', 'El archivo no tiene el patrón requerido.');
			return FALSE;
		}
	}
}

/* End of file catalogo.php */
/* Location: ./application/controllers/catalogo.php */