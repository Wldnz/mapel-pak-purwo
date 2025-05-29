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
        $account = session()->get("account");
    ?>
</head>
<body>

    <header>
        <nav>
            <img src="<?= images ?>/logo.svg" alt="logo-kami">
            <div class="main-menu">
                <ul class="menu-menu list">
                    <li><a href="<?= base_url('/') ?>">Dashboard</a></li>
                    <li><a href="<?= base_url('about-me') ?>">About</a></li>
                    <li><a href="<?= base_url('buku') ?>">Buku</a></li>
                    <li><a href="<?= base_url('bantuan') ?>">Bantuan</a></li>
                </ul>
                <?php 
                    if(isset($account) && $account["role"] == 'user') {?>
                        <div class="profile">
                    <img src="https://res.cloudinary.com/ddiulakke/image/upload/v1747055039/vecteezy_profile-icon-design-vector_5544718_cje74w.jpg" alt="profile-image">
                    <div class="profile-menu">
                        <div class="">
                           <form action="<?= base_url("clear-session") ?>" method="post"><button type="submit">Log out</button></form>
                            <!-- <a href="">Log out</a> -->
                            <a href="<?= base_url('profile') ?>">Profile</a>
                            <a href="<?= base_url('riwayat-peminjaman') ?>">Riwayat Peminjaman</a>
                        </div>
                    </div>
                </div>
                   <?php } else { ?>
                         <div class="menu-menu">
                    <a href="<?= base_url('login') ?>">Masuk</a>
                    <p>|</p>
                    <a href="<?= base_url('register') ?>">Buat Akun</a>
                </div>
                   <?php } 
                ?>
            </div>
        </nav>
    </header>
