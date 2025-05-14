
<?php

$isFailedLogin = $failLogin || false;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PERPUSTAKAAN XYZ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo css.'/poppins.css'?>">
    <link rel="stylesheet" href="<?php echo css.'/style.css'?>">
</head>

<body>
    <main class="main-login">
        <div class="header-text">
            <h2>Selamat Datang,</h2>    
            <p>Perpustakaan Xyz adalah perpustakaan yang menyediakan buku buku yang berguna dan bermanfaat untuk dibaca,<br><mark>silahkan login untuk mendapatkan hak akses sebagai anggota kami.</mark></p>    
        </div>
        <form action="" method="POST">
            <div class="">
                <h3 style="background-color:blue; color:white; padding: 0 10px; border-radius:4px;">Login</h3>
                <p style="display:<?php echo $isFailedLogin? "block"  : "none" ?>;">Data yang diberikan tidak cocok, harap coba lagi</p>
                <div class="text-field">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" minlength="3" maxlength="60" placeholder="Masukkan username..." required>
                </div>
                <div class="text-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" minlength="8" placeholder="Masukkan password..." minlength="8" required>
                </div>
                <?php if($isFailedLogin){  ?>
                    <div class="forgot-password">
                        <a href="#" class="link">Lupa username?</a>
                        <a href="#" class="link">|</a>
                        <a href="#" class="link">Lupa Password?</a>
                    </div>
                <?php }?>
                <button type="submit" class="btn poppins-semibold" username="login">Masuk</button>
                <div class="dont-have-acc">
                    <p>Belum punya akun? <a href="#" class="link">Daftar Sekarang...</a></p>
                </div>
            </div>
        </form>
    </main>
</body>
</html>