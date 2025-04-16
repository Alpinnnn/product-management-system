<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

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
?>

<div class="page-header">
    <h1><i class="fas fa-plus-circle"></i> Tambah Produk Baru</h1>
</div>

<div class="form-container">
    <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

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
</div>

<?php require_once 'includes/footer.php'; ?> 