<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api'] = 'dashboard/API';

#LOGIN
$route['reg'] = 'login/register';
$route['registerData']['post'] = 'login/register/insert_register';

#LOGOUT
$route['logout'] = 'login/doOut';

#ANTRIAN
$route['list_antrian'] = 'antrian/list_antrian';

#SOAP
$route['umum'] = 'soap/soap_umum';
$route['gigi'] = 'soap/soap_gigi';
$route['umum/list_pasien']['post'] = 'soap/soap_umum/list_pasien';
$route['umum/get_soap/(:any)'] = 'soap/soap_umum/get_soap/$1';
$route['umum/get_pasien_by_struck/(:any)'] = 'soap/soap_umum/get_pasien_by_struck/$1';
$route['umum/save_ttd']['post'] = 'soap/soap_umum/ttd';
$route['umum/insert_soap']['post'] = 'soap/soap_umum/insert_soap';
$route['print_umum/(:any)'] = 'soap/soap_umum/print/$1';
$route['print_gigi/(:any)'] = 'soap/soap_gigi/print/$1';

$route['gigi/list_pasien']['post'] = 'soap/soap_gigi/list_pasien';
$route['gigi/get_soap/(:any)'] = 'soap/soap_gigi/get_soap/$1';
$route['gigi/save_ttd']['post'] = 'soap/soap_gigi/ttd';
$route['gigi/insert_soap']['post'] = 'soap/soap_gigi/insert_soap';