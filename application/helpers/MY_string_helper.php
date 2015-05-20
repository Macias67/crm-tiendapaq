<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Funcion para remover acentros
 *
 * @return void
 * @author Luis Macias
 **/
function strip_accents($string){
	return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}