<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Card stats -->
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- <h2 class="mb-0"><?= $title ?></h2> -->
                    <div class="row">
                        <div class="col-md-10"><b>Data <?= $title ?></b></div>
                    </div>
                    <hr>
                    <div class="panel-heading">
                        <form method="post" action="<?= base_url('laporan_stok_keluar') ?>" class="row">
                            <div class="form-group col-md-2">
                                <input type="text" id="tanggalawal" name="tanggalawal" autocomplete="off" class="form-control" value="<?= $tanggalawal ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <input type="text" readonly placeholder="S/D" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" id="tanggalakhir" name="tanggalakhir" autocomplete="off" class="form-control" value="<?= $tanggalakhir ?>">
                            </div>
                            <div class="form-group col-md-4 align-items-end">
                                <button name="action" value="tampil" type="submit" class="btn btn-success btn-col-1 " role="button" aria-disabled="true">Tampilkan</button>
                                <a href="<?= base_url('laporan_stok_keluar/cetak?tglawal=') . $tanggalawal . '&tglakhir=' . $tanggalakhir; ?>" name="cetak" class="btn btn-danger btn-col-1" target="_blank" role="button" aria-disabled="true"><i class="fa fa-balance-scale fa-fw"></i>Cetak</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-heading -->

                    <div class="table-responsive py-2 px-2">
                        <table class="table table-flush table-hover" id="tablelaporanpenjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Barcode</th>
                                    <th>Kode Produk</th>
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
                                        <td>
                                            <?php
                                            $kode = $s['barcode'];
                                            require_once('assets/qrcode/qrlib.php');
                                            QRcode::png($kode, "files/qrcode/kode" . $i . ".png", "M", 2, 2);
                                            ?>
                                            <img src="<?= base_url(); ?>files/qrcode/kode<?= $i ?>.png" alt="">
                                        </td>
                                        <td><?= $s['barcode']; ?></td>
                                        <td><?= $s['nama_produk']; ?></td>
                                        <td><?= $s['jumlah']; ?></td>
                                        <td><?= $s['keterangan']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>


                <?php $this->load->view('templates/_foot'); ?>

                <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                <script>
                    $(document).ready(function() {
                        $('#tanggalawal').datetimepicker({
                            format: 'Y-m-d',
                            timepicker: false
                        });
                    });
                    $(document).ready(function() {
                        $('#tanggalakhir').datetimepicker({
                            format: 'Y-m-d',
                            timepicker: false
                        });
                    });
                    $(document).ready(function() {
                        $('#tablelaporanpenjualan').DataTable({
                            responsive: true
                        });
                    });
                </script>