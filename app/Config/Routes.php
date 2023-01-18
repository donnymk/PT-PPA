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
$routes->get('data_model_unit', 'Admin::data_model_unit');
$routes->get('data_komponen', 'Admin::data_komponen');
$routes->get('data_rekomendasi', 'Admin::data_rekomendasi');
$routes->get('input', 'Admin::input');
$routes->post('get_code_unit', 'Admin::get_code_unit');
$routes->post('input_populasi', 'Admin::input_populasi');
$routes->post('input_komponen', 'Admin::input_komponen');
$routes->post('input_rekomendasi', 'Admin::input_rekomendasi');
$routes->post('input_cbm', 'Admin::input_cbm');
$routes->get('resume', 'Admin::resume');
$routes->get('resume_data', 'Admin::data_cbm');
$routes->get('cetak_form/(:num)', 'PrintForm::index/$1');
$routes->get('update/(:num)', 'Admin::update/$1');
$routes->post('update_followup', 'Admin::update_followup');
$routes->get('delete/(:num)', 'Admin::delete_followup/$1');
$routes->get('delete_populasi/(:num)', 'Admin::delete_populasi/$1');
$routes->get('delete_komponen/(:num)', 'Admin::delete_komponen/$1');
$routes->get('delete_rekomendasi/(:num)', 'Admin::delete_rekomendasi/$1');
$routes->get('jumlah_followup_open', 'Ajax::jumlah_followup_open');
$routes->get('logout', 'Home::logout');

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
