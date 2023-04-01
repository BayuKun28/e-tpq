<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak</title>
</head>

<body>
    <div style="width:auto; margin: auto;">
        <center>
            <h3>Laporan Data Pembayaran </h3>
            <h4> <?= format_indo($tglawal); ?> s/d <?= format_indo($tglakhir); ?></h4>
            <table border="1" width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Santri</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nominal</th>
                        <th>Untuk Bulan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pembayaran as $s) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $s['namasantri']; ?></td>
                            <td><?= format_indo($s['tanggal_pembayaran']); ?></td>
                            <td align="right">Rp<?= number_format($s['nominal']); ?></td>
                            <td align="center"><?= $s['namabulan']; ?></td>
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