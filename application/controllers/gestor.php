<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para la gestion de oficinas, departamentos,
 * sistemas contpaq y demas pequeños datos necesarios para el crm
 * @package default
 * @author Diego Rodriguez
 **/
class Gestor extends AbstractAccess {

	public function __construct()
	{
		parent::__construct();
		//cargamos la libreria
		$this->load->library('form_validation');
		//carga de los modelos a usar en el controlador
		$this->load->model('departamentoModel');
		$this->load->model('oficinasModel');
		$this->load->model('ejecutivoModel');
		$this->load->model('sistemasContpaqiModel');
		$this->load->model('sistemasClienteModel');
	}

	public function index()
	{
	}

 public function add()
 {
 }

	/**
	* Funcion para la gestion de las oficinas
	* @author Diego Rodriguez
	**/
 	public function oficinas($accion=null)
 	{
 		//paso a la vista los datos a manejar de la tabla en la bd
 		$this->data['oficinas'] = $this->oficinasModel->get(array('*'));
 		$this->data['departamentos'] = $this->departamentoModel->get(array('*'));
	 	switch ($accion) {
	 		case 'nuevo':
				//reglas de oficinas
				$this->form_validation->set_rules('ciudad','Ciudad','trim|required|strtolower|ucwords|max_length[40]|xss_clean');
				$this->form_validation->set_rules('estado','Estado','trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('colonia','Colonia','trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('calle','Calle','trim|required|strtolower|ucwords|max_length[50]|xss_clean');
				$this->form_validation->set_rules('numero','Número','trim|required|max_length[5]|xss_clean');
				$this->form_validation->set_rules('email','Email','trim|required|strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono','Teléfono','trim|required|max_length[14]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$oficina = array(
						'ciudad' 		 => $this->input->post('ciudad'),
						'estado' 		 => $this->input->post('estado'),
						'colonia' 	 => $this->input->post('colonia'),
						'calle' 	 	 => $this->input->post('calle'),
						'numero' 	 	 => $this->input->post('numero'),
						'email' 	 	 => $this->input->post('email'),
						'telefono' 	 => $this->input->post('telefono')
					);
					//el compo ciudad estado lo creo maualmnte
					$oficina['ciudad_estado']=$oficina['ciudad'].', '.$oficina['estado'];
					//inserto en la bd
					if(!$this->oficinasModel->insert($oficina))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'oficina' => $oficina['ciudad_estado']);
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
	 		break;

	 		case 'editar':
				//reglas de oficinas
				$this->form_validation->set_rules('ciudad','Ciudad','trim|required|strtolower|ucwords|max_length[40]|xss_clean');
				$this->form_validation->set_rules('estado','Estado','trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('colonia','Colonia','trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('calle','Calle','trim|required|strtolower|ucwords|max_length[50]|xss_clean');
				$this->form_validation->set_rules('numero','Número','trim|required|max_length[5]|xss_clean');
				$this->form_validation->set_rules('email','Email','trim|required|strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono','Teléfono','trim|required|max_length[14]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$oficina = array(
						'ciudad' 		 => $this->input->post('ciudad'),
						'estado' 		 => $this->input->post('estado'),
						'colonia' 	 => $this->input->post('colonia'),
						'calle' 	 	 => $this->input->post('calle'),
						'numero' 	 	 => $this->input->post('numero'),
						'email' 	 	 => $this->input->post('email'),
						'telefono' 	 => $this->input->post('telefono')
					);
					//el compo ciudad estado lo creo maualmnte
					$oficina['ciudad_estado']=$oficina['ciudad'].', '.$oficina['estado'];
					//obterngo el id de la oficina para saber cual actualizar
					$id_oficina=$this->input->post('id_oficina');

					if(!$this->oficinasModel->update($oficina,array('id_oficina' => $id_oficina)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consola o la base de datos para detalles');
					}else
					{
						$respuesta = array('exito' => TRUE, 'oficina' => $oficina['ciudad_estado']);
					}
				}
				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
	 		break;

	 		case 'eliminar':
	 		  //se eliminara con el id, la ciudad y estado es colo para mostrar que oficina se borro mas esteticamente
	 			$id_oficina = $this->input->post('id_oficina');
	 			$ciudad = $this->input->post('ciudad');
	 			$estado = $this->input->post('estado');

	 			$cont=count($this->ejecutivoModel->get_where(array('oficina' => $ciudad.', '.$estado)));
	 			if($cont!=0)
	 			{
	 				$respuesta=array('exito' => FALSE, 'msg' => 'No se puede eliminar, hay ejecutivos asignados a esta oficina!');
	 			}else
	 			{
	 				if (!$this->oficinasModel->delete(array('id_oficina' => $id_oficina)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
					}else
					{
						$respuesta = array('exito' => TRUE, 'oficina' => $ciudad.', '.$estado);
					}
	 			}
	      //mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
	 		break;

	 		default:
	 			$this->_vista('oficinas_dptos');
	 		break;
	 	}
 	}

 	/**
 	 * Funcion para la gestion de departamentos
 	 * @author Diego Rodriguez
 	 **/
 	public function departamentos($accion=null)
 	{
 		//paso a la vista los datos a manejar de la tabla en la bd
 		$this->data['oficinas'] = $this->oficinasModel->get(array('*'));
 		$this->data['departamentos'] = $this->departamentoModel->get(array('*'));
 		switch ($accion) {
 			case 'nuevo':
 				$this->form_validation->set_rules('area','Departamento','trim|required|strtolower|ucwords|max_length[50]|xss_clean');

 				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
 				}else
 				{
 					$departamento= $this->input->post('area');

					if (!$this->departamentoModel->insert(array('area' => $departamento)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else{
						$respuesta = array('exito' => TRUE, 'departamento' => $departamento);
					}
 				}
 				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			case 'editar':
 				$this->form_validation->set_rules('area','Departamento','trim|required|strtolower|ucwords|max_length[50]|xss_clean');

 				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
 				}else
 				{
 					$departamento = $this->input->post('area');
 					$id_departamento = $this->input->post('id_departamento');

					if (!$this->departamentoModel->update(array('area' => $departamento),array('id_departamento' => $id_departamento)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consola o la base de datos para detalles');
					}else{
						$respuesta = array('exito' => TRUE, 'departamento' => $departamento);
					}
 				}
 				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			case 'eliminar':
 				//se eliminara con el id, la ciudad y estado es colo para mostrar que oficina se borro mas esteticamente
	 			$id_departamento = $this->input->post('id_departamento');
	 			$area = $this->input->post('area');

	 			$cont=count($this->ejecutivoModel->get_where(array('departamento' => $area)));
	 			if($cont!=0)
	 			{
	 				$respuesta=array('exito' => FALSE, 'msg' => 'No se puede eliminar, hay ejecutivos asignados a este departamento!');
	 			}else
	 			{
	 				if (!$this->departamentoModel->delete(array('id_departamento' => $id_departamento)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
					}else
					{
						$respuesta = array('exito' => TRUE, 'departamento' => $area);
					}
	 			}
	      //mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			default:
 				$this->_vista('oficinas_dptos');
 			break;
 		}
 	}

	/**
 	 * Funcion para la gestion de sistemas contpaq
 	 * @author Diego Rodriguez
 	 **/
 	public function sistemas($accion=null)
 	{
 		$this->data['sistemascontpaqi'] = $this->sistemasContpaqiModel->get(array('*'));

 		switch ($accion) {
 			case 'nuevo':
 				$this->form_validation->set_rules('sistema','Sistema','trim|required|strtoupper|callback_sistema_check|max_length[30]|xss_clean');

 				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
 				}else
 				{
 					$sistema= $this->input->post('sistema');

					if (!$this->sistemasContpaqiModel->insert(array('sistema' => $sistema)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					}else{
						$respuesta = array('exito' => TRUE, 'sistema' => $sistema);
					}
 				}
 				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;
 			case 'editar':
 				$this->form_validation->set_rules('sistema','Sistema','trim|required|strtoupper|callback_sistema_check|max_length[50]|xss_clean');

 				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
 				}else
 				{
 					$sistema = $this->input->post('sistema');
 					$id_sistema = $this->input->post('id_sistema');

					if (!$this->sistemasContpaqiModel->update(array('sistema' => $sistema),array('id_sistema' => $id_sistema)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consola o la base de datos para detalles');
					}else{
						$respuesta = array('exito' => TRUE, 'sistema' => $sistema);
					}
 				}
 				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;
 			case 'eliminar':
 				//se eliminara con el id
	 			$id_sistema = $this->input->post('id_sistema');
	 			$sistema = $this->input->post('sistema');

	 			$cont=count($this->sistemasClienteModel->get_where(array('sistema' => $sistema)));
	 			if($cont!=0)
	 			{
	 				$respuesta=array('exito' => FALSE, 'msg' => 'No se puede eliminar, hay clientes que tienen este sistema!');
	 			}else
	 			{
	 				if (!$this->sistemasContpaqiModel->delete(array('id_sistema' => $id_sistema)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
					}else
					{
						$respuesta = array('exito' => TRUE, 'sistema' => $sistema);
					}
	 			}
	      //mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;
 			default:
 				$this->_vista('sistemas_contpaqi');
 			break;
 		}
 	}

 	/**
 	 * funciona para la gestion de las versines de
 	 * los sistemas ontpaqui
 	 * @author Diego Rodriguez
 	 **/
 	public function versiones($accion=null)
 	{
 		switch ($accion) {
 			case 'mostrar':
 				$id_sistema = $this->input->post('id_sistema');

 				$versiones=$this->sistemasContpaqiModel->get(array('versiones'),array('id_sistema' => $id_sistema));

 				$respuesta=array(
 					'exito' => TRUE,
 					'versiones' => $versiones[0]->versiones);

 				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			case'actualizar':
 				$id_sistema=$this->input->post('id_sistema');
 				$nuevas_versiones=$this->input->post('nuevas_versiones');

 				$array=explode(',', $nuevas_versiones);

 				$j=count($array);

 				$nuevas_versiones2=$array[0];
 				for ($i=0; $i < $j; $i++) {
 					if($i!=0){
 						$nuevas_versiones2.=', '.$array[$i];
 					}
 				}

 				if(!$this->sistemasContpaqiModel->update(array('versiones' => $nuevas_versiones2), array('id_sistema' => $id_sistema))){
 					$respuesta=array(
 						'exito' => FALSE,
 						'msg' => 'No se actualizo, revisa la consola o la base de datos');
 				}else{
 					$respuesta=array(
 					'exito' => TRUE);
 				}

 				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			default:
 				echo "opcion no valda kokin";
 			break;
 		}
 	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/
	/**
	 * Callback para revisar el sistema este correctamente añadido
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function sistema_check($sistema)
	{
		if ($sistema==='CONTPAQi® ' || $sistema==='CONTPAQI® ') {
			$this->form_validation->set_message('sistema_check', 'Sistema sin nombre!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}

/* End of file gestorGeneral.php */
/* Location: ./application/controllers/gestorGeneral.php */