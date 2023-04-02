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
                     <li class="breadcrumb-item active" aria-current="page">Laporan Pembayaran</li>
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
   <h2 class="mb-0">Laporan Pembayaran</h2>
   <br>
   <div class="row col-md-8 align-items-center">
      <div class="col">
         <div class="form-group">
            <label class="form-control-label">Dari</label>
            <input class="form-control" placeholder="Dari" type="date" value="<?= $tglawal; ?>" id="tglawal" name="tglawal">
         </div>
      </div>
      <div class="col">
         <div class="form-group">
            <label class="form-control-label">Sampai</label>
            <input class="form-control" placeholder="Sampai" type="date" value="<?= $tglakhir; ?>" id="tglakhir" name="tglakhir">
         </div>
      </div>
    <div class="row align-items-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-sm-2 " id="tampilkan" name="tampilkan">Tampilkan</button>
            <button type="button" class="btn btn-danger btn-sm-2 " id="cetak" name="cetak" onclick="cetakpdf()" ><i class="fas fa-print"></i> Cetak</button>
        </div>
   </div>
   </div>
</div>
<div class="table-responsive py-4 px-4">
   <table id="mytable" class="table table-flush">
      <thead class="thead-light">
         <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Tanggal Pembayaran</th>
            <th>Nominal</th>
            <th>Untuk Bulan</th>
            <th>Keterangan</th>
         </tr>
      </thead>
      <tfoot>
         <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Tanggal Pembayaran</th>
            <th>Nominal</th>
            <th>Untuk Bulan</th>
            <th>Keterangan</th>
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
   $(document).ready(function() {

    var tglawal = $('#tglawal').val();
    var tglakhir = $('#tglakhir').val();

    fetch_data(tglawal,tglakhir);

    function fetch_data(tglawal='', tglakhir='')
    {
       table = $('#mytable').DataTable({
   
           "processing": true,
           "serverSide": true,
           "order": [],
   
           "ajax": {
               url: "<?php echo site_url('Laporan/get_ajax_list')?>",
               type: "POST",
               data: {
                tglawal :tglawal,
                tglakhir :tglakhir
               }
           },
   
   
           "columnDefs": [
           {
               "targets": [ 0,1,2,3,4,5],
               "orderable": false,
           },
           ],
   
       });
    }

       $('#tampilkan').click(function(){
            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();
            if(tglawal != '' && tglakhir !='')
            {
                $('#mytable').DataTable().destroy();
                fetch_data(tglawal, tglakhir);
            }
            else
            {
                alert("Both Date is Required");
            }
        }); 
});
function cetakpdf()
{
    var tglawal = $("#tglawal").val();
    var tglakhir = $("#tglakhir").val();
    var base_url = '<?php echo base_url(); ?>';
    window.open("<?php echo base_url();?>Laporan/cetak?tglawal="+tglawal+'&tglakhir='+tglakhir, "_blank");
}
</script>