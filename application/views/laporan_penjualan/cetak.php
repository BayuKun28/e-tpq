<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak</title>
</head>

<body>
    <div style="width:auto; margin: auto;">
        <center>
            <h3>Laporan Data Penjualan </h3>
            <h4> <?= $tanggalawal; ?> s/d <?= $tanggalakhir; ?></h4>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nota</th>
                        <th>Nama Produk</th>
                        <th>Total Bayar</th>
                        <th>Jumlah Uang</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($penjualan as $s) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $s['tanggal']; ?></td>
                            <td><?= $s['nota']; ?></td>
                            <td><?= $s['nama_produk']; ?></td>
                            <td><?= number_format($s['total_bayar']); ?></td>
                            <td><?= number_format($s['jumlah_uang']); ?></td>
                            <td><?= $s['pelanggan']; ?></td>
                            <td><?= $s['kasir']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </center>
        <br>
        Laba Pada Periode Ini : Rp. <?= number_format($laba); ?>
        <br>
        Keuntungan Pada Periode Ini : Rp. <?= number_format($untung); ?>
    </div>
</body>

</html>