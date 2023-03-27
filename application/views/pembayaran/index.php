    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Iuran Wajib Bulanan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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
                <div class="card-header">
                <h3 class="mb-0">Form Pembayaran</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form action="<?= base_url('Pembayaran/add'); ?>" method="post">
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Santri</label>
                          <select class="form-control itemSantri" id="santri" name="santri" onchange="isi_otomatis()" required>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label>Nama Wali</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"> </i></span>
                          </div>
                          <input class="form-control" type="text" id="wali" name="wali" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Nomninal Pembayaran</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                    <span class="input-group-text"><small class="font-weight-bold">Rp</small></span>
                                </div>
                            <input class="form-control" type="text" id="nominal" name="nominal" required>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control itemBulan" id="bulan" name="bulan" required>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Tahun</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                          </div>
                          <input class="form-control" type="text" id="tahun" name="tahun" value="<?= date('Y') ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="text-right">
                    <button type="submit" class="btn btn-success">
                    <i class=" fa fa-fw fa-plus"></i> Tambah</button>
                    </div>
                </form>
</div>
<?php $this->load->view('templates/_foot'); ?>

<script>
$(document).ready(function() {
    $('#nominal').mask('#,##0,000', {
                        reverse: true
                    });
});

                        $('.itemSantri').select2({
                            width: '100%',
                            ajax: {
                                url: "<?= base_url(); ?>/Santri/getsantri2",
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
                                }
                            }
                        });
                        $('.itemBulan').select2({
                            width: '100%',
                            ajax: {
                                url: "<?= base_url(); ?>/Santri/getbulan2",
                                dataType: "json",
                                delay: 250,
                                data: function(params) {
                                    return {
                                        bul: params.term
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

        function isi_otomatis() {
        var santri = $("#santri").val();
        $.ajax({
            type: "GET",
            url: '<?= base_url(); ?>Pembayaran/waliauto',
            data: "santri=" + santri,
            success: function(data) {
                var hasil = JSON.parse(data);
                $.each(hasil, function(key, val) {
                    document.getElementById('wali').value = val.namawali;
                });
            }
        });
    }
</script>