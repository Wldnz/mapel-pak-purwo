<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Pages;
use App\Controllers\Login;
use App\Controllers\DashboardAdmin;
use App\Controllers\HalamanBukuAdmin;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);


$routes->get('login', [Login::class, 'index']);
$routes->post('login', [Login::class, 'login']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('login', [Login::class, 'index']);

$routes->get('admin/dashboard', [DashboardAdmin::class, 'index']);
$routes->get('admin/management-buku', [HalamanBukuAdmin::class, 'index']);