<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM laptop WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $laptop = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];  // Menangkap deskripsi
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar) {
        move_uploaded_file($gambar_tmp, "images/$gambar");
        $query = "UPDATE laptop SET nama='$nama', merek='$merek', harga='$harga', gambar='$gambar', deskripsi='$deskripsi' WHERE id=$id";
    } else {
        $query = "UPDATE laptop SET nama='$nama', merek='$merek', harga='$harga', deskripsi='$deskripsi' WHERE id=$id";
    }

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
    <title>Edit Laptop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Edit Laptop</h1>
    <div class="nav-links">
        <a href="index.php">Beranda</a>
        <a href="keranjang.php">Keranjang Belanja</a>
        <a href="tambah.php">Tambah Laptop</a>
    </div>
</header>
    </header>
    <main>
        <form action="edit.php?id=<?php echo $laptop['id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Laptop:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $laptop['nama']; ?>" required>
            <label for="merek">Merek:</label>
            <input type="text" id="merek" name="merek" value="<?php echo $laptop['merek']; ?>" required>
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?php echo $laptop['harga']; ?>" required>
            <label for="deskripsi">Deskripsi Laptop:</label>
            <textarea id="deskripsi" name="deskripsi" required><?php echo $laptop['deskripsi']; ?></textarea>  <!-- Kolom deskripsi -->
            <label for="gambar">Gambar Laptop:</label>
            <input type="file" id="gambar" name="gambar">
            <button type="submit">Update Laptop</button>
        </form>
    </main>
</body>
</html>
