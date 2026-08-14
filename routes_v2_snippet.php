<?php
// Agregar estas líneas a application/config/routes.php
$route['website/v2/(:num)'] = 'website_v2/index/$1';
$route['website/v2'] = 'website_v2/index/1';
