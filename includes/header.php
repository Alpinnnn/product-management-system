<!DOCTYPE html>
<html lang="id" <?php echo isDarkMode() ? 'class="dark-mode"' : ''; ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Produk</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/fonts/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1><i class="fas fa-box-open"></i> Sistem Manajemen Produk</h1>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="add_product.php"><i class="fas fa-plus"></i> Tambah Produk</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container"> 