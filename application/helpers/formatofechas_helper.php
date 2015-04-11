<?php
/**
 * Retorna fecha en formato
 * con nombre de dia y mes
 *
 * @author Luis Macias
 **/
function fecha_completa($timestamp)
{
	$fecha 			= date('d/n/y', strtotime($timestamp));
	$hora 			= date('h:i A', strtotime($timestamp));
	$array_fecha	= explode('/', $fecha);
	$dia			= $array_fecha[0];
	$mes			= $array_fecha[1];
	$ano			= $array_fecha[2];
	$fecha_php	= $mes.'/'.$dia.'/'.$ano;
	$unix			= strtotime($fecha_php);
	$dia_numero	= date('w', $unix);
	$fecha			= numero_a_dia($dia_numero).', '.$dia.' de '.numero_a_mes($mes).' a las '.$hora;
	return $fecha;
}

/**
 * Retorna fecha en formato
 * condia y mes
 *
 * @author Luis Macias
 **/
function fecha_corta($timestamp)
{
	$fecha 			= date('d/m/y', strtotime($timestamp));
	$hora 			= date('h:i A', strtotime($timestamp));
	$array_fecha	= explode('/', $fecha);
	$dia			= $array_fecha[0];
	$mes			= $array_fecha[1];
	$ano			= $array_fecha[2];
	$fecha			= $dia.'/'.$mes.'/'.$ano;
	return $fecha;
}

function fecha_formato($date)
{
	$fecha 			= date('d/n/Y', strtotime($date));
	$array_fecha	= explode('/', $fecha);
	$dia			= $array_fecha[0];
	$mes			= $array_fecha[1];
	$ano			= $array_fecha[2];
	$fecha_php	= $mes.'/'.$dia.'/'.$ano;
	$unix			= strtotime($fecha_php);
	$dia_numero	= date('w', $unix);
	$fecha			= numero_a_dia($dia_numero).', '.$dia.' de '.numero_a_mes($mes).' del '.$ano;
	return $fecha;
}

function fecha_chat($timestamp)
{
	$fecha 			= date('d/n/Y', strtotime($timestamp));
	$hora 			= date('h:i A', strtotime($timestamp));
	$array_fecha	= explode('/', $fecha);
	$dia			= $array_fecha[0];
	$mes			= $array_fecha[1];
	$ano			= $array_fecha[2];
	$fecha_php	= $mes.'/'.$dia.'/'.$ano;
	$unix			= strtotime($fecha_php);
	$dia_numero	= date('w', $unix);
	$fecha			= 'el '.$dia.'/'.$mes.'/'.$ano.' a las '.$hora;
	return $fecha;
}

function numero_a_mes($numero)
{
	switch ($numero)
	{
		case 1:
			$mes = 'Enero';
		break;
		case 2:
			$mes = 'Febrero';
		break;
		case 3:
			$mes = 'Marzo';
		break;
		case 4:
			$mes = 'Abril';
		break;
		case 5:
			$mes = 'Mayo';
		break;
		case 6:
			$mes = 'Junio';
		break;
		case 7:
			$mes = 'Julio';
		break;
		case 8:
			$mes = 'Agosto';
		break;
		case 9:
			$mes = 'Septiembre';
		break;
		case 10:
			$mes = 'Octubre';
		break;
		case 11:
			$mes = 'Noviembre';
		break;
		case 12:
			$mes = 'Diciembre';
		break;
	}
	return $mes;
}

function numero_a_dia($numero)
{
	switch ($numero)
	{
		case 0:
			$dia = 'Domingo';
		break;
		case 1:
			$dia = 'Lunes';
		break;
		case 2:
			$dia = 'Martes';
		break;
		case 3:
			$dia = 'Miércoles';
		break;
		case 4:
			$dia = 'Jueves';
		break;
		case 5:
			$dia = 'Viernes';
		break;
		case 6:
			$dia = 'Sábado';
		break;
	}
	return $dia;
}