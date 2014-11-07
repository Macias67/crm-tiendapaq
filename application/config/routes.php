<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$DIR_EJECUTIVO	= "ejecutivo/";
$DIR_CLIENTE		= "cliente/";

$route['default_controller']	= $DIR_EJECUTIVO."inicio";
$route['404_override']			= '';

// Funciones generales
$route['login']			= $DIR_EJECUTIVO."inicio/login";
$route['cookiescreen']	= $DIR_EJECUTIVO."inicio/cookiescreen";
$route['validation']		= $DIR_EJECUTIVO."inicio/validation";
$route['logout']		= $DIR_EJECUTIVO."inicio/logout";

// Funciones cliente
$route['cliente/(:any)']	= $DIR_EJECUTIVO."cliente/$1";

// Funciones calendario
$route['calendario']		= $DIR_EJECUTIVO."calendario";
$route['calendario/(:any)']	= $DIR_EJECUTIVO."calendario/$1";

// Funciones pendiente
$route['pendiente']		= $DIR_EJECUTIVO."pendiente";
$route['pendiente/(:any)']	= $DIR_EJECUTIVO."pendiente/$1";

// Funciones ejecutivo
$route['perfil']				= $DIR_EJECUTIVO."ejecutivo";
$route['ejecutivo/(:any)']	= $DIR_EJECUTIVO."ejecutivo/$1";

// Funciones catalogo
$route['catalogo/clientes']		= $DIR_EJECUTIVO."catalogo";
$route['catalogo/productos']	= $DIR_EJECUTIVO."catalogo";
$route['catalogo/(:any)']		= $DIR_EJECUTIVO."catalogo/$1";

// Funciones cotizador
$route['cotizador']			= $DIR_EJECUTIVO."cotizador";
$route['cotizador/(:num)']	= $DIR_EJECUTIVO."cotizador/pendiente/$1";
$route['cotizador/(:any)']	= $DIR_EJECUTIVO."cotizador/$1";

// Funciones de Productos
$route['producto']			= $DIR_EJECUTIVO."producto";
$route['producto/(:any)']	= $DIR_EJECUTIVO."producto/$1";

// // Funciones del Gestor
$route['gestor']			= $DIR_EJECUTIVO."gestor";
$route['gestor/(:any)']		= $DIR_EJECUTIVO."gestor/$1";
$route['actualizar']			= $DIR_CLIENTE."gestor";
$route['actualizar/(:any)']	= $DIR_CLIENTE."gestor/$1";

// Funciones para el manejor de cotiazacion del cliente
$route['cotizacion']		= $DIR_CLIENTE."cotizacion";
$route['cotizacion/(:any)']	= $DIR_CLIENTE."cotizacion/$1";

// Funciones para el manejor de cotiazaciones
$route['cotizaciones']		= $DIR_EJECUTIVO."cotizacion";
$route['cotizaciones/(:any)']	= $DIR_EJECUTIVO."cotizacion/$1";

// Funciones para el manejor de casos
$route['caso']		= $DIR_EJECUTIVO."caso";
$route['caso/(:any)']	= $DIR_EJECUTIVO."caso/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */