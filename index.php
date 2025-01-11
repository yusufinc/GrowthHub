<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Kullanıcı giriş kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$isSubPage = false; // Ana dizinde olduğumuzu belirt
$pageStyle = 'anasayfa';
$pageScript = 'anasayfa';
include 'includes/header.php';
?>

<main class="anasayfa-container">
    <div class="motivation-cards">
        <div class="card" onclick="openPopup(1)">
            <img src="./assets/images/motivation1.jpeg" alt="Motivasyon 1">
            <h3>Hedeflerine Odaklan</h3>
            <p>Her gün bir adım daha ileriye...</p>
        </div>
        <div class="card" onclick="openPopup(2)">
            <img src="./assets/images/motivation2.jpg" alt="Motivasyon 2">
            <h3>Asla Vazgeçme</h3>
            <p>Zorluklar seni güçlendirir...</p>
        </div>
        <div class="card" onclick="openPopup(3)">
            <img src="./assets/images/motivation3.jpg" alt="Motivasyon 3">
            <h3>Hayallerine İnan</h3>
            <p>İnandığın her şey mümkündür...</p>
        </div>
    </div>
    
    <div class="motivation-quote">
        <p>Başka bir hedef belirlemek ve yeni rüyalarını gerçekleştirmek için asla çok geç değil.</p>
    </div>
</main>

<!-- Popup Modal -->
<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div id="popupContent"></div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
