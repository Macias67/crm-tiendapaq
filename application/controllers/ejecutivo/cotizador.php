<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controlador para llevar acabo la cotizacion
 * a un cliente
 *
 * @author Luis Macias |Diego Rodriguez
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
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function index()
	{
		// Modelo para los bancos
		$this->load->model('bancomodel');
		$this->data['bancos']				= $this->bancomodel->get(array('id_banco', 'banco'));
		// Formato fechas
		$this->load->helper('formatofechas');
		$this->data['sig_folio']				= $this->cotizacionModel->getSiguienteFolio();
		$this->data['nombre_completo']	= $this->usuario_activo['primer_nombre'].' '.$this->usuario_activo['apellido_paterno'];
		$this->data['id_ejecutivo']			= $this->usuario_activo['id'];
		$this->data['vigencia']				= $this->DIAS_VIGENCIA.' días de vigencia.';
		$this->data['fecha_vigencia']		= date('d/m/Y', strtotime('+'.$this->DIAS_VIGENCIA.' day'));
		// creo la contraseña para cxc.
		$fechapsw     	= date('mYd');
		$fechapsw = $fechapsw.$this->cotizacionModel->getSiguienteFolio();
		$this->data['fechapsw']				= $fechapsw;
		$this->_vista('index');
	}

	/**
	 * Muestro el cotizador con la informacion
	 * del pendiente que solicita cotizar
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function pendiente($id_pendiente)
	{
		// Cargo modelos
		$this->load->model('pendienteModel');
		$this->load->model('bancomodel');
		if ($this->pendienteModel->exist(array('id_pendiente' => $id_pendiente))) {
			//Helper
			$this->load->helper('formatofechas');
			$pendiente	= $this->pendienteModel->getPendiente(
								$id_pendiente,
								array(
									'pendientes.id_pendiente',
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
									'pendientes.id_estatus_general'
								));
			$this->data['bancos']				= $this->bancomodel->get(array('id_banco', 'banco'));
			$this->data['pendiente']			= $pendiente;
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

	/**
	 * Calcula los dias de la vigencia
	 * de una cotizacion
	 *
	 * @return void
	 * @author Luis Macias
	 **/
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
	 * Metodo para buscar y obtener productos
	 * de menera de JSON para el cotizador
	 *
	 * @param $opcion
	 * @return json
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function producto($opcion)
	{
		switch ($opcion) {
			case 'buscar':
				$query	= $this->input->post('q');
				$limit 	= $this->input->post('page_limit');
				if (!empty($query) && !empty($limit)) {
					$resultados = $this->productoModel->get_productos_like(
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
			break;

			case 'agregar':
				$codigo = $this->input->post('codigo');
				$res = $this->productoModel->get(array('*'),array('codigo' => $codigo), null,'ASC',1);
				//$res = $res[0];
			break;
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
	 * @author Luis Macias | Diego Rodriguez
	 **/
	public function previapdf()
	{
		// Datos para la cotizacion
		$cotizacion	= $this->input->post('cotizacion');
		$cliente		= $this->input->post('cliente');
		$productos 	= $this->input->post('productos');
		$total 			= $this->input->post('total');
		$cxc		= $this->input->post('cxc');
		$psw		= $this->input->post('fechapsw');
		$pass 		= $this->input->post('pass');
		var_dump("expression");
		var_dump($cxc);
		var_dump($psw);
		var_dump($pass);

		//Oficina de expedicion
		$this->load->model('oficinasModel');
		$oficina_ejecutivo = $this->ejecutivoModel->get('oficina', array('id' => $this->usuario_activo['id']), null, 'ASC', 1);
		$oficina = $this->oficinasModel->get_where(array('ciudad_estado' => $oficina_ejecutivo->oficina));

		// Seccion cotizacion

		// Folio de la cotizacion
		$cotizacion['folio'] = $this->cotizacionModel->getSiguienteFolio();
		// Datos ejecutivo
		$data_ejecutivo = $this->ejecutivoModel->get(
			array('primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno'),
			array('id' => $cotizacion['ejecutivo']));
		// Nombre del ejecutivo
		$nombre = 	$data_ejecutivo[0]->primer_nombre.' '.
					$data_ejecutivo[0]->segundo_nombre.' '.
					$data_ejecutivo[0]->apellido_paterno.' '.
					$data_ejecutivo[0]->apellido_materno;
		$cotizacion['agente'] = $nombre;

		// Info del cliente
		$data_cliente = $this->clienteModel->get(
			array('id','razon_social', 'rfc'),
			array('id' => $cliente['id']));
		$this->load->model('contactosModel');
		$campos = array('clientes.razon_social',
		               		'contactos.nombre_contacto',
		               		'contactos.apellido_paterno',
		               		'contactos.apellido_materno',
		               		'contactos.email_contacto',
		               		'contactos.telefono_contacto');
		$cliente = $this->contactosModel->getClientePorContacto($campos, $cliente['contacto']);

		$cliente  = array('razon_social' => $cliente->razon_social,
		                  		'contacto' => $cliente->nombre_contacto.' '.$cliente->apellido_paterno.' '.$cliente->apellido_materno,
		                  		'telefono' => $cliente->telefono_contacto,
		                  		'email' => $cliente->email_contacto);

		// Banco
		$this->load->model('bancoModel');
		$banco = $this->bancoModel->get_where(array('id_banco' => $cotizacion['banco']));

		// Creo directorio para pdf
		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/tmp/cotizacion/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}
		$name		= 'tmp'.$cotizacion['ejecutivo'].$data_cliente[0]->id.'-'.$cotizacion['folio'].'.pdf';
		$path 		= $dir_root.$name;

		//echo json_encode(array('data' =>$oficina));

		$this->_pdf($oficina, $cotizacion, $cliente, $productos, $total, $banco, $path);
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
		$total 			= $this->input->post('total');
		$pendiente 	= $this->input->post('pendiente');
		$cxc		= $this->input->post('cxc');
		$psw		= $this->input->post('fechapsw');
		$pass 		= $this->input->post('pass');
		//Oficina de expedicion
		$this->load->model('oficinasModel');
		$oficina_ejecutivo = $this->ejecutivoModel->get('oficina', array('id' => $this->usuario_activo['id']), null, 'ASC', 1);
		$oficina = $this->oficinasModel->get_where(array('ciudad_estado' => $oficina_ejecutivo->oficina));

		// Datos ejecutivo
		$data_ejecutivo = $this->ejecutivoModel->get(
			array('primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno'),
			array('id' => $cotizacion['ejecutivo']));
		// Nombre del ejecutivo
		$nombre = 	$data_ejecutivo[0]->primer_nombre.' '.
					$data_ejecutivo[0]->segundo_nombre.' '.
					$data_ejecutivo[0]->apellido_paterno.' '.
					$data_ejecutivo[0]->apellido_materno;
		$cotizacion['agente'] = $nombre;

		// Info del cliente
		$data_cliente = $this->clienteModel->get(
			array('id','razon_social', 'rfc', 'usuario', 'password'),
			array('id' => $cliente['id']));
		$this->load->model('contactosModel');
		$campos = array(
						'clientes.id',
						'clientes.razon_social',
						'contactos.id AS id_contacto',
						'contactos.nombre_contacto',
						'contactos.apellido_paterno',
						'contactos.apellido_materno',
						'contactos.email_contacto',
						'contactos.telefono_contacto');
		$cliente = $this->contactosModel->getClientePorContacto($campos, $cliente['contacto']);

		$cliente  = array(
			'id' 				=> $cliente->id,
			'razon_social' 	=> $cliente->razon_social,
			'id_contacto' 	=> $cliente->id_contacto,
			'contacto' 		=>  $cliente->nombre_contacto.' '.$cliente->apellido_paterno.' '.$cliente->apellido_materno,
			'telefono' 		=> $cliente->telefono_contacto,
			'email' 			=> $cliente->email_contacto
		);

		// Banco
		$this->load->model('bancoModel');
		$banco = $this->bancoModel->get_where(array('id_banco' => $cotizacion['banco']));

		// PREPARO INFO PARA BD
		$array_fecha	= explode('/', $cotizacion['vigencia']);
		$vigencia		= $array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];

		$this->load->model('estatusCotizacionModel');
		$id_estatusCotizacion = $this->estatusCotizacionModel->PORPAGAR;
		// Verifico si la cotización es por caso por pagar (CXC)
		if($cxc){ //faltó esta línea
			if ($cxc&&($psw==$pass)) {
				$id_estatusCotizacion = 8;
			}
		}

		$nueva_cot = array(
			'fecha'      	 			=> date('Y-m-d H:i:s'),
			'vigencia'				=> $vigencia,
			'id_ejecutivo'			=> $cotizacion['ejecutivo'],
			'id_cliente'				=> $cliente['id'],
			'id_contacto'			=> $cliente['id_contacto'],
			'id_oficina'				=> $oficina->id_oficina,
			'cotizacion'				=> json_encode($productos),
			'id_observaciones'		=> 1,
			'id_banco'				=> 1,
			'id_estatus_cotizacion'	=> $id_estatusCotizacion);

		// Establezco FOLIO REAL y guardo en LA BD
		$cotizacion['folio'] = $this->cotizacionModel->get_last_id_after_insert($nueva_cot);

		// Si no existe la carpeta cotizacion del cliente la creo
		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cliente['id'].'/cotizacion/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}
		$name		= 'tiendapaq-cotizacion_'.$cotizacion['folio'].'.pdf';
		$path 		= $dir_root.$name;

		// Si no existe la carpeta comprobantes del cliente la creo
		$dir_root	= $this->input->server('DOCUMENT_ROOT').'/clientes/'.$cliente['id'].'/comprobantes/'.$cotizacion['folio'].'/';
		if (!is_dir($dir_root)) {
			mkdir($dir_root, DIR_WRITE_MODE, TRUE);
		}

		// Borro PDF temporal
		$dir_tmp		= $this->input->server('DOCUMENT_ROOT').'/tmp/cotizacion/';
		$name_tmp	= 'tmp'.$cotizacion['ejecutivo'].$cliente['id'].'-'.$cotizacion['folio'].'.pdf';
		$file = $dir_tmp.$name_tmp;
		// Si existe temporal lo borro
		if (is_file($file)) {
			unlink($file);
		}

		// Quito pendiente si es que es pendiente
		if (!empty($pendiente)) {
			// Cargo modelos
			$this->load->model('pendienteModel');
			$this->load->model('estatusGeneralModel');
			$this->pendienteModel->update(array('id_estatus_general' => $this->estatusGeneralModel->CERRADO), array('id_pendiente' => $pendiente));
		}

		// Guardo PDF finals
		$this->_pdf($oficina, $cotizacion, $cliente, $productos, $total, $banco, $path);

		$exito = TRUE;
		if (!LOCAL) {
			//Envio Email con el PDF
			$this->load->library('email');
			$this->load->helper('formatofechas');
			$this->email->set_mailtype('html');
			$this->email->from('cotizacion@moz67.com','Cotización TiendaPAQ');
			$this->email->to($cliente['email']);
			//$this->email->cc('another@example.com');
			//$this->email->bcc('and@another.com');
			$this->email->subject('Envío de Cotización TiendaPAQ');
			// Contenido del correo
			$this->data['usuario'] 		= $data_cliente[0]->usuario;
			$this->data['password'] 	= $data_cliente[0]->password;
			$this->data['folio'] 			= $folio;
			$this->data['fecha'] 		= fecha_completa(date('Y-m-d H:i:s'));
			$this->data['vigencia'] 		= fecha_completa($vigencia);
			$this->data['contacto'] 	= $cliente['contacto'];
			$this->data['estatus'] 		= ucwords('Por Pagar');
			$html = $this->load->view('admin/general/full-pages/email/email_envio_cotizacion.php', $this->data,TRUE);
			$this->email->message($html);
			// Adjunto PDF
			$this->email->attach($path);
			$exito = $this->email->send();
		}

		if ($cxc&&($psw==$pass)) {
					$this->load->model('casoModel');
					$this->load->model('estatusGeneralModel');

					$caso = array(
					    'id_lider' 				=> NULL,
						'id_estatus_general' 	=> $this->estatusGeneralModel->PORASIGNAR,
						'id_cliente' 			=> $cliente['id'],
						'folio_cotizacion'		=> $cotizacion['folio'],
						'fecha_inicio' 			=> date('Y-m-d H:i:s'));
					// Abro un nuevo CASO
					$this->casoModel->insert($caso);
			}

		if($exito) {
			echo json_encode($cotizacion);
		}
	}

	/**
	 * Crea el PDF
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	private function _pdf($oficina, $cotizacion, $cliente, $productos, $total, $banco, $path)
	{
		// Cargo libreria del pdf y numeroaletra
		$this->load->library('pdf');
		$this->load->library('numeroaletra');

		$this->pdf = new PDF();
		$this->pdf->init($oficina, $cotizacion, $cliente, $banco);
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		// Nombre del supervisor
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		// // Nombre del supervisor
		// $this->pdf->SetFont('Arial','B',20);
		// $this->pdf->Cell(180, 8, 'Luis Macias', 0, 1,'L', 1);
		// // Salto
		// $this->pdf->Ln(4);
		// // Cliente
		// $this->pdf->SetFont('Arial','',10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'Cliente:', 00, 0);
		// // Nombre Cliente
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->Cell(50, 6, 'Su Empresa', 00, 1);
		// // RFC
		// $this->pdf->SetFont('Arial','',10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'R.F.C.:', 00, 0);
		// // Datos RFC
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(50, 6, 'AAA00AAAA', 00, 1);
		// // Domicilio
		// $this->pdf->SetFont('Arial','',10);
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'Domicilio:', 00, 0);
		// // Datos domicilio
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(50, 6, 'Cuarzo #541', 00, 1);
		// // Teléfono
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'Teléfono:', 00, 0);
		// // Datos Teléfono
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(42, 6, '(392) 698 5470', 00, 0);
		// // Colonia
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'Colonia:', 00, 0);
		// // Datos Colonia
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(42, 6, 'Solidaridad', 00, 0);
		// // C.P.
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'C.P.:', 00, 0);
		// // Datos C.P.
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(42, 6, '47810', 00, 1);
		// // Ciudad
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'Ciudad:', 0, 0);
		// // Datos Ciudad
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(42, 6, 'Ocotlán', 0, 0);
		// // Estado
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'Estado:', 0, 0);
		// // Datos Estado
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(42, 6, 'Jalisco', 0, 0);
		// // País
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(18, 6, 'País:', 0, 0);
		// // Datos País
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(42, 6, 'Mexico', 0, 1);
		// // Expedicion
		// $this->pdf->SetFont('Arial', '', 10);
		// $this->pdf->SetTextColor(120, 120, 120);
		// $this->pdf->Cell(35, 6, "Lugar de Expedición:", 0, 0);
		// // Datos Expedicion
		// $this->pdf->SetFont('Arial','B',10);
		// $this->pdf->SetTextColor(18,143,188);
		// $this->pdf->Cell(40, 6, 'Datos Requeridos', 0, 1);
		$this->pdf->Ln(5);
		// Tabla
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->SetDrawColor(160, 160, 160);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(15, 5, 'Cantidad', 0, 0,'C', 1);
		$this->pdf->Cell(15, 5, utf8_decode('Código'), 0, 0,'C', 1);
		$this->pdf->Cell(105, 5, utf8_decode('Concepto/Descripción'), 0, 0,'C', 1);
		$this->pdf->Cell(20, 5, 'Valor Unitario', 0, 0,'C', 1);
		$this->pdf->Cell(25, 5, 'Importe', 0, 1,'C', 1);
		// Valores
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(0, 0, 0);

		// Productos
		$total_productos = count($productos);
		for ($i=0; $i < $total_productos; $i++) {
			// SI tiene observacion
			$bool_obs = empty($productos[$i]['observacion']);
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(15, 5, $productos[$i]['cantidad'], 'LBR', 0,'C');
			$this->pdf->Cell(15, 5, $productos[$i]['codigo'], 'BR', 0,'C');
			$this->pdf->Cell(105, 5, utf8_decode($productos[$i]['descripcion']), !$bool_obs ? 'R' : 'BR', 0, 'L');
			$this->pdf->Cell(20, 5, sprintf ('%0.2f', $productos[$i]['precio']), 'BR', 0,'C');
			$this->pdf->Cell(25, 5, sprintf ('%0.2f', $productos[$i]['total']), 'BR', 1,'C');
			// Obervacion
			if (!$bool_obs) {
				$this->pdf->SetFont('Arial','',7);
				//Save the current position
				$x = $this->pdf->GetX();
				$y = $this->pdf->GetY();
				$height = $this->pdf->GetMultiCellHeight(105, 4, $productos[$i]['observacion'], 'BR', 'L');
				$this->pdf->Cell(15, $height, '', 'LBR', 0,'C');
				$this->pdf->Cell(15, $height, '', 'BR', 0,'C');
				$this->pdf->MultiCell(105, 4,  utf8_decode($productos[$i]['observacion']), 'LBR', 'L', TRUE);
				//Put the position to the right of the cell
        			$this->pdf->SetXY($x+(15+15+105),$y);
				$this->pdf->Cell(20, $height, '', 'BR', 0,'C');
				$this->pdf->Cell(25, $height, '', 'BR', 1,'C');
			}
		}
		$this->pdf->Ln(5);
		// Importe con Letra
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(120, 5, 'Importe con letra', 0, 0,'C', 1);
		// Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(150, 150, 150);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10);
		$this->pdf->Cell(25, 5, 'SUBTOTAL:', 1, 0);
		// Valor Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(18, 143, 188);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(25, 5, sprintf ('%0.2f', $total['subtotal']), 1, 1);
		// Valores Importe con Letra
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(0, 0, 0);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(120, 5, strtoupper($this->numeroaletra->ValorEnLetras($total['total'], 'PESOS')), 'LBR', 0,'C');
		// Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(150, 150, 150);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10);
		$this->pdf->Cell(25, 5, 'I.V.A.:', 1, 0);
		// Valor Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(18, 143, 188);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(25, 5, sprintf ('%0.2f', $total['iva']), 1, 1);
		// Metodo pago
		$this->pdf->SetFillColor(18,143,188);
		$this->pdf->SetTextColor(255, 255, 255);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(120, 5, utf8_decode('NOTA'), 0, 0,'C', 1);
		// Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(150, 150, 150);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10);
		$this->pdf->Cell(25, 5, 'TOTAL:', 1, 0);
		// Valor Subtotal
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(18, 143, 188);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(25, 5, sprintf ('%0.2f', $total['total']), 1, 1);
		// Valores
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetTextColor(0, 0, 0);
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->MultiCell(120, 1, '', 'LR');
		$this->pdf->MultiCell(120, 3, utf8_decode('Las promociones, servicios sin costo, descuentos adicionales o cualquier negociación realizada con el ejecutivo de ventas deberá quedar por escrito en un e-mail adicional a este documento de lo contrario no serán validas.'), 'LBR');
		$this->pdf->Output($path, 'F');
	}
}

/* End of file cotizador.php */
/* Location: ./application/controllers/cotizador.php */