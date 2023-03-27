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
                    <!-- <h2 class="mb-0"><?= $title ?></h2> -->
                    <div class="row">
                        <div class="col-md-10"><b>Data <?= $title ?></b></div>
                    </div>
                    <hr>
                    <!-- /.panel-heading -->

                    <form action="<?= base_url('Auth/simpanprofil'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Nama Pengguna</label>
                                <input class="form-control" type="hidden" name="idedit" id="idedit" value="<?= $profil['id']; ?>" required>
                                <input class="form-control" type="text" name="nama" id="nama" value="<?= $profil['nama']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" id="username" value="<?= $profil['username']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>


        <?php $this->load->view('templates/_foot'); ?>