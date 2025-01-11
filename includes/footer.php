    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Adres</h3>
                <p>Bartın, Türkiye</p>
                <p>info@growthhub.com</p>
                <p>+90 (212) 555-0123</p>
            </div>
            <div class="footer-section">
                <h3>Sosyal Medya</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>GrowthHub</h3>
                <p>Hedeflerinize ulaşmanız için yanınızdayız.</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> GrowthHub. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <?php if (isset($pageScript)): ?>
        <script src="<?php echo $basePath; ?>assets/js/<?php echo $pageScript; ?>.js"></script>
    <?php endif; ?>
</body>
</html> 