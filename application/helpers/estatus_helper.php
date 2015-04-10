<?php
/**
 * Pasa de id de estatus
 * al html que muestra el estatus
 *
 * @return void
 * @author Luis Macias
 **/
function id_estatus_gral_to_class_html($id_estatus)
{
	$html = array();
	switch ($id_estatus) {
		case '1': // cancelada
			$html = array(
			              'class' 		=> 'bg-grey-gallery',
			              'estatus'	 => 'Cancelado'
					);
			break;
		case '2': // cerrado
			$html = array(
			              'class' 		=> 'bg-grey-silver',
			              'estatus' 	=> 'Cerrado'
					);
			break;
		case '3': // pendiente
			$html = array(
			              'class' 		=> 'bg-blue',
			              'estatus' 	=> 'Pendiente'
					);
			break;
		case '4':  // precierre
			$html = array(
			              'class' 		=> 'bg-green-turquoise',
			              'estatus' 	=> 'Precierre'
					);
			break;
		case '5': // Proceso
			$html = array(
			              'class' 		=> 'bg-blue',
			              'estatus' 	=> 'Proceso'
					);
			break;
		case '6': // suspendido
			$html = array(
			              'class' 		=> 'label-default',
			              'estatus' 	=> 'Suspendido'
					);
			break;
		case '7': // reasignado
			$html = array(
			              'class' 		=> 'bg-blue',
			              'estatus' 	=> 'Reasignado'
					);
			break;
		case '8': // Por asignar
			$html = array(
			              'class' 		=> 'bg-yellow-gold',
			              'estatus' 	=> 'Por Asignar'
					);
			break;
	}
	return $html;
}