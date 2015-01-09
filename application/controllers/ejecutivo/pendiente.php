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
		// Cargo modelos
		$this->load->model('pendienteModel');
		$this->load->model('estatusGeneralModel');
		$this->load->model('actividadPendienteModel');
	}

	public function index()
	{}

	/**
	 * Método para agregar un pendiente a la BD
	 *
	 * @author Luis Macias
	 **/
	public function nuevo()
	{
		// Reglas de validacion
		$this->form_validation->set_rules('ejecutivo', 'Ejecutivo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|require|xss_clean');
		$this->form_validation->set_rules('actividad', 'Actividad', 'trim|required|xss_clean');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|min_length[5]|max_length[140]|xss_clean');

		// Valido formulario
		if ($this->form_validation->run() === FALSE)
		{
			// SI es FALSO, vuelvo a mostrar vista
			$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
		} else
		{
			$razon_social = $this->input->post('razon_social');
			// Captruo los datos en un array
			$data = array(
				'id_creador'	   	 		    => $this->usuario_activo['id'],
				'id_ejecutivo'						=> $this->input->post('ejecutivo'),
				'id_cliente'							=> (empty($razon_social)) ? NULL : $razon_social,
				'id_actividad_pendiente'	=> $this->input->post('actividad'),
				'id_estatus_general'			=> $this->estatusGeneralModel->PENDIENTE,
				'descripcion'							=> $this->input->post('descripcion'),
				'fecha_origen' 						=> date('Y-m-d H:i:s')
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

	/**
	 * Funcion para mostrar ventana modal con informacion detallada de un pendiente
	 * @author  Luis Macias | Diego Rodriguez
	 **/
	public function detalles($id_pendiente)
	{
		// Cargo modelos
		$this->load->model('estatusGeneralModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('reasignarPendienteModel');
		$campos = array('pendientes.id_pendiente',
						'pendientes.id_ejecutivo',
						'clientes.id as id_cliente',
						'clientes.razon_social',
						'actividades_pendiente.id_actividad as id_actividad_pendiente',
						'actividades_pendiente.actividad',
						'pendientes.descripcion',
						'pendientes.fecha_origen',
						'pendientes.fecha_finaliza',
						'creador.primer_nombre as creador_nombre',
						'creador.apellido_paterno as creador_apellido',
						'ejecutivo.primer_nombre as ejecutivo_nombre',
						'ejecutivo.apellido_paterno as ejecutivo_apellido',
						'creador.oficina as oficina',
						'pendientes.id_estatus_general');
		//Helper
		$this->load->helper('formatofechas');
		$pendiente	= $this->pendienteModel->getPendiente($id_pendiente, $campos);
		$this->data['pendiente']		= $pendiente;
		$this->data['estatus']			= $this->estatusGeneralModel->get('*');
		$this->data['ejecutivos']		= $this->ejecutivoModel->get(array('id','primer_nombre','apellido_paterno'));
		$this->data['reasignaciones']	= count($this->reasignarPendienteModel->getReasignaciones($id_pendiente,'*'));

		// SI la actividad es COTIZAR
		if ($pendiente->id_actividad_pendiente == $this->actividadPendienteModel->SOLICITA_COTIZACION) {
			$this->data['url_cotiza']= anchor('cotizador/'.$pendiente->id_pendiente, 'Cotizar', 'class="btn red btn-circle"');
		}

		$this->_vista_completa('pendiente/detalle-pendiente');
	}

	/**
	 * Funcion para mostrar ventana modal con informacion detallada de un pendientes
	 * @author  Diego Rodriguez
	 **/
	public function reasignaciones($id_pendiente)
	{
		$this->load->model('reasignarPendienteModel');
		$this->load->helper('formatofechas');

		$campos = array('origen.primer_nombre as nombre_origen',
						'origen.apellido_paterno as apellido_origen',
						'destino.primer_nombre as nombre_destino',
						'destino.apellido_paterno as apellido_destino',
						'reasignacion_pendiente.fecha',
						'reasignacion_pendiente.motivo');
		$reasignaciones = $this->reasignarPendienteModel->getReasignaciones($id_pendiente, $campos);
		foreach ($reasignaciones as $index => $reasignacion) {
			$reasignaciones[$index]->fecha = fecha_completa($reasignaciones[$index]->fecha);
		}
		$this->data['reasignaciones'] = $reasignaciones;
		$this->_vista_completa('pendiente/reasignaciones-pendiente');
	}

	/**
	 * Funcion para cambiar el estado de los pendientes
	 * @author Diego Rodriguez
	 **/
	public function actualizar()
	{
		$id_pendiente 						= $this->input->post('id_pendiente');
		$id_estatus 							= $this->input->post('id_estatus');
		$estatus_text						  = $this->input->post('estatus_text');
		$id_ejecutivo_destino   	= $this->input->post('id_ejecutivo_destino');
		$ejecutivo_destino_text 	= $this->input->post('ejecutivo_destino_text');
		$id_ejecutivo_origen 			= $this->usuario_activo['id'];
		$motivo										= $this->input->post('motivo');

		if (empty($id_ejecutivo_destino)) {
			if(empty($id_estatus)){
				$respuesta = array('exito' => TRUE, 'estatus' => 'Sin Cambios');
			}else{
				if($this->pendienteModel->update(array('id_estatus_general' => $id_estatus), array('id_pendiente' => $id_pendiente))){
					if($id_estatus==$this->estatusGeneralModel->CERRADO){
						$this->pendienteModel->update(array('fecha_finaliza' => date('Y-m-d H:i:s')), array('id_pendiente' => $id_pendiente));
					}
					$respuesta = array('exito' => TRUE, 'estatus' => $estatus_text);
				}else{
					$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consla o la base de datos');
				}
			}
		}else{
			$this->load->model('reasignarPendienteModel');

			$reasignacion = array(
				'id_pendiente' => $id_pendiente,
				'id_ejecutivo_origen' => $id_ejecutivo_origen,
				'id_ejecutivo_destino' => $id_ejecutivo_destino,
				'fecha' => date('Y-m-d H:i:s'),
				'motivo' => $motivo
				);

			if($this->reasignarPendienteModel->insert($reasignacion) &&
				 $this->pendienteModel->update(array('id_ejecutivo' => $id_ejecutivo_destino, 'id_estatus_general' => 7), array('id_pendiente' => $id_pendiente)))
			{
				$respuesta = array('exito' => TRUE, 'ejecutivo_destino_text' => $ejecutivo_destino_text);
			}else{
				$respuesta = array('exito' => TRUE, 'msj' => 'No se reasigno, revisa la consola o la base de datos.');
			}
		}

		$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode($respuesta));
	}
}

/* End of file pendiente.php */
/* Location: ./application/controllers/pendiente.php */