<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak</title>
</head>

<body>
    <div style="width:auto; margin: auto;">
        <center>
            <h3>Laporan Data Pembayaran Santri : <?= $namasantri; ?> </h3>
            <h4> Periode : <?= $tahun; ?></h4>
            <table border="1" width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pembayaran as $s) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $s['bulan']; ?></td>
                            <td align="right">Rp<?= number_format($s['nominal']); ?></td>
                            <td align="center"><?= $s['keterangan']; ?></td>
                            <td><?= $s['status']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </center>
    </div>
</body>

</html>