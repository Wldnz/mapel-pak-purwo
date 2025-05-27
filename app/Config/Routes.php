<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Pages;
use App\Controllers\Login;
use App\Controllers\DashboardAdmin;
use App\Controllers\HalamanAkunAdmin;
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
$routes->post('admin/management-buku', [HalamanBukuAdmin::class, 'updateBook']);
$routes->get('admin/management-buku/add-book', [HalamanBukuAdmin::class, 'addBookPage']);
$routes->post('admin/management-buku/add-book', [HalamanBukuAdmin::class, 'addBookPage']);

$routes->get('admin/management-akun', [HalamanAkunAdmin::class, 'index']);
$routes->post('admin/create-akun', [HalamanAkunAdmin::class, 'createAccount']);
$routes->post('admin/update-akun', [HalamanAkunAdmin::class, 'updateAccount']);

$routes->post('admin/verif-akun', [HalamanAkunAdmin::class, 'verifAccount']);
$routes->post('admin/cancel-verif-akun', [HalamanAkunAdmin::class, 'cancelVerification']);
