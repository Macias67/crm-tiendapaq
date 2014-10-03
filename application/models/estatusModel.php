<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Modelo para estatus de los casos
 * y pendientes.
 *
 * @package default
 * @author Luis Macias
 **/
class estatusModel extends MY_Model {

	var $CANCELADA	= 1;
	var $CERRADA		= 2;
	var $PENDIENTE	= 3;
	var $PRECIERRE	= 4;
	var $PROCESO		= 5;
	var $SUSPENDIDA	= 6;
	var $SUSTITUIDA	= 7;
}

/* End of file estatusModel.php */
/* Location: ./application/models/estatusModel.php */