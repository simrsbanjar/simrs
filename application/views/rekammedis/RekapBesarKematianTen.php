<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container mt-3">
        <!-- Page Heading -->

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $laporan; ?></li>
        </ol>

        <hr>
        <br>

        <form style="font-size:15px" action="<?php echo base_url('RekapBesarKematianTen/Cetak') ?>" id="formData" name="formData" method="POST" target="_blank">
            <div class="form-inline">
                <div class="form-group">
                    <label for="awal">Periode</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2 mr-2" id="awal" name="awal" style="width:200px;">
                </div>
                <div class="form-group">
                    <label for="akhir">s/d</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2" id="akhir" name="akhir" style="width:200px;">
                </div>

                <?php $jenispasien  = $this->db->query("SELECT * FROM KelompokPasien  WHERE StatusEnabled = '1' ORDER BY JenisPasien ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group">
                        <label for=" jenispasien" style="margin-left:5px;">Jenis Pasien</label>
                        <select id="jenispasien" name="jenispasien" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="%">- Semua Jenis Pasien -</option>
                            <?php foreach ($jenispasien as $key) { ?>
                                <option value="<?php echo $key->KdKelompokPasien ?>"><?php echo $key->JenisPasien ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-inline" style="margin-left:10px;">
                    <label for="format">Jumlah Data</label>
                    <input type="number" class="form-control" style="margin-left:10px; width: 20mm; text-align: center;" id="jumlahdata" name="jumlahdata" value="10">
                </div>
            </div>

            <?php $ruangan  = $this->db->query("SELECT * FROM Instalasi WHERE StatusEnabled = '1' AND KdInstalasi IN ('01', '02', '03', '06', '08') ORDER BY KdInstalasi ASC")->result(); ?>
            <div class="form-inline">
                <div class="form-group mt-4">
                    <label for=" instalasi">Instalasi</label>
                    <select id="instalasi" name="instalasi" class='form-control' style="width:200px; margin-left:2px;">
                        <option value="%">- Semua Instalasi -</option>
                        <?php foreach ($ruangan as $key) { ?>
                            <option value="<?php echo $key->KdInstalasi ?>"><?php echo $key->NamaInstalasi ?> </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-inline" style="margin-left:5px;">
                    <div class="form-group mt-4">
                        <label for="ruangan">Ruangan</label>
                        <select id="ruangan" name="ruangan" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="%">- Semua Ruangan -</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <div class="form-inline" style="margin-left:10px;">
                        <label for="format" style="margin-right:10px;">Kriteria / Urutan</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radiokriteria" id="diagnosa" value="1" checked />
                            <label class="form-check-label" for="inlineRadio1">Diagnosa</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radiokriteria" id="jumlahpasien" value="2" />
                            <label class="form-check-label" for="inlineRadio2">Jumlah Pasien</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-inline">
                <div class="form-group d-flex bd-highlight">
                    <div class="p-3 order-10 bd-highlight">
                        <input type="hidden" name="kliktombol" value="1" />
                        <buttons type="button" class="btn btn-success mr-2" id="lihat" onclick="AmbilData()"><i class="fas fa-book-medical"></i> Lihat Laporan</buttons>
                        <buttons type="button" class="btn btn-success mr-2" id="grafik" onclick="Grafik()"><i class="fas fa-chart-pie"></i> Grafik</buttons>
                        <button type="submit" value="1" name='tombolcetak' class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive" style="width:100%">
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <div class="card-body">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No. Urut</th>
                            <th>Diagnosa</th>
                            <th>Jumlah Pasien</th>
                        </tr>
                    </thead>
            </table>
        </div>

        <div id="chartContainer" style="float: left; height: 500px; width: 100%;">
        </div>
    </div>
    <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxcore.js"></script>
    <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxdraw.js"></script>
    <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxchart.core.js"></script>
    <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxdata.js"></script>

    <script>
        var saveData;
        var modal = $('#modalData');
        var tableData = $('#myTable');
        var formData = $('#formData');
        var modalTitle = $('#modalTitle');
        var btnsave = $('#btnSave');
        var chart = $('#chartContainer');

        chart.hide();
        tableData.show();
        $(document).ready(function() {
            $('#instalasi').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?= base_url('RekapBesarKematianTen/GetRuanganInst') ?>",
                    method: "POST",
                    data: {
                        "instalasi": id
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        html += "<option value = '%'>- Semua Ruangan -</option>";
                        for (i = 0; i < data.length; i++) {
                            html += "<option value = '" + data[i].KdRuangan + "'>" + data[i].NamaRuangan + "</option>";
                        }
                        $('#ruangan').html(html);

                    }
                });
            });
        });

        function AmbilData() {
            var awal = $('#awal').val();
            var akhir = $('#akhir').val();
            var jenispasien = $('#jenispasien').val();
            var ruangan = $('#ruangan').val();
            var jumlahdata = $('#jumlahdata').val();
            var instalasi = $('#instalasi').val();
            var kriteria = $("input:radio[name=radiokriteria]:checked").val()
            document.formData.kliktombol.value = '1';
            chart.hide();
            tableData.show();
            tableData.DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "bFilter": false,
                "bLengthChange": false,
                "paging": false,
                "info": false,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('RekapBesarKematianTen/AmbilData') ?>",
                    "type": "POST",
                    "data": {
                        "awal": awal,
                        "akhir": akhir,
                        "jenispasien": jenispasien,
                        "ruangan": ruangan,
                        "jumlahdata": jumlahdata,
                        "kriteria": kriteria,
                        "instalasi": instalasi,
                    },
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });

        }

        function Grafik() {
            var awal = $('#awal').val();
            var akhir = $('#akhir').val();
            var jenispasien = $('#jenispasien').val();
            var ruangan = $('#ruangan').val();
            var jumlahdata = $('#jumlahdata').val();
            var instalasi = $('#instalasi').val();
            var kriteria = $("input:radio[name=radiokriteria]:checked").val()
            document.formData.kliktombol.value = '2';
            chart.show();
            tableData.hide();
            // memanggil data array dengan JSON
            var source = {
                datatype: "json",
                datafields: [{
                        name: 'hasil'
                    },
                    {
                        name: 'total'
                    }
                ],
                url: "<?= base_url('RekapBesarKematianTen/Grafik') ?>",
                type: "POST",
                data: {
                    "awal": awal,
                    "akhir": akhir,
                    "jenispasien": jenispasien,
                    "ruangan": ruangan,
                    "jumlahdata": jumlahdata,
                    "kriteria": kriteria,
                    "instalasi": instalasi
                },
            };

            var dataAdapter = new $.jqx.dataAdapter(source, {
                async: false,
                autoBind: true
            });
            // pengaturan jqxChart
            var settings = {
                title: "Rekapitulasi 10 Besar Penyakit",
                description: "",
                enableAnimations: true,
                showLegend: true,
                showBorderLine: true,
                legendLayout: {
                    left: 10,
                    top: 100,
                    width: 400,
                    height: 500,
                    flow: 'vertical'
                },
                padding: {
                    left: 5,
                    top: 5,
                    right: 5,
                    bottom: 5
                },
                titlePadding: {
                    left: 0,
                    top: 0,
                    right: 0,
                    bottom: 10
                },
                source: dataAdapter,
                colorScheme: 'scheme03',
                seriesGroups: [{
                    type: 'pie',
                    showLabels: true,
                    series: [{
                        dataField: 'total',
                        displayText: 'hasil',
                        labelRadius: 120,
                        initialAngle: 15,
                        radius: 100,
                        centerOffset: 0,
                        formatFunction: function(value) {
                            if (isNaN(value))
                                return value;
                            return parseFloat(value);
                        },
                    }]
                }]
            };
            // Menampilkan Chart
            $('#chartContainer').jqxChart(settings);
        }
    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->