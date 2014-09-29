<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para llevar acabo la cotizacion
 * a un cliente
 *
 * @author Luis Macias
 **/
class Cotizador extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('productoModel');
		$this->load->model('cotizacionModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('clienteModel');
	}

	/**
	 * Vista Principal
	 *
	 * @author Luis Macias
	 **/
	public function index()
	{
		$this->data['sig_folio']				= $this->cotizacionModel->getSiguienteFolio();
		$this->data['nombre_completo']	= $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'];
		$this->data['id_ejecutivo']			= $this->usuario_activo['id'];
		$this->_vista('index');
	}

	public function add()
	{}

	/**
	 * Metodo para mostrar las empresas
	 * de menera de JSON
	 *
	 * @param $codigo
	 * @return void
	 * @author Luis Macias
	 **/
	public function json($codigo = null)
	{
		if (is_null($codigo)) {
			$query	= $this->input->post('q');
			$limit 	= $this->input->post('page_limit');
			if (!empty($query) && !empty($limit)) {
				$resultados = $this->productoModel->get_select_query(
					array('codigo','descripcion'),
					$query,
					$limit);
				$res = array();
				if (!empty($resultados)) {
					foreach ($resultados as $value) {
						array_push($res, array("id" => $value->codigo, "text" => $value->descripcion));
					}
				} else {
					$res = array("id"=>"0","text"=>"No se encontraron resultados...");
				}
			}
		} else {
			$res = $this->productoModel->get_like(
					array('*'),
					'codigo',
					$codigo,
					'descripcion',
					'ASC',
					1);
			$res = $res[0];
		}

		// Muestro la salida
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($res));
	}

	/**
	 * Funcion para crear los pdf temporales
	 * para la vista previa antes de enviarlos a un cliente
	 *
	 * @author Luis Macias
	 **/
	public function previapdf()
	{

		// Datos para la cotizacion
		$cotizacion	= $this->input->post('cotizacion');
		$cliente		= $this->input->post('cliente');
		$productos 	= $this->input->post('productos');

		// Info del cliente
		$data_cliente = $this->clienteModel->get(
			array('id','razon_social', 'rfc'),
			array('id' => $cliente['id']));

		//Info del ejecutivo
		$data_ejecutivo = $this->ejecutivoModel->get(
			array('primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno'),
			array('id' => $cotizacion['ejecutivo']));
		// Nombre del ejecurivo
		$nombre = 	$data_ejecutivo[0]->primer_nombre.' '.
					$data_ejecutivo[0]->segundo_nombre.' '.
					$data_ejecutivo[0]->apellido_paterno.' '.
					$data_ejecutivo[0]->apellido_materno;

		// Folio de la cotizacion
		$folio = $this->cotizacionModel->getSiguienteFolio();

		// Ejemplo de HTML2PDF
	    	$content = "
	    	<page backtop='7mm' backbottom='7mm' backleft='10mm' backright='10mm'>

			<h1>Datos de la cotización</h1>

			<h5>Folio: </h5>
			<p>".$cotizacion['folio']."</p>

			<h5>Fecha: </h5>
			<p>".date('Y-m-d')."</p>

			<h5>Ejecutivo: </h5>
			<p>$nombre</p>

			<h5>Cliente: </h5>
			<p>".$data_cliente[0]->id." - ".$data_cliente[0]->rfc." - ".$data_cliente[0]->razon_social."</p>

			<h5>Productos: </h5>
		";

		foreach ($productos as $producto) {
			$content .= "<b>".$producto['codigo'].' - '.$producto['descripcion']."</b>";
			$content .= "<p style='font-size: 12px'>".$producto['observacion']."</p>";
		}

		$content .= "</page>";

		require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
		$html2pdf = new HTML2PDF('P','LETTER','es');
		$html2pdf->WriteHTML($content);

		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/tmp/cotizacion/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}
		$name		= 'tmp'.$cotizacion['ejecutivo'].''.$data_cliente[0]->id.'-'.$cotizacion['folio'].'.pdf';
		$path 		= $dir_root.$name;

		$html2pdf->Output($path, 'F');
	}

	/**
	 * Funcion para crear los pdf y enviarlos
	 * via email al cliente
	 *
	 * @author Luis Macias
	 **/
	public function enviapdf()
	{
		// Datos para la cotizacion
		$cotizacion	= $this->input->post('cotizacion');
		$cliente		= $this->input->post('cliente');
		$productos 	= $this->input->post('productos');

		// Info del cliente
		$data_cliente = $this->clienteModel->get(
			array('id','razon_social', 'rfc'),
			array('id' => $cliente['id']));

		//Info del ejecutivo
		$data_ejecutivo = $this->ejecutivoModel->get(
			array('primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno', 'oficina'),
			array('id' => $cotizacion['ejecutivo']));
		// Nombre del ejecurivo
		$nombre = 	$data_ejecutivo[0]->primer_nombre.' '.
					$data_ejecutivo[0]->segundo_nombre.' '.
					$data_ejecutivo[0]->apellido_paterno.' '.
					$data_ejecutivo[0]->apellido_materno;

		// Folio de la cotizacion
		$folio = $this->cotizacionModel->getSiguienteFolio();

	    	// Ejemplo de HTML2PDF
	    	$content = "
	    	<page backtop='7mm' backbottom='7mm' backleft='10mm' backright='10mm'>

			<h1>Datos de la cotización</h1>

			<h5>Folio: </h5>
			<p>".$folio."</p>

			<h5>Fecha: </h5>
			<p>".date('Y-m-d')."</p>

			<h5>Ejecutivo: </h5>
			<p>$nombre</p>

			<h5>Cliente: </h5>
			<p>".$data_cliente[0]->id." - ".$data_cliente[0]->rfc." - ".$data_cliente[0]->razon_social."</p>

			<h5>Productos: </h5>
		";

		foreach ($productos as $producto) {
			$content .= "<b>".$producto['codigo'].' - '.$producto['descripcion']."</b>";
			$content .= "<p style='font-size: 12px'>".$producto['observacion']."</p>";
		}

		$content .= "</page>";

		require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
		$html2pdf = new HTML2PDF('P','LETTER','es');
		$html2pdf->WriteHTML($content);

		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$data_cliente[0]->id.'/cotizacion/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}
		$name		= 'cotizacion-'.$folio.'.pdf';
		$path 		= $dir_root.$name;

		// Borro PDF temporal
		$dir_tmp		= $this->input->server('DOCUMENT_ROOT').'/tmp/cotizacion/';
		$name_tmp	= 'tmp'.$cotizacion['ejecutivo'].$data_cliente[0]->id.'-'.$folio.'.pdf';
		unlink($dir_tmp.$name_tmp);
		// Guardo PDF finals
		$html2pdf->Output($path, 'F');

		// Guardo en la base de datos
		$this->load->model('oficinasModel');
		$oficina = $this->oficinasModel->get(
			array('id_oficina'),
			array('ciudad_estado' => $data_ejecutivo[0]->oficina),
			null,
			'ASC',
			1
		);

		$cotizacion = array(
			'fecha'			=> date('Y-m-d'),
			'agente'		=> $cotizacion['ejecutivo'],
			'cliente'		=> $cliente['id'],
			'oficina'		=> $oficina->id_oficina,
			'cotizacion'		=> json_encode($productos),
			'observaciones'	=> 1,
			'banco'			=> 1,
			'estatus'		=> 1);

		if($this->cotizacionModel->insert($cotizacion)) {
			echo json_encode($cotizacion);
		}
	}

}

/* End of file cotizador.php */
/* Location: ./application/controllers/cotizador.php */