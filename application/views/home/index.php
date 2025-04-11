<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Pemesanan Percetakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
    margin: 0;
    padding: 0;
    display: flex;
    font-family: 'Segoe UI', sans-serif;
}

.sidebar {
    width: 250px;
    background-color: #212529;
    color: white;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    transition: all 0.3s ease;
    padding: 1rem;
    z-index: 1000;
}

.sidebar.collapsed {
    width: 0;
    padding: 0;
    overflow: hidden;
}

.sidebar .brand {
    font-size: 1.25rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
}

.sidebar a {
    color: #adb5bd;
    display: flex;
    align-items: center;
    padding: 0.6rem 1rem;
    margin-bottom: 0.5rem;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.sidebar a:hover, .sidebar a.fw-bold {
    background-color: #343a40;
    color: #fff !important;
}

.sidebar a i {
    margin-right: 10px;
}

.main-content {
    margin-left: 250px;
    width: 100%;
    transition: margin-left 0.3s ease;
}

.main-content.full {
    margin-left: 0; /* Mobile: when sidebar is active */
}

.header {
    background-color: #f8f9fa;
    padding: 1rem;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.hamburger {
    font-size: 24px;
    cursor: pointer;
    border: none;
    background: none;
    margin-right: 1rem;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0 !important; /* Reset margin on mobile */
    }

    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        position: absolute;
        height: 100%;
        z-index: 999;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .main-content.full {
        margin-left: 250px; /* When sidebar is active on mobile */
    }
}

    </style>
</head>
<body>

<!-- Sidebar -->
<?php $role = $this->session->userdata('role'); ?>
<div class="sidebar" id="sidebar">
    <div class="brand">📄 Percetakan</div>
    <a href="<?= base_url('index.php/home') ?>" class="<?= $this->uri->segment(1) == 'home' ? 'fw-bold text-white' : '' ?>">
        <i class="bi bi-house-door-fill text-info"></i> Dashboard
    </a>
    <a href="<?= base_url('index.php/barang') ?>" class="<?= $this->uri->segment(1) == 'barang' ? 'fw-bold text-white' : '' ?>">
        <i class="bi bi-box-seam text-warning"></i> Kelola Barang
    </a>
    <a href="<?= base_url('index.php/transaksi') ?>" class="<?= $this->uri->segment(1) == 'transaksi' ? 'fw-bold text-white' : '' ?>">
        <i class="bi bi-bag-check-fill text-success"></i> Transaksi
    </a>
    <?php if ($role == 'operator') : ?>
        <a href="<?= base_url('index.php/laporan') ?>" class="<?= $this->uri->segment(1) == 'laporan' ? 'fw-bold text-white' : '' ?>">
            <i class="bi bi-file-earmark-text text-primary"></i> Laporan
        </a>
    <?php endif; ?>
    <a href="<?= base_url('index.php/auth/logout') ?>" onclick="return confirm('Yakin ingin logout?')" class="text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

<!-- Main Content -->
<div class="main-content" id="main-content">
    <div class="header">
        <div class="d-flex align-items-center">
            <button class="hamburger" onclick="toggleSidebar()">☰</button>
            <h4 class="mb-0">Dashboard</h4>
        </div>
        <span class="text-muted">Sistem Pemesanan Percetakan</span>
    </div>

    <div class="container mt-4">
        <h2 class="mb-4">Selamat Datang di Sistem Pemesanan Percetakan</h2>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Barang</h5>
                        <p>Total Barang: <strong><?= $total_barang ?></strong></p>
                        <a href="<?= base_url('index.php/barang') ?>" class="btn btn-primary">Lihat Barang</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transaksi</h5>
                        <p>Total Transaksi: <strong><?= $total_transaksi ?></strong></p>
                        <a href="<?= base_url('index.php/transaksi') ?>" class="btn btn-success">Lihat Transaksi</a>
                    </div>
                </div>
            </div>

            <?php if ($role == 'operator') : ?>
            <div class="col-md-4 mb-3">
                <div class="card border-info shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Laporan</h5>
                        <p>Total Laporan: <strong><?= $total_laporan ?></strong></p>
                        <a href="<?= base_url('index.php/laporan') ?>" class="btn btn-info">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Chart Section -->
        <?php if (!empty($barang_terlaris) || !empty($status_lunas_chart)) : ?>
        <div class="row mt-4">
            <?php if (!empty($barang_terlaris)) : ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Barang Terlaris (Top 5)</h5>
                        <canvas id="barChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($status_lunas_chart)) : ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Status Pembayaran</h5>
                        <canvas id="pieChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php if (!empty($barang_terlaris)) : ?>
<script>
    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($barang_terlaris, 'nama_barang')) ?>,
            datasets: [{
                label: 'Jumlah Terjual',
                data: <?= json_encode(array_column($barang_terlaris, 'total_terjual')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Terjual'
                    }
                }
            }
        }
    });
</script>
<?php endif; ?>

<?php if (!empty($status_lunas_chart)) : ?>
<script>
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Lunas', 'Belum Lunas'],
            datasets: [{
                data: [<?= $status_lunas_chart['lunas'] ?>, <?= $status_lunas_chart['belum'] ?>],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            return `${label}: ${value} transaksi`;
                        }
                    }
                }
            }
        }
    });
</script>
<?php endif; ?>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');

        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('active'); // mobile: toggle sidebar visibility
            main.classList.toggle('full'); // mobile: move content to the right
        } else {
            sidebar.classList.toggle('collapsed'); // desktop: collapse/expand sidebar
            main.classList.toggle('full'); // desktop: adjust main content
        }
    }

    window.addEventListener('resize', () => {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');

        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            sidebar.classList.remove('collapsed');
            main.classList.remove('full');
        }
    });
</script>

</body>
</html>
