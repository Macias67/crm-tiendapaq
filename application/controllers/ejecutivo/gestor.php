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
		$this->load->model('ejecutivoModel');
		$this->load->model('sistemasClienteModel');
		$this->load->model('sistemasContpaqiModel');
		$this->load->model('sistemasOperativosModel');
	}

	public function index()
	{}

	/**
	* Funcion para la gestion de las oficinas
	* @author Diego Rodriguez
	**/
	public function oficinas($accion=null, $id_oficina=null)
	{
		//carga de los modelos y datosa usar
		$this->load->model('departamentoModel');
		$this->load->model('oficinasModel');

		// Segun la accion que reciba es lo que voy a procesar
		switch ($accion) {
			case 'nuevo':
				//reglas de oficinas
				$this->form_validation->set_rules('ciudad','Ciudad','trim|required|strtolower|ucwords|max_length[40]|xss_clean');
				$this->form_validation->set_rules('estado','Estado','trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('colonia','Colonia','trim|required|strtolower|ucwords|max_length[30]|xss_clean');
				$this->form_validation->set_rules('calle','Calle','trim|required|strtolower|ucwords|max_length[50]|xss_clean');
				$this->form_validation->set_rules('numero','Número','trim||max_length[5]|xss_clean');
				$this->form_validation->set_rules('email','Email','trim||strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono','Teléfono','trim||max_length[14]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					//si las reglas son correctas preparo los datos para insertar
					$oficina = array(
						'ciudad'		=> $this->input->post('ciudad'),
						'estado'	=> $this->input->post('estado'),
						'colonia'	=> $this->input->post('colonia'),
						'calle'		=> $this->input->post('calle'),
						'numero'	=> $this->input->post('numero'),
						'email'		=> $this->input->post('email'),
						'telefono'	=> $this->input->post('telefono')
					);
					//el armo ciudad estado lo creo maualmnte
					$oficina['ciudad_estado']=$oficina['ciudad'].', '.$oficina['estado'];
					//inserto en la bd
					if(!$this->oficinasModel->insert($oficina))
					{
						$respuesta = array('exito' => FALSE, 'msg' => '<h4>No se agrego, revisa la consola o la base de datos para detalles.</h4>');
					}else
					{
						$respuesta = array('exito' => TRUE, 'msg' => '<h4> Oficina de <b>'.$oficina['ciudad_estado'].'</b> añadida con éxito.</h4>');
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
				$this->form_validation->set_rules('numero','Número','trim|max_length[5]|xss_clean');
				$this->form_validation->set_rules('email','Email','trim|strtolower|valid_email|max_length[50]|xss_clean');
				$this->form_validation->set_rules('telefono','Teléfono','trim|max_length[14]|xss_clean');

				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				}else
				{
					//si las reglas son correctas preparo los datos para insertar
					$oficina = array(
						'ciudad'		=> $this->input->post('ciudad'),
						'estado'	=> $this->input->post('estado'),
						'colonia'	=> $this->input->post('colonia'),
						'calle'		=> $this->input->post('calle'),
						'numero'	=> $this->input->post('numero'),
						'email'		=> $this->input->post('email'),
						'telefono'	=> $this->input->post('telefono')
					);
					//el compo ciudad estado lo creo maualmnte
					$oficina['ciudad_estado']=$oficina['ciudad'].', '.$oficina['estado'];
					//obterngo el id de la oficina para saber cual actualizar
					$id_oficina=$this->input->post('id_oficina');

					if(!$this->oficinasModel->update($oficina, array('id_oficina' => $id_oficina)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => '<h4>No se actualizo, revisa la consola o la base de datos para detalles.</h4>');
					}else
					{
						$respuesta = array('exito' => TRUE, 'msg' => '<h4>Oficina de <b>'.$oficina['ciudad_estado'].'</b> actualizada con éxito.</h4>');
					}
					}
					//mando la repuesta
					$this->output
						->set_content_type('application/json')
						->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				//se eliminara con el id, la ciudad y estado es colo para mostrar que oficina se borro mas esteticamente
				$id_oficina	= $this->input->post('id_oficina');
				$ciudad	= $this->input->post('ciudad');
				$estado	= $this->input->post('estado');

				$cont=count($this->ejecutivoModel->get_where(array('oficina' => $ciudad.', '.$estado)));
				if($cont != 0)
				{
					$respuesta=array('exito' => FALSE, 'msg' => '<h4>No se puede eliminar, hay ejecutivos asignados a esta oficina.</h4>');
				} else
				{
					if (!$this->oficinasModel->delete(array('id_oficina' => $id_oficina)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => '<h4>No se elimino, revisa la consola o la base de datos</h4>');
					} else
					{
						$respuesta = array('exito' => TRUE, 'msg' => '<h4>Oficina de <b>'.$ciudad.', '.$estado.'</b> eliminada con éxito.</h4>');
					}
				}
					//mando la repuesta
					$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'mostrar':
				$this->data['oficina'] = $this->oficinasModel->get(array('*'), array('id_oficina' => $id_oficina), null, 'ASC', 1);
				
				$this->_vista_completa('gestor/modal-editar-oficina');
			break;

			default:
				$this->data['oficinas']			= $this->oficinasModel->get(array('*'));
				$this->data['departamentos']	= $this->departamentoModel->get(array('*'));
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
 		//carga de los modelos y datos a usar
 		$this->load->model('departamentoModel');
		$this->load->model('oficinasModel');

		switch ($accion) {
			case 'nuevo':
				// Regla de validacion
				$this->form_validation->set_rules('area','Departamento','trim|required|strtolower|ucwords|max_length[50]|xss_clean');
				// Valido formulario
				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					// Capturo variable
					$departamento= $this->input->post('area');
					if (!$this->departamentoModel->insert(array('area' => $departamento)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					} else
					{
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
				// Valido Formulario
				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$departamento	= $this->input->post('area');
					$id_departamento	= $this->input->post('id_departamento');
					if (!$this->departamentoModel->update(array('area' => $departamento),array('id_departamento' => $id_departamento)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consola o la base de datos para detalles');
					} else
					{
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
				$id_departamento	= $this->input->post('id_departamento');
				$area				= $this->input->post('area');

				$cont=count($this->ejecutivoModel->get_where(array('departamento' => $area)));
				if($cont!=0)
				{
					$respuesta=array('exito' => FALSE, 'msg' => 'No se puede eliminar, hay ejecutivos asignados a este departamento!');
				} else
				{
					if (!$this->departamentoModel->delete(array('id_departamento' => $id_departamento)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
					} else
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
				$this->data['oficinas']			= $this->oficinasModel->get(array('*'));
				$this->data['departamentos']	= $this->departamentoModel->get(array('*'));
				$this->_vista('oficinas_dptos');
			break;
		}
 	}

	/**
 	 * Funcion para la gestion de sistemas contpaqi
 	 * @author Diego Rodriguez
 	 **/
 	public function sistemas($accion=null)
 	{
 		switch ($accion) {
 			case 'nuevo':
 				$this->form_validation->set_rules('sistema','Sistema','trim|required|strtoupper|callback_sistema_check|max_length[30]|xss_clean');

 				if($this->form_validation->run() === FALSE)
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
 				} else
 				{
 					$sistema= $this->input->post('sistema');

					if (!$this->sistemasContpaqiModel->insert(array('sistema' => $sistema)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos para detalles');
					} else
					{
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
 				} else
 				{
					$sistema		= $this->input->post('sistema');
					$id_sistema	= $this->input->post('id_sistema');

					if (!$this->sistemasContpaqiModel->update(array('sistema' => $sistema), array('id_sistema' => $id_sistema)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se actualizo, revisa la consola o la base de datos para detalles');
					} else
					{
						$respuesta = array('exito' => TRUE, 'sistema' => $sistema);
					}
 				}
 				//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			case 'eliminar':
				$id_sistema	= $this->input->post('id_sistema');
				$sistema		= $this->input->post('sistema');

 				if (!$this->sistemasContpaqiModel->delete(array('id_sistema' => $id_sistema)))
				{
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
				} else
				{
					$respuesta = array('exito' => TRUE, 'sistema' => $sistema);
				}
	      			//mando la repuesta
				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			default:
 				$this->data['sistemascontpaqi'] = $this->sistemasContpaqiModel->get(array('*'), null, 'sistema');
 				$this->_vista('sistemas_contpaqi');
 			break;
 		}
 	}

 	/**
 	 * funciona para la gestion de las versiones de
 	 * los sistemas contpaqui
 	 * @author Diego Rodriguez
 	 **/
 	public function versiones($accion=null)
 	{
 		switch ($accion) {
 			case 'mostrar':
 				//se obtiene el id del sistema para saber de que sistema se editaran las versiones
 				$id_sistema = $this->input->post('id_sistema');
 				//obtenemos la cadena con las versiones
 				$versiones = $this->sistemasContpaqiModel->get(array('versiones'),array('id_sistema' => $id_sistema));

 				$respuesta = array(
						'exito'		=> TRUE,
						'versiones'	=> $versiones[0]->versiones);
 				//mandamos la respuesta
 				$this->output
					 ->set_content_type('application/json')
					 ->set_output(json_encode($respuesta));
 			break;

 			case 'actualizar':
				$id_sistema		=$this->input->post('id_sistema');
				$nuevas_versiones	=$this->input->post('nuevas_versiones');

 				//obtenemos las nuevas versiones y le damos formato
				$array	= explode(',', $nuevas_versiones);
				$j		= count($array);

 				$versiones_array = $array[0];
 				for ($i=0; $i < $j; $i++) {
 					if($i != 0){
 						$versiones_array .= ', '.$array[$i];
 					}
 				}

 				if(!$this->sistemasContpaqiModel->update(array('versiones' => $versiones_array), array('id_sistema' => $id_sistema))){
 					$respuesta = array(
						'exito'	=> FALSE,
						'msg'	=> 'No se actualizo, revisa la consola o la base de datos');
 				} else
 				{
 					$respuesta=array('exito' => TRUE);
 				}

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
	 * funcion para gestionar los sistemas operativos
	 * @author Diego Rodriguez
	 **/
	public function operativos($accion=null)
	{
		switch ($accion) {
			case 'nuevo':
				$this->form_validation->set_rules('sistema_operativo', 'Sistema Operativo', 'trim|required|max_length[30]|strtolower|ucwords|callback_so_nombre_check|xss_clean');

				if (!$this->form_validation->run())
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$sistema_operativo = $this->input->post('sistema_operativo');
					if(!$this->sistemasOperativosModel->insert(array('sistema_operativo' => $sistema_operativo)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos');
					} else
					{
						$respuesta = array('exito' => TRUE, 'so' => $sistema_operativo );
					}
				}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'editar':
				$this->form_validation->set_rules('sistema_operativo', 'Sistema Operativo', 'trim|required|max_length[30]|strtolower|ucwords|callback_so_nombre_check|xss_clean');

				if (!$this->form_validation->run())
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$id_so					= $this->input->post('id_so');
					$sistema_operativo	= $this->input->post('sistema_operativo');

					if(!$this->sistemasOperativosModel->update(array('sistema_operativo' => $sistema_operativo), array('id_so' => $id_so)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agredo, revisa la consola o la base de datos');
					} else
					{
						$respuesta = array('exito' => TRUE, 'so' => $sistema_operativo );
					}
				}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$id_so					= $this->input->post('id_so');
				$sistema_operativo	= $this->input->post('sistema_operativo');

			 	if(!$this->sistemasOperativosModel->delete(array('id_so' => $id_so)))
			 	{
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
			 	} else
			 	{
					$respuesta = array('exito' => TRUE, 'so' => $sistema_operativo );
			 	}

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			default:
				$this->data['sistemasoperativos'] = $this->sistemasOperativosModel->get(array('*'), $where = null, $orderBy = 'id_so', $orderForm = 'ASC');
				$this->_vista('sistemas_operativos');
			break;
		}
	}

	/**
	* funcion para gestionar los bancos
	* @author Diego Rodriguez
	**/
	public function bancos($accion=null,$id_banco=null)
	{
		//carga de los modelos a usar en el controlador
		$this->load->model('bancoModel');

		switch ($accion) {
			case 'nuevo':
				$this->form_validation->set_rules('banco', 'Banco', 'trim|required|max_length[30]|strtoupper|xss_clean');
				$this->form_validation->set_rules('sucursal', 'Sucursal', 'trim|required|max_length[8]|callback_numeros_check|xss_clean');
				$this->form_validation->set_rules('cta', 'Numero de Cuenta', 'trim|required|max_length[11]|callback_numeros_check|xss_clean');
				$this->form_validation->set_rules('titular', 'Titular', 'trim|required|max_length[50]|strtoupper|xss_clean');
				$this->form_validation->set_rules('cib', 'Clave Interbancaria', 'trim|required|min_length[18]|max_length[18]|callback_numeros_check|xss_clean');

				if(!$this->form_validation->run())
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$banco = array(
						'banco'		=> $this->input->post('banco'),
						'sucursal'	=> $this->input->post('sucursal'),
						'cta'		=> $this->input->post('cta'),
						'titular'		=> $this->input->post('titular'),
						'cib'		=> $this->input->post('cib'),
					);

					if(!$this->bancoModel->insert($banco))
					{
						$respuesta = array('exito' => FALSE, 'msg' => "No se agrego, revisa la consola o la base de datos");
					} else
					{
						$respuesta = array('exito' => TRUE, 'msg' => "<h4>Banco <b>".$banco['banco']."</b> añadido con éxito.</h4>");
					}
				}

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'editar':
				$this->form_validation->set_rules('banco', 'Banco', 'trim|required|max_length[30]|strtoupper|xss_clean');
				$this->form_validation->set_rules('sucursal', 'Sucursal', 'trim|required|max_length[8]|callback_numeros_check|xss_clean');
				$this->form_validation->set_rules('cta', 'Numero de Cuenta', 'trim|required|max_length[8]|callback_numeros_check|xss_clean');
				$this->form_validation->set_rules('titular', 'Titular', 'trim|required|max_length[50]|strtoupper|xss_clean');
				$this->form_validation->set_rules('cib', 'Clave Interbancaria', 'trim|required|min_length[18]|max_length[18]|callback_numeros_check|xss_clean');

				if(!$this->form_validation->run())
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$id_banco 	= $this->input->post('id_banco');
					$banco 	= array(
						'banco'		=> $this->input->post('banco'),
						'sucursal'	=> $this->input->post('sucursal'),
						'cta'		=> $this->input->post('cta'),
						'titular'		=> $this->input->post('titular'),
						'cib'		=> $this->input->post('cib')
					);

					if(!$this->bancoModel->update($banco, array('id_banco' => $id_banco)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => "No se agrego, revisa la consola o la base de datos");
					} else
					{
						$respuesta = array('exito' => TRUE, 'msg' => "<h4>Banco <b>".$banco['banco']."</b> actualizado con éxito.</h4>");
					}
				}

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$id_banco	=$this->input->post('id_banco');

				if(!$this->bancoModel->delete(array('id_banco' => $id_banco)))
				{
					$respuesta = array('exito' => FALSE, 'msg' => "No se elimino, revisa la consola o la base de datos");
				} else
				{
					$respuesta = array('exito' => TRUE, 'msg' => "<h4>Banco eliminado con éxito.</h4>");
				}

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'mostrar':
				$this->data['banco'] = $this->bancoModel->get(array('*'),array('id_banco' => $id_banco), null, 'ASC', 1);

				$this->_vista_completa('gestor/modal-editar-banco');
			break;

			default:
				$this->data['bancos'] = $this->bancoModel->get(array('*'));
				$this->_vista('bancos');
			break;
		}
	}

	 /**
	 * funcion para gestionar las observaciones
	 * @author Diego Rodriguez
	 **/
	public function observaciones($accion=null)
	{
		$this->load->model('observacionCotizacionModel');

		switch ($accion) {
			case 'nuevo':
				$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|max_length[200]|strtoupper|xss_clean');

				if (!$this->form_validation->run())
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$observacion = $this->input->post('descripcion');
					if(!$this->observacionCotizacionModel->insert(array('descripcion' => $observacion)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos');
					} else
					{
						$respuesta = array('exito' => TRUE, 'observacion' => $observacion );
					}
				}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'editar':
				$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|max_length[200]|strtoupper|xss_clean');

				if (!$this->form_validation->run())
				{
					$respuesta = array('exito' => FALSE, 'msg' => validation_errors());
				} else
				{
					$id_observacion	= $this->input->post('id_observacion');
					$observacion		= $this->input->post('descripcion');

					if(!$this->observacionCotizacionModel->update(array('descripcion' => $observacion), array('id_observacion' => $id_observacion)))
					{
						$respuesta = array('exito' => FALSE, 'msg' => 'No se agrego, revisa la consola o la base de datos');
					} else
					{
						$respuesta = array('exito' => TRUE, 'observacion' => $observacion );
					}
				}

				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			case 'eliminar':
				$id_observacion	= $this->input->post('id_observacion');
				$observacion		= $this->input->post('descripcion');

			 	if(!$this->observacionCotizacionModel->delete(array('id_observacion' => $id_observacion)))
			 	{
					$respuesta = array('exito' => FALSE, 'msg' => 'No se elimino, revisa la consola o la base de datos');
			 	} else
			 	{
					$respuesta = array('exito' => TRUE, 'observacion' => $observacion );
			 	}
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($respuesta));
			break;

			default:
				$this->data['observaciones'] = $this->observacionCotizacionModel->get(array('*'));
				$this->_vista('observaciones');
			break;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| CALLBACKS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Callback para revisar el sistema no sea repetido y tenga nombre valido
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function sistema_check($sistema)
	{
		$id_sistema=$this->input->post('id_sistema');

		if ($sistema==='CONTPAQI®' || ($this->sistemasContpaqiModel->exist(array('sistema' => $sistema)) && $id_sistema=="undefined"))
		{
			$this->form_validation->set_message('sistema_check', 'Sistema sin nombre o nombre repetido!');
			return FALSE;
		} else
		{
			return TRUE;
		}
	}

	/**
	 * Callback para revisar el sistema operativo no se repita
	 * @param  string $nombre Nombre a revisar
	 * @return boolean
	 * @author Diego Rodriguez | Luis Macias
	 */
	public function so_nombre_check($so)
	{
		$id_so = $this->input->post('id_so');
		if (($id_so =="undefined" && $this->sistemasOperativosModel->exist(array('sistema_operativo' => $so))))
		{
			$this->form_validation->set_message('so_nombre_check', 'Sistema repetido!');
			return FALSE;
		} else
		{
			return TRUE;
		}
	}

		/**
	 * Callback para revisar que esten todos los numeros
	 * @param  string $num Numero a revisar
	 * @return boolean
	 * @author Diego Rodriguez
	 */
	public function numeros_check($num)
	{
		$flag = false;

		if(ctype_digit($num)){
			$flag = true;
		}else{
			$flag=false;
			$this->form_validation->set_message('numeros_check', 'Faltan numeros en algun campo.');
		}

		return $flag;
	}
}

/* End of file gestorGeneral.php */
/* Location: ./application/controllers/gestorGeneral.php */