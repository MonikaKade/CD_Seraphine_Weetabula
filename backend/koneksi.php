<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cd_seraphine";
$port = "3306";

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
