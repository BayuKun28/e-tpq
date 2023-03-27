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
<div id="page-wrapper">
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h2 class="mb-0"><?= $title ?></h2>
                        <div class="text-right"><a href="#" class="btn btn-success btn-sm-2 " data-toggle="modal" data-target="#modaltambahstokkeluar" name="tambahstokkeluar" id="tambahstokkeluar">Tambah</a></div>
                    </div>
                        <div class="table-responsive py-4 px-4">
                            <table class="table table-flush  table-hover" id="tablestokkeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Barcode</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($stok_keluar as $s) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $s['tanggal']; ?></td>
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

<!-- /#wrapper -->

<div class="modal fade" id="modaltambahstokkeluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Tambah Stok Keluar</b></h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Stok_keluar/addstokkeluar'); ?>" method="post">
                    <!-- <input type="hidden" name="id"> -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" placeholder="tanggal" name="tanggal" id="tanggal" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>Barcode</label>
                        <select class="form-control itemBarcode" id="barcode" name="barcode">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <select class="form-control" id="keterangan" name="keterangan">
                            <option value="Rusak">Rusak</option>
                            <option value="Hilang">Hilang</option>
                            <option value="Kadaluarsa">Kadaluarsa</option>
                        </select>
                    </div>
                    <button class="btn btn-success" type="submit">Tambah</button>
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/_foot'); ?>

<script src="<?= base_url('assets/moment/moment.min.js') ?>"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#tablestokkeluar').DataTable({
            responsive: true
        });
    });


    $('.itemBarcode').select2({
        width: '100%',
        ajax: {
            url: "<?= base_url(); ?>/Stok_keluar/getbarcode",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return {
                    bar: params.term
                };
            },
            processResults: function(data) {
                var results = [];
                $.each(data, function(index, item) {
                    results.push({
                        id: item.id,
                        text: item.barcode
                    });
                });
                return {
                    results: results
                }
            }
        }
    });


    $('.itemSupplier').select2({
        width: '100%',
        ajax: {
            url: "<?= base_url(); ?>/Stok_keluar/getsupplier",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return {
                    sup: params.term
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

    $(document).on('click', '#tambahstokkeluar', function(event) {
        $("#tanggal").datetimepicker({
            format: "d-m-Y h:i:s"
        })
        let a = moment().format("D-MM-Y H:mm:ss");
        $("#tanggal").val(a)
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