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
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h2 class="mb-0"><?= $title ?></h2>
                    <!-- <div class="col-md-6">Menu Transaksi</div> -->
                    <div class="col-md-12 text-right"><b>Nomor Nota : <?= $nota; ?></b></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="table-responsive py-2 px-2">
                                <a class="scanproduk btn btn-danger" data-toggle="modal" data-target="#qrscanmodal"><i class="fa fa-camera"></i> Scan Produk</a>
                                <table class="table table-flush table-hover" id="tableproduk">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th hidden>Kode</th>
                                            <th>Nama</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($produk as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td hidden><?php echo $row->barcode; ?></td>
                                                <td class='text-wrap width-200'><?php echo $row->nama_produk; ?><br>
                                                    <small style="font-size: 9px; color: blue;"><?php echo $row->barcode; ?>
                                                </td>
                                                <td><?php echo $row->stok; ?></td>
                                                <td><?php echo 'Rp ' . number_format($row->harga); ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <input style="width: 90px;" type="number" name="quantity" id="<?php echo $row->id; ?>" value="1" class="quantity form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><button class="add_cart btn btn-success btn-sm" data-produk_id="<?php echo $row->id; ?>" data-nama_produk="<?php echo $row->nama_produk; ?>" data-harga="<?php echo $row->harga; ?>" data-stok="<?php echo $row->stok; ?>">
                                                        <i class=" fa fa-fw fa-shopping-bag"></i> Add</button></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- /.table-responsive -->
                        <div class="col-md-5">
                            <form class="form-horizontal" action="<?php echo base_url() ?>Order/proses_order" method="post" name="frmCO" id="frmCO">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="pelanggan">Pelanggan</label>
                                        <select class="itemPelanggan form-control" id="pelanggan" name="pelanggan">
                                        </select>
                                    </div>
                                </div>
                                </br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Jumlah Uang Bayar" class="form-control" id="uangbayar" name="uangbayar">
                                    </div>
                                    <div class=" col-md-4">
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Proses</button>
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
                            <div class="row table-responsive py-2 px-2">
                                <div class="col-md-12">
                                    <table class="table table-flush table-hover">
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
                    </div>
                </div>

            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- modal -->
        <div class="modal fade" id="qrscanmodal" tabindex="-1" role="dialog" aria-labelledby="qrscanmodalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrscanmodalLabel">SCAN QR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form>
                            <div class="form-row">
                                <div class="col">
                                    <video id="preview" width="100%" class="rounded"></video>
                                </div>
                            </div>
                            <input type="hidden" class="form-control " placeholder="" id="text" name="text" readonly="true">
                            <input type="hidden" class="form-control " placeholder="" id="idscan" name="idscan" readonly="true">
                            <div>
                                <b><label for="namascan">Nama Produk</label></b>
                                <input type="text" class="form-control " placeholder="" id="namascan" name="namascan" readonly="true">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b><label for="hargascan">Harga</label></b>
                                    <input type="text" class="form-control " placeholder="" id="hargascan" name="hargascan" readonly="true">
                                </div>
                                <div class="col-md-3">
                                    <b><label for="stokscan">Stok</label></b>
                                    <input type="text" class="form-control " placeholder="" id="stokscan" name="stokscan" readonly="true">
                                </div>
                                <div class="col-md-2">
                                    <b><label for="qty">Qty</label></b>
                                    <input type="number" name="quantityscan" id="quantityscan" value="1" class="quantity form-control">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="add_cartscan btn btn-success">
                            <i class=" fa fa-fw fa-shopping-bag"></i> Add</button>
                        <button type="button" class="closecam btn btn-secondary" data-dismiss="modal" id="closecam">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <?php $this->load->view('templates/_foot'); ?>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {

                $('#tableproduk').DataTable({
                    fixedColumns: true,
                    responsive: true,
                    "paging": false,
                    "scrollY": "300px",
                    "scrollCollapse": true,

                });
                $('#tablecart').DataTable({
                    "columnDefs": [{
                        "width": "5",
                        "targets": 0
                    }],
                    fixedColumns: true,
                    responsive: true

                });

                $('.scanproduk').click(function() {
                    let scanner = new Instascan.Scanner({
                        video: document.getElementById('preview')
                    });

                    scanner.addListener('scan', function(content) {
                        // alert(content);
                        // window.open(document.getElementById('text').value=content);
                        document.getElementById('text').value = content;
                        var barcode = document.getElementById('text').value;
                        $.ajax({
                            url: "<?php echo site_url('Order/getprodukscan'); ?>",
                            type: "POST",
                            data: '&barcode=' + barcode,
                            success: function(data) {
                                var hasil = JSON.parse(data);
                                $.each(hasil, function(key, val) {
                                    document.getElementById('idscan').value = val.id;
                                    document.getElementById('namascan').value = val.nama_produk;
                                    document.getElementById('stokscan').value = val.stok;
                                    document.getElementById('hargascan').value = val.harga;
                                });
                            }
                        });
                    });

                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.start(cameras[0]);
                        } else {
                            alert('No Cameras Found');
                        }

                    }).catch(function(e) {
                        console.error(e);
                    });
                    $('.closecam').click(function() {
                        scanner.stop();
                    });
                });

                $('.itemPelanggan').select2({
                    width: '100%',
                    ajax: {
                        url: "<?= base_url(); ?>/Pelanggan/getpelanggans2",
                        dataType: "json",
                        delay: 250,
                        data: function(params) {
                            return {
                                pel: params.term
                            };
                        },
                        processResults: function(data) {
                            var results = [];
                            $.each(data, function(index, item) {
                                results.push({
                                    id: item.id,
                                    text: item.nama
                                });
                            });
                            return {
                                results: results
                            }
                        }
                    }
                });



                $('.add_cart').click(function() {
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
                                stok: stok,
                                qty: qty
                            },
                            success: function(data) {
                                $('#detail_cart').html(data);
                            }
                        });
                    }
                });

                $('.add_cartscan').click(function() {
                    var produk_id = document.getElementById('idscan').value;
                    var nama_produk = document.getElementById('namascan').value;
                    var stok = document.getElementById('stokscan').value;
                    var harga = document.getElementById('hargascan').value;
                    var qty = document.getElementById('quantityscan').value;

                    var cekqty = parseInt(qty);
                    var cekstok = parseInt(stok);

                    if (cekqty > cekstok) {
                        alert('Stok Kurang');
                    } else {
                        $.ajax({
                            url: "<?php echo base_url(); ?>Order/add_to_cart",
                            method: "POST",
                            data: {
                                produk_id: produk_id,
                                nama_produk: nama_produk,
                                harga: harga,
                                stok: stok,
                                qty: qty
                            },
                            success: function(data) {
                                $('#detail_cart').html(data);
                            }
                        });
                        document.getElementById('idscan').value = '';
                        document.getElementById('namascan').value = '';
                        document.getElementById('stokscan').value = '';
                        document.getElementById('hargascan').value = '';
                        document.getElementById('quantityscan').value = '1';
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