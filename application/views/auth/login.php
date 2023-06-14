<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?= $title;  ?></title>
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/argon/') ?>assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/argon/') ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/argon/') ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/argon/') ?>assets/css/argon.css?v=1.1.0" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/argon/') ?>assets/vendor/animate.css/animate.min.css">
</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary">
                        <div class="card-header bg-transparent pb-2">
                           <div class="btn-wrapper text-center p-2">
                                <img class="card-img-top" src="<?= base_url('assets/'); ?>pngegg.png" style="width: 300px; height: auto;">
                            </div>
                            <div class="btn-wrapper text-center py-2">
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="<?= base_url('Auth'); ?>" method="POST">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Username" type="text" name="username" id="username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" name="password" id="password">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?= base_url('assets/argon/') ?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('assets/argon/') ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/argon/') ?>assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?= base_url('assets/argon/') ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url('assets/argon/') ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="<?= base_url('assets/argon/') ?>assets/js/argon.js?v=1.1.0"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="<?= base_url('assets/argon/') ?>assets/js/demo.min.js"></script>
    <script src="<?= base_url('assets/argon/') ?>assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
</body>

</html>