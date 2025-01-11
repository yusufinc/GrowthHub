<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$message = '';
$error = '';

// Şifre güncelleme işlemi
if (isset($_POST['sifreGuncelle'])) {
    $username = $_POST['username'];
    $eskiSifre = $_POST['eskiSifre'];
    $yeniSifre = $_POST['yeniSifre'];
    $yeniSifreTekrar = $_POST['yeniSifreTekrar'];

    // Şifrelerin eşleşip eşleşmediğini kontrol et
    if ($yeniSifre !== $yeniSifreTekrar) {
        $error = "Yeni şifreler eşleşmiyor!";
    } else {
        // Kullanıcı adı ve eski şifreyi kontrol et
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ? AND username = ?");
        $stmt->execute([$userId, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($eskiSifre, $user['password'])) {
            // Yeni şifreyi güncelle
            $hashedPassword = password_hash($yeniSifre, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashedPassword, $userId]);
            $message = "Şifreniz başarıyla güncellendi!";
        } else {
            $error = "Kullanıcı adı veya eski şifre yanlış!";
        }
    }
}

// Hesap silme işlemi
if (isset($_POST['hesapSil'])) {
    $username = $_POST['silUsername'];
    $password = $_POST['silPassword'];

    // Kullanıcı bilgilerini kontrol et
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ? AND username = ?");
    $stmt->execute([$userId, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Kullanıcıyı sil
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);

        // Oturumu sonlandır ve login sayfasına yönlendir
        session_destroy();
        header("Location: ../login.php");
        exit();
    } else {
        $error = "Kullanıcı adı veya şifre yanlış!";
    }
}

$pageStyle = 'hesapYonetimi';
include '../includes/header.php';
?>

<main class="hesap-container">
    <h1>Hesap Yönetimi</h1>

    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <section class="sifre-guncelleme">
        <h2>Şifre Güncelleme</h2>
        <form method="POST" class="hesap-form">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="eskiSifre">Eski Şifre</label>
                <input type="password" id="eskiSifre" name="eskiSifre" required>
            </div>

            <div class="form-group">
                <label for="yeniSifre">Yeni Şifre</label>
                <input type="password" id="yeniSifre" name="yeniSifre" required>
            </div>

            <div class="form-group">
                <label for="yeniSifreTekrar">Yeni Şifre Tekrar</label>
                <input type="password" id="yeniSifreTekrar" name="yeniSifreTekrar" required>
            </div>

            <button type="submit" name="sifreGuncelle" class="btn-guncelle">Şifreyi Güncelle</button>
        </form>
    </section>

    <section class="tehlikeli-bolge">
        <h2>Hesap Silme</h2>
        <p class="uyari">Bu işlem geri alınamaz. Hesabınız ve tüm verileriniz kalıcı olarak silinecektir.</p>
        <form method="POST" class="hesap-form" onsubmit="return confirmDelete();">
            <div class="form-group">
                <label for="silUsername">Kullanıcı Adı</label>
                <input type="text" id="silUsername" name="silUsername" required>
            </div>

            <div class="form-group">
                <label for="silPassword">Şifre</label>
                <input type="password" id="silPassword" name="silPassword" required>
            </div>

            <button type="submit" name="hesapSil" class="btn-tehlike">Hesabı Sil</button>
        </form>
    </section>
</main>

<script>
function confirmDelete() {
    if (confirm('Hesabınızı silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!')) {
        // LocalStorage'daki tüm hedefleri temizle
        localStorage.removeItem('hedefler');
        localStorage.removeItem('tamamlananHedefler');
        localStorage.removeItem('hedefGecmisi');
        // Diğer ilgili localStorage verileri varsa onları da temizle
        
        return true; // Form gönderimini onayla
    }
    return false; // Form gönderimini iptal et
}
</script>

<?php include '../includes/footer.php'; ?> 