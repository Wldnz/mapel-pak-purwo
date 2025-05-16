<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= css ?>/style.css">
</head>
<body>

    <header>
        <nav>
            <img src="<?= images ?>/logo.svg" alt="logo-kami">
            <div class="main-menu">
                <ul class="menu-menu list">
                    <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li>Profile</li>
                    <li><a href="<?= base_url('buku') ?>">Buku - Buku</a></li>
                    <li>Aktivitas</li>
                    <li><a href="<?= base_url('bantuan') ?>">Bantuan</a></li>
                </ul>
                <div class="menu-menu">
                    <a href="<?= base_url('login') ?>">Masuk</a>
                    <p>|</p>
                    <a href="<?= base_url('register') ?>">Buat Akun</a>
                </div>
            </div>
        </nav>
    </header>
