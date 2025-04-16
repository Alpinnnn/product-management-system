# Dokumentasi Kode - Sistem Manajemen Produk

## Ringkasan Project

Sistem Manajemen Produk adalah aplikasi web berbasis PHP yang dirancang dengan pendekatan minimalis dan profesional untuk mengelola data produk. Aplikasi ini menerapkan operasi CRUD dasar (Create, Read, Update, Delete) dan dilengkapi dengan fitur pencarian serta mode gelap untuk meningkatkan pengalaman pengguna. Sistem ini menggunakan PHP native (tanpa framework) dengan struktur yang modular untuk memudahkan pemeliharaan dan pengembangan lebih lanjut.

## 1. Statement / Pernyataan Require, Include, Require_Once, dan Include_Once

Project ini menggunakan pernyataan `require_once` untuk memastikan file-file penting dimuat sekali dan berhenti dengan error jika file tidak ditemukan. Berikut adalah contoh penggunaannya:

### Di file index.php (halaman utama):

```php
<?php
require_once 'config/database.php';  // Memuat koneksi database
require_once 'includes/functions.php'; // Memuat fungsi umum
require_once 'includes/header.php';    // Memuat header halaman
```

### Di file toggle_dark_mode.php:

```php
<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
```

### Di file add_product.php dan edit_product.php:

```php
<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';
```

Project ini menggunakan `require_once` untuk memastikan file-file kritis seperti koneksi database, fungsi-fungsi utama, dan elemen tampilan header/footer hanya dimuat sekali dan wajib ada. Tidak ada penggunaan `include`, `include_once`, atau `require` sederhana dalam project ini karena semua komponen dianggap wajib ada untuk fungsi aplikasi.

## 2. Fungsi

Project ini mengimplementasikan beberapa fungsi dalam file `includes/functions.php` untuk mengelola operasi database dan fitur lainnya.

### Fungsi Database:

```php
// Fungsi untuk mendapatkan semua produk
function getProducts($conn) {
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Fungsi untuk menambahkan produk baru
function addProduct($conn, $name, $description, $price) {
    $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssd", $name, $description, $price);
    return mysqli_stmt_execute($stmt);
}

// Fungsi untuk mengupdate produk
function updateProduct($conn, $id, $name, $description, $price) {
    $sql = "UPDATE products SET name=?, description=?, price=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdi", $name, $description, $price, $id);
    return mysqli_stmt_execute($stmt);
}

// Fungsi untuk menghapus produk
function deleteProduct($conn, $id) {
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// Fungsi untuk mencari produk
function searchProducts($conn, $keyword) {
    $sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    $search = "%$keyword%";
    mysqli_stmt_bind_param($stmt, "ss", $search, $search);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
```

### Fungsi Fitur Tambahan:

```php
// Fungsi untuk mengecek apakah dark mode aktif
function isDarkMode() {
    return isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] === true;
}

// Fungsi untuk mengatur dark mode
function setDarkMode($dark_mode) {
    $_SESSION['dark_mode'] = $dark_mode;
    return true;
}
```

## 3. Form & Session

### Session Management:

Project ini menggunakan session PHP untuk menyimpan pesan (message), error, dan preferensi mode gelap. Session dimulai di `functions.php`:

```php
<?php
// Memulai session
session_start();
```

### Penggunaan Session:
- Untuk pesan sukses/error setelah operasi CRUD
- Untuk menyimpan preferensi mode gelap

### Form:

Project ini memiliki tiga form utama:

### 1. Form Pencarian (di index.php):

```php
<div class="search-container">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari produk berdasarkan nama atau deskripsi..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn"><i class="fas fa-search"></i> Cari</button>
    </form>
</div>
```

### 2. Form Tambah Produk (di add_product.php):

```php
<form method="POST" action="">
    <div class="form-group">
        <label for="name"><i class="fas fa-box"></i> Nama Produk</label>
        <input type="text" id="name" name="name" required placeholder="Masukkan nama produk">
    </div>

    <div class="form-group">
        <label for="description"><i class="fas fa-align-left"></i> Deskripsi</label>
        <textarea id="description" name="description" required placeholder="Masukkan deskripsi produk"></textarea>
    </div>

    <div class="form-group">
        <label for="price"><i class="fas fa-tag"></i> Harga</label>
        <input type="number" id="price" name="price" required min="0" step="1000" placeholder="Masukkan harga produk">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn"><i class="fas fa-save"></i> Simpan</button>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</form>
```

### 3. Form Edit Produk (di edit_product.php):

```php
<form method="POST" action="">
    <div class="form-group">
        <label for="name"><i class="fas fa-box"></i> Nama Produk</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required placeholder="Masukkan nama produk">
    </div>

    <div class="form-group">
        <label for="description"><i class="fas fa-align-left"></i> Deskripsi</label>
        <textarea id="description" name="description" required placeholder="Masukkan deskripsi produk"><?php echo htmlspecialchars($product['description']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="price"><i class="fas fa-tag"></i> Harga</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required min="0" step="1000" placeholder="Masukkan harga produk">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn"><i class="fas fa-save"></i> Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</form>
```

## 4. Penerapan Statement/Pernyataan Pada Form dan Database MySQL

### Penanganan Form Tambah Produk:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (addProduct($conn, $name, $description, $price)) {
        $_SESSION['message'] = 'Produk berhasil ditambahkan';
        header('Location: index.php');
        exit;
    } else {
        $error = 'Gagal menambahkan produk';
    }
}
```

### Penanganan Form Edit Produk:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (updateProduct($conn, $id, $name, $description, $price)) {
        $_SESSION['message'] = 'Produk berhasil diperbarui';
        header('Location: index.php');
        exit;
    } else {
        $error = 'Gagal memperbarui produk';
    }
}
```

### Penanganan Form Pencarian:

```php
// Cek apakah ada pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$products = $search ? searchProducts($conn, $search) : getProducts($conn);
```

### Pengamanan Database dengan Prepared Statements:

Project ini menggunakan prepared statements untuk semua operasi database untuk mencegah SQL injection:

```php
function addProduct($conn, $name, $description, $price) {
    $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssd", $name, $description, $price);
    return mysqli_stmt_execute($stmt);
}
```

Penggunaan parameter binding (`?`) dan `mysqli_stmt_bind_param()` memastikan bahwa input pengguna diproses dengan aman sebelum dimasukkan ke dalam database.

### Toggle Dark Mode:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dark_mode = isset($_POST['dark_mode']) && $_POST['dark_mode'] === 'true';
    setDarkMode($dark_mode);
    echo json_encode(['success' => true]);
}
```

## Kesimpulan

Project Sistem Manajemen Produk ini menunjukkan penerapan konsep PHP dasar seperti include/require, fungsi, form, session, dan database dengan pendekatan yang terstruktur dan aman. Struktur modular memungkinkan pemisahan antara logika, tampilan, dan interaksi database, sehingga kode lebih mudah dipelihara dan dikembangkan. Fitur tambahan seperti mode gelap dan bottom bar meningkatkan pengalaman pengguna dengan tetap mempertahankan kesederhanaan dan profesionalitas desain. 