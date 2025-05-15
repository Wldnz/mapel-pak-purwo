


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Perpustakaan</title>
    <link rel="shortcut icon" href="<?= images ?>/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pridi:wght@200;300;400;500;600;700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= css ?>/style.css">
    <link rel="stylesheet" href="<?= css ?>/login.css">
</head>
<body>
    
   <aside class="left">
    <img src="<?= images ?>/logo.svg" alt="logo" class="perpus-log">
    <form action="" method="post">
        <div class="text-field">
            <label for="username">Username<span style="color:red;">*</span></label>
            <input 
            type="text" name="username" id="username" 
            minlength="3" maxlength="120" 
            placeholder="Masukkan username"
            required>
            <p class="error-message">Minimal 3 karakter dan maximal karakter adalah 120 karakter</p>
        </div>
        <div class="text-field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" 
            placeholder="Masukkan username"
            minlength="8" required>
            <p class="error-message">Minimal 8 karakter</p>
        </div>
        <div class="text-bantuan">
            <div class="remember-me">
                <input type="checkbox" name="remember-me" checked="false" id="remember-me">
                <label for="remember-me">ingat saya selama 7 hari?</label>
            </div>
            <div class="bantuan">
                <a href="#">Lupa username?</a>
                <p>|</p>
                <a href="#">Lupa Password?</a>
            </div>
        </div>
        <div class="text-field blm-punya-akun">
            <button type="submit" class="btn">Masuk</button>
            <div class="blm-punya-akun">
                <p>Belum Punya Akun?</p>
                <a href="#">Daftar Disini...</a>
            </div>
        </div>
    </form>
   </aside>
   <aside class="right">
        <div>
            <h2>Perpustakaan Xyz</h2>
            <p>Perpustakaan Xyz adalah perpustakaan yang menyediakan bermacam-macam buku yang dapat membantu anda dalam mencari informasi, buku buku juga akan memberikan wawasan kepada anda</p>
            <button class="btn">Lihat buku</button>
        </div>
   </aside>

</body>
</html>