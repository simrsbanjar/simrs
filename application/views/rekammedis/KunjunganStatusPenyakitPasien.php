<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="container-fluid">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $laporan; ?></li>
        </ol>

        <div class="row">
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
                            <button onclick="prosesReset()" type="button" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>

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
                    <form action="<?php echo base_url(); ?>KunjunganStatusPenyakitPasien/filter" method="POST" target="_blank">
                        <input type="hidden" name="nilaifilter" id="nilaifilter" value="1">

                        <input name="valnilai" type="hidden">
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <?php $instalasi  = $this->db->query("SELECT * FROM Instalasi  WHERE StatusEnabled = '1' AND (KdInstalasi IN ('01', '02', '03', '04', '06', '08', '09', '10', '11', '16','22')) ORDER BY KdInstalasi ASC")->result(); ?>
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Instalasi</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="instalasi" id="instalasi" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Instalasi Harus Dipilih.')" oninput="this.setCustomValidity('')">
                                        <option value="">- Pilih Instalasi -</option>
                                        <?php foreach ($instalasi as $key) { ?>
                                            <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>

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

                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">Format</label>
                                </div>
                                <div class="col col-md-9 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Speadsheet
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Grafik
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-success" value="1" name="submit1"><i class="fa fa-print"></i> Print</button>
                            <button type="submit" class="btn btn-sm btn-success" value="2" name="submit2" id="submit2"><i class="fas fa-file-export"></i> Simpan Ke Excel</button>
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
                    <form id="formbulan" action="<?php echo base_url(); ?>KunjunganStatusPenyakitPasien/filter" method="POST" target="_blank">
                        <div class="card-body card-block">
                            <input type="hidden" name="nilaifilter" id="nilaifilter" value="2">

                            <input name="valnilai" type="hidden">
                            <div class="row form-group">
                                <?php $instalasi  = $this->db->query("SELECT * FROM Instalasi  WHERE StatusEnabled = '1' AND (KdInstalasi IN ('01', '02', '03', '04', '06', '08', '09', '10', '11', '16','22')) ORDER BY KdInstalasi ASC")->result(); ?>
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Instalasi</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="instalasi1" id="instalasi1" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Instalasi Harus Dipilih.')" oninput="this.setCustomValidity('')">>
                                        <option value="">- Pilih Instalasi -</option>
                                        <?php foreach ($instalasi as $key) { ?>
                                            <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Tahun</label></div>
                                <div class="col-12 col-md-10">
                                    <select name="tahun1" id="tahun1" class="form-control form-control-user" title="Pilih Tahun" required oninvalid="this.setCustomValidity('Tahun Harus Dipilih.')" oninput="this.setCustomValidity('')">>
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
                                    <label for="select" class=" form-control-label">Dari Bulan</label>
                                </div>
                                <div class="col col-md-4">
                                    <select name="bulanawal" id="bulanawal" class="form-control form-control-user" title="Pilih Bulan" required oninvalid="this.setCustomValidity('Bulan Awal Harus Dipilih.')" oninput="this.setCustomValidity('')">>
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
                                    <label for="select" class=" form-control-label">Sampai Bulan</label>
                                </div>
                                <div class="col col-md-4">
                                    <select name="bulanakhir" id="bulanakhir" class="form-control form-control-user" title="Pilih Bulan" required oninvalid="this.setCustomValidity('Bulan Akhir Harus Dipilih.')" oninput="this.setCustomValidity('')">>
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
                                    <label for="select" class=" form-control-label">Format</label>
                                </div>
                                <div class="col col-md-9 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Speadsheet
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Grafik
                                        </label>
                                    </div>
                                </div>
                                <small class="help-block form-text"></small>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-success" value="1" name="submit1"><i class="fa fa-print"></i> Print</button>
                            <button type="submit" class="btn btn-sm btn-success" value="2" name="submit3" id="submit3"><i class="fas fa-file-export"></i> Simpan Ke Excel</button>
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
                    <form id="formtahun" action="<?php echo base_url(); ?>KunjunganStatusPenyakitPasien/filter" method="POST" target="_blank">
                        <input name="valnilai" type="hidden">
                        <div class="card-body card-block">

                            <input type="hidden" name="nilaifilter" id="nilaifilter" value="3">
                            <div class="row form-group">
                                <?php $instalasi  = $this->db->query("SELECT * FROM Instalasi  WHERE StatusEnabled = '1' AND (KdInstalasi IN ('01', '02', '03', '04', '06', '08', '09', '10', '11', '16','22')) ORDER BY KdInstalasi ASC")->result(); ?>
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Instalasi</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="instalasi2" id="instalasi2" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Instalasi Harus Dipilih.')" oninput="this.setCustomValidity('')">>
                                        <option value="">- Pilih Instalasi -</option>
                                        <?php foreach ($instalasi as $key) { ?>
                                            <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Tahun Awal </label></div>
                                <div class="col col-md-4">
                                    <select name="tahun2" id="tahun2" class="form-control form-control-user" title="Pilih Tahun" required oninvalid="this.setCustomValidity('Tahun Awal Harus Dipilih.')" oninput="this.setCustomValidity('')">>
                                        <option value="">-PILIH-</option>
                                        <?php foreach ($tahun as $thn) : ?>
                                            <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>

                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Tahun Akhir</label></div>
                                <div class="col col-md-4">
                                    <select name="tahun3" id="tahun3" class="form-control form-control-user" title="Pilih Tahun" required oninvalid="this.setCustomValidity('Tahun Akhir Harus Dipilih.')" oninput="this.setCustomValidity('')">>
                                        <option value="">-PILIH-</option>
                                        <?php foreach ($tahun as $thn) : ?>
                                            <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>

                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">Format</label>
                                </div>
                                <div class="col col-md-9 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Speadsheet
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="2" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Grafik
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-success" value="1" name="submit1"><i class="fa fa-print"></i> Print</button>
                            <button type="submit" class="btn btn-sm btn-success" value="2" name="submit4" id="submit4"><i class="fas fa-file-export"></i> Simpan Ke Excel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <script type="text/javascript">
        /*digunakan untuk menyembunyikan form tanggal, bulan dan tahun saat halaman di load */
        $(document).ready(function() {

            $("#tanggalfilter").hide();
            $("#tahunfilter").hide();
            $("#bulanfilter").hide();
            $("#cardbayar").hide();
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

            $("#instalasi").val('');
            $("#periode").val('');
            $("#tanggalawal").val('<?= date('Y-m-d') ?>');
            $("#tanggalakhir").val('<?= date('Y-m-d') ?>');
            $("#tahun1").val('');
            $("#bulanawal").val('');
            $("#bulanakhir").val('');
            $("#tahun2").val('');
            $("#targetbayar").empty();
            $("#submit2").show();
            $("#submit3").show();
            $("#submit4").show();
            $("input[name=flexRadioDefault][value='1']").prop('checked', true);
        }

        $('input[name="flexRadioDefault"]').on("click", function(e) {
            var id = $(this).val();

            if (id == '1') {
                $("#submit2").show();
                $("#submit3").show();
                $("#submit4").show();
            } else {
                $("#submit2").hide();
                $("#submit3").hide();
                $("#submit4").hide();
            }
        })
    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->