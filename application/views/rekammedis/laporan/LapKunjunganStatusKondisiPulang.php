<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Kunjungan Pasien Berdasarkan Status dan Kondisi Pasien</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
    <!-- Chart Plugin -->
    <script src="<?php echo base_url(); ?>assets/css/Chart.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/Chart.js"></script>
    <link href="<?= base_url('assets/'); ?>css/Chart.css">
    <link href="<?= base_url('assets/'); ?>css/Chart.min.css">
    <script src="<?php echo base_url() ?>assets/chartjs/Chart.js"></script>
    <link href="<?= base_url('assets/'); ?>css/bg.css" rel="stylesheet">

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
    <h2>
        <center><b>Laporan Kunjungan Pasien Berdasarkan Status dan Kondisi Pasien</b></center>
    </h2>
    <div class="mb-3">
        <p align="center">
            <?php $instalasi       = $this->db->query("SELECT * FROM Instalasi WHERE KdInstalasi ='" . $instalasi . "'")->row(); ?>
            Periode : <?= $subtitle ?> <br>
            Instalasi : <?= $instalasi->NamaInstalasi  ?>
        </p>
    </div>
    <?php if ($datafilter['format'] == '1') { ?>
        <?php
        $no = 0;
        foreach ($kondisipasien as $row) : ?>
            <?php $no++ ?>
        <?php endforeach ?>
        <?php
        $no1 = 0;
        foreach ($statuspasien as $row) : ?>
            <?php $no1++ ?>
        <?php endforeach ?>

        <table class="table table-bordered mt-5">
            <tr style="text-align: center;">
                <th rowspan="3">Periode</th>
                <th rowspan="3">Ruangan</th>
                <th colspan="<?= ($no * 3) + 1; ?>">Kondisi Pasien</th>
                <th colspan="<?= ($no * 3) + 1; ?>">Status Pasien</th>
            </tr>
            <tr style="text-align: center;">
                <?php foreach ($kondisipasien as $row) : ?>
                    <th colspan="3"><?= $row->Detail; ?></th>
                <?php endforeach ?>
                <th rowspan="2">Total</th>
                <?php foreach ($statuspasien as $row1) : ?>
                    <th colspan="3"><?= $row1->Detail; ?></th>
                <?php endforeach ?>
                <th rowspan="2">Total</th>
            </tr>
            <tr style="text-align: center;">
                <?php foreach ($kondisipasien as $row) : ?>
                    <th>L</th>
                    <th>P</th>
                    <th>Total</th>
                <?php endforeach ?>
                <?php foreach ($statuspasien as $row1) : ?>
                    <th>L</th>
                    <th>P</th>
                    <th>Total</th>
                <?php endforeach ?>
            </tr>

            <?php foreach ($periode as $rowperiode) : ?>

                <?php if ($datafilter['nilaifilter'] == '1') {
                    $ruangan = $this->M_KunjunganStatusKondisiPulang->GetRuanganTgl($datafilter['tanggalawal'], $datafilter['tanggalakhir'], $instalasi->KdInstalasi, $rowperiode->TglKeluar);
                } else if ($datafilter['nilaifilter'] == '2') {
                    $ruangan = $this->M_KunjunganStatusKondisiPulang->GetRuanganBulan($datafilter['tahun'], $datafilter['bulanawal'], $datafilter['bulanakhir'], $instalasi->KdInstalasi, $rowperiode->TglKeluar);
                } else {
                    $ruangan = $this->M_KunjunganStatusKondisiPulang->GetRuanganTahun($datafilter['tahun'], $instalasi->KdInstalasi, $rowperiode->TglKeluar, $datafilter['tahunakhir']);
                }; ?>

                <?php
                $noruangan = 0;
                foreach ($ruangan as $rowruangan) : ?>
                    <?php $noruangan++ ?>
                <?php endforeach ?>

                <?php if ($datafilter['nilaifilter'] == '2') { ?>
                    <td style="text-align: center;" rowspan='<?= $noruangan + 1 ?>'><?php echo $rowperiode->Bulan;            ?></td>
                <?php } else { ?>
                    <td style="text-align: center;" rowspan='<?= $noruangan + 1 ?>'><?php echo $rowperiode->TglKeluar;            ?></td>
                <?php } ?>

                <?php
                $sumtotal = 0;
                foreach ($ruangan as $row) : ?>
                    <tr>
                        <?php $sumtotal = 0; ?>
                        <td style="text-align: center;"><?php echo $row->RuanganPelayanan;            ?></td>
                        <?php foreach ($kondisipasien as $row1) : ?>
                            <?php if ($datafilter['nilaifilter'] == '1') {
                                $data = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row1->Detail . "' and convert(DATE,TglKeluar) = '" . $rowperiode->TglKeluar . "'")->row();
                            } else if ($datafilter['nilaifilter'] == '2') {
                                $data = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '" . $datafilter['tahun'] . "' and MONTH(TglKeluar) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row1->Detail . "' and MONTH(TglKeluar) = '" . $rowperiode->TglKeluar . "'")->row();
                            } else {
                                $data = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row1->Detail . "' and YEAR(TglKeluar) ='" . $rowperiode->TglKeluar . "'")->row();
                            }; ?>
                            <td style="text-align: center;"><?= $data->L; ?></td>
                            <td style="text-align: center;"><?= $data->P; ?></td>
                            <td style="text-align: center;"><?= $data->TOTAL; ?></td>

                            <?php $sumtotal = $sumtotal + $data->TOTAL  ?>
                        <?php endforeach ?>
                        <td style="text-align: center;"><?= $sumtotal; ?></td>
                        <?php $sumpastotal = 0; ?>
                        <?php foreach ($statuspasien as $row2) : ?>
                            <?php if ($datafilter['nilaifilter'] == '1') {
                                $data1 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row2->Detail . "' and convert(DATE,TglKeluar) = '" . $rowperiode->TglKeluar . "'")->row();
                            } else if ($datafilter['nilaifilter'] == '2') {
                                $data1 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '" . $datafilter['tahun'] . "' and MONTH(TglKeluar) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row2->Detail . "' and MONTH(TglKeluar) = '" . $rowperiode->TglKeluar . "'")->row();
                            } else {
                                $data1 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where  YEAR(TglKeluar) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row2->Detail . "' and YEAR(TglKeluar) ='" . $rowperiode->TglKeluar . "'")->row();
                            }; ?>
                            <td style="text-align: center;"><?= $data1->L; ?></td>
                            <td style="text-align: center;"><?= $data1->P; ?></td>
                            <td style="text-align: center;"><?= $data1->TOTAL; ?></td>

                            <?php $sumpastotal = $sumpastotal + $data1->TOTAL  ?>
                        <?php endforeach ?>
                        <td style="text-align: center;"><?= $sumpastotal; ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endforeach ?>

            <th style="text-align: center;" colspan="2">Total</th>
            <?php $sumtotalall = 0; ?>
            <?php foreach ($kondisipasien as $row3) : ?>
                <?php if ($datafilter['nilaifilter'] == '1') {
                    $data2 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row3->Detail . "'")->row();
                } else if ($datafilter['nilaifilter'] == '2') {
                    $data2 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '" . $datafilter['tahun'] . "' and MONTH(TglKeluar) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row3->Detail . "'")->row();
                } else {
                    $data2 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row3->Detail . "'")->row();
                }; ?>
                <th style="text-align: center;"><?= $data2->L; ?></th>
                <th style="text-align: center;"><?= $data2->P; ?></th>
                <th style="text-align: center;"><?= $data2->TOTAL; ?></th>
                <?php $sumtotalall = $sumtotalall + $data2->TOTAL ?>
            <?php endforeach ?>

            <th style="text-align: center;"><?= $sumtotalall; ?></th>
            <?php $sumtotalallpas = 0; ?>
            <?php foreach ($statuspasien as $row4) : ?>
                <?php if ($datafilter['nilaifilter'] == '1') {
                    $data3 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row4->Detail . "'")->row();
                } else if ($datafilter['nilaifilter'] == '2') {
                    $data3 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '" . $datafilter['tahun'] . "' and MONTH(TglKeluar) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row4->Detail . "'")->row();
                } else {
                    $data3 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row4->Detail . "'")->row();
                }; ?>
                <th style="text-align: center;"><?= $data3->L; ?></th>
                <th style="text-align: center;"><?= $data3->P; ?></th>
                <th style="text-align: center;"><?= $data3->TOTAL; ?></th>
                <?php $sumtotalallpas = $sumtotalallpas + $data3->TOTAL ?>
            <?php endforeach ?>
            <th style="text-align: center;"><?= $sumtotalallpas; ?></th>
        </table>
    <?php } else { ?>
        <div style="width:auto;">
            <canvas id="myChart"></canvas>
        </div>

        <script src=" https://code.jquery.com/jquery-3.5.1.js"> </script>

    <?php } ?>

