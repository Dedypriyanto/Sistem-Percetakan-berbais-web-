<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
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
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="hamburger" onclick="toggleSidebar()">☰</button>
            <h4 class="mb-0">Edit Transaksi</h4>
        </div>
        <span class="text-muted">Sistem Pemesanan Percetakan</span>
    </div>

    <div class="container mt-4">
        <form method="post" action="<?= base_url('index.php/transaksi/update/' . $transaksi->id) ?>">
            <label>Nama Barang</label>
            <select name="id_barang" id="id_barang" class="form-control" onchange="hitungTotal()">
                <?php foreach($barang as $b): ?>
                    <option value="<?= $b->id ?>" data-harga="<?= $b->harga ?>" <?= $transaksi->id_barang == $b->id ? 'selected' : '' ?>>
                        <?= $b->nama_barang ?> - Rp<?= number_format($b->harga) ?>
                    </option>
                    <script>barangHarga[<?= $b->id ?>] = <?= $b->harga ?>;</script>
                <?php endforeach; ?>
            </select>

            <label class="mt-2">Harga Satuan</label>
            <input type="text" class="form-control" id="harga" readonly>

            <label class="mt-2">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $transaksi->jumlah ?>" oninput="hitungTotal()" required>

            <label class="mt-2">Total</label>
            <input type="text" class="form-control" id="total" readonly>
            <input type="hidden" name="total_hidden" id="total_hidden" value="<?= $transaksi->harga_total ?>">

            <label class="mt-2">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control" value="<?= $transaksi->tanggal_pesan ?>" required>

            <label class="mt-2">Tanggal Ambil</label>
            <input type="date" name="tanggal_ambil" class="form-control" value="<?= $transaksi->tanggal_ambil ?>" required>

            <label class="mt-2">DP</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" name="dp" id="dp" class="form-control" value="<?= $transaksi->dp ?>" oninput="cekStatus()">
            </div>

            <label class="mt-2">Status</label>
            <select name="status_lunas" id="status_lunas" class="form-control" readonly>
                <option value="Lunas" <?= $transaksi->status_lunas == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                <option value="Belum" <?= $transaksi->status_lunas != 'Lunas' ? 'selected' : '' ?>>Belum</option>
            </select>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        sidebar.classList.toggle('collapsed');
        main.classList.toggle('full');
    }

    function hitungTotal() {
        const id = document.getElementById('id_barang').value;
        const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
        const harga = barangHarga[id] || 0;
        const total = harga * jumlah;

        document.getElementById('harga').value = 'Rp ' + harga.toLocaleString('id-ID');
        document.getElementById('total').value = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('total_hidden').value = total;

        cekStatus();
    }

    function cekStatus() {
        const dp = parseInt(document.getElementById('dp').value) || 0;
        const total = parseInt(document.getElementById('total_hidden').value) || 0;
        const statusField = document.getElementById('status_lunas');

        if (dp >= total) {
            statusField.value = 'Lunas';
        } else {
            statusField.value = 'Belum';
        }
    }

    window.onload = hitungTotal;
</script>

</body>
</html>
