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

$route['default_controller'] = "index";
$route['404_override'] = '';

$route['project/(:num)'] = 'project/view/$1';
$route['wit/(:num)'] = 'wit/view/$1';
$route['wit/add'] = 'wit/edit';
$route['vote/(:num)'] = 'vote/view/$1';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['signup'] = 'user/signup';
$route['home'] = 'user/home';
$route['home/score'] = 'user/score';
$route['home/profile'] = 'user/profile';
$route['home/project'] = 'user/project';
$route['space/(:num)'] = 'user/space/$1';
$route['profile'] = 'user/profile';
$route['finance'] = 'user/finance';

$route['company/addproduct'] = 'company/editproduct';
$route['company/addproject'] = 'company/editproject';
$route['company/product/(:num)'] ='company/editproduct/$1';
$route['company/project/(:num)'] ='company/editproject/$1';

$route['admin/addfinance'] = 'admin/editfinance';
$route['admin/addcompany'] = 'admin/editcompany';
$route['admin/adduser'] = 'admin/edituser';

$route['admin/finance/(:num)'] = 'admin/editfinance/$1';
$route['admin/company/(:num)'] = 'admin/editcompany/$1';
$route['admin/user/(:num)'] = 'admin/edituser/$1';

$route['admin/product'] = 'company/product';
$route['admin/product/(:num)'] = 'company/editproduct/$1';
$route['admin/product/(:any)'] = 'company/product/$1';

$route['admin/project'] = 'company/project';
$route['admin/project/(:num)'] = 'company/editproject/$1';
$route['admin/project/(:any)'] = 'company/project/$1';

$route['admin/wit'] = 'company/wit';
$route['admin/wit/(:any)'] = 'company/wit/$1';

$route['admin/version'] = 'company/version';
$route['admin/version/(:any)'] = 'company/version/$1';
$route['admin/versioncompare'] = 'company/versioncompare';

/* End of file routes.php */
/* Location: ./application/config/routes.php */