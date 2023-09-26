<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->post('/upload', 'MainController::upload');
$routes->get('/delete_song/(:any)', 'MainController::delete_song/$1');
$routes->get('/playlist/(:any)', 'MainController::playlist/$1');
$routes->get('/create_playlist', 'MainController::create_playlist');
$routes->post('/save_playlist', 'MainController::save_playlist');
$routes->get('/add_to_playlist/(:any)', 'MainController::add_to_playlist/$1');
$routes->post('/save_adding/(:any)', 'MainController::save_adding/$1');
$routes->get('/remove_song/(:any)/(:any)', 'MainController::remove_song/$1/$2');
$routes->get('/delete_playlist/(:any)', 'MainController::delete_playlist/$1');