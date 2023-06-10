</div>
<!-- Footer -->
<footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
            <div class="copyright text-center text-lg-left text-muted">
                &copy; 2023
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url('assets/argon/');   ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="<?= base_url('assets/argon/'); ?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Argon JS -->
<script src="<?= base_url('assets/argon/');   ?>assets/js/argon.js?v=1.1.0"></script>
<!-- Demo JS - remove this in your project -->
<script src="<?= base_url('assets/argon/');   ?>assets/js/demo.min.js"></script>
<script src="<?= base_url('assets/argon/'); ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/argon/'); ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/argon/'); ?>assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?= base_url('assets/'); ?>sweetalert/dist/sweetalert2.min.js"></script>

<script src="<?= base_url('assets/'); ?>jquery-mask/jquery.mask.js"></script>
<script src="<?= base_url('assets/'); ?>select2/select2.min.js"></script>
<script src="<?= base_url('assets/'); ?>datepicker/jquery.datetimepicker.full.js"></script>

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
            } elseif ($pesan == "Kwitansi Sukses") {
                // die($pesan);
                $script = "
                            <script>
                                    Swal.fire({
                                      icon: 'success',
                                      title: 'Data',
                                      text: 'Kwitansi Berhasil Di Kirim Ke Wali Santri'
                                    }) 
                            </script>
                        ";
                    } elseif ($pesan == "Reminder") {
                        // die($pesan);
                        $script = "
                                    <script>
                                            Swal.fire({
                                              icon: 'success',
                                              title: 'Data',
                                              text: 'Berhasil Meningirim Reminder!'
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