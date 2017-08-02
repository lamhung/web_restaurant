<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'dashboard';

$route['sign_in'] = 'auth/sign_in';
$route['sign_out'] = 'auth/sign_out';

# Menu
$route['menu/add'] = 'menu/add';
$route['menu/edit'] = 'menu/edit';
$route['menu/delete'] = 'menu/delete';
$route['menu'] = 'menu/index';

# User
$route['user/add'] = 'user/add';
$route['user/edit'] = 'user/edit';
$route['user/delete'] = 'user/delete';
$route['user'] = 'user/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
