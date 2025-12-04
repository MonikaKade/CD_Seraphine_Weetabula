<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include '../backend/koneksi.php';

// Ambil data produk dari database
$query = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../home/style.css">
    <style>
        .dashboard-container {
            max-width: 1000px;
            margin: 120px auto;
            background-color: var(--white);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .dashboard-header h2 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
        }

        .dashboard-header .actions a {
            text-decoration: none;
            margin-left: 1rem;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: var(--transition);
            font-weight: 600;
        }

        .dashboard-header .actions a:hover {
            background-color: var(--accent-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        th, td {
            padding: 0.9rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        td img {
            width: 80px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .aksi-btn {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.9rem;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-edit {
            background-color: #FFD700;
            color: #5D2906;
        }

        .btn-edit:hover {
            background-color: #e6c200;
        }

        .btn-hapus {
            background-color: #d9534f;
            color: white;
        }

        .btn-hapus:hover {
            background-color: #c9302c;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 8px;
            }

            td {
                padding: 0.8rem;
                text-align: right;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                float: left;
                font-weight: 600;
                color: var(--primary-color);
            }

            th {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Halo, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
            <div class="actions">
                <a href="tambahproduk.php">+ Tambah Produk</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; foreach ($rows as $produk): ?>
               <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($produk['nama_produk']); ?></td>
                <td><?= htmlspecialchars($produk['kategori']); ?></td>
                <td>Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                <td>
                    <img src="../aset/image/<?= htmlspecialchars($produk['gambar']); ?>" alt="Foto Produk" width="80">
                </td>
                <td>
                    <a href="hapus_produk.php?id=<?= htmlspecialchars($produk['id']); ?>"
                    class="aksi-btn btn-hapus"
                    onclick="return confirm('Yakin ingin menghapus produk ini?');">
                    Hapus
                    </a>
                    <a href="edit_produk.php?id=<?= htmlspecialchars($produk['id']); ?>"
                    class="aksi-btn btn-edit">
                    Edit
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
     </div>  
</body>
</html>
