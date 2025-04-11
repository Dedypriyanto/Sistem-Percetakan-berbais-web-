<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 10px;
            font-size: 12px;
        }

        .struk {
            border: 1px dashed #000;
            padding: 10px;
            width: 250px;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        hr {
            border: 1px dashed #000;
            margin: 10px 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="struk">
        <h4 class="text-center">Struk Transaksi</h4>
        <hr>
        <p><span class="bold">ID Transaksi:</span> <?= $transaksi->id ?></p>
        <p><span class="bold">Nama Barang:</span> <?= $transaksi->nama_barang ?></p>
        <p><span class="bold">Harga:</span> Rp<?= number_format($transaksi->harga_satuan) ?></p>
        <p><span class="bold">Jumlah:</span> <?= $transaksi->jumlah ?></p>
        <p><span class="bold">Total:</span> Rp<?= number_format($transaksi->harga_total) ?></p>
        <p><span class="bold">DP:</span> Rp<?= number_format($transaksi->dp) ?></p>
        <p><span class="bold">Status:</span> <span class="bold"><?= strtoupper($transaksi->status_lunas) ?></span></p>
        <p><span class="bold">Tanggal Pesan:</span> <?= $transaksi->tanggal_pesan ?></p>
        <p><span class="bold">Tanggal Ambil:</span> <?= $transaksi->tanggal_ambil ?></p>
        <hr>
        <p class="text-center"><em><strong>Struk wajib dibawa saat pengambilan pesanan</strong></em></p>
        <p class="text-center">Terima kasih!</p>
    </div>
</body>
</html>
