<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Mengatur alamat semua halaman
$routes->get('/help', 'Home::index', ['as' => 'help']);
$routes->get('/', 'Home::index');
$routes->get('/test', 'Home::test');
$routes->add('/register', 'Auth::register');
$routes->post('/register', 'Auth::proses_register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::proses_login');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Admin\Dashboard::index');
$routes->get('/list-order', 'Admin\ListOrder::index');

// faq
$routes->get('/faq-admin', 'Admin\Faq::index');
$routes->post('/faq-admin', 'Admin\Faq::create');
$routes->put('/faq-admin', 'Admin\Faq::update');
$routes->delete('/faq-admin', 'Admin\Faq::delete');

// services
$routes->get('/services', 'Admin\Services::index');
$routes->post('/services', 'Admin\Services::create');
$routes->put('/services', 'Admin\Services::update');
$routes->delete('/services', 'Admin\Services::delete');

// tags
$routes->get('/tags-admin', 'Admin\Tags::index');
$routes->post('/tags-admin', 'Admin\Tags::create');
$routes->put('/tags-admin', 'Admin\Tags::update');
$routes->delete('/tags-admin', 'Admin\Tags::delete');

// portfolio
$routes->get('/portfolio-admin', 'Admin\Portfolio::index');
$routes->post('/portfolio-admin', 'Admin\Portfolio::create');
$routes->put('/portfolio-admin', 'Admin\Portfolio::update');
$routes->delete('/portfolio-admin', 'Admin\Portfolio::delete');

// profile
$routes->get('/profile', 'Profile::index');
$routes->put('/profile', 'Profile::update');

// payment
$routes->get('/payment/(:any)', 'payment::index/$1');
