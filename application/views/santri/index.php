    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Santri</a></li>
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
                        <h2 class="mb-0">Data Santri</h2>
                        <div class="text-right"><a href="#" class="btn btn-success btn-sm-2 " data-toggle="modal" data-target="#modaltambah">Tambah</a></div>
                    </div>
                    <div class="table-responsive py-4 px-4">
                        <table id="mytable" class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Wali Santri</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Wali Santri</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modaleditsantri" aria-labelledby="modaleditsantriLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modaleditsantriLabel">Edit Santri</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Santri/editsantri'); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="hidden" class="form-control" placeholder="Nama" name="idedit" id="idedit" required>
                                            <input type="text" class="form-control" placeholder="Nama" name="namaedit" id="namaedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahiredit" id="tanggal_lahiredit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamatedit" id="alamatedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" id="jkedit" name="jkedit" required>
                                                <option value="" disabled="" selected="">---Jenis Kelamin----</option>
                                                <option value="L">L</option>
                                                <option value="P">P</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Wali Santri</label>
                                            <select class="form-control itemWali" id="id_waliedit" name="id_waliedit" required>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Aktif ?</label>
                                            <select class="form-control" id="is_activeedit" name="is_activeedit" required>
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modaltambah" aria-labelledby="modaltambahLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modaltambahLabel">Tambah Santri</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Santri/addsantri'); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" id="jk" name="jk" required>
                                                <option value="" disabled="" selected="">---Jenis Kelamin----</option>
                                                <option value="L">L</option>
                                                <option value="P">P</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Wali Santri</label>
                                            <select class="form-control itemWali" id="id_wali" name="id_wali" required>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Aktif ?</label>
                                            <select class="form-control" id="is_active" name="is_active" required>
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
$(document).ready(function() {

    //datatables
    table = $('#mytable').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('Santri/get_ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
            }
        },


        "columnDefs": [
        {
            "targets": [ 0,1,2,3,4,5,6 ],
            "orderable": false,
        },
        ],

    });
    $(document).on('click', '#editsantri', function() {
                                var idedit = $(this).data('idedit'); 
                                var namaedit = $(this).data('namaedit');
                                var tanggal_lahiredit = $(this).data('tanggal_lahiredit');
                                var alamatedit = $(this).data('alamatedit');
                                var id_waliedit = $(this).data('id_waliedit');
                                var namawaliedit = $(this).data('namawaliedit');
                                var jkedit = $(this).data('jkedit');
                                var is_activeedit = $(this).data('is_activeedit');
                                $('#idedit').val(idedit);
                                $('#namaedit').val(namaedit);
                                $('#tanggal_lahiredit').val(tanggal_lahiredit);
                                $('#alamatedit').val(alamatedit);
                                $('#jkedit').val(jkedit);
                                $('#is_activeedit').val(is_activeedit);

                                var $hasilwali = $("<option selected='selected'></option>").val(id_waliedit).text(namawaliedit)
                                $("#id_waliedit").append($hasilwali).trigger('change');
                            })
                        })

                        $(document).on('click', '.del_santri', function(event) {
                            event.preventDefault();
                            let kode = $(this).attr('data-kode');
                            let delete_url = "<?= base_url(); ?>/Santri/delete/" + kode;


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

                        $('.itemWali').select2({
                            width: '100%',
                            ajax: {
                                url: "<?= base_url(); ?>/Santri/getwali2",
                                dataType: "json",
                                delay: 250,
                                data: function(params) {
                                    return {
                                        wal: params.term
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
</script>