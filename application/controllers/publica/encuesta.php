<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends AbstractController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('encuestamodel');
	}

	public function index()
	{}

	public function form($token)
	{
		$encuesta = $this->encuestamodel->get_where(array('token' => $token));
		if ($encuesta != NULL && $encuesta->fecha_respuesta == NULL) {
			$this->load->helper('form');
			$this->data['form'] = array(
					'class' 		=> 'form-horizontal',
					'id' 			=> 'encuesta',
					'role' 		=> 'form');
			$this->data['id_caso'] 	= $encuesta->id_caso;
			$this->data['token'] 	= $encuesta->token;
			$this->_vista('encuesta');
		} else {
			show_404();
		}
	}

	public function validar()
	{
		$data =$this->input->post();

		$id_caso 		= $data['id_caso'];
		$token 			= $data['token'];

		$encuesta = $this->encuestamodel->get_where(array('token' => $token, 'id_caso' => $id_caso));

		if ($encuesta != NULL && $encuesta->fecha_respuesta == NULL) {
			$pregunta1	= $data['pregunta1'];
			$p1_porque	= $data['p1_porque'];

			$pregunta2	= $data['pregunta2'];
			$p2_porque	= $data['p2_porque'];

			$pregunta3 	= $data['pregunta3'];
			$pregunta4 	= $data['pregunta4'];

			$pregunta5 	= $data['pregunta5'];
			$p5_nombre 	= $data['p5_nombre'];
			$p5_email 		= $data['p5_email'];
			$p5_telefono 	= $data['p5_telefono'];
			$p5_porque 	= $data['p5_porque'];

			$pregunta6 	= $data['pregunta6'];

			// Puntaje
			$puntaje = 0;

			$puntos1 = 0;
			$puntos2 = 0;
			$puntos3 = 0;
			$puntos4 = 0;
			$puntos5 = 0;

			// Pregunta 1 - 25pts.
			if ($pregunta1 == 'si') {
				$puntaje += 25;
				$puntos1 = 25;
			}

			// Pregunta 2 - 15pts.
			if ($pregunta2 == 'si') {
				$puntaje += 15;
				$puntos2 = 15;
			}

			// Pregunta 3 - 10 - 30pts
			$pregunta3 = (int)$pregunta3;
			$puntos3 	= ($pregunta3*30)/10;
			$puntaje 	+= $puntos3;

			// Pregunta 4 - 10 - 30pts
			$pregunta4 = (int)$pregunta4;
			$puntos4 	= ($pregunta4*30)/10;
			$puntaje 	+= $puntos4;

			// Pregunta 5
			if ($pregunta5 == 'si') {
				$puntos5 = 10;
			} elseif ($pregunta5 == 'no') {
				$puntos5 = 5;
			} elseif ($pregunta5 == 'nunca') {
				$puntos5 = 0;
			}
			$puntaje += $puntos5;

			$this->load->model('casomodel');
			$this->load->model('ejecutivomodel');
			$this->load->model('clietemodel');

			$caso 		= $this->casomodel->get_where(array('id' => $id_caso));
			$lider		= $this->ejecutivomodel->get_where(array('id' => $caso->id_lider));
			$cliente 	= $this->clientemodel->get_where(array('id' => $caso->id_cliente));

			/*
			* LA VALIDACION ES SI EL PUNTAJE SE LLEGA
			* AL 80% EL CASO SE DA POR CERRADO
			 */
			$update_caso = TRUE;
			if ($puntaje >= 80) {
				$this->load->model('estatusgeneralmodel');

				// Cierro el caso
				$update_caso = $this->casomodel->update(
					array('id_estatus_general' => $this->estatusgeneralmodel->CERRADO),
					array('id' => $id_caso)
				);
			}

			// Guardo respuestas encuesta
			$update_encuesta = $this->encuestamodel->update(
				array(
				      'pregunta1' => $pregunta1,
				      'pregunta2' => $pregunta2,
				      'pregunta3' => $pregunta3,
				      'pregunta4' => $pregunta4,
				      'pregunta5' => $pregunta5,
				      'pregunta6' => $pregunta6,
				      'porque_p1' => $p1_porque,
				      'porque_p2' => $p2_porque,
				      'porque_p5' => $p5_porque,
				      'nombre' 	=> $p5_nombre,
				      'email' 		=> $p5_email,
				      'telefono' 	=> $p5_telefono,
				      'fecha_respuesta' => date('Y-m-d H:i:s'),
				      'calificacion' => $puntaje),
				array('token' => $token, 'id_caso' => $id_caso)
			);

			// Envio encuestas al lider del caso
			// y al correo de encuestas de TiendaPAQ - encuestas@tiendapaq.com.mx
			$this->load->library('email');

			$this->email->set_mailtype('html');

			$asunto = $puntaje.'% - ';
			$asunto .= ($caso->folio_cotizacion) ? 'Folio: '.$caso->folio_cotizacion.' - ' : 'Sin Cotización';
			$asunto .= $cliente->razon_social;

			$this->email->from('encuestas@moz67.com',  'Encuestas TiendaPAQ');
			$this->email->to($lider->email);
			$this->email->cc('encuestas@tiendapaq.com.mx');

			$this->email->subject($asunto);

			// Descripcion
			$this->data['folio'] 		= ($caso->folio_cotizacion) ? 'Folio: '$caso->folio_cotizacion : 'Sin Cotización';
			$this->data['id_caso'] 	= $caso->id;
			$this->data['lider'] 		= $lider->primer_nombre.' '.$lider->apellido_paterno;
			$this->data['cliente']	= $cliente->razon_social;

			// Puntos
			$this->data['puntos1']	= $puntos1;
			$this->data['puntos2']	= $puntos2;
			$this->data['puntos3']	= $puntos3;
			$this->data['puntos4']	= $puntos4;
			$this->data['puntos5']	= $puntos5;
			$this->data['puntaje']	= ($puntaje >= 80) ? $puntaje.'% - Cierra caso' : $puntaje.'% - Calificación baja';

			// Respuestas
			$this->data['respuesta1'] 	= ($pregunta1 == 'si') ? 'SI' : 'NO, ¿Porque? '.$p1_porque;
			$this->data['respuesta2'] 	= ($pregunta2 == 'si') ? 'SI' : 'NO, ¿Porque? '.$p2_porque;
			$this->data['respuesta3'] 	= $pregunta3;
			$this->data['respuesta4'] 	= $pregunta4;
			$this->data['respuesta5']	= $pregunta5;
			$this->data['data'] 			= $data;

			$mensaje = $this->_vista_completa('email/email_respuestas_cuestionario', TRUE);
			$this->email->message($mensaje);

			$envio = $this->email->send();

			$exito = ($update_caso && $update_encuesta && $envio);
			if ($exito) {
				$msg = 'Gracias por su tiempo, sus respuestas nos ayudarán a mejorar el servicio';
			} else {
				$msg = 'No se pudo registar en la BD o enviar correo de respuesta';
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('msg' => $msg)));
		}
	}

	public function correo()
	{
		$this->_vista_completa('email/email_respuestas_cuestionario');
	}
}

/* End of file encuesta.php */
/* Location: ./application/controllers/encuesta.php */