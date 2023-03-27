<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Transaksi</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Menu Transaksi
                    </div>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Barcode</label>
                                                <div class="col-sm6">
                                                    <select id="barcode" class="form-control select2 col-6" onchange="getNama()"></select>
                                                    <span class="ml-3 text-muted" id="nama_produk"></span>
                                                </div>
                                                <small class="form-text text-muted" id="sisa"></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control col-sm-6" placeholder="Jumlah" id="jumlah" autocomplete="off" onkeyup="checkEmpty()">
                                            </div>
                                            <div class="form-group">
                                                <label> </label>
                                            </div>
                                            <div class="form-group">
                                                <button id="tambah" class="btn btn-success" onclick="checkStok()" disabled>Tambah</button>
                                                <button id="bayar" class="btn btn-success" data-toggle="modal" data-target="#modal" disabled>Bayar</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-end text-right nota">
                                            <div>
                                                <div class="mb-0">
                                                    <b class="mr-2">Nota</b> <span id="nota"></span>
                                                </div>
                                                <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table w-100 table-bordered table-hover" width="100%" id="transaksi">
                                        <thead>
                                            <tr>
                                                <th>Barcode</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bayar</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="pelannggan" id="pelanggan" class="form-control pelanggan"></select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Uang</label>
                        <input placeholder="Jumlah Uang" type="number" class="form-control" name="jumlah_uang" onkeyup="kembalian()" required>
                    </div>
                    <div class="form-group">
                        <label>Diskon</label>
                        <input placeholder="Diskon" type="number" class="form-control" onkeyup="kembalian()" name="diskon">
                    </div>
                    <div class="form-group">
                        <b>Total Bayar:</b> <span class="total_bayar"></span>
                    </div>
                    <div class="form-group">
                        <b>Kembalian:</b> <span class="kembalian"></span>
                    </div>
                    <button id="add" class="btn btn-success" type="submit" onclick="bayar()" disabled>Bayar</button>
                    <button id="cetak" class="btn btn-success" type="submit" onclick="bayarCetak()" disabled>Bayar Dan Cetak</button>
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('templates/_foot'); ?>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    var produkGetNamaUrl = '<?php echo site_url('produk/get_nama') ?>';
    var produkGetStokUrl = '<?php echo site_url('produk/get_stok') ?>';
    var addUrl = '<?php echo site_url('transaksi/add') ?>';
    var getBarcodeUrl = '<?php echo site_url('produk/get_barcode') ?>';
    var pelangganSearchUrl = '<?php echo site_url('pelanggan/search') ?>';
    var cetakUrl = '<?php echo site_url('transaksi/cetak/') ?>';
</script>

<script src="<?php echo base_url('assets/moment/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/transaksi.js') ?>"></script>


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