<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CotizacionModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'cotizacion';

	public function __construct()
	{
		parent::__construct();
		$this->table = self::TABLE;
	}

	public function getSiguienteFolio()
	{
		$folio = $this->cotizacionModel->get('folio', null, 'folio', 'DESC', 1);
		if (empty($folio)) {
			$folio = 1;
		} else {
			$folio = (int)$folio->folio;
			$folio++;
		}
		return $folio;
	}

}

/* End of file cotizacionModel.php */
/* Location: ./application/models/cotizacionModel.php */