<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include '../backend/koneksi.php';

$berhasil = false;

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];

    // Upload gambar
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Pindah file ke folder image
    move_uploaded_file($tmpName, "../aset/image/" . $namaFile);

    // Simpan ke DB
    $query = "INSERT INTO produk (nama_produk, kategori, harga, gambar)
              VALUES ('$nama', '$kategori', '$harga', '$namaFile')";
    mysqli_query($koneksi, $query);

    $berhasil = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../home/home.css"> <!-- Pastikan path ini benar -->
  <style>
    .form-container {
      max-width: 600px;
      margin: 120px auto;
      background-color: var(--light-color);
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 2rem;
      font-family: 'Playfair Display', serif;
      color: var(--primary-color);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--dark-color);
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    select {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: var(--white);
      font-size: 1rem;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 2rem;
    }

    button, .back-btn {
      background-color: var(--primary-color);
      color: var(--white);
      padding: 0.7rem 1.8rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: var(--transition);
      text-decoration: none;
      text-align: center;
    }

    button:hover, .back-btn:hover {
      background-color: var(--accent-color);
      transform: translateY(-2px);
    }

    .alert-success {
      background-color: #dff0d8;
      color: #3c763d;
      padding: 1rem;
      margin-bottom: 1.5rem;
      border-radius: 6px;
      border: 1px solid #d6e9c6;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Tambah Produk Baru</h2>

    <?php if ($berhasil): ?>
      <div class="alert-success">
        Produk berhasil ditambahkan! 🎉
      </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama">Nama Produk:</label>
        <input type="text" name="nama" id="nama" required>
      </div>

      <div class="form-group">
        <label for="kategori">Kategori:</label>
        <select name="kategori" id="kategori" required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Tenun">Tenun</option>
          <option value="Tas">Tas</option>
          <option value="Selendang">Selendang</option>
          <option value="Aksesoris">Aksesoris</option>
        </select>
      </div>

      <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" required>
      </div>

      <div class="form-group">
        <label for="gambar">Gambar Produk:</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" required>
      </div>

      <div class="btn-group">
        <a href="dashboard.php" class="back-btn">← Kembali</a>
        <button type="submit" name="submit">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
