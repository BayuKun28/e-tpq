  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
      <div class="scrollbar-inner">
          <!-- Brand -->
          <div class="sidenav-header d-flex align-items-center">
              <div class="row">
                  <div class="col-md-9">
                      <a class="navbar-brand" href="<?= base_url('Dashboard'); ?>">
                          <i class="fas fa-store-alt"></i> <?php echo $this->session->userdata('identitas')->app_name; ?>
                      </a>
                  </div>
                  <div class="col-md-3">
                      <div class="ml-auto">
                          <!-- Sidenav toggler -->
                          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                              <div class="sidenav-toggler-inner">
                                  <i class="sidenav-toggler-line"></i>
                                  <i class="sidenav-toggler-line"></i>
                                  <i class="sidenav-toggler-line"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="navbar-inner">
              <!-- Collapse -->
              <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                  <!-- Nav items -->
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link" href="<?= base_url('Dashboard'); ?>">
                              <i class="ni ni-shop text-primary"></i>
                              <span class="nav-link-text">Dashboard</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-master">
                              <i class="ni ni-satisfied text-primary"></i>
                              <span class="nav-link-text">Master</span>
                          </a>
                          <div class="collapse" id="navbar-master">
                              <ul class="nav nav-sm flex-column">
                                  <li class="nav-item">
                                      <a href="<?= base_url('Wali'); ?>" class="nav-link">Wali Santri</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="<?= base_url('Santri'); ?>" class="nav-link">Santri</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?= base_url('Pembayaran/Data'); ?>">
                          <i class="ni ni-cart text-green"></i>
                              <span class="nav-link-text">Iuran Wajib Bulanan</span>
                          </a>
                      </li>
                      <!-- <li class="nav-item">
                          <a class="nav-link" href="#navbar-iuran" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-iuran">
                            <i class="ni ni-cart text-green"></i>
                              <span class="nav-link-text">Iuran Wajib Bulanan</span>
                          </a>
                          <div class="collapse" id="navbar-iuran">
                              <ul class="nav nav-sm flex-column">
                                  <li class="nav-item">
                                      <a href="<?= base_url('Pembayaran'); ?>" class="nav-link">Pembayaran</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="<?= base_url('Pembayaran/Data'); ?>" class="nav-link">Data</a>
                                  </li>
                              </ul>
                          </div>
                      </li> -->
                      <li class="nav-item">
                          <a class="nav-link" href="#navbar-laporan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-laporan">
                              <i class="ni ni-basket text-orange"></i>
                              <span class="nav-link-text">Laporan</span>
                          </a>
                          <div class="collapse" id="navbar-laporan">
                              <ul class="nav nav-sm flex-column">
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">Laporan Pembayaran</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?= base_url('Pengaturan'); ?>">
                              <i class="ni ni-settings text-primary"></i>
                              <span class="nav-link-text">Pengaturan</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?= base_url('Auth/pengguna'); ?>">
                              <i class="ni ni-single-02 text-primary"></i>
                              <span class="nav-link-text">Pengguna</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </nav>