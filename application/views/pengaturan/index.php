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

                    <form action="<?= base_url('Pengaturan/edit') ?>" method="POST">
                        <div class="table-responsive">
                            <div class="row col-md-12">
                                <div class="form-group">
                                    <label>App Name</label>
                                    <input type="text" class="form-control" placeholder="App Name" name="app_name" value="<?php echo $identitas->app_name ?>" required style="width: 1002px; height: 40px;">
                                </div>
                                <div class="form-group">
                                    <label>Nama Identitas</label>
                                    <input type="text" class="form-control" placeholder="Nama identitas" name="nama" value="<?php echo $identitas->nama ?>" required style="width: 1002px; height: 40px;">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" placeholder="Alamat" class="form-control" required style="width: 1002px; height: 96px;"><?php echo $identitas->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control" placeholder="Nomor Rekening" name="no_hp" value="<?php echo $identitas->no_hp; ?>" required style="width: 1002px; height: 40px;">
                                </div>
                                <div class="form-group">

                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>


        <?php $this->load->view('templates/_foot'); ?>