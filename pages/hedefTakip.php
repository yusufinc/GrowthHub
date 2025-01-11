<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageStyle = 'hedefTakip';
$pageScript = 'hedefTakip';
include '../includes/header.php';
?>

<main class="hedef-container">
    <div class="hedef-header">
        <h1>Hedeflerim</h1>
        <div class="hedef-buttons">
            <button class="btn active" onclick="showActiveGoals()">Aktif Hedefler</button>
            <button class="btn completed" onclick="showCompletedGoals()">Tamamlanmış Hedefler</button>
        </div>
    </div>

    <div class="hedef-form">
        <input type="text" id="hedefBaslik" placeholder="Yeni hedef başlığı...">
        <textarea id="hedefAciklama" placeholder="Hedef açıklaması..."></textarea>
        <div class="form-row">
            <input type="date" id="hedefTarih">
            <button onclick="hedefEkle()" class="btn add">Hedef Ekle</button>
        </div>
    </div>

    <div id="aktifHedefler" class="hedef-list">
        <!-- Aktif hedefler buraya JavaScript ile eklenecek -->
    </div>

    <div id="tamamlananHedefler" class="hedef-list" style="display: none;">
        <!-- Tamamlanan hedefler buraya JavaScript ile eklenecek -->
    </div>
</main>

<?php include '../includes/footer.php'; ?> 