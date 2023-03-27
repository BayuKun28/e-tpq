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
                    <div class="col-md-10"><b>Data <?= $title ?></b></div>
                    <div class="text-right"><a href="#" class="btn btn-success btn-sm-2" data-toggle="modal" data-target="#modaltambahpengguna">Tambah</a></div>
                </div>

                <div class="table-responsive py-4 px-4">
                    <table class="table table-flush table-hover" id="tablepengguna">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pengguna as $s) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $s['username']; ?></td>
                                    <td><?= $s['nama']; ?></td>
                                    <td><?php
                                        if ($s['role'] == 1) {
                                            echo "Admin";
                                        } else {
                                            echo "Kasir";
                                        }; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaleditpengguna" data-idedit="<?= $s['id']; ?>" data-namaedit="<?= $s['nama']; ?>" data-usernameedit="<?= $s['username']; ?>" data-roleedit="<?= $s['role']; ?>" name="editpengguna" id="editpengguna"><i class="fa fa-edit"></i></a>

                                        <a data-kode="<?= $s['id']; ?>" href='javascript:void(0)' class="del_pengguna btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="modaleditpengguna">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Edit pengguna</b></h5>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Auth/edit'); ?>" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="idedit" id="idedit">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama" name="namaedit" id="namaedit" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="usernameedit" id="usernameedit" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="roleedit" id="roleedit" class="form-control" required>
                                            <option value="1">Admin</option>
                                            <option value="2">Kasir</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="passwordedit" id="passwordedit" required>
                                    </div>
                                    <button class="btn btn-success" type="submit">Tambah</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modaltambahpengguna">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Tambah pengguna</b></h5>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Auth/tambah'); ?>" method="post">
                                    <!-- <input type="hidden" name="id"> -->
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="1">Admin</option>
                                            <option value="2">Kasir</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
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
                        $('#tablepengguna').DataTable({
                            responsive: true
                        });
                    });

                    $(document).ready(function() {
                        $(document).on('click', '#editpengguna', function() {
                            var idedit = $(this).data('idedit');
                            var namaedit = $(this).data('namaedit');
                            var usernameedit = $(this).data('usernameedit');
                            var roleedit = $(this).data('roleedit');
                            $('#idedit').val(idedit);
                            $('#namaedit').val(namaedit);
                            $('#usernameedit').val(usernameedit);
                            $('#roleedit').val(roleedit);
                        })
                    })

                    $(document).on('click', '.del_pengguna', function(event) {
                        event.preventDefault();
                        let kode = $(this).attr('data-kode');
                        let delete_url = "<?= base_url(); ?>/Auth/delete/" + kode;


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