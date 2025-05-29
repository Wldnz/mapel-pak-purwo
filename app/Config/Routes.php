<?php

use App\Controllers\RiwayatPeminjamanAdmin;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Pages;
use App\Controllers\Login;
use App\Controllers\DashboardAdmin;
use App\Controllers\HalamanAkunAdmin;
use App\Controllers\HalamanBukuAdmin;
use App\Controllers\HalamanProfile;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);


$routes->get('register', [Login::class, 'register']);
$routes->get('login', [Login::class, 'index']);
$routes->post('login', [Login::class, 'login']);
$routes->post('clear-session', [Login::class, 'clearSession']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('login', [Login::class, 'index']);

$routes->get('admin/dashboard', [DashboardAdmin::class, 'index']);
$routes->get('admin/profile', [HalamanProfile::class, 'index']);
$routes->get('admin/laporan', [RiwayatPeminjamanAdmin::class, 'index']);
$routes->get('admin/management-buku', [HalamanBukuAdmin::class, 'index']);
$routes->post('admin/management-buku', [HalamanBukuAdmin::class, 'updateBook']);
$routes->get('admin/management-buku/add-book', [HalamanBukuAdmin::class, 'addBookPage']);
$routes->post('admin/management-buku/add-book', [HalamanBukuAdmin::class, 'addBookPage']);
$routes->post('admin/management-buku/create-book-copy', [HalamanBukuAdmin::class, 'createBookCopy']);
$routes->post('admin/management-buku/update-book-copy', [HalamanBukuAdmin::class, 'updateBookCopy']);

$routes->get('admin/management-akun', [HalamanAkunAdmin::class, 'index']);
$routes->post('admin/create-akun', [HalamanAkunAdmin::class, 'createAccount']);
$routes->post('admin/update-akun', [HalamanAkunAdmin::class, 'updateAccount']);

$routes->post('admin/verif-akun', [HalamanAkunAdmin::class, 'verifAccount']);
$routes->post('admin/cancel-verif-akun', [HalamanAkunAdmin::class, 'cancelVerification']);

$routes->get('admin/management-riwayat-peminjaman', [RiwayatPeminjamanAdmin::class, 'index']);
$routes->post('admin/management-riwayat-peminjaman/create', [RiwayatPeminjamanAdmin::class, 'createPeminjaman']);
$routes->post('admin/management-riwayat-peminjaman/accept', [RiwayatPeminjamanAdmin::class, 'acceptRequest']);
$routes->post('admin/management-riwayat-peminjaman/cancel', [RiwayatPeminjamanAdmin::class, 'cancelRequest']);
$routes->post('admin/management-riwayat-peminjaman/return', [RiwayatPeminjamanAdmin::class, 'returnBook']);


