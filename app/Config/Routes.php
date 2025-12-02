<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home Route (Root)
$routes->get('/', 'HomeController::index');

// Device Types Routes
$routes->group('device-types', function($routes) {
    $routes->get('/', 'DeviceTypeController::index');
    $routes->get('new', 'DeviceTypeController::new');
    $routes->post('create', 'DeviceTypeController::create');
    $routes->get('(:num)', 'DeviceTypeController::show/$1');
    $routes->get('(:num)/edit', 'DeviceTypeController::edit/$1');
    $routes->post('(:num)/update', 'DeviceTypeController::update/$1');
    $routes->get('(:num)/delete', 'DeviceTypeController::delete/$1');
});


// Devices Routes
$routes->group('devices', function($routes) {
    $routes->get('/', 'DeviceController::index');
    $routes->get('new', 'DeviceController::new');
    $routes->post('create', 'DeviceController::create');
    $routes->get('(:num)', 'DeviceController::show/$1');
    $routes->get('(:num)/edit', 'DeviceController::edit/$1');
    $routes->post('(:num)/update', 'DeviceController::update/$1');
    $routes->get('(:num)/delete', 'DeviceController::delete/$1');
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    // Device Types API
    $routes->get('device-types', 'DeviceTypeApiController::index');
    $routes->get('device-types/(:num)', 'DeviceTypeApiController::show/$1');
    
    // Devices API
    $routes->get('devices', 'DeviceApiController::index');
    $routes->get('devices/(:num)', 'DeviceApiController::show/$1');
    $routes->post('devices', 'DeviceApiController::create');
    $routes->put('devices/(:num)', 'DeviceApiController::update/$1');
    $routes->delete('devices/(:num)', 'DeviceApiController::delete/$1');
});

// Netbox Routes
$routes->group('netbox', function($routes) {
    $routes->get('devices', 'NetboxController::index');
});