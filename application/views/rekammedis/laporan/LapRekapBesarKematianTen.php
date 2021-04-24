<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rekapitulasi 10 Besar</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap-v5.min.css">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>

</head>

<body>
    <table style="width: 100%;" class="mb-5">
        <?php $masterrs       = $this->db->query("SELECT * FROM ProfilRS WHERE StatusEnabled ='1'")->row(); ?>
        <tr>
            <td align="Left">
                <span style="line-height: normal; font-size: 12px;">
                    <div>
                        <?= $masterrs->NamaRS ?>
                    </div>
                    <div>
                        <?= $masterrs->Alamat ?>, <?= $masterrs->KotaKodyaKab ?> - <?= $masterrs->KodePos ?> Telp. <?= $masterrs->Telepon ?> Fax. <?= $masterrs->Faks ?>
                    </div>
                    <div>
                        <?= $masterrs->Website ?> , <?= $masterrs->Email ?>
                    </div>
                </span>
            </td>
        </tr>
    </table>
    <br>

    <h3>
        <center><b>DAFTAR <?= $datafilter['JumlahData']; ?> BESAR KEMATIAN PASIEN <?= $datafilter['Kriteria']; ?>
            </b></center>
    </h3>
    <?php $instalasi       = $this->db->query("SELECT * FROM Instalasi WHERE KdInstalasi ='" . $datafilter['Instalasi'] . "'")->row(); ?>
    <?php $ruangan       = $this->db->query("SELECT * FROM Ruangan WHERE KdRuangan ='" . $datafilter['Ruangan'] . "'")->row(); ?>
    <?php $jenispasien       = $this->db->query("SELECT * FROM KelompokPasien WHERE KdKelompokPasien ='" . $datafilter['JenisPasien'] . "'")->row(); ?>

    <div class="mb-3">
        <p align="center">
            <?php if ($datafilter['Instalasi'] != '%') {
                echo  $instalasi->NamaInstalasi;
            } else {
                echo  'Semua Instalasi';
            }; ?> <br>
            <?php if ($datafilter['Ruangan'] != '%') {
                echo  $ruangan->NamaRuangan;
            } else {
                echo  'Semua Ruangan';
            }; ?> <br>
            <?php if ($datafilter['JenisPasien'] != '%') {
                echo  $jenispasien->JenisPasien;
            } else {
                echo  'Semua Jenis Pasien';
            }; ?> <br>
            Periode : <?= date('d-m-Y', strtotime($datafilter['TglAwal'])) ?> s.d <?= date('d-m-Y', strtotime($datafilter['TglAkhir'])) ?> <br>

        </p>
    </div>

    <?php if ($datafilter['kliktombol'] == '1') { ?>
        <table class="table table-bordered mt-5 border border-dark">
            <thead>
                <tr style="text-align: center;" class="align-middle">
                    <th>No. Urut</th>
                    <th>Kd. Diagnosa</th>
                    <th>Diagnosa</th>
                    <th>Jumlah</th>
                    <th>Persentase</th>
                </tr>
            </thead>

            <?php
            $jumlahdata = 0;
            foreach ($datahasil as $row) : ?>
                <?php $jumlahdata += $row->JumlahPasien ?>
            <?php endforeach ?>

            <?php
            $no = 1;
            foreach ($datahasil as $row) : ?>
                <tr>
                    <td style="text-align: center;" class="align-middle"><?php echo $no++;                 ?></td>
                    <td style="text-align: center;" class="align-middle"><?php echo $row->KdDiagnosa;            ?></td>
                    <td><?php echo $row->Diagnosa;    ?></td>
                    <td style="text-align: center;" class="align-middle"><?php echo $row->JumlahPasien;    ?></td>
                    <td style="text-align: center;" class="align-middle"><?php echo round(($row->JumlahPasien / $jumlahdata) * 100, 2); ?> % </td>
                </tr>
            <?php endforeach ?>

            <tr style="font-weight: bold; text-align: center;">
                <td colspan="3">Jumlah</td>
                <td><?php echo $jumlahdata; ?> </td>
                <td>100 %</td>
            </tr>

        </table>
    <?php } else { ?>
        <div id="chartContainer" style="float: left; height: 500px; width: 100%;">
        </div>

        <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxcore.js"></script>
        <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxdraw.js"></script>
        <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxchart.core.js"></script>
        <script src="<?php echo base_url(); ?>/assets/jqwidgets/jqxdata.js"></script>
    <?php } ?>
</body>

<script>
    <?php if ($datafilter['kliktombol'] == '2') { ?>
        var awal = "<?= $datafilter['TglAwal'] ?>";
        var akhir = "<?= $datafilter['TglAkhir'] ?>";
        var jenispasien = "<?= $datafilter['JenisPasien'] ?>";
        var ruangan = "<?= $datafilter['Ruangan'] ?>";
        var jumlahdata = "<?= $datafilter['JumlahData'] ?>";
        var instalasi = "<?= $datafilter['Instalasi'] ?>";
        var kriteria = "<?= $datafilter['Kriteria'] ?>";

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
    <?php } ?>

    setTimeout(window.print, 500);
    window.onafterprint = function() {
        window.close();
    }
</script>

</html>