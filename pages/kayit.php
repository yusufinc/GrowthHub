<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    
    if ($password !== $password_confirm) {
        $error = "Şifreler eşleşmiyor!";
    } else {
        if (registerUser($username, $email, $password)) {
            $success = "Hesabınız başarıyla oluşturuldu! Şimdi giriş yapabilirsiniz.";
        } else {
            $error = "Kayıt sırasında bir hata oluştu. Bu e-posta adresi zaten kullanılıyor olabilir.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowthHub - Kayıt Ol</title>
    <link rel="stylesheet" href="../assets/css/kayit.css">
</head>
<body>
    <div class="auth-container">
       <!-- <div class="logo">
            <img src="../assets/images/logo.png" alt="GrowthHub Logo">
        </div> -->
        <h1>Hesap Oluştur</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-posta Adresi</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Şifre Tekrar</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
            </div>
            <button type="submit" class="btn">Kayıt Ol</button>
        </form>
        <div class="auth-links">
            <p>Zaten hesabınız var mı? <a href="../login.php">Giriş Yap</a></p>
        </div>
    </div>
</body>
</html> 