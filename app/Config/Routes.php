<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Login;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);

use App\Controllers\Pages;

$routes->get('pages', [Pages::class, 'index']);
$routes->get('login', [Login::class, 'index']);