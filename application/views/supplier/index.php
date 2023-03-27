    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Suplier</a></li>
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
                        <h2 class="mb-0">Data Supplier</h2>
                        <div class="text-right"><a href="#" class="btn btn-success btn-sm-2 " data-toggle="modal" data-target="#modaltambah">Tambah</a></div>
                    </div>
                    <div class="table-responsive py-4 px-4">
                        <table class="table table-flush" id="tabledata">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($supplier as $s) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td class='text-wrap width-200'><?= $s['nama']; ?></td>
                                        <td class='text-wrap width-200'><?= $s['alamat']; ?></td>
                                        <td><?= $s['telepon']; ?></td>
                                        <td><?= $s['keterangan']; ?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaleditsupplier" data-idedit="<?= $s['id']; ?>" data-namaedit="<?= $s['nama']; ?>" data-alamatedit="<?= $s['alamat']; ?>" data-teleponedit="<?= $s['telepon']; ?>" data-keteranganedit="<?= $s['keterangan']; ?>" name="editsupplier" id="editsupplier"><i class="fa fa-edit"></i></a>
                                            <a data-kode="<?= $s['id']; ?>" href='javascript:void(0)' class="del_supplier btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modaleditsupplier" aria-labelledby="modaleditsupplierLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modaleditsupplierLabel">Edit Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('supplier/editsupplier'); ?>" method="post">
                                    <div class="modal-body">

                                        <input type="hidden" name="idedit" id="idedit">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="namaedit" id="namaedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamatedit" id="alamatedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="number" class="form-control" placeholder="Telepon" name="teleponedit" id="teleponedit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keteranganedit" id="keteranganedit" class="form-control" placeholder="Keterangan" required></textarea>
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
                                    <h5 class="modal-title" id="modaltambahLabel">Tambah Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('supplier/addsupplier'); ?>" method="post">
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
                                            <label>Telepon</label>
                                            <input type="number" class="form-control" placeholder="Telepon" name="telepon" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" placeholder="Keterangan" required></textarea>
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
                    <script>
                        $('#tabledata').DataTable({});
                        $(document).ready(function() {
                            $('#tablesupplier').DataTable({
                                responsive: true
                            });
                        });

                        $(document).ready(function() {
                            $(document).on('click', '#editsupplier', function() {
                                var idedit = $(this).data('idedit');
                                var namaedit = $(this).data('namaedit');
                                var alamatedit = $(this).data('alamatedit');
                                var teleponedit = $(this).data('teleponedit');
                                var keteranganedit = $(this).data('keteranganedit');
                                $('#idedit').val(idedit);
                                $('#namaedit').val(namaedit);
                                $('#alamatedit').val(alamatedit);
                                $('#teleponedit').val(teleponedit);
                                $('#keteranganedit').val(keteranganedit);
                            })
                        })

                        $(document).on('click', '.del_supplier', function(event) {
                            event.preventDefault();
                            let kode = $(this).attr('data-kode');
                            let delete_url = "<?= base_url(); ?>/Supplier/delete/" + kode;


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