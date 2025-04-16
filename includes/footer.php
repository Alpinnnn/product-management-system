    </main>
    
    <!-- Settings Button -->
    <button class="settings-btn" id="settingsBtn">
        <i class="fas fa-cog"></i>
    </button>

    <!-- Bottom Bar -->
    <div class="bottom-bar" id="bottomBar">
        <div class="bottom-bar-content">
            <h3><i class="fas fa-sliders-h"></i> Pengaturan</h3>
            <div class="settings-item">
                <span>Mode Gelap</span>
                <label class="switch">
                    <input type="checkbox" id="darkModeToggle" <?php echo isDarkMode() ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="social-links">
                <a href="https://alpinnnn.vercel.app" target="_blank" class="social-btn website">
                    <i class="fas fa-globe"></i>
                    <span>Website</span>
                </a>
                <a href="https://github.com/Alpinnnn" target="_blank" class="social-btn github">
                    <i class="fab fa-github"></i>
                    <span>GitHub</span>
                </a>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Sistem Manajemen Produk <span class="separator">|</span> <i class="fas fa-code"></i> Dibuat dengan <i class="fas fa-heart" style="color: #dc2626;"></i></p>
        </div>
    </footer>
    
    <script src="assets/js/main.js"></script>
</body>
</html> 