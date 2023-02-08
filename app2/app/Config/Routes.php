<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('login', 'Home::login');
$routes->post('loginproses', 'Home::loginproses');
$routes->get('data_jobsite', 'Admin::data_jobsite');
$routes->post('input_jobsite', 'Admin::input_jobsite');
$routes->get('delete_jobsite/(:num)', 'Admin::delete_jobsite/$1');
$routes->get('data_populasi', 'Admin::data_populasi');
$routes->post('input_populasi', 'Admin::input_populasi');
$routes->get('delete_populasi/(:num)', 'Admin::delete_populasi/$1');

$routes->get('input_cwp', 'Admin::input_cwp');
$routes->post('submit_cwp', 'Admin::submit_cwp');
$routes->get('resume', 'Admin::resume');

$routes->get('changepwd', 'Admin::changepwd');
$routes->post('submit_changepwd', 'Admin::submit_changepwd');
$routes->get('logout', 'Home::logout');

$routes->post('get_model_unit', 'AjaxCWP::get_model_unit');
$routes->post('get_code_unit', 'AjaxCWP::get_code_unit');
$routes->get('resume_data', 'AjaxCWP::data_cbm');
$routes->get('jumlah_followup_open', 'AjaxCWP::jumlah_followup_open');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
