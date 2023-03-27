<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Detail Pesanan</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-9"><b>Data Detail Pesanan</b></div>
                            <div class="col-md-3">
                                <table>
                                    <tr>
                                        <td> <b>Total Tagihan </b></td>
                                        <td> <b> : </b></td>
                                        <td> <b>Rp. </b></td>
                                        <td align="right">
                                            <b><?= number_format($info['jumlah_uang']); ?></b>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <div class="row col-12">
                            <div class="form-group col-md-6">
                                <label>Nama Pelanggan</label>
                                <input type="hidden" class="form-control" name="idtransaksi" id="idtransaksi" value="<?= $info['idtransaksi'] ?>" disabled>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $info['nama_pelanggan'] ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nota</label>
                                <input type="text" class="form-control" name="nota" id="nota" value="<?= $info['nota'] ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Waktu</label>
                                <input type="text" class="form-control" name="waktu" id="waktu" value="<?= $info['tanggal'] ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Bukti</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><?= $info['bukti']; ?></p>
                                        <br>
                                        <a href="<?= base_url('upload/bukti/') . $info['bukti']; ?>" target="_blank" class="btn btn-warning btn-col-1">Buka</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="form-group col-md-4 align-items-end">
                                <a data-kode="<?= $info['idtransaksi']; ?>" href='javascript:void(0)' class="konfr btn btn-success">Konfirmasi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-10"><b>Detail Pesanan</b></div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tabledata">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($detail as $s) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $s['nama_produk']; ?></td>
                                                <td><?= number_format($s['harga']); ?></td>
                                                <td><?= $s['qty']; ?></td>
                                                <td><?= number_format($s['subtotal']); ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php $this->load->view('templates/_foot'); ?>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#tabledata').DataTable({
            responsive: true
        });
    });
    $(document).on('click', '.konfr', function(event) {
        event.preventDefault();
        let kode = $(this).attr('data-kode');
        let konfirmasi_url = "<?= base_url(); ?>/Order/konfirmasi/" + kode;
        let cetak = "<?= base_url(); ?>/Order/cetakkonfirmasi/" + kode;

        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda Yakin Ingin Konfirmasi Transaksi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.value) {
                // window.location.href = konfirmasi_url;
                window.open(window.location.href = cetak, '_blank');

                window.open(window.location.href = konfirmasi_url, '_self');
            }
        });
    });
</script>
<?php
if (!empty($this->session->flashdata('message'))) {
    $pesan = $this->session->flashdata('message');
    if ($pesan == "Berhasil Ditambah") {
        $script = "
                    <script>
                            Swal.fire({
                              icon: 'success',
                              title: 'Data',
                              text: 'Data Berhasil Ditambah'
                            }) 
                    </script>
                ";
    } elseif ($pesan == "Berhasil Dihapus") {
        // die($pesan);
        $script = "
                    <script>
                            Swal.fire({
                              icon: 'success',
                              title: 'Data',
                              text: 'Berhasil Dihapus'
                            }) 
                    </script>
                ";
    } elseif ($pesan == "Berhasil Di Update") {
        // die($pesan);
        $script = "
                    <script>
                            Swal.fire({
                              icon: 'success',
                              title: 'Data',
                              text: 'Berhasil Di Update'
                            }) 
                    </script>
                ";
    } elseif ($pesan == "Berhasil Konfirmasi") {
        // die($pesan);
        $script = "
                            <script>
                                    Swal.fire({
                                      icon: 'success',
                                      title: 'Data',
                                      text: 'Berhasil Konfirmasi'
                                    }) 
                            </script>
                        ";
    } else {
        $script =
            "
                    <script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Data',
                                  text: 'Gagal'
                                }) 

                    </script>
                    ";
    }
} else {
    $script = "";
}
echo $script;
?>

</body>

</html>