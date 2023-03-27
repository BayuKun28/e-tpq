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
                                <div class="row panel">
                                    <?php foreach ($produk as $row) : ?>
                                        <div class="col-md-4">
                                            <div class="thumbnail container-fluid">
                                                <img width="150" src="<?= base_url('assets\photos\default.png');  ?>">
                                                <div class="">
                                                    <center>
                                                        <strong>
                                                            <h4><?php echo $row->nama_produk; ?></h4>
                                                        </strong>
                                                    </center>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <center>
                                                                <h5> <i class=" fa fa-fw fa-truck"></i>Stok : <?php echo $row->stok; ?></h5>
                                                            </center>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <center>
                                                                <h4><?php echo 'Rp ' . number_format($row->harga); ?></h4>
                                                            </center>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="number" name="quantity" id="<?php echo $row->id; ?>" value="1" class="quantity form-control">
                                                        </div>
                                                    </div>
                                                    <button class="add_cart btn btn-success btn-block" data-produk_id="<?php echo $row->id; ?>" data-nama_produk="<?php echo $row->nama_produk; ?>" data-harga="<?php echo $row->harga; ?>" data-stok="<?php echo $row->stok; ?>">
                                                        <i class=" fa fa-fw fa-shopping-bag"></i> Add To Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

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

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#tableproduk').DataTable({
            "columnDefs": [{
                "width": "5",
                "targets": 0
            }],
            fixedColumns: true,
            responsive: true

        });
        $('#tablecart').DataTable({
            "columnDefs": [{
                "width": "5",
                "targets": 0
            }],
            fixedColumns: true,
            responsive: true

        });


        $('#add_cart').click(function() {
            var produk_id = $(this).data("produk_id");
            var nama_produk = $(this).data("nama_produk");
            var stok = $(this).data("stok");
            var harga = $(this).data("harga");
            var qty = $('#' + produk_id).val();

            if (qty > stok) {
                alert('Stok Kurang');
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>Order/add_to_cart",
                    method: "POST",
                    data: {
                        produk_id: produk_id,
                        nama_produk: nama_produk,
                        harga: harga,
                        qty: qty
                    },
                    success: function(data) {
                        $('#detail_cart').html(data);
                    }
                });
            }
        });

        $('#uangbayar').mask('#,##0,000', {
            reverse: true
        });

        $('#uangbayar').keyup(function() {
            var txtFirstNumberValue = document.getElementById('uangbayar').value;
            var value1 = txtFirstNumberValue.replace(",", "").replace(",", "");
            var txtSecondNumberValue = document.getElementById('sumtotal').value;
            var result = parseInt(value1) - parseInt(txtSecondNumberValue);

            if (result < 0) {
                document.getElementById('hasilkembalian').value = 0;
            } else {
                if (!isNaN(result)) {
                    document.getElementById('hasilkembalian').value = result;
                }
                $('#hasilkembalian').mask('#,##0,000', {
                    reverse: true
                });
            }



        });

        $('#detail_cart').load("<?php echo base_url(); ?>Order/load_cart");

        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>Order/hapus_cart",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>
<?php
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
?>

</body>

</html>