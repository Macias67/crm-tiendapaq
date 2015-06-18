<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para menenjar las cotizaciones
 * del lado del cliente
 *
 * @package default
 * @author Luis Macias
 **/
class Cotizacion extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cotizacionModel');
	}

	public function index()
	{

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

		if ($existe = $this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('/clientes/'.$this->usuario_activo['id'].'/cotizacion').'/';
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
	 * Funcion
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function comprobante($folio)
	{
		$campos = array('cotizacion.folio','cotizacion.id_cliente','cotizacion.id_estatus_cotizacion','clientes.razon_social');
		$joins = array('clientes');

		//cargo los comentarios
		$this->load->model('comentariosCotizacionModel');
		$this->load->helper('formatofechas_helper');
		$comentarios = $this->comentariosCotizacionModel->get_comentarios($folio);
		$this->comentariosCotizacionModel->marcar_comentarios_visto($folio, 'E');
		$this->data['comentarios'] = $comentarios;

		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($campos, $joins, $folio)) {
			$this->load->model('estatusCotizacionModel');
			$this->data['cotizacion'] = $cotizacion;
			if ($cotizacion->id_estatus_cotizacion == $this->estatusCotizacionModel->PORPAGAR ||
				$cotizacion->id_estatus_cotizacion == $this->estatusCotizacionModel->IRREGULAR ||
				$cotizacion->id_estatus_cotizacion == $this->estatusCotizacionModel->PARCIAL ||
				$cotizacion->id_estatus_cotizacion == $this->estatusCotizacionModel->CXC)
			{
				$this->_vista('formulario');
			} else
			{
				$this->load->helper('directory');
				$archivos = directory_map('./clientes/'.$this->usuario_activo['id'].'/comprobantes/'.$folio.'/', 1);
				// Descarto la carpeta de las thumnail
				foreach ($archivos as $index => $archivo) {
					if ($archivos[$index] == 'thumbnail') {
						unset($archivos[$index]);
					}
				}
				$this->data['archivos'] = $archivos;
				$this->_vista('archivos');
			}
		} else {
			show_404();
		}
	}

	/**
	 * Funcion encargada de subir los archivos mediante
	 * AJAX y el plugin
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function ajax($cliente, $folio)
	{
		error_reporting(E_ALL | E_STRICT);
		$params = array(
			'script_url' 			=> site_url('cotizacion/ajax/'.$cliente.'/'.$folio),
			'upload_dir' 		=> dirname($this->input->server('SCRIPT_FILENAME')).'/clientes/'.$cliente.'/comprobantes/'.$folio.'/',
			'upload_url' 		=> site_url('clientes/'.$cliente.'/comprobantes/'.$folio).'/',
			'max_number_of_files' 	=> 3,
			'accept_file_types'		=> '/\.(gif|jpe?g|png|pdf)$/i',
			'image_file_types'		=> '/\.(gif|jpe?g|png)$/i',
			// Image resolution restrictions:
			'max_width'			=> null,
			'max_height'			=> null,
			'min_width'				=> 1,
			'min_height'			=> 1,
			'image_versions'	=> array(
				'' => array(
					'auto_orient'	=> true,
					'crop' 			=> false,
					'max_width'	=> 1600,
					'max_height'	=> 1200
				),
				// 'medium' => array(
				// 	'crop' 			=> true,
				// 	'max_width'	=> 1024,
				// 	'max_height'	=> 768
				// ),
				'thumbnail' => array(
					'auto_orient'	=> true,
					'crop' 			=> true,
					'max_width'	=> 200,
					'max_height'	=> 150
				)
			)
		);
		$this->load->library("UploadHandler", $params);
	}

	public function estado()
	{
		$this->load->model('estatusCotizacionModel');
		$this->load->helper('directory');

		$folio 	= $this->input->post('folio');
		$cxc 	= $this->input->post('cxc');

		$archivos = directory_map('./clientes/'.$this->usuario_activo['id'].'/comprobantes/'.$folio.'/', 1);
		// Descarto la carpeta de las thumnail
		foreach ($archivos as $index => $archivo) {
			if ($archivos[$index] == 'thumbnail') {
				unset($archivos[$index]);
			}
		}
		$total = count($archivos);
		if ($total == 0 && (!isset($archivos['thumbnail']) || count($archivos['thumbnail']) == 0))
		{
			$response = array('exito' => FALSE, 'total' => $total, 'msj' => 'Tienes que agregar mínimo un archivo para comprobar tu pago.');
		} else
		{
			if ($this->cotizacionModel->exist(array('folio' => $folio, 'id_estatus_cotizacion' => $this->estatusCotizacionModel->PORPAGAR)) ||
				$this->cotizacionModel->exist(array('folio' => $folio, 'id_estatus_cotizacion' => $this->estatusCotizacionModel->IRREGULAR)) ||
				$this->cotizacionModel->exist(array('folio' => $folio, 'id_estatus_cotizacion' => $this->estatusCotizacionModel->PARCIAL)) ||
				$this->cotizacionModel->exist(array('folio' => $folio, 'id_estatus_cotizacion' => $this->estatusCotizacionModel->CXC)))
			{
				if ($cxc == $this->estatusCotizacionModel->CXC) {
					$exito = $this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->CXC),
						array('folio' => $folio));
					$response = array('exito' => $exito);
				}else{
					$exito = $this->cotizacionModel->update(
						array('id_estatus_cotizacion' => $this->estatusCotizacionModel->REVISION),
						array('folio' => $folio));
					$response = array('exito' => $exito);
				}
			}else{
				$response = array('exito' => FALSE, 'msj' => 'Qué pena, esto no debería estar pasando.');
			}
		}

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
	public function descarga($folio)
	{
		$this->load->helper('download');

		if ($this->cotizacionModel->exist(array('folio' => $folio)))
		{
			$dir_root	= site_url('/clientes/'.$this->usuario_activo['id'].'/cotizacion').'/';
			$name		= 'tiendapaq-cotizacion_'.$folio.'.pdf';
			$path 	= $dir_root.$name;
			force_download($name, file_get_contents($path));
		}
	}

	/**
	 * funcion para cancelar una cotizacion
	 *
	 * @author Diego Rodriguez
	 **/
	public function cancelar()
	{
		$this->load->model('estatusCotizacionModel');
		$folio = $this->input->post('folio');

		if($this->cotizacionModel->update(array('id_estatus_cotizacion' => $this->estatusCotizacionModel->CANCELADA),array('folio' => $folio))){
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>La cotización fue cancelada.</h4>' );
		}else{
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! Revisa la consola para más información.</h4>' );
		}

		//mando la repuesta
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion para guardar los comentarios de la cotizacion
	 * @author Diego Rodriguez
	 **/
	public function comentarios()
	{
		$comentario = array(
			'folio'        		=> $this->input->post('folio'),
			'fecha'        		=> date('Y-m-d H:i:s'),
			'tipo' 	       		=> 'C',
			'id_ejecutivo' 	=>	1,
			'comentario'   	=> $this->input->post('comentario'),
		);

		$this->load->model('comentariosCotizacionModel');

		if($this->comentariosCotizacionModel->insert($comentario)){
			//notifico que hay mensajes no vistos e incremento el numero de mensajes
			$this->load->model('cotizacionModel');
			$this->cotizacionModel->update(array('visto' => 0),array('folio' => $comentario['folio']));
			$this->cotizacionModel->incrementa_comentarios($comentario['folio']);

			$respuesta = array('exito' => TRUE);
		}else{
			$respuesta = array('exito' => FALSE);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	/**
	 * Modal para mostrar archivos
	 * de una cotizacion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function archivos($folio)
	{
		$campos = array(
			'cotizacion.id_cliente',
			'cotizacion.id_estatus_cotizacion',
			'clientes.razon_social');
		if ($cotizacion = $this->cotizacionModel->get_cotizacion_cliente($campos, array('clientes'), $folio)) {
			$archivos 				= $this->cotizacionModel->get_files_cotizacion($cotizacion->id_cliente, $folio);
			$this->data['archivos'] 	= $archivos;
			$this->_vista_completa('cotizacion/modal-archivos-cotizacion');
		} else {
			show_404();
		}
	}
}

/* End of file cotizacion.php */
/* Location: ./application/controllers/cotizacion.php */