<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para llevar acabo la cotizacion
 * a un cliente
 *
 * @author Luis Macias
 **/
class Cotizador extends AbstractAccess {

	private $DIAS_VIGENCIA = 60;

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
		// Formato fechas
		$this->load->helper('formatofechas');
		$this->data['sig_folio']				= $this->cotizacionModel->getSiguienteFolio();
		$this->data['nombre_completo']	= $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'];
		$this->data['id_ejecutivo']			= $this->usuario_activo['id'];
		$this->data['vigencia']				= $this->DIAS_VIGENCIA.' días de vigencia.';
		$this->data['fecha_vigencia']		= date('d/m/Y', strtotime('+'.$this->DIAS_VIGENCIA.' day'));
		$this->_vista('index');
	}

	public function pendiente($id_pendiente)
	{
		// Cargo modelos
		$this->load->model('pendienteModel');
		if ($this->pendienteModel->exist(array('id_pendiente' => $id_pendiente))) {
			//Helper
			$this->load->helper('formatofechas');

			$pendiente	= $this->pendienteModel->getPendiente($id_pendiente,
													array('pendientes.id_pendiente',
																'clientes.razon_social',
																'actividades_pendiente.id_actividad as id_actividad_pendiente',
																'actividades_pendiente.actividad',
																'pendientes.descripcion',
																'pendientes.fecha_origen',
																'creador.primer_nombre as creador_nombre',
																'creador.apellido_paterno as creador_apellido',
																'ejecutivo.primer_nombre as ejecutivo_nombre',
																'ejecutivo.apellido_paterno as ejecutivo_apellido',
																'creador.oficina as oficina',
																'pendientes.id_estatus_general'));

			$this->data['pendiente']				= $pendiente;
			$this->data['sig_folio']				= $this->cotizacionModel->getSiguienteFolio();
			$this->data['nombre_completo']	= $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'];
			$this->data['id_ejecutivo']			= $this->usuario_activo['id'];
			$this->data['vigencia']				= $this->DIAS_VIGENCIA.' días de vigencia.';
			$this->data['fecha_vigencia']		= date('d/m/Y', strtotime('+'.$this->DIAS_VIGENCIA.' day'));
			$this->_vista('index');
		} else {
			show_404();
		}
	}

	public function vigencia()
	{
		$vigencia	= $this->input->post('fecha');
		$vigencia	= explode('/', $vigencia);
		$diferecnia	= strtotime($vigencia[2].'/'.$vigencia[1].'/'.$vigencia[0]) - time();
		$dias		= floor($diferecnia/(60*60*24));
		$dias 		= ($dias == 1) ? $dias.' día de vigencia.' : $dias.' días de vigencia.';
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('dias' => $dias)));
	}

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
		$pendiente 	= $this->input->post('pendiente');

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

		// Si no existe la carpeta cotizacion del cliente la creo
		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$data_cliente[0]->id.'/cotizacion/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}
		$name		= 'tiendapaq-cotiza_'.$folio.'.pdf';
		$path 		= $dir_root.$name;

		// Si no existe la carpeta comprobantes del cliente la creo
		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$data_cliente[0]->id.'/comprobantes/'.$folio.'/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}

		// Borro PDF temporal
		$dir_tmp		= $this->input->server('DOCUMENT_ROOT').'/tmp/cotizacion/';
		$name_tmp	= 'tmp'.$cotizacion['ejecutivo'].$data_cliente[0]->id.'-'.$folio.'.pdf';
		$file = $dir_tmp.$name_tmp;
		// Si existe temporal lo borro
		if (is_file($file)) {
			unlink($file);
		}
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

		// Quito pendiente si es que es pendiente
		if (!empty($pendiente)) {
			// Cargo modelos
			$this->load->model('pendienteModel');
			$this->load->model('estatusGeneralModel');
			$this->pendienteModel->update(array('id_estatus_general' => $this->estatusGeneralModel->CERRADO), array('id_pendiente' => $pendiente));
		}

		$array_fecha	= explode('/', $cotizacion['vigencia']);
		$vigencia		= $array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];

		$this->load->model('estatusCotizacionModel');

		$cotizacion = array(
			'fecha'					=> date('Y-m-d'),
			'vigencia'				=> $vigencia,
			'id_ejecutivo'			=> $cotizacion['ejecutivo'],
			'id_cliente'				=> $cliente['id'],
			'id_oficina'				=> $oficina->id_oficina,
			'cotizacion'				=> json_encode($productos),
			'id_observaciones'		=> 1,
			'id_banco'				=> 1,
			'id_estatus_cotizacion'	=> $this->estatusCotizacionModel->PORPAGAR);

		if($this->cotizacionModel->insert($cotizacion)) {
			echo json_encode($cotizacion);
		}
	}

}

/* End of file cotizador.php */
/* Location: ./application/controllers/cotizador.php */