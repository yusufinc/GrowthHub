<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowthHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php
    $basePath = strpos($_SERVER['PHP_SELF'], '/pages/') !== false ? '../' : './';
    ?>
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/header-footer.css">
    <?php if (isset($pageStyle)): ?>
        <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/<?php echo $pageStyle; ?>.css">
    <?php endif; ?>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="<?php echo $basePath; ?>index.php">
                    <i class="fas fa-chart-line"></i>
                    GrowthHub
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo $basePath; ?>pages/hedefTakip.php"><i class="fas fa-bullseye"></i>Hedef Takibi</a></li>
                <li><a href="<?php echo $basePath; ?>pages/ilerleme.php"><i class="fas fa-chart-bar"></i>İlerleme</a></li>
                <li><a href="<?php echo $basePath; ?>pages/motivasyon.php"><i class="fas fa-star"></i>Motivasyon</a></li>
                <li><a href="<?php echo $basePath; ?>pages/iletisim.php"><i class="fas fa-envelope"></i>İletişim</a></li>
                <li class="user-menu">
                    <a href="<?php echo $basePath; ?>pages/hesapYonetimi.php">
                        <div class="user-menu-content">
                            <div class="menu-top">
                                <i class="fas fa-user"></i>
                                <span class="menu-text">Hesap Yönetimi</span>
                            </div>
                            <?php if (isset($_SESSION['username'])): ?>
                                <div class="username-small" style="margin-left: 50px;"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                            <?php endif; ?>
                        </div>
                    </a>
                </li>
                <li><a href="<?php echo $basePath; ?>logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i>Çıkış</a></li>
            </ul>
        </nav>
    </header>
</body>
</html> 