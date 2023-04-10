    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Wali</a></li>
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
                        <h2 class="mb-0">Data Wali</h2>
                        <div class="text-right"><a href="#" class="btn btn-success btn-sm-2 " data-toggle="modal" data-target="#modaltambah">Tambah</a></div>
                    </div>
                    <div class="table-responsive py-4 px-4">
                        <table id="mytable" class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modaleditwali" aria-labelledby="modaleditwaliLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modaleditwaliLabel">Edit Wali</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Wali/editwali'); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="hidden" class="form-control" placeholder="Nama" name="idedit" id="idedit" required>
                                            <input type="text" class="form-control" placeholder="Nama" name="namaedit" id="namaedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamatedit" id="alamatedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>No Hp</label>
                                            <input type="text" class="form-control" placeholder="No Hp" name="no_hpedit" id="no_hpedit" required>
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
                                    <h5 class="modal-title" id="modaltambahLabel">Tambah Wali</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Wali/addwali'); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label>No Hp</label>
                                            <input type="text" class="form-control" placeholder="No Hp" name="no_hp" required>
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
            "url": "<?php echo site_url('Wali/get_ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
            }
        },


        "columnDefs": [
        {
            "targets": [ 0,1,2,3,4 ],
            "orderable": false,
        },
        ],

    });
    $(document).on('click', '#editwali', function() {
                                var idedit = $(this).data('idedit'); 
                                var namaedit = $(this).data('namaedit');
                                var alamatedit = $(this).data('alamatedit');
                                var no_hpedit = $(this).data('no_hpedit');
                                var is_activeedit = $(this).data('is_activeedit');
                                $('#idedit').val(idedit);
                                $('#namaedit').val(namaedit);
                                $('#alamatedit').val(alamatedit);
                                $('#no_hpedit').val(no_hpedit);
                                $('#is_activeedit').val(is_activeedit);
                            })
                        })

                        $(document).on('click', '.del_wali', function(event) {
                            event.preventDefault();
                            let kode = $(this).attr('data-kode');
                            let delete_url = "<?= base_url(); ?>/Wali/delete/" + kode;


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