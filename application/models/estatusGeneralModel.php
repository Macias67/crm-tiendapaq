 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Modelo para estatus de los casos
 * y pendientes.
 *
 * @package default
 * @author Luis Macias | Diego Rodriguez
 **/
class estatusGeneralModel extends MY_Model {

	/**
	 * Nombre de la tabla a conectarse
	 *
	 * @var string
	 **/
	const TABLE = 'estatus_general';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->table	= self::TABLE;
	}

	var $CANCELADO	= 1;
	var $CERRADO		= 2;
	var $PENDIENTE	= 3;
	var $PRECIERRE	= 4;
	var $PROCESO		= 5;
	var $SUSPENDIDO	= 6;
	var $REASIGNADO	= 7;
	var $PORASIGNAR	= 8;
}

/* End of file estatusModel.php */
/* Location: ./application/models/estatusModel.php */