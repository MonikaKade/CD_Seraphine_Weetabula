<?php
include '../backend/koneksi.php';
$produk = mysqli_query($koneksi, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produk - CD Seraphine Weetebula</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="produk.css" />
</head>
<body>

<!-- Navbar -->
<header class="navbar">
  <div class="navbar-left">
    <img src="../aset/image/logo.jpg" alt="Logo" class="logo">
    <span class="site-name">CD Seraphine Weetebula</span>
  </div>
  <nav class="navbar-links">
    <a href="../home/home.html">Home</a>
    <a href="produk.php" class="active">Produk</a>
    <a href="../kontak/kontak.html">Kontak</a>
  </nav>
</header>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1>Produk Tenun Sumba</h1>
    <h2>Keindahan dalam Setiap Rajutan</h2>
    <p class="hero-subtitle">Temukan koleksi eksklusif buatan tangan dari pengrajin lokal</p>
    <a href="#kategori" class="hero-button">Jelajahi Produk</a>
  </div>
</section>

<!-- Categories -->
<section class="categories-section" id="kategori">
  <div class="section-header center">
    <span>Kategori</span>
    <h2>Pilih Kategori Produk</h2>
    <div class="divider center"></div>
  </div>
  <div class="categories">
    <div class="category active" data-kategori="semua">Semua</div>
    <div class="category" data-kategori="kain">Kain Tenun</div>
    <div class="category" data-kategori="tas">Tas</div>
    <div class="category" data-kategori="selendang">Selendang</div>
  </div>
</section>

<!-- Produk Grid -->
<section class="products-section">
  <div class="products-grid">
    <?php while($row = mysqli_fetch_assoc($produk)) : ?>
      <div class="product-card" data-kategori="<?= strtolower($row['kategori']); ?>">
        <img src="../aset/image/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>">
        <div class="product-info">
          <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
          <p class="price">
            Rp<?= number_format($row['harga'], 0, ',', '.'); ?>
            <?php if (!empty($row['harga_awal'])) : ?>
              <span class="original-price">Rp<?= number_format($row['harga_awal'], 0, ',', '.'); ?></span>
            <?php endif; ?>
          </p>
          <a href="https://wa.me/6289542177009?text=Halo%20admin%2C%20saya%20tertarik%20dengan%20<?= urlencode($row['nama_produk']); ?>" target="_blank" class="pesan-btn">
            <i class="fab fa-whatsapp"></i> Pesan
          </a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <div class="footer-content">
    <div class="footer-left">
      <div class="footer-logo">
        <img src="../aset/image/logo.jpg" alt="Logo" class="logo">
        <span class="site-name">CD Seraphine Weetebula</span>
      </div>
      <p>Melestarikan warisan tenun Sumba sambil memberdayakan masyarakat lokal melalui karya berkualitas tinggi.</p>
      <div class="social-media">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/6289542177009?text=Halo%20admin%2C%20saya%20ingin%20bertanya%20seputar%20produk" target="_blank">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
    </div>
    <div class="footer-center">
      <h3>Kontak Kami</h3>
      <p><i class="fas fa-map-marker-alt"></i> Jln. Bulgur, No. 12, Langgalero, Tambolaka, SBD, NTT</p>
      <p><i class="fas fa-phone"></i> +62 895-4217-7009</p>
      <p><i class="fas fa-envelope"></i> balaitenunseraphine@gmail.com</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 CD Seraphine Weetebula. All Rights Reserved.</p>
  </div>
</footer>

<!-- Back to Top -->
<div class="back-to-top">
  <i class="fas fa-arrow-up"></i>
</div>

<!-- Kategori Filter Script -->
<script>
  const kategoriButtons = document.querySelectorAll('.category');
  const produkCards = document.querySelectorAll('.product-card');

  kategoriButtons.forEach(button => {
    button.addEventListener('click', () => {
      const kategoriDipilih = button.getAttribute('data-kategori');

      produkCards.forEach(card => {
        const kategoriProduk = card.getAttribute('data-kategori');
        if (kategoriDipilih === 'semua' || kategoriProduk === kategoriDipilih) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });

      kategoriButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
    });
  });
</script>

</body>
</html>
