<?php
session_start();
include 'koneksi.php';

// Mengambil data produk yang ada di keranjang
if (isset($_SESSION['keranjang'])) {
    $produk_in_keranjang = [];
    foreach ($_SESSION['keranjang'] as $id_produk) {
        $query = "SELECT * FROM laptop WHERE id = $id_produk";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $produk_in_keranjang[] = mysqli_fetch_assoc($result);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
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
        <div class="keranjang-list">
            <?php if (count($produk_in_keranjang) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_harga = 0;
                        foreach ($produk_in_keranjang as $produk):
                            $total_harga += $produk['harga'];
                        ?>
                        <tr>
                            <td><img src="images/<?php echo $produk['gambar']; ?>" alt="Laptop" width="100"></td>
                            <td><?php echo $produk['nama']; ?></td>
                            <td>Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="proses.php?remove_from_cart=<?php echo $produk['id']; ?>" class="tombol">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="total-harga">
                    <p><strong>Total Harga:</strong> Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
                    <a href="checkout.php" class="tombol">Proses Pembelian</a>
                </div>
            <?php else: ?>
                <p>Keranjang belanja Anda kosong. <a href="index.php">Kembali ke Toko</a></p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
