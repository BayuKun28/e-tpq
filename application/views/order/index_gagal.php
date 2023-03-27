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
                        <div class="row">
                            <div class="col-md-6">Menu Transaksi</div>
                            <div class="col-md-6 text-right"><b>Nomor Nota : <?= $nota; ?></b></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Produk</h4>
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <input type="text" class="form-control" name="search_text" id="search_text" autofocus="" placeholder="Cari">
                                    </div>
                                </div>
                                <div class="row panel" id="result">

                                </div>

                            </div>
                            <div class="col-md-4">
                                <form class="form-horizontal" action="<?php echo base_url() ?>Order/proses_order" method="post" name="frmCO" id="frmCO">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" placeholder="Jumlah Uang Bayar" class="form-control" id="uangbayar" name="uangbayar">
                                        </div>
                                        <div class=" col-md-4">
                                            <button type="submit" class="btn btn-primary pull-right">Proses Order</button>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="hasilkembalian">Kembalian :</label>
                                            <input class="form-control" readonly type="text" name="hasilkembalian" id="hasilkembalian" placeholder="Kembalian">
                                        </div>
                                    </div>
                                </form>
                                <h4>Keranjang Belanja</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_cart">

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- end off cart -->
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

<script src="<?= base_url('assets'); ?>/js/order.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<<?php
    if (!empty($this->session->flashdata('message'))) {
        $pesan = $this->session->flashdata('message');
        if ($pesan == "Berhasil Belanja") {
            $script = "
                    <script>
                            Swal.fire({
                              icon: 'success',
                              title: 'Data',
                              text: 'Berhasil Belanja'
                            }) 
                    </script>
                ";
            redirect('Order/cetak');
        } elseif ($pesan == "Uang Kurang") {
            // die($pesan);
            $script = "
                    <script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Data',
                            text: 'Uang Kurang'
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
    ?> </body>

    </html>