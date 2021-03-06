<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <title><?= $title; ?></title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/rsubanjar.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Chart Plugin -->
    <script src="<?php echo base_url(); ?>assets/css/Chart.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/Chart.js"></script>
    <link href="<?= base_url('assets/'); ?>css/Chart.css">
    <link href="<?= base_url('assets/'); ?>css/Chart.min.css">
    <script src="<?php echo base_url() ?>assets/chartjs/Chart.js"></script>
    <link href="<?= base_url('assets/'); ?>css/bg.css" rel="stylesheet">

    <!-- Data label -->
    <script src="<?php echo base_url() ?>assets/css/chartjs-plugin-datalabels.js"></script>
    <script src="<?php echo base_url() ?>assets/css/chartjs-plugin-datalabels.min.js"></script>

    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        .dataTables_wrapper .myfilter .dataTables_filter {
            float: right
        }

        .dataTables_wrapper .mylength .dataTables_length {
            float: left
        }
    </style>
    <script src="<?php echo base_url(); ?>assets/export/Buttons-1.5.1/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/Buttons-1.5.1/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/pdfmake-0.1.32/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/pdfmake-0.1.32/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/Buttons-1.5.1/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/export/Buttons-1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">