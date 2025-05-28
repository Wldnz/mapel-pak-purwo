<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pridi:wght@200;300;400;500;600;700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= images ?>/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= css ?>/style.css">
    <?php
        if(isset($nameFileStyleSheet)){
            echo "<link rel='stylesheet' href='". css ."/$nameFileStyleSheet.css'>";
        }
    ?>
</head>
<body>

    <header>
        <nav>
            <img src="<?= images ?>/logo.svg" alt="logo-kami">
            <div class="main-menu">
                <ul class="menu-menu list">
                    <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li>Profile</li>
                    <!-- <li><a href="<?= base_url('buku') ?>">Buku - Buku</a></li> -->
                    <li class="option-menu-parrent">
                        <p>Management</p>
                        <div class="option-menu">
                            <a href="<?= base_url('admin/management-buku')?>">Management Buku</a>
                            <a href="<?= base_url('admin/management-akun')?>">Management Akun</a>
                            <a href="<?= base_url('admin/management-riwayat-peminjaman')?>">Management Riwayat</a>
                        </div>
                    </li>
                    <li><a href="<?= base_url('bantuan') ?>">Bantuan</a></li>
                </ul>
                <!-- <div class="menu-menu">
                    <a href="<?= base_url('login') ?>">Masuk</a>
                    <p>|</p>
                    <a href="<?= base_url('register') ?>">Buat Akun</a>
                </div> -->
                <div class="profile">
                    <img src="https://res.cloudinary.com/ddiulakke/image/upload/v1747055039/vecteezy_profile-icon-design-vector_5544718_cje74w.jpg" alt="profile-image">
                    <div class="profile-menu">
                        <div class="">
                            <a href="<?= base_url("/login") ?>">Log out</a>
                            <!-- <a href="">Log out</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
