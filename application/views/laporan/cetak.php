<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        @media print {
            @page { margin: 10mm; }
        }
    </style>
</head>
<body onload="window.print()">
    <h3 style="text-align: center;">Laporan Transaksi</h3>
    <table>
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
                <td><?= $l->status_lunas ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
