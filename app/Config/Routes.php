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

// List Order
$routes->get('/list-order', 'Admin\ListOrder::index');
$routes->delete('/list-order', 'Admin\ListOrder::delete');
$routes->put('/list-order', 'Admin\ListOrder::update');


// List Order
$routes->get('/list-orders-guest', 'Guest\ListOrder::index');
$routes->delete('/list-orders-guest', 'Guest\ListOrder::delete');
$routes->put('/list-orders-guest', 'Guest\ListOrder::update');

// faq
$routes->get('/faq-admin', 'Admin\Faq::index');
$routes->post('/faq-admin', 'Admin\Faq::create');
$routes->put('/faq-admin', 'Admin\Faq::update');
$routes->delete('/faq-admin', 'Admin\Faq::delete');

// payment-methods
$routes->get('/payment-methods', 'Admin\PaymentMethods::index');
$routes->post('/payment-methods', 'Admin\PaymentMethods::create');
$routes->put('/payment-methods', 'Admin\PaymentMethods::update');
$routes->delete('/payment-methods', 'Admin\PaymentMethods::delete');

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
$routes->post('/payment/(:any)', 'payment::create/$1');

// Chat Admin
$routes->get('/chat-admin', 'Admin\Chat::index');
$routes->post('/chat-admin', 'Admin\Chat::create');
$routes->put('/chat-admin', 'Admin\Chat::update');
$routes->delete('/chat-admin', 'Admin\Chat::delete');

// Chat Guest
$routes->get('/chat-guest', 'Guest\Chat::index');
$routes->post('/chat-guest', 'Guest\Chat::create');
$routes->put('/chat-guest', 'Guest\Chat::update');
$routes->delete('/chat-guest', 'Guest\Chat::delete');

$routes->get('/chat-to-guest', 'Admin\ChatToGuest::index');
$routes->post('/chat-to-guest', 'Admin\ChatToGuest::create');

// Riwayat
$routes->get('/riwayat-admin', 'Admin\Riwayat::index');
$routes->post('/riwayat-admin', 'Admin\Riwayat::create');
$routes->put('/riwayat-admin', 'Admin\Riwayat::update');
$routes->delete('/riwayat-admin', 'Admin\Riwayat::delete');
