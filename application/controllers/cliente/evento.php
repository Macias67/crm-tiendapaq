<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Evento extends AbstractAccess {

	public function index()
	{}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('eventoModel');
		$this->load->model('clienteModel');
		$this->load->model('contactosModel');
	}

	public function ver_eventos()
	{
		// Cargo la librería para las fechas
		$this->load->helper('formatofechas_helper');

		$this->data['eventos_revision'] = $this->eventoModel->get_evento_revision(
			array(
				'eventos.id_evento',
				'eventos.id_ejecutivo',
				'ejecutivos.primer_nombre',
				'ejecutivos.apellido_paterno',
				'eventos.titulo',
				'eventos.fecha_creacion'
			));

		$this->_vista('ver_eventos');
	}

	public function registro_evento()
	{
		$this->_vista('registro_evento');
	}

	/**
	 * Metodo para mostrar las empresas
	 * de menera de JSON
	 *
	 * @return void
	 * @author Luis Macias
	 **/
	public function json()
	{
		$id_cliente = $this->input->post('id_cliente');
		/**
		 * Si el $id_cliente es vacio, entonces es porque
		 * sera utilizado en el select de busqueda de clientes
		 * que esta en el cotizador
		 */
		if (empty($id_cliente))
		{
			$query	= $this->input->post('q');
			$limit 	= $this->input->post('page_limit');

			if (isset($query) && isset($limit))
			{
				$resultados = $this->clienteModel->get_like(
					array('id','razon_social'),
					'razon_social',
					$query,
					'razon_social',
					'ASC',
					$limit);

				$res = array();

				if (!empty($resultados))
				{
					foreach ($resultados as $value)
					{
						array_push($res, array("id" => (int)$value->id, "text" => $value->razon_social));
					}
				} else
				{
					$res = array("id"=>"0","text"=>"No se encontraron resultados...");
				}

				// Muestro la salida
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($res));
			}
		} else
		{
			/**
			 * Si no sera para obtener la info de un
			 * cliente en especifico y sus contactos
			 */

			//Obtengo cliente
			$cliente		= $this->clienteModel->get_like(array('telefono1'), 'id', $id_cliente);
			//Obtengo contactos
			$contactos	= $this->contactosModel->get(array('*'), array('id_cliente' => $id_cliente), 'nombre_contacto');

			$total_contactos = count($contactos);

			if ($total_contactos > 0)
			{
				$res = array(
					'total_contactos'	=> $total_contactos,
					'contactos'			=> $contactos);

			} else
			{
				$res = array(
					'total_contactos'	=> $total_contactos,
					'msg'				=> 'La empresa no tiene contactos registrados.');
			}
			// Muestro salida
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($res));
		}
	}

}

/* End of file evento.php */
/* Location: ./application/controllers/cliente/evento.php */