</body>

<script>
    <?php if ($datafilter['format'] = '2') { ?>
        var periode = "<?= $datafilter['nilaifilter'] ?>";
        var instalasi = "<?= $datafilter['instalasi'] ?>";

        var tanggalawal = "<?= $datafilter['tanggalawal'] ?>";
        var tanggalakhir = "<?= $datafilter['tanggalakhir'] ?>";
        var tahun1 = "<?= $datafilter['tahun1'] ?>";
        var bulanawal = "<?= $datafilter['bulanawal'] ?>";
        var bulanakhir = "<?= $datafilter['bulanakhir'] ?>";
        var tahun2 = "<?= $datafilter['tahun2'] ?>";
        var tahun3 = "<?= $datafilter['tahun3'] ?>";
        var dataparm = {
            "tanggalawal": tanggalawal,
            "tanggalakhir": tanggalakhir,
            "periode": periode,
            "instalasi": instalasi,
            "tahun1": tahun1,
            "bulanawal": bulanawal,
            "bulanakhir": bulanakhir,
            "tahun2": tahun2,
            "tahun3": tahun3
        };
        $.ajax({
            url: "<?= base_url('KunjunganStatusKondisiPulang/Grafik') ?>",
            type: "POST",
            dataType: "json",
            data: dataparm,
            success: function(msg) {
                var densityCanvas = document.getElementById("myChart");

                var totaldata = [];
                var tanggaldata = [];
                var yaxisdata = [];
                var dataawal = [];

                // console.log(datahasil);
                for (var i in msg.hasil) {

                    var dataawal = msg.total.filter((KELOMPOK) => KELOMPOK.KDKELOMPOK == msg.hasil[i].KDKELOMPOK);
                    var datahasil = [];

                    for (var iii in msg.tanggal) {
                        var dataawal = msg.total.filter((KELOMPOK) => KELOMPOK.KDKELOMPOK == msg.hasil[i].KDKELOMPOK && KELOMPOK.TANGGAL == msg.tanggal[iii].IDTANGGAL);
                        if (dataawal.length > 0) {
                            for (var ii in dataawal) {
                                datahasil.push(dataawal[ii].JUMLAH)
                            }
                        } else {
                            datahasil.push(0)
                        }
                    }

                    const randomBetween = (min, max) => min + Math.floor(Math.random() * (max - min + 1));
                    const r = randomBetween(0, 255);
                    const g = randomBetween(0, 255);
                    const b = randomBetween(0, 255);
                    const a = randomBetween(0, 255);

                    totaldata.push({
                        label: msg.hasil[i].KELOMPOK,
                        data: datahasil,
                        backgroundColor: `rgba(${r}, ${g}, ${b}, ${a})`,
                        borderWidth: 0
                    })
                }

                for (var i in msg.tanggal) {
                    tanggaldata.push(msg.tanggal[i].TANGGAL)
                }

                var setup = {
                    events: false,
                    legend: {
                        display: true
                    },
                    tooltips: {
                        enabled: false
                    },
                    animation: {
                        onComplete: function() {
                            var ctx = this.chart.ctx;
                            ctx.textAlign = "center";
                            ctx.textBaseline = "middle";
                            var chart = this;
                            var datasets = this.config.data.datasets;

                            datasets.forEach(function(dataset, i) {
                                ctx.font = "12px Lobster Two";
                                ctx.fillStyle = "#4F4C4D";

                                chart.getDatasetMeta(i).data.forEach(function(p, j) {
                                    ctx.fillText(datasets[i].data[j], p._model.x, p._model.y - 10);
                                });
                            });
                        }
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: 0.6,
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Periode',
                                fontStyle: 'bold'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Jumlah',
                                fontStyle: 'bold'
                            }
                        }]
                    }
                };
                var hasilData = {
                    labels: tanggaldata,
                    datasets: totaldata,
                };
                var barChart = new Chart(densityCanvas, {
                    type: 'bar',
                    data: hasilData,
                    plugins: [{
                        beforeInit: function(chart, options) {
                            chart.legend.afterFit = function() {
                                // Tinggi / Pendeknya Spasi Antara Grafik dan Legend
                                this.height = this.height + 20;
                            };
                        }
                    }],
                    options: setup
                });
            }
        });
    <?php } ?>

    // setTimeout(window.print, 5000);
</script>

</html>