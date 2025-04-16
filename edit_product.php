<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

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

// Ambil data produk
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header('Location: index.php');
    exit;
}
?>

<div class="page-header">
    <h1><i class="fas fa-edit"></i> Edit Produk</h1>
</div>

<div class="form-container">
    <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

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
</div>

<?php require_once 'includes/footer.php'; ?> 