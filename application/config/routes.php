<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = 'Home';
$route['logout'] = 'Login/logout';

// Usuarios:
$route['usuarios'] = 'usuario/Usuario';
$route['registra_usuario'] = 'usuario/UsuarioAlta';
$route['edita_usuario/(:any)'] = 'usuario/UsuarioAlta/editaUsuario/$1';
$route['elimina_usuario/(:any)'] = 'usuario/UsuarioAlta/eliminaUsuario/$1';
$route['activar_usuario/(:any)'] = 'usuario/UsuarioAlta/activarUsuario/$1';
$route['inactivar_usuario/(:any)'] = 'usuario/UsuarioAlta/inactivarUsuario/$1';

// Empresa:
$route['empresa'] = 'empresa/Empresa';
$route['registrar_empresa'] = 'empresa/EmpresaAlta';
$route['editar_empresa/(:any)'] = 'empresa/EmpresaAlta/editarEmpresa/$1';

// Almacenes
$route['almacen'] = 'almacen/Almacen';
$route['registrar_almacen'] = 'almacen/AlmacenAlta';
$route['editar_almacen/(:any)'] = 'almacen/AlmacenAlta/editarAlmacen/$1';

// Familias
$route['familia'] = 'familia/Familia';
$route['registrar_familia'] = 'familia/FamiliaAlta';
$route['editar_familia/(:any)'] = 'familia/FamiliaAlta/editarFamilia/$1';

//Codigos postales:
$route['buscar_municipios'] = 'codigo_postal/CodigoPostal/dimeMunicipios';
