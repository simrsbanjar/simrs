<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <div class="btn btn-danger btn-xs mr-1 d-none d-lg-inline" style="min-width:160px;">
                <div style="font-size: 20px;">
                    <i class="far fa-calendar-alt fa-lg" style="float: left; padding-top:0.5rem; padding-bottom:0.5rem; padding-right:0.25rem; padding-left:0;"></i>
                </div>
                <span style="font-size: 14px; float: left; padding-left: 5px; line-height: 50px; text-align: left;">
                    <span id="demo" style="font-size: 16px; float:left; padding-left: 5px; line-height: 16px;text-align: left;"></span>
            </div>
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <!-- Judul Sistem Informasi Manajemen Rumah Sakit -->
                <!-- <h2 class="mt-3" style="position: static; font-weight: bold; margin-right: 100px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Sistem Informasi Manajemen Rumah Sakit</h2> -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="mr-1 d-none d-lg-inline text-gray-600 small">
                            <?= $datapegawai['NamaLengkap']; ?>
                            <br>
                            Ruangan : <?= $ruangan['NamaRuangan']; ?>
                        </div>
                        <?php if ($datapegawai['JenisKelamin'] == 'L') { ?>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/default.png'); ?>">
                        <?php } else { ?>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/default_1.png'); ?>">
                        <?php } ?>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('User'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('UbahPassword'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->