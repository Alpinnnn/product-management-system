document.addEventListener('DOMContentLoaded', function() {
    const settingsBtn = document.getElementById('settingsBtn');
    const bottomBar = document.getElementById('bottomBar');
    const darkModeToggle = document.getElementById('darkModeToggle');

    // Periksa apakah dark mode aktif saat halaman dimuat
    if (darkModeToggle && darkModeToggle.checked) {
        document.documentElement.classList.add('dark-mode');
    }

    // Toggle bottom bar
    if (settingsBtn) {
        settingsBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            bottomBar.classList.toggle('active');
        });
    }

    // Close bottom bar when clicking outside
    document.addEventListener('click', function(event) {
        if (bottomBar && !bottomBar.contains(event.target) && settingsBtn && !settingsBtn.contains(event.target)) {
            bottomBar.classList.remove('active');
        }
    });

    // Dark mode toggle
    if (darkModeToggle) {
        darkModeToggle.addEventListener('change', function() {
            const isDarkMode = this.checked;
            document.documentElement.classList.toggle('dark-mode', isDarkMode);
            
            // Send request to update dark mode
            fetch('toggle_dark_mode.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'dark_mode=' + isDarkMode
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Gagal mengubah mode gelap');
                    // Kembalikan toggle ke posisi semula jika gagal
                    this.checked = !isDarkMode;
                    document.documentElement.classList.toggle('dark-mode');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Kembalikan toggle ke posisi semula jika error
                this.checked = !isDarkMode;
                document.documentElement.classList.toggle('dark-mode');
            });
        });
    }
}); 