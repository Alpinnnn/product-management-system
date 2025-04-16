<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Cek apakah ada pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$products = $search ? searchProducts($conn, $search) : getProducts($conn);

// Tampilkan pesan sukses/error jika ada
if (isset($_SESSION['message'])) {
    echo '<div class="message success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="message error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<div class="page-header">
    <h1><i class="fas fa-list"></i> Daftar Produk</h1>
</div>

<div class="search-container">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari produk berdasarkan nama atau deskripsi..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn"><i class="fas fa-search"></i> Cari</button>
    </form>
</div>

<div class="products-container">
    <?php if (mysqli_num_rows($products) > 0): ?>
        <?php while($product = mysqli_fetch_assoc($products)): ?>
            <div class="product-card">
                <div class="product-icon"><i class="fas fa-box"></i></div>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="price"><i class="fas fa-tag"></i> Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                <div class="actions">
                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn"><i class="fas fa-edit"></i> Edit</a>
                    <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="message">
            <?php echo $search ? 'Tidak ada produk yang cocok dengan pencarian Anda.' : 'Belum ada produk yang ditambahkan.'; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?> 