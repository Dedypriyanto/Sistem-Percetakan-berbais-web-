<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Sistem Percetakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .fitur-card {
            transition: 0.3s;
        }
        .fitur-card:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <a class="navbar-brand" href="#">Sistem Percetakan</a>
        <div class="ms-auto">
            <button class="btn btn-secondary me-2" onclick="toggleDarkMode()">🌓</button>
            <a href="<?= site_url('index.php/auth/login') ?>" class="btn btn-primary me-2">Demo</a>
            <a href="<?= site_url('index.php/auth/login') ?>" class="btn btn-success">Login</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="text-center py-5 bg-light">
        <div class="container">
            <h1 class="display-5 fw-bold">Selamat Datang di Sistem Pemesanan Percetakan</h1>
            <p class="lead">Kelola barang, transaksi, laporan, dan pemesanan dengan efisien</p>
            <a href="<?= site_url('index.php/auth/register') ?>" class="btn btn-outline-primary btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Fitur -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Fitur Utama</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card fitur-card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-box fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Kelola Barang</h5>
                            <p class="card-text">Tambah, edit, dan hapus daftar barang percetakan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card fitur-card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-receipt fa-3x mb-3 text-success"></i>
                            <h5 class="card-title">Kelola Transaksi</h5>
                            <p class="card-text">Mencatat transaksi lengkap dengan status pembayaran.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card fitur-card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-chart-line fa-3x mb-3 text-warning"></i>
                            <h5 class="card-title">Laporan</h5>
                            <p class="card-text">Menampilkan dan mencetak laporan penjualan dan transaksi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-light">
        <small>&copy; <?= date('Y') ?> Sistem Percetakan. All rights reserved.</small>
    </footer>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
