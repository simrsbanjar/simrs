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
                                    <select name="periode" id="periode" class="form-control form-control-user" title="Pilih Periode">
                                        <option value="">-PILIH-</option>
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

                            <button onclick="prosesReset()" type="button" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>

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
                    <form id="formbulan" action="<?php echo base_url(); ?>SurveilensMorbiditasPasien/filter" method="POST" target="_blank">
                        <div class="card-body card-block">
                            <input type="hidden" name="nilaifilter" id="nilaifilter" value="2">

                            <input name="valnilai" type="hidden">
                            <div class="row form-group">
                                <?php $instalasi  = $this->db->query("SELECT * FROM Instalasi  WHERE StatusEnabled = '1' AND (KdInstalasi IN ('01', '02', '03', '04', '06', '08', '09', '10', '11', '16','22')) ORDER BY KdInstalasi ASC")->result(); ?>
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Instalasi</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="instalasi1" id="instalasi1" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Instalasi Harus Dipilih.')" oninput="this.setCustomValidity('')" oninput="this.setCustomValidity('')">
                                        <option value="">- Pilih Instalasi -</option>
                                        <?php foreach ($instalasi as $key) { ?>
                                            <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Ruangan</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="ruangan" id="ruangan" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Ruangan Harus Dipilih.')" oninput="this.setCustomValidity('')">
                                        <option value="">- Pilih Ruangan -</option>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Tahun</label></div>
                                <div class="col-12 col-md-4">
                                    <select name="tahun1" id="tahun1" class="form-control form-control-user" title="Pilih Tahun" required oninvalid="this.setCustomValidity('Tahun Harus Dipilih.')" oninput="this.setCustomValidity('')">
                                        <option value="">-PILIH-</option>
                                        <?php foreach ($tahun as $thn) : ?>
                                            <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Bulan</label></div>
                                <div class="col col-md-4">
                                    <select name="bulanawal" id="bulanawal" class="form-control form-control-user" title="Pilih Bulan" required oninvalid="this.setCustomValidity('Bulan Harus Dipilih.')" oninput="this.setCustomValidity('')">
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
                            </div>
                        </div>
                        <div class="card-footer">
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
                    <form id="formtahun" action="<?php echo base_url(); ?>SurveilensMorbiditasPasien/filter" method="POST" target="_blank">
                        <input name="valnilai" type="hidden">
                        <div class="card-body card-block">

                            <input type="hidden" name="nilaifilter" id="nilaifilter" value="3">
                            <div class="row form-group">
                                <?php $instalasi  = $this->db->query("SELECT * FROM Instalasi  WHERE StatusEnabled = '1' AND (KdInstalasi IN ('01', '02', '03', '04', '06', '08', '09', '10', '11', '16','22')) ORDER BY KdInstalasi ASC")->result(); ?>
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Instalasi</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="instalasi2" id="instalasi2" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Instalasi Harus Dipilih.')" oninput="this.setCustomValidity('')">
                                        <option value="">- Pilih Instalasi -</option>
                                        <?php foreach ($instalasi as $key) { ?>
                                            <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Ruangan</label></div>
                                <div class="col-12 col-md-9 ">
                                    <select name="ruangan1" id="ruangan1" class="form-control form-control-user" required oninvalid="this.setCustomValidity('Ruangan Harus Dipilih.')" oninput="this.setCustomValidity('')">
                                        <option value="">- Pilih Ruangan -</option>
                                    </select>
                                    <small class="help-block form-text"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div id="form-tanggal" class="col col-md-2"><label for="select" class=" form-control-label">Tahun </label></div>
                                <div class="col col-md-4">
                                    <select name="tahun2" id="tahun2" class="form-control form-control-user" title="Pilih Tahun" required oninvalid="this.setCustomValidity('Tahun Awal Harus Dipilih.')" oninput="this.setCustomValidity('')">
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

            $("#tahunfilter").hide();
            $("#bulanfilter").hide();

        });

        /*digunakan untuk menampilkan form tanggal, bulan dan tahun*/

        function prosesPeriode() {
            var periode = $("[name='periode']").val();

            if (periode == "bulan") {
                $("#btnproses").hide();
                $("[name='valnilai']").val('bulan');
                $("#bulanfilter").show();

            } else {
                $("#btnproses").hide();
                $("[name='valnilai']").val('tahun');
                $("#tahunfilter").show();
            }
        }

        /*digunakan untuk menytembunyikan form tanggal, bulan dan tahun*/

        function prosesReset() {
            $("#btnproses").show();

            $("#tahunfilter").hide();
            $("#bulanfilter").hide();
            $("#cardbayar").hide();

            $("#instalasi1").val('');
            $("#instalasi2").val('');
            $("#periode").val('');
            $("#tahun1").val('');
            $("#bulanawal").val('');
            $("#tahun2").val('');
            $("#ruangan").val('');
            $("#ruangan1").val('');
        }

        $('#instalasi1').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('SurveilensMorbiditasPasien/GetRuanganInst') ?>",
                method: "POST",
                data: {
                    "instalasi": id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    html += "<option value = ''>- Pilih Ruangan -</option>";
                    for (i = 0; i < data.length; i++) {
                        html += "<option value = '" + data[i].KdRuangan + "'>" + data[i].NamaRuangan + "</option>";
                    }
                    $('#ruangan').html(html);

                }
            });
        });

        $('#instalasi2').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('SurveilensMorbiditasPasien/GetRuanganInst') ?>",
                method: "POST",
                data: {
                    "instalasi": id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    html += "<option value = ''>- Pilih Ruangan -</option>";
                    for (i = 0; i < data.length; i++) {
                        html += "<option value = '" + data[i].KdRuangan + "'>" + data[i].NamaRuangan + "</option>";
                    }
                    $('#ruangan1').html(html);

                }
            });
        });
    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->