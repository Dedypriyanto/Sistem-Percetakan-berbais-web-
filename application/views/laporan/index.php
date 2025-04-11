<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            transition: all 0.3s ease;
            padding: 1rem;
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
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: #fff;
        }

        .main-content {
            margin-left: 250px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .main-content.full {
            margin-left: 0;
        }

        .header {
            background-color: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .hamburger {
            font-size: 24px;
            cursor: pointer;
            border: none;
            background: none;
            margin-right: 1rem;
        }

        .card h5 {
            font-weight: 600;
        }

        .card p {
            font-size: 0.95rem;
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
    <div class="header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="hamburger" onclick="toggleSidebar()">☰</button>
            <h4 class="mb-0">Laporan Transaksi</h4>
        </div>
        <span class="text-muted">Sistem Pemesanan Percetakan</span>
    </div>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('index.php/home') ?>" class="btn btn-secondary mb-2">Kembali</a>
            <a href="<?= base_url('index.php/laporan/cetak') ?>" target="_blank" class="btn btn-primary">Cetak Laporan</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tgl Pesan</th>
                    <th>Tgl Ambil</th>
                    <th>DP</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laporan as $l): ?>
                <tr>
                    <td><?= $l->id ?></td>
                    <td><?= $l->nama_barang ?></td>
                    <td><?= $l->jumlah ?></td>
                    <td>Rp<?= number_format($l->harga_total) ?></td>
                    <td><?= $l->tanggal_pesan ?></td>
                    <td><?= $l->tanggal_ambil ?></td>
                    <td>Rp<?= number_format($l->dp) ?></td>
                    <td>
    <span class="badge bg-<?= strtolower($l->status_lunas) == 'lunas' ? 'success' : 'warning' ?>">
        <?= ucfirst(strtolower($l->status_lunas)) ?>
    </span>
</td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        sidebar.classList.toggle('collapsed');
        main.classList.toggle('full');
    }
</script>

</body>
</html>
