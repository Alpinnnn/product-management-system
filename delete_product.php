<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if (deleteProduct($conn, $id)) {
    $_SESSION['message'] = 'Produk berhasil dihapus';
} else {
    $_SESSION['error'] = 'Gagal menghapus produk';
}

header('Location: index.php');
exit; 