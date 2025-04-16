# Website PHP Sederhana

Website PHP sederhana yang menampilkan daftar produk dengan fitur CRUD (Create, Read, Update, Delete) dan user interface yang minimalis dan profesional.

## Fitur
- Menampilkan daftar produk
- Menambahkan produk baru
- Mengedit produk yang ada
- Menghapus produk
- Pencarian produk
- Session management
- Mode Gelap (Dark Mode) dengan penyimpanan preferensi
- Bottom Bar dengan pengaturan dan social links
- Desain responsive dengan UI minimalis

## Struktur Proyek
```
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── fonts/
├── config/
│   └── database.php
├── docs/
│   └── code_documentation.md
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── functions.php
├── index.php
├── add_product.php
├── edit_product.php
├── delete_product.php
├── toggle_dark_mode.php
└── README.md
```

## Fitur UI/UX

### Mode Gelap
Aplikasi menyediakan toggle mode gelap yang memungkinkan pengguna menyesuaikan tampilan sesuai preferensi mereka. Preferensi ini disimpan dalam session dan akan dipertahankan selama sesi berlangsung.

### Bottom Bar
Bottom bar dapat diakses dengan mengklik tombol pengaturan di pojok kanan bawah layar. Fitur ini berisi:
- Toggle Mode Gelap
- Social Links (Website & GitHub)

### Desain Minimalis
- Penggunaan sistem warna yang konsisten dengan variabel CSS
- Font yang mudah dibaca
- Kartu produk dengan animasi hover halus
- Ikon Font Awesome untuk meningkatkan pengalaman visual

## Instalasi
1. Clone repositori ini
2. Import file `database.sql` ke MySQL
3. Sesuaikan konfigurasi database di `config/database.php`
4. Akses website melalui web server (XAMPP, dll)

## Teknologi yang Digunakan
- PHP 7.4+
- MySQL
- HTML5
- CSS3
- JavaScript (Vanilla JS)
- Font Awesome 6

## Dokumentasi
Dokumentasi terperinci tentang implementasi kode tersedia di folder `docs`:
- [Dokumentasi Kode](docs/code_documentation.md) - Menjelaskan struktur kode, pernyataan require/include, fungsi, form, session, dan interaksi database.

## Lisensi
MIT License 