<?php
include '../backend/koneksi.php';

$newPassword = password_hash('admin123', PASSWORD_DEFAULT);

$query = "UPDATE admin SET password = '$newPassword' WHERE username = 'admin'";
if (mysqli_query($koneksi, $query)) {
    echo "Password admin berhasil direset ke: admin123";
} else {
    echo "Gagal reset password: " . mysqli_error($koneksi);
}
?>
