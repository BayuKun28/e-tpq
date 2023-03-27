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
                    <h2 class="mb-0"><?= $title ?></h2>
                    <div class="text-right"><a href="#" class="btn btn-success btn-sm-2 " data-toggle="modal" data-target="#modaltambahproduk">Tambah</a></div>
                </div>
                <div class="table-responsive py-4 px-4">
                    <table class="table table-flush table-hover" id="tableproduk">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Produk</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Kategori</th>
                                <th>Harga Modal</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($produk as $s) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>
                                        <?php
                                        $kode = $s['barcode'];
                                        require_once('assets/qrcode/qrlib.php');
                                        QRcode::png($kode, "files/qrcode/kode" . $i . ".png", "M", 2, 2);
                                        ?>
                                        <img src="<?= base_url(); ?>files/qrcode/kode<?= $i ?>.png" alt="">
                                    </td>
                                    <td><?= $s['barcode']; ?></td>
                                    <td> <img src="<?= base_url('upload/produk/') . $s['gambar']; ?>" style="width:50px;height:50px;"></td>
                                    <td><?= $s['nama_produk']; ?></td>
                                    <td><?= $s['satuan']; ?></td>
                                    <td><?= $s['kategori']; ?></td>
                                    <td><?= number_format($s['harga_modal']); ?></td>
                                    <td><?= number_format($s['harga']); ?></td>
                                    <td><?= $s['stok']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaleditproduk" data-idedit="<?= $s['id']; ?>" data-barcodeedit="<?= $s['barcode']; ?>" data-nama_produkedit="<?= $s['nama_produk']; ?>" data-satuanedit="<?= $s['satuan']; ?>" data-kdsatuanedit="<?= $s['kdsatuan']; ?>" data-kategoriedit="<?= $s['kategori']; ?>" data-kdkategoriedit="<?= $s['kdkategori']; ?>" data-harga_modaledit="<?= $s['harga_modal']; ?>" data-hargaedit="<?= $s['harga']; ?>" data-stokedit="<?= $s['stok']; ?>" data-keteranganedit="<?= $s['keterangan']; ?>" name="editproduk" id="editproduk"><i class="fa fa-edit"></i></a>
                                        <a data-kode="<?= $s['id']; ?>" href='javascript:void(0)' class="del_produk btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->

                <!-- modal edit -->
                <div class="modal fade bs-example-modal-xl" id="modaleditproduk">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Edit Produk</b></h5>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Produk/editproduk'); ?>" method="POST" enctype="multipart/form-data">
                                    <!-- <input type="hidden" name="id"> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Barcode</label>
                                            <input type="hidden" name="idedit" id="idedit">
                                            <input type="text" class="form-control" placeholder="Barcode" name="barcodeedit" id="barcodeedit" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama_produkedit" id="nama_produkedit" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Satuan</label>
                                            <select class="form-control itemSatuanEdit" id="satuanedit" name="satuanedit">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kategori</label>
                                            <select class="form-control itemKategoriEdit" id="kategoriedit" name="kategoriedit">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Harga Modal</label>
                                            <input type="text" class="form-control harga_modaledit" placeholder="Harga Modal" name="harga_modaledit" id="harga_modaledit" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control hargaedit" placeholder="Harga Jual" name="hargaedit" id="hargaedit" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Deskripsi / Keterangan</label>
                                                <textarea class="form-control" name="keteranganedit" id="keteranganedit" cols="30" rows="5" placeholder="Ketik Keterangan" required></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Stok</label>
                                                        <input type="text" class="form-control" name="stokedit" id="stokedit" readonly required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="fileedit">Gambar</label>
                                                        <input type="file" id="fileedit" name="fileedit" accept=".jpg, .png">
                                                        <span><b>Jika Tidak Update File Biarkan</b></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-success" type="submit">Edit</button>
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal tambah -->
                <div class="modal fade bs-example-modal-xl" id="modaltambahproduk">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Tambah Produk</b></h5>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Produk/addproduk'); ?>" method="POST" enctype="multipart/form-data">
                                    <!-- <input type="hidden" name="id"> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control" placeholder="Barcode" name="barcode" id="barcode" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama_produk" id="nama_produk" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Satuan</label>
                                            <select class="form-control itemSatuan" id="satuan" name="satuan" required>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kategori</label>
                                            <select class="form-control itemKategori" id="kategori" name="kategori" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Harga Modal</label>
                                            <input type="text" class="form-control" placeholder="Harga Modal" name="harga_modal" id="harga_modal" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" placeholder="Harga Jual" name="harga" id="harga" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Deskripsi / Keterangan</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5" placeholder="Ketik Keterangan" required></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Stok</label>
                                                        <input type="text" class="form-control" value="0" name="stok" id="stok" readonly required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="file">Gambar</label>
                                                        <input type="file" id="file" name="file" accept=".jpg, .png" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-success" type="submit">Tambah</button>
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $this->load->view('templates/_foot'); ?>

                <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                <script>
                    $(document).ready(function() {
                        $('#tableproduk').DataTable({
                            responsive: true
                        });
                    });

                    $('#harga').mask('#,##0,000', {
                        reverse: true
                    });
                    $('#harga_modal').mask('#,##0,000', {
                        reverse: true
                    });

                    $('.itemSatuan').select2({
                        width: '100%',
                        ajax: {
                            url: "<?= base_url(); ?>/Produk/getdatasatuan",
                            dataType: "json",
                            delay: 250,
                            data: function(params) {
                                return {
                                    sat: params.term
                                };
                            },
                            processResults: function(data) {
                                var results = [];
                                $.each(data, function(index, item) {
                                    results.push({
                                        id: item.id,
                                        text: item.satuan
                                    });
                                });
                                return {
                                    results: results
                                }
                            }
                        }
                    });

                    $('.itemSatuanEdit').select2({
                        width: '100%',
                        ajax: {
                            url: "<?= base_url(); ?>/Produk/getdatasatuan",
                            dataType: "json",
                            delay: 250,
                            data: function(params) {
                                return {
                                    sat: params.term
                                };
                            },
                            processResults: function(data) {
                                var results = [];
                                $.each(data, function(index, item) {
                                    results.push({
                                        id: item.id,
                                        text: item.satuan
                                    });
                                });
                                return {
                                    results: results
                                }
                            }
                        }
                    });

                    $('.itemKategori').select2({
                        width: '100%',
                        ajax: {
                            url: "<?= base_url(); ?>/Produk/getdatakategori",
                            dataType: "json",
                            delay: 250,
                            data: function(params) {
                                return {
                                    kat: params.term
                                };
                            },
                            processResults: function(data) {
                                var results = [];
                                $.each(data, function(index, item) {
                                    results.push({
                                        id: item.id,
                                        text: item.kategori
                                    });
                                });
                                return {
                                    results: results
                                }
                            }
                        }
                    });

                    $('.itemKategoriEdit').select2({
                        width: '100%',
                        ajax: {
                            url: "<?= base_url(); ?>/Produk/getdatakategori",
                            dataType: "json",
                            delay: 250,
                            data: function(params) {
                                return {
                                    kat: params.term
                                };
                            },
                            processResults: function(data) {
                                var results = [];
                                $.each(data, function(index, item) {
                                    results.push({
                                        id: item.id,
                                        text: item.kategori
                                    });
                                });
                                return {
                                    results: results
                                }
                            }
                        }
                    });

                    $(document).ready(function() {
                        $(document).on('click', '#editproduk', function() {
                            var idedit = $(this).data('idedit');
                            var barcodeedit = $(this).data('barcodeedit');
                            var nama_produkedit = $(this).data('nama_produkedit');
                            var satuanedit = $(this).data('satuanedit');
                            var kdsatuanedit = $(this).data('kdsatuanedit');
                            var kategoriedit = $(this).data('kategoriedit');
                            var kdkategoriedit = $(this).data('kdkategoriedit');
                            var harga_modaledit = $(this).data('harga_modaledit');
                            var hargaedit = $(this).data('hargaedit');
                            var stokedit = $(this).data('stokedit');
                            var keteranganedit = $(this).data('keteranganedit');

                            $('#idedit').val(idedit);
                            $('#barcodeedit').val(barcodeedit);
                            $('#nama_produkedit').val(nama_produkedit);
                            $('#satuanedit').val(satuanedit);
                            $('#kategoriedit').val(kategoriedit);
                            $('#harga_modaledit').val(harga_modaledit);
                            $('#hargaedit').val(hargaedit);
                            $('#stokedit').val(stokedit);
                            $('#keteranganedit').val(keteranganedit);

                            $('#hargaedit').mask('#,##0,000', {
                                reverse: true
                            });
                            $('#harga_modaledit').mask('#,##0,000', {
                                reverse: true
                            });


                            var $hasilsatuan = $("<option selected='selected'></option>").val(kdsatuanedit).text(satuanedit)
                            $("#satuanedit").append($hasilsatuan).trigger('change');

                            var $hasilkategori = $("<option selected='selected'></option>").val(kdkategoriedit).text(kategoriedit)
                            $("#kategoriedit").append($hasilkategori).trigger('change');

                        })
                    })

                    $(document).on('click', '.del_produk', function(event) {
                        event.preventDefault();
                        let kode = $(this).attr('data-kode');
                        let delete_url = "<?= base_url(); ?>/Produk/delete/" + kode;

                        Swal.fire({
                            title: 'Hapus Data',
                            text: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Hapus',
                            cancelButtonText: 'Batal'
                        }).then(async (result) => {
                            if (result.value) {
                                window.location.href = delete_url;
                            }
                        });
                    });
                </script>

                </body>

                </html>