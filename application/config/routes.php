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

$EJECUTIVO	= "ejecutivo/";
$CLIENTE		= "cliente/";
$PUBLICO		= "publica/";

$route['default_controller']	= $EJECUTIVO."inicio";
$route['404_override']			= '';

/*
| -------------------------------------------------------------------------
| PUBLICA
| -------------------------------------------------------------------------
*/
$route['login']			= $PUBLICO."login";
$route['cookiescreen']	= $PUBLICO."login/cookiescreen";
$route['validation']		= $PUBLICO."login/validation";
$route['recordar']		= $PUBLICO."login/recordar";
$route['logout']		= $PUBLICO."login/logout";
// Funciones del eventos
$route['cursos']		= $PUBLICO."evento";
$route['cursos/(:any)']	= $PUBLICO."evento/$1";
// Encuesta
$route['encuesta/(:any)']	= $PUBLICO."encuesta/form/$1";
$route['encuesta/validar']	= $PUBLICO."encuesta/validar";
$route['encuesta/correo']	= $PUBLICO."encuesta/correo";
// Tickets
$route['abre-ticket']		= $PUBLICO."ticket";

/*
| -------------------------------------------------------------------------
| CLIENTE
| -------------------------------------------------------------------------
*/

$route['usuario']			= $CLIENTE."inicio";
// Funciones del Gestor
$route['gestionar']			= $CLIENTE."gestor";
$route['gestionar/(:any)']	= $CLIENTE."gestor/$1";
// Funciones para el manejo de cotiazacion del cliente
$route['cotizacion']		= $CLIENTE."cotizacion";
$route['cotizacion/(:any)']	= $CLIENTE."cotizacion/$1";
// Funciones para el manejo de casos del cliente
$route['client/casos']			= $CLIENTE."caso";
$route['client/casos/(:any)']	= $CLIENTE."caso/$1";

/*
| -------------------------------------------------------------------------
| EJECUTIVO
| -------------------------------------------------------------------------
*/

$route['inicio/(:any)']			= $EJECUTIVO."inicio/$1";
/* Funciones cliente */
$route['cliente/(:any)']			= $EJECUTIVO."cliente/$1";
/* Funciones calendario */
$route['calendario']			= $EJECUTIVO."calendario";
$route['calendario/(:any)']		= $EJECUTIVO."calendario/$1";
// Funciones pendiente
$route['pendiente']			= $EJECUTIVO."pendiente";
$route['pendiente/(:any)']		= $EJECUTIVO."pendiente/$1";
// Funciones ejecutivo
$route['perfil']					= $EJECUTIVO."ejecutivo";
$route['ejecutivo/(:any)']		= $EJECUTIVO."ejecutivo/$1";
// Funciones de Eventos
$route['eventos']				= $EJECUTIVO."evento";
$route['evento/(:any)']			= $EJECUTIVO."evento/$1";
// Funciones catalogo
$route['catalogo/clientes']		= $EJECUTIVO."catalogo";
$route['catalogo/productos']	= $EJECUTIVO."catalogo";
$route['catalogo/(:any)']		= $EJECUTIVO."catalogo/$1";
// Funciones cotizador
$route['cotizador']				= $EJECUTIVO."cotizador";
$route['cotizador/(:num)']		= $EJECUTIVO."cotizador/pendiente/$1";
$route['cotizador/(:any)']		= $EJECUTIVO."cotizador/$1";
// Funciones de Productos
$route['producto']				= $EJECUTIVO."producto";
$route['producto/(:any)']		= $EJECUTIVO."producto/$1";
// Funciones del Gestor
$route['gestor']				= $EJECUTIVO."gestor";
$route['gestor/(:any)']			= $EJECUTIVO."gestor/$1";
// Funciones para el manejo de cotiazaciones
$route['cotizaciones']			= $EJECUTIVO."cotizacion";
$route['cotizaciones/(:any)']	= $EJECUTIVO."cotizacion/$1";
// Funciones para el manejo de casos
$route['caso']					= $EJECUTIVO."caso";
$route['casos']					= $EJECUTIVO."caso/casos_ejecutivos";
$route['caso/(:any)']			= $EJECUTIVO."caso/$1";
// Funciones para el manejo de tareas
$route['tareas']				= $EJECUTIVO."tarea";
$route['tarea/(:any)']			= $EJECUTIVO."tarea/$1";
// Funciones para el manejo de notas en tareas
$route['nota/(:any)']			= $EJECUTIVO."nota/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */