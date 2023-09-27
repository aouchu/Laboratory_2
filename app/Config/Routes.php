<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/music', 'Playlist::index');
$routes->get('/search', 'Playlist::search');
$routes->post('/save', 'Playlist::save');
$routes->post('/save_p', 'Playlist::save_p');
$routes->get('/delete_p/(:any)', 'Playlist::delete_p/$1');
$routes->get('/delete/(:any)/(:any)', 'Playlist::delete/$1/$2');
$routes->get('/playlist/(:any)/(:any)', 'Playlist::playlist/$1/$2');

