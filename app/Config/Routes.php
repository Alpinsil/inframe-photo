<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Mengatur allamat semua halaman
$routes->get('/help', 'Home::index', ['as' => 'help']);
$routes->get('/', 'Home::index');
$routes->get('/test', 'Home::test');
$routes->add('/register', 'Auth::register');
$routes->post('/register', 'Auth::proses_register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::proses_login');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Admin\Dashboard::index');
$routes->get('/list-order', 'Admin\listOrder::index');

$routes->get('/faq-admin', 'Admin\Faq::index');
$routes->post('/faq-admin', 'Admin\Faq::create');
$routes->put('/faq-admin', 'Admin\Faq::update');
$routes->delete('/faq-admin', 'Admin\Faq::delete');
