<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/rsubanjar.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/bg.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
                <img src="<?= base_url('assets/img/simrs') ?>/logosimrs.png" width="320px" class="mb-auto col-5"></img>
                <!-- <i class="fas fa-hospital-alt"></i> -->
                <!-- </div> -->
                <div class="mb-auto sidebar-brand-text mx-3" style="font-size: 28px;">SIMRS</div>
            </a>

            <!-- Divider -->
            <br>
            <hr class="sidebar-divider my-0">
            <br>

            <?php foreach ($menu as $key) { ?>
                <div class="RSUwarna RSUuppercase" style="font-size: 18px; padding: 0 1rem; font-weight: 800;">
                    <?php echo $key->NamaMenu; ?>
                </div>

                <li class="nav-item">
                    <?php $mensub       = $this->db->query("SELECT * FROM SubListMenuWeb WHERE NoIndex_p = '" . $key->NoIndex . "' ORDER BY NoUrut")->result(); ?>

                    <?php if ($mensub) { ?>
                        <?php foreach ($mensub as $key_s) { ?>

                            <?php $mendsub       = $this->db->query("SELECT * FROM DtlSubListMenuWeb WHERE NoIndex_p = '" . $key->NoIndex . "' AND NoIndex_p_s = '" . $key_s->NoIndex . "' AND StatusEnabled ='1' ORDER BY NoUrut")->result(); ?>

                            <?php if ($mendsub) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span style="font-size: 16px;"><?php echo $key_s->NamaMenu; ?></span>
                    </a>
                    <?php foreach ($mendsub as $key_ds) { ?>

                        <?php $menrdsub       = $this->db->query("SELECT * FROM RincDtlSubListMenuWeb WHERE NoIndex_p = '" . $key->NoIndex . "' AND NoIndex_p_s = '" . $key_s->NoIndex . "' AND NoIndex_p_s_d ='" . $key_ds->NoIndex . "'AND StatusEnabled ='1' ORDER BY NoUrut")->result(); ?>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <div class="RSUnavdesain">
                                        <a class="RSUnavbarline"><?php echo $key_ds->NamaMenu; ?></a>
                                    </div>
                                    <?php foreach ($menrdsub as $key_rds) { ?>
                                        <a style="font-size: 12px;" class="RSUsidebarline" href="<?php echo $key_rds->Object; ?>"><?php echo $key_rds->NamaMenu; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </li>
            <?php }  ?>
        <?php } ?>

    <?php } else { ?>
        <a class="nav-link" href="<?= base_url('submenu'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>
                <?php echo $key->NamaMenu; ?>
            </span>
        <?php } ?>
        </a>
        </li>
    <?php } ?>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <h2 class="mt-3" style="position: static; font-weight: bold; margin-right: 80px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Sistem Informasi Manajemen Rumah Sakit</h2>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="mr-1 d-none d-lg-inline text-gray-600 small">
                                    <?= $datapegawai['NamaLengkap']; ?>
                                    <br>
                                    Ruangan : <?= $ruangan['NamaRuangan']; ?>
                                </div>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/default.png'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href=<?= base_url('User'); ?>>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/img/profile/default.png'); ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $datapegawai['NamaLengkap']; ?></h5>
                                    <p class="card-text">Jenis Kelamin : <?= $datapegawai['JenisKelamin']; ?></p>
                                    <p class="card-text">Tempat Tangal Lahir : <?= $datapegawai['TempatLahir'] . ', ' . date('d-m-Y', strtotime($datapegawai['TglLahir'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIMRS RSU Kota Banjar <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda Yakin Keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>