<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageStyle = 'ilerleme';
$pageScript = 'ilerleme';
include '../includes/header.php';
?>

<main class="ilerleme-container">
    <div class="ilerleme-header">
        <h1>İlerleme Durumu</h1>
    </div>

    <div class="charts-container">
        <div class="chart-box">
            <canvas id="genelIlerleme"></canvas>
            <!-- Diğer grafikler JavaScript ile buraya eklenecek -->
        </div>
        
        <div class="stats-container">
            <div class="stats-box">
                <h3>İstatistikler</h3>
                <div id="istatistikler"></div>
            </div>
            
            <div class="rozetler-box">
                <h3>Rozetlerim</h3>
                <div id="rozetListesi">
                    <div class="rozet" id="bronzRozet">
                        <i class="fas fa-medal bronze"></i>
                        <span>Bronz</span>
                        <small>3 hedef tamamla</small>
                    </div>
                    <div class="rozet" id="gumusRozet">
                        <i class="fas fa-medal silver"></i>
                        <span>Gümüş</span>
                        <small>5 hedef tamamla</small>
                    </div>
                    <div class="rozet" id="altinRozet">
                        <i class="fas fa-medal gold"></i>
                        <span>Altın</span>
                        <small>10 hedef tamamla</small>
                    </div>
                    <div class="rozet" id="kararliRozet">
                        <i class="fas fa-fire"></i>
                        <span>Kararlı</span>
                        <small>7 gün üst üste hedef tamamla</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo $basePath; ?>assets/js/hedefTakip.js"></script>
<script src="<?php echo $basePath; ?>assets/js/ilerleme.js"></script>

<?php include '../includes/footer.php'; ?> 