<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageStyle = 'motivasyon';
$pageScript = 'motivasyon';
include '../includes/header.php';
?>

<main class="motivasyon-container">
    <section class="makaleler-section">
        <h1>KİŞİSEL GELİŞİM MAKALELERİ</h1>
        
        <div class="makale-cards">
            <div class="makale-card">
                <img src="../assets/images/m1.jpeg" alt="Olumlu Düşünme">
                <div class="makale-content">
                    <h3>OLUMLU DÜŞÜNMENİN GÜCÜ</h3>
                    <p>Hayat bir aynadır. Siz ona gülümserseniz, o da size gülümser</p>
                    <a href="https://arguden.net/makale/olumlu-dusunmenin-gucu/" target="_blank" class="btn-read">Okumaya başla</a>
                </div>
            </div>

            <div class="makale-card">
                <img src="../assets/images/m2.jpeg" alt="Alışkanlıklar">
                <div class="makale-content">
                    <h3>İNSAN ALIŞKANLIKLARININ ESERİDİR</h3>
                    <p>İnsan alışkanlıklarının eseridir. Dolayısıyla, hayatında özel başarılara imza atmanın nasıl farkılık yarattığını anlamak için öncelikle onların alışkanlıklarını incelemek gerekir.</p>
                    <a href="https://arguden.net/makale/insan-aliskanliklarinin-eseridir/" target="_blank" class="btn-read">Okumaya başla</a>
                </div>
            </div>

            <div class="makale-card">
                <img src="../assets/images/m3.jpeg" alt="Başarılı İnsanlar">
                <div class="makale-content">
                    <h3>BAŞARILI İNSANLARIN SIRLARI</h3>
                    <p>Bazı insanlar kendilerinin ve başkalarının hayatlarında önemli ve olumlu gelişmeler sağlarlar ve başarılı olarak kabul edilirler. Başarılı insanlar üzerinde yapılan araştırmalar, onların birçok ortak noktasının olduğunu ortaya koyuyor.</p>
                    <a href="https://arguden.net/makale/basarili-insanlarin-sirlari/" target="_blank" class="btn-read">Okumaya başla</a>
                </div>
            </div>
        </div>
    </section>

    <section class="podcast-section">
        <h2>PODCASTLER</h2>
        <div class="podcast-cards">
            <div class="podcast-card">
                <h3>GİRİŞİMCİLİK YOLCULUĞU</h3>
                <iframe src="https://open.spotify.com/embed/episode/your-episode-id" width="100%" height="152" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>

            <div class="podcast-card">
                <h3>KENDİNE GÜVEN NASIL KAZANILIR</h3>
                <iframe src="https://open.spotify.com/embed/episode/your-episode-id" width="100%" height="152" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>

            <div class="podcast-card">
                <h3>HAYAT AMACINI BUL</h3>
                <iframe src="https://open.spotify.com/embed/episode/your-episode-id" width="100%" height="152" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>
    </section>

    <section class="alintilar-section">
        <h2>ALINTILAR</h2>
        <div class="alinti-cards">
            <div class="alinti-card">
                <blockquote>
                    "Başarı, her gün tekrar edilen küçük çabalar toplamıdır."
                    <cite>- Robert Collier</cite>
                </blockquote>
            </div>

            <div class="alinti-card">
                <blockquote>
                    "Eğer bir hayaliniz varsa, peşinden gidin. Cesaret her şeydir."
                    <cite>- Walt Disney</cite>
                </blockquote>
            </div>

            <div class="alinti-card">
                <blockquote>
                    "Her şey seninle başlar. Kendine inan ve harekete geç."
                    <cite>- Anonymous</cite>
                </blockquote>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?> 