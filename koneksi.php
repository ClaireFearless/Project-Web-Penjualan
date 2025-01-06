<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_laptop";  // Ganti dengan nama database Anda

// Buat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
