<?php
/**
 * Pasa de id de estatus
 * al html que muestra el estatus
 *
 * @return void
 * @author Luis Macias
 **/
function id_estatus_to_class_html($id_estatus)
{
	$html = array();
	switch ($id_estatus) {
		case '1': // por pagar
			$html = array(
			              'class' 		=> 'label-primary',
			              'estatus' 	=> 'Por Pagar'
					);
			break;
		case '2': // revision
			$html = array(
			              'class' 		=> 'label-warning',
			              'estatus' 	=> 'Revisión'
					);
			break;
		case '3':  // pagada
			$html = array(
			              'class' 		=> 'bg-green',
			              'estatus' 	=> 'Pagada'
					);
			break;
		case '4': // irregular
			$html = array(
			              'class' 		=> 'label-danger',
			              'estatus' 	=> 'Irregular'
					);
			break;
		case '5': // vencida
			$html = array(
			              'class' 		=> 'label-default',
			              'estatus' 	=> 'Vencida'
					);
			break;
		case '6': // pago parcial
			$html = array(
			              'class' 		=> 'bg-green-turquoise',
			              'estatus' 	=> 'Pago Parcial'
					);
			break;
		case '7': // cancelada
			$html = array(
			              'class' 		=> 'bg-grey-gallery',
			              'estatus'	 => 'Cancelada'
					);
			break;
		case '8': // cancelada
			$html = array(
			              'class' 		=> 'bg-grey-gallery',
			              'estatus'	 => 'Cuenta por cobrar'
					);
			break;
	}

	return $html;
}