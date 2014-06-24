<?php
/**
 * Retorna la url correcta del
 * script que se necesita
 *
 * @author Luis  Macias
 * @param string $myscript Nombre del script a utilizar
 **/
function load_myscript($base, $privilegios, $controlador, $myscript)
{
	return $base.$privilegios.'/'.$controlador.'/'.$myscript.'.js';
}