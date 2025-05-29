
<?php 

    $showPassword = false;

?>

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
       <div class="header-login">
            <img src="<?= images ?>/logo.svg" alt="logo" class="perpus-log">
            <div class="header-text">
                <h2>Selamat Datang!</h2>
                <p>Silahkan login untuk mendapatkan wewenang sebagai anggota kami...</p>
            </div>
            <?php
                if($failLogin){ ?>
                  <p class="error-message"><?= $error_message ?></p>  
            <?php }
            ?>
        </div>
    <form action="" method="post">
        <div class="text-field">
            <label for="username" class="wajib">Username</label>
            <input 
            type="text" name="username" id="username" 
            minlength="3" maxlength="120" 
            placeholder="Masukkan username"
            required>
            <p class="error-message hidden">Minimal 3 karakter dan maximal karakter adalah 120 karakter</p>
        </div>
        <div class="text-field">
            <label for="password" class="wajib">Password</label>
            <div class="password-input">
                <input type="password" name="password" id="password" 
                placeholder="Masukkan username"
                minlength="8" required>
                <img src="<?= icons ?>/close-eye.svg" alt="">
            </div>
            <p class="error-message hidden">Minimal 8 karakter</p>
        </div>
        <div class="text-bantuan">
            <?php if($failLogin){
                echo '<div class="bantuan">
                <a href="#">Lupa username?</a>
                <p>|</p>
                <a href="#">Lupa Password?</a>
            </div>';
            } ?>
            <div class="remember-me">
                <input type="checkbox" name="remember-me" id="remember-me">
                <label for="remember-me" class="wajib">Menyetujui <a href="#">Syarat & Ketentuan</a></label>
            </div>
        </div>
        <div class="text-field blm-punya-akun">
            <button type="button" class="btn btn-disabled" id="btn-login">Masuk</button>
            <div class="blm-punya-akun">
                <p>Belum Punya Akun?</p>
                <a href="<?= base_url("register") ?>">Daftar Disini...</a>
            </div>
        </div>
    </form>
   </aside>
   <aside class="right">
        <main>
            <div class="populer-buku">
                <h2>Buku - Buku Yang Populer</h2>
            </div>
            <div class="content">
                <img src="" alt="buku" id="buku-populer">
                <div class="wrapper-dot">
                    <?php
                        foreach($books as $book){ ?>
                            <div class="dot"></div>
                    <?php } ?>
                </div>
                <p id="judul-buku">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, praesentium.</p>
                <button class="btn btn-transparent btn-lihat-buku" id="lihat-buku">Lihat Buku</button>
            </div>
        </main>
        <div class="footer-helper">
            <div class="copyrights">
                <p>&copy; <?= date('Y') ?> PerpustakaanXyz</p>
            </div>
        </div>
   </aside>
    <?php
     $books_encode = json_encode($books);
     echo "<script>
        const wrapper_dot = document.querySelector('.wrapper-dot').children;
        const buku_populer = document.getElementById('buku-populer'); 
        const judul_buku = document.getElementById('judul-buku');
        const lihat_buku = document.getElementById('lihat-buku');
        const remember_me = document.getElementById('remember-me');
        const books = $books_encode;
        const showPasswordParent = document.querySelector('.password-input').children;
        let index = 0;
        let showPassword = false;

        buku_populer.src = books[index].image_url;
        judul_buku.textContent = books[index].title;
        wrapper_dot[index].classList.add('bg-active');
        remember_me.onchange = (e) => {
            if(e.target.checked){
                document.getElementById('btn-login').type = 'submit';
                document.getElementById('btn-login').classList.remove('btn-disabled');
            }else{
                document.getElementById('btn-login').type = 'button';
                document.getElementById('btn-login').classList.add('btn-disabled');
            }
        };


        setInterval(() => {
            wrapper_dot[index].classList.remove('bg-active');
            if(index === books.length - 1){
                index = 0
            }else{
                index += 1;
            }
            buku_populer.src = books[index].image_url;
            judul_buku.textContent = books[index].title;
            wrapper_dot[index].classList.add('bg-active');
        },5000)
        lihat_buku.onclick = () => console.log('pergi ke halaman'+ books[index].title);
        showPasswordParent[1].onclick = () => {
          if(showPassword){
            showPasswordParent[0].type = 'text';
            showPasswordParent[1].src = showPasswordParent[1].src.replace('close-eye.svg','open-eye.svg');
          }else{
            showPasswordParent[0].type = 'password';
            showPasswordParent[1].src = showPasswordParent[1].src.replace('open-eye.svg','close-eye.svg');
          }
          showPassword = !showPassword;
        };
    </script>"
    
    ?>
</body>
</html>