<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak</title>
</head>

<body>
    <div style="width:auto; margin: auto;">
        <center>
            <h3>Laporan Data Stok Keluar </h3>
            <h4> <?= $tanggalawal; ?> s/d <?= $tanggalakhir; ?></h4>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Barcode</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($stok as $s) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $s['tanggal']; ?></td>
                            <td><?= $s['barcode']; ?></td>
                            <td><?= $s['nama_produk']; ?></td>
                            <td><?= $s['jumlah']; ?></td>
                            <td><?= $s['keterangan']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </center>
    </div>
</body>

</html>