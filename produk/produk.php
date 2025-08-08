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
  <!-- UBAHAN MULAI: tambahkan sedikit style inline untuk elemen request (opsional, kamu bisa pindah ke produk.css) -->
  <style>
    .search-row { display:flex; gap:12px; align-items:center; margin:20px 0; }
    .search-input { flex:1; padding:10px 12px; border-radius:8px; border:1px solid #ddd; font-size:14px; }
    .request-area { margin-top:18px; display:none; padding:12px; border-radius:8px; background:#fff8f0; border:1px dashed #ffb86b; }
    .request-area input, .request-area textarea { width:100%; padding:8px 10px; margin-top:8px; border-radius:6px; border:1px solid #ddd; font-size:14px; }
    .btn-request { display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border-radius:8px; border:none; background:#25D366; color:#fff; cursor:pointer; text-decoration:none; }
    .no-results { text-align:center; padding:20px; color:#777; }
    .products-grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap:18px; }
  
  </style>
  <!-- UBAHAN SELESAI -->
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

  <!-- UBAHAN MULAI: Search bar dan request button -->
  <div class="search-row" style="margin-top:16px;">
    <input type="search" id="searchInput" class="search-input" placeholder="Cari produk... ketik nama produk">
    <button id="openRequestBtn" class="btn-request" type="button"><i class="fas fa-plus"></i> Request Produk</button>
  </div>

  <div id="requestArea" class="request-area" aria-hidden="true">
    <strong>Request Produk (jika produk tidak tersedia)</strong>
    <input type="text" id="requestNama" placeholder="Nama produk yang Anda cari (contoh: Kain Tenun Motif X)">
    <textarea id="requestDesc" rows="3" placeholder="Deskripsi singkat / ukuran / warna / catatan lain (opsional)"></textarea>
    <div style="margin-top:8px; display:flex; gap:8px;">
      <button id="sendRequestBtn" class="btn-request" type="button"><i class="fab fa-whatsapp"></i> Kirim Request via WhatsApp</button>
      <button id="closeRequestBtn" type="button" style="padding:8px 12px; border-radius:8px; border:1px solid #ddd; background:#fff; cursor:pointer;">Tutup</button>
    </div>
    <div style="font-size:12px; color:#666; margin-top:8px;">(Admin akan membalas via WhatsApp. Nomor admin: +62 822-3641-7190)</div>
  </div>
  <!-- UBAHAN SELESAI -->
</section>

<!-- Produk Grid -->
<section class="products-section">
  <div id="productsGrid" class="products-grid">
    <?php while($row = mysqli_fetch_assoc($produk)) : ?>
      <!-- UBAHAN MULAI: buat link WA per produk & atribut data untuk JS -->
      <?php 
        $namaProduk = htmlspecialchars($row['nama_produk']);
        $pesanWA = "Halo, terima kasih sudah menghubungi CD Seraphine Weetebula \n\n"
                  . "Saya Nanda, admin toko ini\n"
                  . "Berikut detail pesanan Anda:\n"
                  . "Produk: $namaProduk\n\n"
                  . "Apakah ingin saya kirimkan detail lengkap & foto produknya?";
        // Nomor admin: 082236417190 -> format internasional 6282236417190
        $linkWA = "https://wa.me/6282236417190?text=" . urlencode($pesanWA);
      ?>
      <div class="product-card" 
           data-kategori="<?= strtolower($row['kategori']); ?>" 
           data-nama="<?= $namaProduk; ?>"
           data-link="<?= $linkWA; ?>">
        <img src="../aset/image/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= $namaProduk; ?>">
        <div class="product-info">
          <h3><?= $namaProduk; ?></h3>
          <p class="price">
            Rp<?= number_format($row['harga'], 0, ',', '.'); ?>
            <?php if (!empty($row['harga_awal'])) : ?>
              <span class="original-price">Rp<?= number_format($row['harga_awal'], 0, ',', '.'); ?></span>
            <?php endif; ?>
          </p>
          <a href="<?= $linkWA; ?>" target="_blank" class="pesan-btn">
            <i class="fab fa-whatsapp"></i> Pesan
          </a>
        </div>
      </div>
      <!-- UBAHAN SELESAI -->
    <?php endwhile; ?>
  </div>

  <!-- UBAHAN MULAI: pesan ketika tidak ada hasil -->
  <div id="noResults" class="no-results" style="display:none;">
    <p>Produk tidak ditemukan.</p>
    <p>
      <button id="noResultsRequestBtn" class="btn-request"><i class="fab fa-whatsapp"></i> Request Produk via WhatsApp</button>
    </p>
  </div>
  <!-- UBAHAN SELESAI -->
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
        <a href="https://www.facebook.com/profile.php?id=61578673720495"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/balaitenunseraphine?igsh=aHBta2dtZ3diZTZt"><i class="fab fa-instagram"></i></a>
        <!-- UBAHAN: nomor WhatsApp admin baru -->
        <a href="https://wa.me/6282236417190?text=Halo%20admin%2C%20saya%20ingin%20bertanya%20seputar%20produk" target="_blank">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
    </div>
    <div class="footer-center">
      <h3>Kontak Kami</h3>
      <p><i class="fas fa-map-marker-alt"></i> Jln. Bulgur, No. 12, Langgalero, Tambolaka, SBD, NTT</p>
      <p><i class="fas fa-phone"></i> +62 822-3641-7190 <!-- UBAHAN: nomor baru --></p>
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

<!-- UBAHAN MULAI: Script pencarian + klik kartu + request -->
<script>
  const kategoriButtons = document.querySelectorAll('.category');
  const productsGrid = document.getElementById('productsGrid');
  const produkCards = () => Array.from(document.querySelectorAll('.product-card'));
  const searchInput = document.getElementById('searchInput');
  const noResultsDiv = document.getElementById('noResults');

  // Category filter
  kategoriButtons.forEach(button => {
    button.addEventListener('click', () => {
      const kategoriDipilih = button.getAttribute('data-kategori');

      produkCards().forEach(card => {
        const kategoriProduk = card.getAttribute('data-kategori');
        if (kategoriDipilih === 'semua' || kategoriProduk === kategoriDipilih) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });

      kategoriButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      // jalankan juga filter teks agar sinkron
      filterByText(searchInput.value.trim());
    });
  });

  // Klik seluruh kartu produk buka WhatsApp, kecuali saat klik tombol Pesan
  function attachCardClicks() {
    produkCards().forEach(card => {
      // pastikan handler tidak terduplikasi
      card.onclick = function(e) {
        if (!e.target.closest('.pesan-btn')) {
          const linkWA = card.getAttribute('data-link');
          window.open(linkWA, '_blank');
        }
      };
    });
  }
  attachCardClicks();

  // Pencarian real-time berdasarkan nama produk (case-insensitive)
  function filterByText(query) {
    const q = query.toLowerCase();
    let visibleCount = 0;

    produkCards().forEach(card => {
      const nama = (card.getAttribute('data-nama') || '').toLowerCase();
      const currentlyVisibleByCategory = (card.style.display !== 'none');

      if (nama.includes(q) && currentlyVisibleByCategory) {
        card.style.display = 'block';
        visibleCount++;
      } else {
        // jika cocok kategori tapi tidak cocok text -> sembunyikan
        // namun jika sudah disembunyikan oleh kategori, biarkan tetap none
        if (currentlyVisibleByCategory) card.style.display = 'none';
      }
    });

    // jika ada hasil tampilkan grid, kalau tidak tampilkan noResults dan sediakan tombol request
    if (visibleCount === 0) {
      noResultsDiv.style.display = 'block';
    } else {
      noResultsDiv.style.display = 'none';
    }
  }

  searchInput.addEventListener('input', (e) => {
    filterByText(e.target.value.trim());
  });

  // REQUEST AREA (form untuk kirim request via WA)
  const openRequestBtn = document.getElementById('openRequestBtn');
  const requestArea = document.getElementById('requestArea');
  const closeRequestBtn = document.getElementById('closeRequestBtn');
  const sendRequestBtn = document.getElementById('sendRequestBtn');
  const requestNama = document.getElementById('requestNama');
  const requestDesc = document.getElementById('requestDesc');
  const noResultsRequestBtn = document.getElementById('noResultsRequestBtn');

  openRequestBtn.addEventListener('click', () => {
    requestArea.style.display = requestArea.style.display === 'block' ? 'none' : 'block';
    requestArea.setAttribute('aria-hidden', requestArea.style.display !== 'block' ? 'true' : 'false');
    requestNama.focus();
  });

  closeRequestBtn.addEventListener('click', () => {
    requestArea.style.display = 'none';
    requestArea.setAttribute('aria-hidden', 'true');
  });

  // tombol di pesan "Produk tidak ditemukan"
  noResultsRequestBtn.addEventListener('click', () => {
    // tampilkan area request dan scroll ke situ
    requestArea.style.display = 'block';
    requestArea.setAttribute('aria-hidden', 'false');
    requestNama.focus();
    requestNama.scrollIntoView({ behavior: 'smooth', block: 'center' });
  });

  // fungsi buat buka WA dengan pesan request
  function sendRequestToWA(nama, desc) {
    const adminNumber = '6282236417190'; // UBAHAN: nomor admin (format internasional)
    const namaEsc = nama ? nama : '-';
    const descEsc = desc ? desc : '-';
    const pesan = "🌸 Halo, saya ingin request produk yang tidak tersedia di katalog. 🌸\n\n"
                + "Nama produk: " + namaEsc + "\n"
                + "Deskripsi / catatan: " + descEsc + "\n\n"
                + "Mohon info jika tersedia atau kapan bisa dibuat. Terima kasih.";
    const url = "https://wa.me/" + adminNumber + "?text=" + encodeURIComponent(pesan);
    window.open(url, '_blank');
  }

  sendRequestBtn.addEventListener('click', () => {
    const namaVal = requestNama.value.trim();
    const descVal = requestDesc.value.trim();
    if (namaVal.length === 0) {
      alert('Silakan isi nama produk yang Anda cari (misal: Kain Tenun Motif X).');
      requestNama.focus();
      return;
    }
    sendRequestToWA(namaVal, descVal);
  });

  // tombol di bawah "produk tidak ditemukan" (pilihan cepat)
  // ini akan membuka WA dengan field nama kosong agar pelanggan bisa mengetik langsung di WA
  document.getElementById('noResultsRequestBtn').addEventListener('click', () => {
    // buka WA dengan pesan template singkat
    const adminNumber = '6282236417190';
    const pesan = "Halo admin, saya ingin request produk yang belum ada di katalog. Nama produk: ";
    const url = "https://wa.me/" + adminNumber + "?text=" + encodeURIComponent(pesan);
    window.open(url, '_blank');
  });

  // jika ada produk baru (misal dari server) dan DOM berubah, pastikan klik ulang terpasang
  // (tidak perlu sekarang, tapi fungsi attachCardClicks tersedia)
</script>
<!-- UBAHAN SELESAI -->

</body>
</html>
