<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Ticket extends AbstractController
{

	function index()
	{
		$this->load->model('eventomodel');
		$this->load->model('sesionmodel');
		$this->load->model('sistemascontpaqimodel');

		$this->load->helper('directory');
		$this->load->helper('formatofechas');
		$this->load->helper('form');

		$sistemas =  $this->sistemascontpaqimodel->get(array('id_sistema','sistema'));

		$sistemas_array = [];
		$sistemas_array[''] = "";
		foreach($sistemas as $sistema) {
			$array = (array) $sistema;
			$sistemas_array[$array['sistema']] = $array['sistema'];
		}
		$sistemas_array['OTRO'] = "Otro";

		$this->data['sistemas'] = $sistemas_array;

		$this->_vista('form-abre-ticket');
	}

	function registro() {

		$id_cliente 	= $this->input->post('id_cliente');
		$id_contacto 	= $this->input->post('id_contacto');

		/*Cliente*/
		$rfc 			= $this->input->post('rfc');
		$razon_social 	= $this->input->post('razon_social');
		$email 			= $this->input->post('email');
		$tipo 			= $this->input->post('tipo');
		$calle 			= $this->input->post('calle');
		$no_exterior 	= $this->input->post('no_exterior');
		$no_interior 	= $this->input->post('no_interior');
		$colonia 		= $this->input->post('colonia');
		$codigo_postal = $this->input->post('codigo_postal');
		$ciudad 		= $this->input->post('ciudad');
		$municipio 		= $this->input->post('municipio');
		$estado 		= $this->input->post('estado');
		$pais 			= $this->input->post('pais');
		$telefono1 	= $this->input->post('telefono1');
		$telefono2 	= $this->input->post('telefono2');
		$usuario 		= $this->input->post('usuario');
		$password 		= $this->input->post('password');

		/*Contacto*/
		$nombre_contacto 	= $this->input->post('nombre_contacto');
		$apellido_paterno 		= $this->input->post('apellido_paterno');
		$apellido_materno 		= $this->input->post('apellido_materno');
		$email_contacto 		= $this->input->post('email_contacto');
		$telefono_contacto 	= $this->input->post('telefono_contacto');
		$puesto_contacto 		= $this->input->post('puesto_contacto');

		$this->load->model('clientemodel');
		$this->load->model('contactosmodel');
		$this->load->model('ticketmodel');

		$data = array(
			//Datos basicos
			'razon_social'	=> $razon_social,
			'rfc'			=> $rfc,
			'email'			=> $email,
			'tipo'			=> $tipo,
			'calle'			=> $calle,
			'no_exterior'	=> $no_exterior,
			'no_interior'	=> $no_interior,
			'colonia'		=> $colonia,
			'codigo_postal'	=> $codigo_postal,
			'ciudad'			=> $ciudad,
			'municipio'		=> $municipio,
			'estado'		=> $estado,
			'pais'			=> $pais,
			'telefono1'		=> $telefono1,
			'telefono2'		=> $telefono2,
			'usuario'  		=> $usuario,
			'password' 		=> $password,
			//Contacto
			'nombre_contacto'		=> $nombre_contacto,
			'apellido_paterno'		=> $apellido_paterno,
			'apellido_materno'		=> $apellido_materno,
			'email_contacto'		=> $email_contacto,
			'telefono_contacto'	=> $telefono_contacto,
			'puesto_contacto'		=> $puesto_contacto,
		);

		// SI son vacios los id's de cliente y contacto, es cliente nuevo
		if (empty($id_cliente) && empty($id_contacto)) {
			//armo objeto de CLIENTE NUEVO e inserto a la BD
			$cliente 		= $this->clientemodel->array_to_object($data, $tipo, TRUE);
			$id_cliente 	= $this->clientemodel->get_last_id_after_insert($cliente);
			//armo objeto de CONTACTO NUEVO e inserto a la BD
			$contacto		= $this->contactosmodel->arrayToObject($id_cliente, $data);
			$id_contacto 	= $this->contactosmodel->get_last_id_after_insert($contacto);
		}
		elseif (!empty($id_cliente) && empty($id_contacto)) {
			// SI es vacio el id de contacto, y cliente NO, entonces contacto nuevo
			$contacto		= $this->contactosmodel->arrayToObject($id_cliente, $data);
			$id_contacto 	= $this->contactosmodel->get_last_id_after_insert($contacto);

			// VALIDO LA CONTRASEÑA
			$cliente = $this->clientemodel->get_where(['id' => $id_cliente]);

			if($data['usuario'] != $cliente->usuario || $data['password'] != $cliente->password) {
				$this->load->model('eventomodel');
				$this->load->model('sesionmodel');
				$this->load->model('sistemascontpaqimodel');

				$this->load->helper('directory');
				$this->load->helper('formatofechas');
				$this->load->helper('form');

				$sistemas =  $this->sistemascontpaqimodel->get(array('id_sistema','sistema'));

				$sistemas_array = [];
				$sistemas_array[''] = "";
				foreach($sistemas as $sistema) {
					$array = (array) $sistema;
					$sistemas_array[$array['sistema']] = $array['sistema'];
				}
				$sistemas_array['OTRO'] = "Otro";

				$this->data['sistemas'] = $sistemas_array;
				$this->data['validation'] = "<div class=\"alert alert-danger\"><strong>Error</strong> El usaurio o la contraña no son válidos. </div>";
				$this->_vista('form-abre-ticket');
			}
		}
		else {

			// VALIDO EL USUARIO Y  CONTRASEÑA
			// Extraigo datos del cliente
			$cliente = $this->clientemodel->get_where(['id' => $id_cliente]);

			if($data['usuario'] == $cliente->usuario && $data['password'] == $cliente->password) {
				// se crea un objeto con la informacion basica de CLIENTE Y CONTACTO para insertarlo en la tabla clientes con sus datos actualizados
				$cliente_update 	= $this->clientemodel->array_to_object($data, $tipo);
				$contacto = array(
					'nombre_contacto'		=> trim(ucwords(strtolower($nombre_contacto))),
					'apellido_paterno'		=> trim(ucwords(strtolower($apellido_paterno))),
					'apellido_materno'		=> trim(ucwords(strtolower($apellido_materno))),
					'email_contacto'		=> trim(strtolower($email_contacto)),
					'telefono_contacto'	=> trim($telefono_contacto),
					'puesto_contacto'		=> trim(ucwords(strtolower($puesto_contacto)))
				);
				// Quito el usuario y contraseña para que no sean actualizados
				unset($cliente_update->usuario);
				unset($cliente_update->password);
				// Inserto cliente y contacto actualizados
				$this->clientemodel->update($cliente_update, array('id' => $id_cliente));
				// Verifico si el cliente ya registrado tiene contactos
				$total_contactos = $this->contactosmodel->get_where(array('id_cliente' => $id_cliente));
				// SI ya hay contactos, actualizo mediante el id del contacto
				if (count($total_contactos) > 0) {
					$this->contactosmodel->update($contacto, array('id' => $id_contacto));
				}
				// SI no hay contactos, inserto contacto y extraigo el id_contacto
				else {
					//armo objeto de CONTACTO NUEVO e inserto a la BD
					$contacto		= $this->contactosmodel->arrayToObject($id_cliente, $data);
					$id_contacto 	= $this->contactosmodel->get_last_id_after_insert($contacto);
				}

				$this->load->model('estatusgeneralmodel');

				$mensaje = $this->input->post('ticket');
				$sistemas =  $this->input->post('sistemas');

				// Registro el ticket
				$id_ticket = $this->ticketmodel->get_last_id_after_insert([
					'id_cliente' => $id_cliente,
					'id_contacto' => $id_contacto,
					'mensaje' => trim($mensaje),
					'id_estatus' => $this->estatusgeneralmodel->PENDIENTE,
					'asunto' => $sistemas,
				        'fecha_creacion' => date('Y-m-d H:i:s')
				]);

				if(!is_dir('clientes/'.$id_cliente.'/ticket/'.$id_ticket.'/'))
				{
					mkdir('clientes/'.$id_cliente.'/ticket/'.$id_ticket.'/', 0777, TRUE);
				}

				// Subida de archivos
				$config['upload_path'] = 'clientes/'.$id_cliente.'/ticket/'.$id_ticket.'/';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['max_size']	= '2048';
				$config['max_width']  = '2048';
				$config['max_height']  = '2048';
				$this->load->library('upload', $config);

				$total_archivos = count($_FILES);
				for($i=0; $i<$total_archivos; $i++) {
					$this->upload->do_upload("userfile".$i);
				}
				$this->_vista('exito-ticket');

			} else {
				$this->load->model('eventomodel');
				$this->load->model('sesionmodel');
				$this->load->model('sistemascontpaqimodel');

				$this->load->helper('directory');
				$this->load->helper('formatofechas');
				$this->load->helper('form');

				$sistemas =  $this->sistemascontpaqimodel->get(array('id_sistema','sistema'));

				$sistemas_array = [];
				$sistemas_array[''] = "";
				foreach($sistemas as $sistema) {
					$array = (array) $sistema;
					$sistemas_array[$array['sistema']] = $array['sistema'];
				}
				$sistemas_array['OTRO'] = "Otro";

				$this->data['sistemas'] = $sistemas_array;
				$this->data['validation'] = "<div class=\"alert alert-danger\"><strong>Error</strong> El usaurio o la contraña no son válidos. </div>";

				$this->_vista('form-abre-ticket');
			}

		}
	}
}