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
                        <div class="col-md-2">
                            <table>
                                <tr>
                                    <td> <b>Laba </b></td>
                                    <td> <b> : </b></td>
                                    <td> <b>Rp. </b></td>
                                    <td align="right">
                                        <b><?= number_format($laba); ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <b>Untung </b></td>
                                    <td> <b> : </b></td>
                                    <td> <b>Rp. </b></td>
                                    <td align="right">
                                        <b><?= number_format($untung); ?></b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- </div>
                    </div> -->
                    <div class="panel-heading">
                        <form method="post" action="<?= base_url('laporan_penjualan') ?>" class="row">
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
                                <a href="<?= base_url('laporan_penjualan/cetak?tglawal=') . $tanggalawal . '&tglakhir=' . $tanggalakhir; ?>" name="cetak" class="btn btn-danger btn-col-1" target="_blank" role="button" aria-disabled="true"><i class="fa fa-balance-scale fa-fw"></i>Cetak</a>
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
                                        <td class="text-wrap width-200"><?= $s['tanggal']; ?></td>
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
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- -->
                <!-- /#wrapper -->

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