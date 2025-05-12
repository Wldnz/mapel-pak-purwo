<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);

use App\Controllers\Pages;

$routes->get('pages', [Pages::class, 'index']);