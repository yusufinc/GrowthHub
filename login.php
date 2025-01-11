<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    
    $user = loginUser($email, $password);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Geçersiz e-posta veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowthHub - Giriş</title>
    <link rel="stylesheet" href="./assets/css/kayit.css">
</head>
<body>
    <div class="auth-container">
     <!--   <div class="logo">
            <img src="assets/images/logo.png" alt="GrowthHub Logo">
        </div> -->
        <h1>GrowthHub'a Hoş Geldiniz</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">E-posta Adresi</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Giriş Yap</button>
        </form>
        <div class="auth-links">
            <p>Hesabınız yok mu? <a href="pages/kayit.php">Hesap Oluştur</a></p>
        </div>
    </div>
</body>
</html> 