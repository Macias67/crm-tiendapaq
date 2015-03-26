<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase para gestionar la informacion respecto a los casos
 *
 * @package default
 * @author Diego Rodriguez
 **/

class Caso extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('casoModel');
	}

	/**
	 * Vista para la asignacion de casos
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function index()
	{
		$this->load->model('ejecutivoModel');
		$this->load->helper('formatofechas_helper');

		// Extraigo el campo `asignador_casos` del usuario activo
		$asignador_casos = $this->ejecutivoModel->get(array('asignador_casos'), array('id' => $this->data['usuario_activo']['id']));
		// SI es asignador entonces
		if($asignador_casos[0]->asignador_casos == "si"){
			$this->load->model('casoModel');
			$campos = array(
						'caso.id as id_caso',
						'clientes.razon_social',
						'estatus_general.descripcion',
						'id_cliente',
						'folio_cotizacion',
						'fecha_inicio',
						'fecha_final'
				              );
			// Mando los casos que esten por asignar
			$this->data['casos_asignacion'] = $this->casoModel->get_casos_asignacion($campos);
			$this->_vista('casos_asignar');
		}else{
			show_404();
		}
	}

	/**
	 * Funcion para mostrar los detalles de un caso
	 *
	 * @author Diego Rodriguez
	 **/
	public function detalles($id_caso)
	{
		$this->load->helper('formatofechas_helper');
		//verificamos si el caso aun no tiene lider para saber como hacer la consulta en el model
		$lider = $this->casoModel->get(array('id_lider'), array('id' => $id_caso), null, 'ASC', 1);
		if(empty($lider->id_lider)){
			$this->data['caso'] = $this->casoModel->get_caso_detalles($id_caso, 'vacio');
			$this->data['caso']->primer_nombre = 'SIN';
			$this->data['caso']->apellido_paterno = ' LIDER';
		}else{
			$this->data['caso'] = $this->casoModel->get_caso_detalles($id_caso);
		}
		$this->_vista_completa('caso/modal-detalles-caso');
	}

	/**
	 * Funcion para asignarle un caso a un ejecutivo
	 *
	 * @return json
	 * @author Diego Rodriguez
	 **/
	public function asignar($accion=null, $id_caso=null)
	{
		switch ($accion) {
			// Respuesta JSON cambia la base de datos para asignar caso a un ejecutivo
			case 'asignar':
				$this->load->model('estatusGeneralModel');
				$id_caso 		= $this->input->post('id_caso');
				$id_ejecutivo 	= $this->input->post('id_ejecutivo');

				if($this->casoModel->update(array('id_lider' => $id_ejecutivo, 'id_estatus_general' => $this->estatusGeneralModel->PENDIENTE), array('id' => $id_caso))) {
					//SECCION ENVIAR CORREO A CONTACTO DE COTIZACION NOTIFICANDO QUE SU CASO HA SIDO ABIERTO Y ASIGNADO
					$enviado = TRUE;
					if (!LOCAL) {
						$this->load->model('casoModel');
						$this->load->model('cotizacionModel');
						$this->load->model('contactosModel');
						$this->load->model('clienteModel');
						$this->load->helper('formatofechas');
						$this->load->library('email');

						$caso 				= $this->casoModel->get_where(array('id' => $id_caso));
						$folio_cotizacion 	= $this->casoModel->get(array('folio_cotizacion'), array('id' => $id_caso), null, 'ASC', 1);
						$id_contacto 		= $this->cotizacionModel->get(array('id_contacto'), array('folio' => $folio_cotizacion->folio_cotizacion), null, 'ASC', 1);
						$contacto 			= $this->contactosModel->get('*', array('id' => $id_contacto->id_contacto), null, 'ASC', 1);
						$cliente 			= $this->clienteModel->get(array('usuario','password'),array('id' => $contacto->id_cliente), null, 'ASC', 1);

						$nombre_contacto = $contacto->nombre_contacto.' '.$contacto->apellido_paterno.' '.$contacto->apellido_materno;
						//Envio Email
						$this->email->set_mailtype('html');
						$this->email->from('notificacion@moz67.com', 'Apertura de Caso - TiendaPAQ');
						$this->email->to($contacto->email);
						//$this->email->cc('another@example.com');
						//$this->email->bcc('and@another.com');
						$this->email->subject('Apertura de Caso - TiendaPAQ');
						//Contenido del correo
						$this->data['usuario'] 		= $cliente->usuario;
						$this->data['password'] 	= $cliente->password;
						$this->data['id_caso'] 		= $caso->id;
						$this->data['fecha'] 		= fecha_completa($caso->fecha_inicio);
						$this->data['folio'] 			= $folio_cotizacion->folio_cotizacion;
						$this->data['contacto'] 	= $nombre_contacto;
						$html = $this->load->view('admin/general/full-pages/email/email_inicio_caso.php', $this->data, TRUE);
						$this->email->message($html);
						// Adjunto PDF
						//$this->email->attach($path);
						$this->email->send();
					}
					$respuesta = array('exito' => TRUE);
				}else{
					$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error, revisa la consola para mas información</h4>');
				}
				$this->output
						->set_content_type('application/json')
						->set_output(json_encode($respuesta));
			break;
			// Muestra la vista para asignar el caso a un ejecutivo
			case 'mostrar':
				$this->load->model('ejecutivoModel');
				$this->data['ejecutivos'] = $this->ejecutivoModel->get(array('id','primer_nombre','apellido_paterno'));
				$this->data['id_caso'] = $id_caso;

				$this->_vista_completa('caso/modal-asignar-ejecutivo');
			break;
		}
	}

	/**
	 * funcion para abrir un caso de manera directa
	 *
	 * @return void
	 * @author Diego Rodriguez
	 **/
	public function abrir()
	{
		$this->load->model('estatusGeneralModel');

		// Campos a guardar en la Base de datos
		$caso = array(
				'id_lider'				=> $this->input->post('lider_caso'),
				'id_estatus_general'	=> $this->estatusGeneralModel->PENDIENTE,
				'id_cliente'				=> $this->input->post('razon_social_caso'),
				'fecha_inicio'			=> date('Y-m-d H:i:s'),
				'descripcion'			=> $this->input->post('descripcion_caso')
		 	);

		// Guardo y extraigo el ultimo ID
		if($id_caso = $this->casoModel->get_last_id_after_insert($caso)) {
			if (!LOCAL) {
				$this->load->model('casoModel');
				$this->load->model('cotizacionModel');
				$this->load->model('contactosModel');
				$this->load->model('clienteModel');
				$this->load->helper('formatofechas');
				$this->load->library('email');

				$cliente 			= $this->clienteModel->get(array('razon_social','email','usuario','password'), array('id' => $caso['id_cliente']), null, 'ASC', 1);
				$caso 				= $this->casoModel->get_where(array('id' => $id_caso));

				//Envio Email
				$this->email->set_mailtype('html');
				$this->email->from('notificacion@moz67.com', 'Apertura de Caso - TiendaPAQ');
				$this->email->to($cliente->email);
				//$this->email->cc('another@example.com');
				//$this->email->bcc('and@another.com');
				$this->email->subject('Apertura de Caso - TiendaPAQ');
				//Contenido del correo
				$this->data['usuario'] 		= $cliente->usuario;
				$this->data['password'] 	= $cliente->password;
				$this->data['id_caso'] 		= $caso->id;
				$this->data['fecha'] 		= fecha_completa($caso->fecha_inicio);
				$this->data['folio'] 			= 'Caso Directo';
				$this->data['contacto'] 	= $cliente->razon_social;
				$html = $this->load->view('admin/general/full-pages/email/email_inicio_caso.php', $this->data, TRUE);
				$this->email->message($html);
				// Adjunto PDF
				//$this->email->attach($path);
				$this->email->send();
			}
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>Caso abierto con éxito.</h4>');
		} else {
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! revisa la consola para mas detalles.</h4>');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}

	/**
	 * Funcion pra cerrar un caso
	 *
	 * @author Diego Rodriguez
	 **/
	public function cerrar()
	{
		$id_caso = $this->input->post('id_caso');
		$this->load->model('estatusGeneralModel');

		if($this->casoModel->update(array('id_estatus_general' => $this->estatusGeneralModel->CERRADO), array('id' => $id_caso))){
			$respuesta = array('exito' => TRUE, 'msg' => '<h4>Caso cerrado con éxito.</h4>');
		}else{
			$respuesta = array('exito' => FALSE, 'msg' => '<h4>Error! revisa la consola para mas detalles.</h4>');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($respuesta));
	}
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */