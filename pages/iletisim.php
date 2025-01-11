<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageStyle = 'iletisim';
$pageScript = 'iletisim';
include '../includes/header.php';
?>

<div class="container">
    <h1>GERİ BİLDİRİMLERİNİZİ BİZİMLE PAYLAŞIN</h1>
    
    <form action="" class="contact__form" id="contact-form">
        <div class="contact__form-div">
            <label for="" class="contact__form-tag">Adınız</label>
            <input name="user_name" type="text" class="contact__form-input" placeholder="Lütfen Adınızı Giriniz">
        </div>

        <div class="contact__form-div">
            <label for="" class="contact__form-tag">E-Posta</label>
            <input name="user_email" type="email" class="contact__form-input" placeholder="Lütfen E-Posta Adresinizi Giriniz">
        </div>

        <div class="contact__form-div contact__form-area">
            <label for="" class="contact__form-tag">Önerileriniz, görüşleriniz, istekleriniz, şikayetleriniz</label>
            <textarea name="user_mesage" placeholder="Önerileriniz, görüşleriniz, istekleriniz, şikayetlerinizi giriniz lütfen" id="user__message" cols="30" rows="10" class="contact__form-input"></textarea>
        </div>

        <div class="button-wrapper">
            <p class="contact__message" id="contact-message"></p>
            <button type="submit" class="button">Mesaj Gönder</button>
        </div>
    </form>
</div>

<!-- EmailJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

<?php include '../includes/footer.php'; ?> 