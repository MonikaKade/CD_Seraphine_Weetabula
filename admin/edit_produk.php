<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include '../backend/koneksi.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Ambil data produk
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

// Jika form disubmit
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama_produk']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = htmlspecialchars($_POST['harga']);

    $update = "UPDATE produk SET 
                nama_produk = '$nama',
                kategori = '$kategori',
                harga = '$harga'
               WHERE id = $id";

    if (mysqli_query($koneksi, $update)) {
        echo "<script>
                alert('Data berhasil diubah!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../home/style.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Playfair Display', serif;
        }

        .edit-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 2rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.5rem;
            color: #444;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 0.6rem 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        button {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: var(--accent-color);
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Edit Produk</h2>
        <form action="" method="POST">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>

            <label>Kategori:</label>
            <input type="text" name="kategori" value="<?= htmlspecialchars($produk['kategori']); ?>" required>

            <label>Harga:</label>
            <input type="number" name="harga" value="<?= htmlspecialchars($produk['harga']); ?>" required>

            <button type="submit" name="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
