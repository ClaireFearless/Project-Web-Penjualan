<?php
session_start();
include 'koneksi.php';

// Menampilkan daftar laptop yang ada di keranjang belanja
if (isset($_SESSION['keranjang'])) {
    $keranjang = $_SESSION['keranjang'];
} else {
    $keranjang = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = $_POST['nama_pembeli'];
    $alamat = $_POST['alamat'];
    $total_harga = 0;

    // Menghitung total harga
    foreach ($keranjang as $id_laptop => $jumlah) {
        $query = "SELECT * FROM laptop WHERE id = $id_laptop";
        $result = mysqli_query($conn, $query);
        $laptop = mysqli_fetch_assoc($result);
        $total_harga += $laptop['harga'] * $jumlah;
    }

    // Insert data transaksi
    $query = "INSERT INTO transaksi (nama_pembeli, alamat, total_harga) VALUES ('$nama_pembeli', '$alamat', '$total_harga')";
    mysqli_query($conn, $query);
    $transaksi_id = mysqli_insert_id($conn);

    // Insert data detail transaksi
    foreach ($keranjang as $id_laptop => $jumlah) {
        $query = "SELECT * FROM laptop WHERE id = $id_laptop";
        $result = mysqli_query($conn, $query);
        $laptop = mysqli_fetch_assoc($result);
        $harga = $laptop['harga'];

        $query_detail = "INSERT INTO detail_transaksi (transaksi_id, laptop_id, jumlah, harga) VALUES ('$transaksi_id', '$id_laptop', '$jumlah', '$harga')";
        mysqli_query($conn, $query_detail);
    }

    // Menghapus keranjang setelah checkout
    unset($_SESSION['keranjang']);

    // Redirect ke halaman sukses atau detail transaksi
    header("Location: sukses.php?transaksi_id=$transaksi_id");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Checkout</h1>
        <a href="keranjang.php" class="tombol">Kembali ke Keranjang</a>
    </header>
    <main>
        <form action="checkout.php" method="POST">
            <label for="nama_pembeli">Nama Pembeli:</label>
            <input type="text" id="nama_pembeli" name="nama_pembeli" required>
            <label for="alamat">Alamat Pengiriman:</label>
            <textarea id="alamat" name="alamat" required></textarea>
            <button type="submit">Konfirmasi Pembelian</button>
        </form>
    </main>
</body>
</html>
