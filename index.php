<?php
session_start();
include 'koneksi.php';

// Query untuk mengambil semua laptop dari database
$query = "SELECT * FROM laptop";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Laptop</title>
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

    <main>
        <h2>Daftar Laptop</h2>
        <div class="laptop-list">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="laptop-item">
                <img src="images/<?php echo $row['gambar']; ?>" alt="Laptop" class="laptop-image">
                <h3><?php echo $row['nama']; ?></h3>
                <p><strong>Merek:</strong> <?php echo $row['merek']; ?></p>
                <p><strong>Harga:</strong> Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                <p><strong>Deskripsi:</strong> <?php echo substr($row['deskripsi'], 0, 100); ?>...</p>
                <a href="detail.php?id=<?php echo $row['id']; ?>" class="tombol">Lihat Detail</a>
                <a href="proses.php?add_to_cart=<?php echo $row['id']; ?>" class="tombol">Tambah ke Keranjang</a>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>
