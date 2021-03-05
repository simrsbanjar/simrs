<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
</head>

<body>
    <!-- <title>SIAK - MTS Daarus Sunnah Wangon</title> -->
    <title>Kunjungan Bersarkan Status dan Jenis Pasien</title>


    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <!--<script src="" type="text/javascript"></script>-->

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet"> -->

    <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!--<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" ></script>-->

    </head>

    <body id="page-top">
        <div id="wrapper">

            <div id="content-wrapper">

                <div class="container-fluid">
                    <!-- row satu  -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="text-align: center;">
                                    <strong>Form</strong> Instalasi
                                </div>
                                <!--id formfilter adalah nama form untuk filter-->
                                <?php $instalasi  = $this->db->query("SELECT * FROM Instalasi  WHERE StatusEnabled = '1' AND (KdInstalasi IN ('01', '02', '03', '04', '06', '08', '09', '10', '11', '16','22')) ORDER BY NamaInstalasi ASC")->result(); ?>

                                <form id="forminstalasi">
                                    <div class="card-body card-block">
                                        <div class="row form-group">
                                            <div id="form-tanggal" class="col col-md-2" style="text-align: right;"><label for="select" class=" form-control-label">Instalasi</label></div>
                                            <div class="col-12 col-md-9 ">
                                                <select name="instalasi" id="instalasi" class="form-control form-control-user">
                                                    <option value="">- Pilih Instalasi -</option>
                                                    <?php foreach ($instalasi as $key) { ?>
                                                        <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                                                    <?php } ?>
                                                </select>
                                                <small class="help-block form-text"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">

                                        <!--ketika di klik tombol Proses, maka akan mengeksekusi fungsi javascript prosesPeriode() , untuk menampilkan form-->

                                        <button id="btnproses" type="button" onclick="prosesPeriode()" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Proses</button>

                                        <!--ketika di klik tombol Reset, maka akan mengeksekusi fungsi javascript prosesReset() , untuk menyembunyikan form-->
                                        <button onclick="prosesReset()" type="button" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="pilihanfilter">
                        <!-- row satu  -->
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Form</strong> Filter
                                </div>
                                <!--id formfilter adalah nama form untuk filter-->
                                <form id="formfilter">
                                    <div class="card-body card-block">
                                        <input name="valnilai" type="hidden">
                                        <div class="row form-group">
                                            <div id="form-tanggal" class="col col-md-3"><label for="select" class=" form-control-label">Pilih Periode By</label></div>
                                            <div class="col-12 col-md-9">
                                                <select name="periode" id="periode" class="form-control form-control-user" title="Pilih Tahun Ajaran">
                                                    <option value="">-PILIH-</option>
                                                    <option value="tanggal">Tanggal</option>
                                                    <option value="bulan">Bulan</option>
                                                    <option value="tahun">Tahun</option>
                                                </select>
                                                <small class="help-block form-text"></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">

                                        <!--ketika di klik tombol Proses, maka akan mengeksekusi fungsi javascript prosesPeriode() , untuk menampilkan form-->

                                        <button id="btnproses" type="button" onclick="prosesPeriode()" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Proses</button>

                                        <!--ketika di klik tombol Reset, maka akan mengeksekusi fungsi javascript prosesReset() , untuk menyembunyikan form-->
                                        <!-- <button onclick="prosesReset()" type="button" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> -->

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- row kedua  -->
                        <div class="col-lg-7" id="tanggalfilter">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Form</strong> Filter by Tanggal
                                </div>
                                <form action="<?php echo base_url(); ?>KunjunganStatusJenisPasien/filter" method="POST" target="_blank">
                                    <input type="hidden" name="nilaifilter" value="1">

                                    <input name="valnilai" type="hidden">
                                    <div class="card-body card-block">

                                        <div class="row form-group">
                                            <div class="col col-md-2">
                                                <label for="select" class=" form-control-label">Dari tanggal</label>
                                            </div>
                                            <div class="col col-md-4">
                                                <input name="tanggalawal" value="<?= date('Y-m-d') ?>" type="date" class="form-control" placeholder="Inputkan Jenis Bayar" id="tanggalawal" required="">
                                            </div>
                                            <div class="col col-md-2">
                                                <label for="select" class=" form-control-label">Sampai tanggal</label>
                                            </div>
                                            <div class="col col-md-4">
                                                <input name="tanggalakhir" value="<?= date('Y-m-d') ?>" type="date" class="form-control" placeholder="Inputkan Jenis Bayar" id="tanggalakhir" required="">
                                            </div>
                                            <small class="help-block form-text"></small>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Print</button>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- row ketiga  -->
                        <div class="col-lg-7" id="bulanfilter">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Form</strong> Filter by Bulan
                                </div>
                                <form id="formbulan" action="<?php echo base_url(); ?>filter" method="POST" target="_blank">
                                    <div class="card-body card-block">
                                        <input type="hidden" name="nilaifilter" value="2">

                                        <input name="valnilai" type="hidden">
                                        <div class="row form-group">
                                            <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Pilih Tahun</label></div>
                                            <div class="col-12 col-md-10">
                                                <select name="tahun1" id="tahun1" class="form-control form-control-user" title="Pilih Tahun">
                                                    <option value="">-PILIH-</option>
                                                    <?php foreach ($tahun as $thn) : ?>
                                                        <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="help-block form-text"></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-2">
                                                <label for="select" class=" form-control-label">Dari tanggal</label>
                                            </div>
                                            <div class="col col-md-4">
                                                <select name="bulanawal" id="bulanawal" class="form-control form-control-user" title="Pilih Bulan">
                                                    <option value="">-PILIH-</option>
                                                    <option value="1">JANUARI</option>
                                                    <option value="2">FEBRUARI</option>
                                                    <option value="3">MARET</option>
                                                    <option value="4">APRIL</option>
                                                    <option value="5">MEI</option>
                                                    <option value="6">JUNI</option>
                                                    <option value="7">JULI</option>
                                                    <option value="8">AGUSTUS</option>
                                                    <option value="9">SEPTEMBER</option>
                                                    <option value="10">OKTOBER</option>
                                                    <option value="11">NOVEMBER</option>
                                                    <option value="12">DESEMBER</option>
                                                </select>
                                            </div>
                                            <div class="col col-md-2">
                                                <label for="select" class=" form-control-label">Sampai tanggal</label>
                                            </div>
                                            <div class="col col-md-4">
                                                <select name="bulanakhir" id="bulanakhir" class="form-control form-control-user" title="Pilih Bulan">
                                                    <option value="">-PILIH-</option>
                                                    <option value="1">JANUARI</option>
                                                    <option value="2">FEBRUARI</option>
                                                    <option value="3">MARET</option>
                                                    <option value="4">APRIL</option>
                                                    <option value="5">MEI</option>
                                                    <option value="6">JUNI</option>
                                                    <option value="7">JULI</option>
                                                    <option value="8">AGUSTUS</option>
                                                    <option value="9">SEPTEMBER</option>
                                                    <option value="10">OKTOBER</option>
                                                    <option value="11">NOVEMBER</option>
                                                    <option value="12">DESEMBER</option>
                                                </select>
                                            </div>
                                            <small class="help-block form-text"></small>

                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Print</button>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- row keempat  -->
                        <div class="col-lg-7" id="tahunfilter">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Form</strong> Filter by Tahun
                                </div>
                                <form id="formtahun" action="<?php echo base_url(); ?>filter" method="POST" target="_blank">
                                    <input name="valnilai" type="hidden">
                                    <div class="card-body card-block">

                                        <input type="hidden" name="nilaifilter" value="3">

                                        <div class="row form-group">
                                            <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Pilih Tahun</label></div>
                                            <div class="col-12 col-md-10">
                                                <select name="tahun2" id="tahun2" class="form-control form-control-user" title="Pilih Tahun">
                                                    <option value="">-PILIH-</option>
                                                    <?php foreach ($tahun as $thn) : ?>
                                                        <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="help-block form-text"></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Print</button>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.content-wrapper -->
            </div>
        </div>

        <script type="text/javascript">
            /*digunakan untuk menyembunyikan form tanggal, bulan dan tahun saat halaman di load */
            $(document).ready(function() {

                $("#tanggalfilter").hide();
                $("#tahunfilter").hide();
                $("#bulanfilter").hide();
                $("#cardbayar").hide();
                $("#pilihanfilter").hide();

            });

            /*digunakan untuk menampilkan form tanggal, bulan dan tahun*/

            function prosesPeriode() {
                var periode = $("[name='periode']").val();

                if (periode == "tanggal") {
                    $("#btnproses").hide();
                    $("#tanggalfilter").show();
                    $("[name='valnilai']").val('tanggal');

                } else if (periode == "bulan") {
                    $("#btnproses").hide();
                    $("[name='valnilai']").val('bulan');
                    $("#bulanfilter").show();

                } else if (periode == "tahun") {
                    $("#btnproses").hide();
                    $("[name='valnilai']").val('tahun');
                    $("#tahunfilter").show();
                }
            }

            /*digunakan untuk menytembunyikan form tanggal, bulan dan tahun*/

            function prosesReset() {
                $("#btnproses").show();

                $("#tanggalfilter").hide();
                $("#tahunfilter").hide();
                $("#bulanfilter").hide();
                $("#cardbayar").hide();

                $("#periode").val('');
                $("#tanggalawal").val('');
                $("#tanggalakhir").val('');
                $("#tahun1").val('');
                $("#bulanawal").val('');
                $("#bulanakhir").val('');
                $("#tahun2").val('');
                $("#targetbayar").empty();

            }
        </script>
    </body>

</html>