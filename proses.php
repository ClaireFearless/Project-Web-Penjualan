<?php
session_start();  // Memulai session untuk menyimpan keranjang

// Cek apakah ada produk yang ditambahkan ke keranjang
if (isset($_GET['add_to_cart'])) {
    $id_produk = $_GET['add_to_cart'];

    // Periksa apakah keranjang sudah ada atau belum
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];  // Jika belum ada keranjang, buat array kosong
    }

    // Cek apakah produk sudah ada di keranjang
    if (!in_array($id_produk, $_SESSION['keranjang'])) {
        $_SESSION['keranjang'][] = $id_produk;  // Tambahkan produk ke keranjang
    }

    // Debugging untuk melihat apakah produk ditambahkan
    var_dump($_SESSION['keranjang']);
}

// Cek apakah ada produk yang ingin dihapus dari keranjang
if (isset($_GET['remove_from_cart'])) {
    $id_produk = $_GET['remove_from_cart'];

    // Periksa apakah keranjang sudah ada
    if (isset($_SESSION['keranjang'])) {
        // Mencari ID produk dalam keranjang dan menghapusnya
        $key = array_search($id_produk, $_SESSION['keranjang']);
        if ($key !== false) {
            unset($_SESSION['keranjang'][$key]);  // Menghapus produk dari keranjang
            $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);  // Reindex array keranjang
        }
    }
}

// Kembali ke halaman toko setelah menambahkan atau menghapus produk
header('Location: index.php');  // Arahkan kembali ke halaman toko
exit;
?>
