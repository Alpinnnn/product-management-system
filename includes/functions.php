<?php
// Memulai session
session_start();

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

// Fungsi untuk mengecek apakah dark mode aktif
function isDarkMode() {
    return isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] === true;
}

// Fungsi untuk mengatur dark mode
function setDarkMode($dark_mode) {
    $_SESSION['dark_mode'] = $dark_mode;
    return true;
}
?> 