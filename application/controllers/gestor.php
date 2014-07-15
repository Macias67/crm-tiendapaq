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
		//carda de las variables con los datos que usaremos
		$this->data['oficinas'] = $this->oficinasModel->get(array('*'));
		$this->data['departamentos'] = $this->departamentoModel->get(array('*'));
	}

	public function index()
	{
		//var_dump($this->data);
		$this->_vista('oficinas_dptos');
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
					$oficina_nueva = array(
						'ciudad' 		 => $this->input->post('ciudad'),
						'estado' 		 => $this->input->post('estado'),
						'colonia' 	 => $this->input->post('colonia'),
						'calle' 	 	 => $this->input->post('calle'),
						'numero' 	 	 => $this->input->post('numero'),
						'email' 	 	 => $this->input->post('email'),
						'telefono' 	 => $this->input->post('telefono')
					);
					//el compo ciudad estado lo creo maualmnte
					$oficina_nueva['ciudad_estado']=$oficina_nueva['ciudad'].', '.$oficina_nueva['estado'];
					//inserto en la bd
					$this->oficinasModel->insert($oficina_nueva);
					$respuesta = array('exito' => TRUE, 'oficina_nueva' => $oficina_nueva['ciudad_estado']);
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
					$oficina_editada = array(
						'ciudad' 		 => $this->input->post('ciudad'),
						'estado' 		 => $this->input->post('estado'),
						'colonia' 	 => $this->input->post('colonia'),
						'calle' 	 	 => $this->input->post('calle'),
						'numero' 	 	 => $this->input->post('numero'),
						'email' 	 	 => $this->input->post('email'),
						'telefono' 	 => $this->input->post('telefono')
					);
					//el compo ciudad estado lo creo maualmnte
					$oficina_editada['ciudad_estado']=$oficina_editada['ciudad'].', '.$oficina_editada['estado'];
					//obterngo el id de la oficina para saber cual actualizar
					$id_oficina=$this->input->post('id_oficina');
					//actualizo y creo respuesta
					$this->oficinasModel->update($oficina_editada,array('id_oficina' => $id_oficina));
					$respuesta = array('exito' => TRUE, 'oficina_editada' => $oficina_editada['ciudad_estado']);
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
						$respuesta = array('exito' => TRUE, 'oficina_eliminada' => $ciudad.', '.$estado);
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
 				# code...
 			break;

 			default:
 				$this->_vista('oficinas_dptos');
 			break;
 		}
 	}

}

/* End of file gestorGeneral.php */
/* Location: ./application/controllers/gestorGeneral.php */