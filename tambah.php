<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];  // Menangkap deskripsi
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($gambar_tmp, "images/$gambar");

    $query = "INSERT INTO laptop (nama, merek, harga, gambar, deskripsi) VALUES ('$nama', '$merek', '$harga', '$gambar', '$deskripsi')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laptop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Toko Laptop</h1>
        <div class="nav-links">
        <a href="index.php">Beranda</a>
        <a href="keranjang.php">Keranjang Belanja</a>
        <a href="tambah.php">Tambah Laptop</a>
    </div>
</header>
    </header>
    <main>
        <form action="tambah.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Laptop:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="merek">Merek:</label>
            <input type="text" id="merek" name="merek" required>
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" required>
            <label for="deskripsi">Deskripsi Laptop:</label>
            <textarea id="deskripsi" name="deskripsi" required></textarea>  <!-- Kolom deskripsi -->
            <label for="gambar">Gambar Laptop:</label>
            <input type="file" id="gambar" name="gambar" required>
            <button type="submit">Tambah Laptop</button>
        </form>
    </main>
</body>
</html>
