<?php

    $isFailedLogin = false;

    if(isset($_POST['username']) && isset($_POST['password'])){
        echo 'login yokok';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Perpustakaan</title>
</head>
<body>
    <aside class="left">
        <h2>Smart Perpus</h2>
        <form action="#">
            <div class="field-input">
                <label for="username">username</label>
                <input type="text" name="username" id="username" minlength="3" max="120" placeholder="masukkan username...">
            </div>
            <div class="field-input">
                <label for="password">password</label>
                <input type="password" name="password" id="password" minlength="3" max="120" placeholder="masukkan password...">
            </div>
            <div class="field-text">
                <p>Don't have account? <a href="./register">Register here...</a></p>
            </div>
            <button type="submit" class="btn btn-login">Masuk</button>
            <?php 
                if($isFailedLogin){
            ?>
                <div class="field-text">
                    <a href="./forgot_password">Forgot Password?</a>
                </div>
            <?php } ?>
            
        </form>
    </aside>
    <aside class="right">
        
    </aside>
</body>
</html>

