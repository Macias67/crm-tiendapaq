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
	}

	public function index()
	{
		$this->_vista('principal');
	}

	public function add()
	{}

 /**
 * Funcion que insertara los clientes a la bd de CRM tiendapaq
 * basandose en un txt cargado por el ejecutivo
 * @author Diego Rodriguez
 **/
 	public function importar_clientes()
	{
		// Reglas de validacion
		$this->form_validation->set_rules('userfile',"El archivo", "file_required|file_min_size[5KB]|file_allowed_type[txt]|callback_pattern_check_clientes");
		if ($this->form_validation->run() == FALSE)
		{
			// Muestro vista de nuevo con errores
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error: </strong>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>',
					' <b><a href="'.site_url('catalogo').'" style="color:red">(Intentar de nuevo)</a></b></div>');

			$this->_vista('principal');
			//echo "no se encuentra el archivo o es incorrecto";
		} else
		{
			echo "archivo correcto entrando a preocesar";
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
}

/* End of file catalogo.php */
/* Location: ./application/controllers/catalogo.php */