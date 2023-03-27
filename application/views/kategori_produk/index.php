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
                    <div class="text-right"><a href="#" class="btn btn-success btn-sm-2 " data-toggle="modal" data-target="#modaltambahkategori">Tambah</a></div>
                </div>
                <div class="table-responsive py-4 px-4">
                    <table class="table table-flush table-hover" id="tablekategori">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kategori_produk as $s) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $s['kategori']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaleditkategori" data-idedit="<?= $s['id']; ?>" data-kategoriedit="<?= $s['kategori']; ?>" name="editkategori" id="editkategori"><i class="fa fa-edit"></i></a>

                                        <a data-kode="<?= $s['id']; ?>" href='javascript:void(0)' class="del_kategori btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>


                <div class="modal fade" id="modaleditkategori">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Edit Kategori</b></h5>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Kategori_produk/editproduk'); ?>" method="post">
                                    <input type="hidden" name="idedit" id="idedit">
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" class="form-control" placeholder="Kategori" name="kategoriedit" id="kategoriedit" required>
                                    </div>
                                    <button class="btn btn-success" type="submit">Edit</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modaltambahkategori">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Tambah Kategori</b></h5>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Kategori_produk/addkategoriproduk'); ?>" method="post">
                                    <!-- <input type="hidden" name="id"> -->
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" class="form-control" placeholder="Kategori" name="kategori" id="kategori" required>
                                    </div>
                                    <button class="btn btn-success" type="submit">Tambah</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


<?php $this->load->view('templates/_foot'); ?>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#tablekategori').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#editkategori', function() {
            var idedit = $(this).data('idedit');
            var kategoriedit = $(this).data('kategoriedit');
            $('#idedit').val(idedit);
            $('#kategoriedit').val(kategoriedit);
        })
    })

    $(document).on('click', '.del_kategori', function(event) {
        event.preventDefault();
        let kode = $(this).attr('data-kode');
        let delete_url = "<?= base_url(); ?>/Kategori_produk/delete/" + kode;

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