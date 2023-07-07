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
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                <h3 class="mb-0">Detail Santri</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form action="<?= base_url('Pembayaran/Detail/').$detail['id']; ?>" method="post">
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Santri</label>
                        <input class="form-control" type="text" id="santri" name="santri" value="<?= $detail['nama']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label>Nama Wali</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"> </i></span>
                          </div>
                          <input class="form-control" type="text" id="wali" name="wali" value="<?= $detail['namawali']; ?>" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control itemBulan" id="bulan" name="bulan" required>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tahun</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                          </div>
                          <input class="form-control" type="hidden" id="id_santri" name="id_santri" value="<?= $detail['id']; ?>" required>
                          <input class="form-control" type="number" id="tahun" name="tahun" id="tahun" value="<?= $tahun; ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Input groups with icon -->
                    <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                    <i class=" fa fa-fw fa-print"></i> Tampilkan</button>
                    </div>
                </form>
                <div class="table-responsive py-4 px-4">
                        <table id="mytable" class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modaledit" aria-labelledby="modaleditLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modaleditLabel">Edit Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Pembayaran/edit'); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <input type="hidden" class="form-control"  name="idedit" id="idedit" readonly>
                                            <input type="hidden" class="form-control"  name="idpage" id="idpage" value="<?= $detail['id']; ?>" readonly>
                                            <input type="text" class="form-control" name="bulanedit" id="bulanedit" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nominal Pembayaran</label>
                                            <input class="form-control" type="text" id="nominaledit" name="nominaledit" value="<?= $detail['nominal']; ?>" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" id="keteranganedit" name="keteranganedit" readonly required>LUNAS</textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalbayar" aria-labelledby="modalbayarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalbayarLabel">Form Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Pembayaran/add'); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <input type="hidden" class="form-control"  name="idpage" id="idpage" value="<?= $detail['id']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="id_bulan" id="id_bulan" readonly>
                                            <input type="hidden" class="form-control" name="id_tahun" id="id_tahun" value="<?= $tahun; ?>" readonly>
                                            <input type="text" class="form-control" name="bulan" id="bulan" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nominal Pembayaran</label>
                                            <input class="form-control" type="text" id="nominal" name="nominal" value="<?= $detail['nominal']; ?>" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" readonly required>LUNAS</textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>
<?php $this->load->view('templates/_foot'); ?>

<script>
  
  $(document).ready(function() {
    var tahun = $("#tahun").val();
    table = $('#mytable').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('Pembayaran/get_ajax_listdetail')?>",
            "type": "POST",
            "data": function ( data ) {
              data.tahun = $('#tahun').val();
              data.id_santri = $('#id_santri').val();
            }
        },


        "columnDefs": [
        {
            "targets": [ 0,1,2,3,4 ],
            "orderable": false,
        },
        ],
        autoWidth: false

    });
                          $(document).on('click', '#edit', function() {
                                var idedit = $(this).data('idedit'); 
                                var bulanedit = $(this).data('bulanedit');
                                var nominaledit = $(this).data('nominaledit');
                                var keteranganedit = $(this).data('keteranganedit');
                                $('#idedit').val(idedit);
                                $('#bulanedit').val(bulanedit);
                                $('#nominaledit').val(nominaledit);
                                $('#keteranganedit').val(keteranganedit);
                                $('#nominaledit').mask('#,##0,000', {
                                    reverse: true
                                });
                            })
                            $(document).on('click', '#bayar', function() {
                                var id_bulan = $(this).data('id_bulan'); 
                                var bulan = $(this).data('bulan');
                                $('#id_bulan').val(id_bulan);
                                $('#bulan').val(bulan);
                                $('#nominal').mask('#,##0,000', {
                                    reverse: true
                                });
                            })
  

    // $('.itemBulan').select2({
    //                         width: '100%',
    //                         ajax: {
    //                             url: "<?= base_url(); ?>/Santri/getbulan2",
    //                             dataType: "json",
    //                             delay: 250,
    //                             data: function(params) {
    //                                 return {
    //                                     bul: params.term
    //                                 };
    //                             },
    //                             processResults: function(data) {
    //                                 var results = [];
    //                                 $.each(data, function(index, item) {
    //                                     results.push({
    //                                         id: item.id,
    //                                         text: item.nama
    //                                     });
    //                                 });
    //                                 return {
    //                                     results: results
    //                                 }
    //                             }
    //                         }
    //                     });

    //       var bulan = parseInt(<?= date('m') ?>); 
    //           $.ajax({
    //               type: "GET",
    //               url: '<?= base_url(); ?>Santri/getbulan',
    //               data: "id=" + bulan,
    //               success: function(data) {
    //                   var hasil = JSON.parse(data);
    //                   $.each(hasil, function(key, val) {
    //                     var $newOption = $("<option selected='selected'></option>").val(bulan).text(val.nama);
    //                     $("#bulan").append($newOption).trigger('change');
    //                   });
    //               }
    //           });
  });
</script>