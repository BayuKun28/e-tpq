<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Pembayaran Per Santri</li>
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
                    <h2 class="mb-0">Laporan Pembayaran Per Santri</h2>
                    <br>
                    <form>
                        <div class="row col-md-8 align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Santri</label>
                                    <select class="form-control itemSantri" id="id_santri" name="id_santri" required>
                                        <option value="9999999999999999999">Klik Untuk Pilih Santri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Tahun</label>
                                    <input class="form-control" placeholder="Tahun" type="number" value="<?= $tahun; ?>" id="tahun" name="tahun" required>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success btn-sm-2 " id="tampilkan" name="tampilkan">Tampilkan</button>
                                    <button type="button" class="btn btn-danger btn-sm-2 " id="cetak" name="cetak" onclick="cetakpdf()"><i class="fas fa-print"></i> Cetak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive py-4 px-4">
                    <table id="mytable" class="table table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <?php $this->load->view('templates/_foot'); ?>
                <script type="application/javascript">
                    var save_method;
                    var table;
                    var csfrData = {};
                    csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo
                                                                                            $this->security->get_csrf_hash(); ?>';
                    $.ajaxSetup({
                        data: csfrData
                    });
                    $(document).ready(function() {});

                    function tampilkan() {
                        table = $('#mytable').DataTable({

                            "processing": true,
                            "serverSide": true,
                            "pageLength": 12,
                            "order": [],

                            "ajax": {
                                "url": "<?php echo site_url('Laporan/get_ajax_listpersantri') ?>",
                                "type": "POST",
                                "data": function(data) {
                                    data.tahun = $('#tahun').val(),
                                        data.id_santri = $('#id_santri').val()
                                }
                            },


                            "columnDefs": [{
                                "targets": [0, 1, 2, 3, 4],
                                "orderable": false,
                            }, ],autoWidth: false

                        });
                        table.destroy();
                        table.ajax.reload();
                    }

                    $('#tampilkan').click(function() {
                        var z = $('#id_santri').val();
                        if (z == "9999999999999999999") {
                            alert("Silahkan Pilih Santri");
                        } else {
                            tampilkan();
                        }
                    });

                    function cetakpdf() {
                        var z = $('#id_santri').val();
                        if (z == "9999999999999999999") {
                            alert("Silahkan Pilih Santri");
                        } else {
                            var id_santri = $("#id_santri").val();
                            var tahun = $("#tahun").val();
                            var base_url = '<?php echo base_url(); ?>';
                            window.open("<?php echo base_url(); ?>Laporan/cetakpersantri?tahun=" + tahun + '&id_santri=' + id_santri, "_blank");
                        }
                    }

                    $('.itemSantri').select2({
                        width: '100%',
                        ajax: {
                            url: "<?= base_url(); ?>/Santri/getSantri2",
                            dataType: "json",
                            delay: 250,
                            data: function(params) {
                                return {
                                    san: params.term
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
                            },
                        }
                    });
                </script>