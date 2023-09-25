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
$routes->get('/playlist/{:any}', 'Playlist::playlist/1');


