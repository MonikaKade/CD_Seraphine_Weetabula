<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include '../backend/koneksi.php';

// Pastikan id_produk ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus produk
    $query = "DELETE FROM produk WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Produk berhasil dihapus!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus produk.');
                window.location.href = 'dashboard.php';
              </script>";
    }
} else {
    // Kalau tidak ada id
    header("Location: dashboard.php");
}
?>
