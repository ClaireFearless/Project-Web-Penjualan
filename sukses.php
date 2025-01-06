<?php
include 'koneksi.php';

if (isset($_GET['transaksi_id'])) {
    $transaksi_id = $_GET['transaksi_id'];
    $query = "SELECT * FROM transaksi WHERE id = $transaksi_id";
    $result = mysqli_query($conn, $query);
    $transaksi = mysqli_fetch_assoc($result);

    $query_detail = "SELECT * FROM detail_transaksi WHERE transaksi_id = $transaksi_id";
    $result_detail = mysqli_query($conn, $query_detail);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Sukses</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Transaksi Sukses</h1>
        <div class="nav-links">
        <a href="index.php">Beranda</a>
        <a href="keranjang.php">Keranjang Belanja</a>
        <a href="tambah.php">Tambah Laptop</a>
    </div>
</header>
    </header>
    <main>
        <h2>Terima kasih atas pembelian Anda, <?php echo $transaksi['nama_pembeli']; ?>!</h2>
        <p>Total Harga: Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></p>
        <h3>Detail Pembelian:</h3>
        <table>
            <tr>
                <th>Nama Laptop</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
            <?php while ($detail = mysqli_fetch_assoc($result_detail)): ?>
            <?php
            $query_laptop = "SELECT * FROM laptop WHERE id = " . $detail['laptop_id'];
            $result_laptop = mysqli_query($conn, $query_laptop);
            $laptop = mysqli_fetch_assoc($result_laptop);
            ?>
            <tr>
                <td><?php echo $laptop['nama']; ?></td>
                <td><?php echo $detail['jumlah']; ?></td>
                <td>Rp <?php echo number_format($detail['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
