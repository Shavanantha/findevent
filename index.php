<?php
// ===============================
//  INDEX.PHP — Halaman Beranda
// ===============================

require_once 'koneksi.php';
require_once 'functions.php';

// --------------------------------------
// Ambil data event dari database
// --------------------------------------
$events_from_db = [];
$error_message = "";

$query = "SELECT id, judul, tanggal, waktu, lokasi, gambar, kategori, deadline 
          FROM event ORDER BY id DESC";
$result = $koneksi->query($query);

if ($result && $result->num_rows > 0) {
    $events_from_db = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $error_message = "Belum ada event yang tersedia untuk saat ini.";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindEvent – Portal Event Universitas Lampung</title>

    <!-- FONT & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- =============================== -->
<!-- HEADER / NAVBAR -->
<!-- =============================== -->
<header>
    <div class="logo">
        <img src="assets/logo.png" alt="Logo FindEvent">
        <span>FindEvent</span>
    </div>

    <button id="dark-mode-toggle" title="Mode Gelap / Terang">🌙</button>

    <nav>
      <a href="index.php" class="<?php echo set_active('index.php'); ?>">Beranda</a>
      <a href="kategori.php?tipe=lomba" class="<?php echo set_active('kategori.php', 'lomba'); ?>">Lomba</a>
      <a href="kategori.php?tipe=seminar" class="<?php echo set_active('kategori.php', 'seminar'); ?>">Seminar</a>
      <a href="kategori.php?tipe=workshop" class="<?php echo set_active('kategori.php', 'workshop'); ?>">Workshop</a>
      <a href="tentang.php" class="<?php echo set_active('tentang.php'); ?>">Tentang</a>
    </nav>
</header>

<!-- =============================== -->
<!-- HERO -->
<!-- =============================== -->
<section class="hero">
    <div class="hero-content">
        <h2>Temukan Berbagai Event di Universitas Lampung!</h2>
        <p>Jelajahi seminar, lomba, dan workshop menarik yang diselenggarakan di lingkungan Universitas Lampung.</p>
    </div>
</section>

<!-- =============================== -->
<!-- EVENT LIST -->
<!-- =============================== -->
<main class="container">

    <h2 class="section-title">✨ Rekomendasi Event</h2>

    <?php if ($error_message): ?>
        <p class="empty-message text-center"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <div class="event-grid">

        <?php foreach ($events_from_db as $event): 
            $status = get_event_status($event['deadline']);
            $img = (!empty($event['gambar'])) ? $event['gambar'] : "assets/default.jpg";
        ?>

        <div class="event-card" data-kategori="<?php echo $event['kategori']; ?>">

            <!-- STATUS EVENT -->
            <span class="event-status <?php echo $status['class']; ?>">
                <?php echo $status['text']; ?>
            </span>

            <!-- GAMBAR -->
            <img src="<?php echo $img; ?>" alt="<?php echo $event['judul']; ?>">

            <div class="event-info">
                <h3><?php echo $event['judul']; ?></h3>

                <div class="event-meta">
                    <span>📅 <?php echo $event['tanggal']; ?></span>
                    <span>🕒 <?php echo $event['waktu']; ?></span>
                    <span>📍 <?php echo $event['lokasi']; ?></span>
                </div>

                <a href="detail.php?id=<?php echo $event['id']; ?>" class="btn">
                    Baca Selengkapnya
                </a>
            </div>

        </div>

        <?php endforeach; ?>

    </div>
</main>

<!-- =============================== -->
<!-- FOOTER -->
<!-- =============================== -->
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <img src="assets/logo.png" alt="Logo FindEvent">
            <h2>FindEvent</h2>
            <p>Temukan berbagai event kampus seperti seminar, lomba, dan workshop di Universitas Lampung.</p>
        </div>

        <div class="footer-right">
            <h3>Hubungi Kami</h3>
            <div class="social-icons">
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/5968/5968830.png" alt="X"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/3670/3670051.png" alt="WhatsApp"></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 FindEvent. Semua hak dilindungi.</p>
    </div>
</footer>

<script src="script.js"></script>
</body>
</html>
