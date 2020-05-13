<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';

// API Endpoint
$route['API/'] = 'API/';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
