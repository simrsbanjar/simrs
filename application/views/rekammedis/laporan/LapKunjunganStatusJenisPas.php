<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Kunjungan Pasien Berdasarkan Status dan Jenis Pasien</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap-v5.min.css">

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
        <center><b>Laporan Kunjungan Pasien Berdasarkan Status dan Jenis Pasien</b></center>
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
        $ruangan_old = '';
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '1') { ?>
                <?php if ($ruangan_old != $row->RuanganPelayanan) { ?>
                    <?php $ruangan[] = [
                        'KdRuanganPelayanan' => $row->KdRuanganPelayanan,
                        'RuanganPelayanan' => $row->RuanganPelayanan
                    ]; ?>
                <?php } ?>
                <?php $ruangan_old = $row->RuanganPelayanan;  ?>
            <?php } ?>
        <?php endforeach ?>

        <?php
        $jenispasien_old = '';
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '1') { ?>
                <?php if ($jenispasien_old != $row->Detail) { ?>
                    <?php $jenispasien[] = $row->Detail ?>
                <?php } ?>
                <?php $jenispasien_old = $row->Detail;  ?>
            <?php } ?>
        <?php endforeach ?>
        <?php $jenispasien    = array_values(array_unique($jenispasien)); ?>

        <?php
        $row = 1;
        while ($row <= 2) {
            if ($row == 1) {
                $ketstspas  = 'Baru';
            } else {
                $ketstspas  = 'Lama';
            };

            $statuspasien[] = $ketstspas;
            $row++;
        }
        ?>

        <?php
        $no = 0;
        foreach ($jenispasien as $row) : ?>
            <?php $no++ ?>
        <?php endforeach ?>

        <?php
        $no1 = 0;
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '2') { ?>
                <?php if ($ruangan_old != $row->RuanganPelayanan) { ?>
                    <?php $no1++ ?>
                <?php } ?>
            <?php } ?>
        <?php endforeach ?>

        <table class="table table-bordered mt-5 border border-dark">
            <tr style="text-align: center;" class="align-middle">
                <th rowspan="3">Ruangan</th>
                <th colspan="<?= ($no * 3) + 1; ?>">Jenis Pasien</th>
                <th colspan="<?= ($no1 * 3) + 1; ?>">Status Pasien</th>
            </tr>
            <tr style="text-align: center;" class="align-middle">
                <?php foreach ($jenispasien as $row) : ?>
                    <th colspan="3"><?= $row; ?></th>
                <?php endforeach ?>
                <th rowspan="2">Total</th>
                <?php foreach ($statuspasien as $row1) : ?>
                    <th colspan="3"><?= $row1; ?></th>
                <?php endforeach ?>
                <th rowspan="2">Total</th>
            </tr>

            <tr style="text-align: center;" class="align-middle">
                <?php foreach ($jenispasien as $row) : ?>
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
            <?php
            $row = 0;
            while ($row <= count($ruangan) - 1) { ?>
                <tr>
                    <?php $sumtotal = 0; ?>
                    <td style="text-align: center;" class="align-middle"><?= $ruangan[$row]['RuanganPelayanan'];            ?></td>

                    <?php
                    $row1 = 0;
                    while ($row1 <= count($jenispasien) - 1) { ?>
                        <?php
                        $row2 = 0;
                        $count = 0;
                        while ($row2 <= count($jumlah) - 1) {
                            if (
                                $jumlah[$row2]->Detail == $jenispasien[$row1] and
                                $jumlah[$row2]->RuanganPelayanan == $ruangan[$row]['RuanganPelayanan']
                            ) { ?>
                                <td style="text-align: center;" class="align-middle"><?= number_format($jumlah[$row2]->L, 0, ',', '.'); ?></td>
                                <td style="text-align: center;" class="align-middle"><?= number_format($jumlah[$row2]->P, 0, ',', '.'); ?></td>
                                <td style="text-align: center;" class="align-middle"><?= number_format($jumlah[$row2]->TOTAL, 0, ',', '.'); ?></td>

                                <?php $sumtotal = $sumtotal + $jumlah[$row2]->TOTAL  ?>
                                <?php $count++ ?>
                            <?php
                            }

                            $row2++;
                        }
                        if ($count == 0) { ?>
                            <td style="text-align: center;" class="align-middle">0</td>
                            <td style="text-align: center;" class="align-middle">0</td>
                            <td style="text-align: center;" class="align-middle">0</td>
                    <?php }
                        $row1++;
                    }; ?>
                    <td style="text-align: center;" class="align-middle"><?= number_format($sumtotal, 0, ',', '.'); ?></td>
                    <?php $sumpastotal = 0; ?>
                    <?php
                    $row1 = 0;
                    while ($row1 <= count($statuspasien) - 1) { ?>
                        <?php
                        $row2 = 0;
                        $count = 0;
                        while ($row2 <= count($jumlah) - 1) {
                            if (
                                $jumlah[$row2]->Detail == $statuspasien[$row1] and
                                $jumlah[$row2]->RuanganPelayanan == $ruangan[$row]['RuanganPelayanan']
                            ) { ?>
                                <td style="text-align: center;" class="align-middle"><?= number_format($jumlah[$row2]->L, 0, ',', '.'); ?></td>
                                <td style="text-align: center;" class="align-middle"><?= number_format($jumlah[$row2]->P, 0, ',', '.'); ?></td>
                                <td style="text-align: center;" class="align-middle"><?= number_format($jumlah[$row2]->TOTAL, 0, ',', '.'); ?></td>

                                <?php $sumpastotal = $sumpastotal + $jumlah[$row2]->TOTAL  ?>
                                <?php $count++ ?>
                            <?php
                            }

                            $row2++;
                        }
                        if ($count == 0) { ?>
                            <td style="text-align: center;" class="align-middle">0</td>
                            <td style="text-align: center;" class="align-middle">0</td>
                            <td style="text-align: center;" class="align-middle">0</td>
                    <?php }
                        $row1++;
                    }; ?>
                    <td style="text-align: center;" class="align-middle"><?= number_format($sumpastotal, 0, ',', '.'); ?></td>
                </tr>
                <?php $row++; ?>
            <?php }; ?>

            <th style="text-align: center;">Total</th>

            <?php
            $sumtotalall = 0;
            $row1 = 0;
            while ($row1 <= count($jenispasien) - 1) { ?>
                <?php
                $row2 = 0;
                $count = 0;
                $totalL = 0;
                $totalP = 0;
                $sumtotal = 0;
                while ($row2 <= count($jumlah) - 1) {
                    if (
                        $jumlah[$row2]->Detail == $jenispasien[$row1]
                    ) {
                        $sumtotal = $sumtotal + $jumlah[$row2]->TOTAL;
                        $totalL = $totalL + $jumlah[$row2]->L;
                        $totalP = $totalP + $jumlah[$row2]->P;
                        $sumtotalall = $sumtotalall + $jumlah[$row2]->TOTAL;
                        $count++;
                    };
                    $row2++;
                }; ?>

                <th style="text-align: center;"><?= number_format($totalL, 0, ',', '.'); ?></th>
                <th style="text-align: center;"><?= number_format($totalP, 0, ',', '.'); ?></th>
                <th style="text-align: center;"><?= number_format($sumtotal, 0, ',', '.'); ?></th>

                <?php if ($count == 0) { ?>
                    <th style="text-align: center;">0</th>
                    <th style="text-align: center;">0</th>
                    <th style="text-align: center;">0</th>
            <?php }
                $row1++;
            }; ?>
            <th style="text-align: center;"><?= number_format($sumtotalall, 0, ',', '.'); ?></th>

            <?php
            $sumtotalallpas = 0;
            $row1 = 0;
            while ($row1 <= count($statuspasien) - 1) { ?>
                <?php
                $row2 = 0;
                $count = 0;
                $totalL = 0;
                $totalP = 0;
                $sumtotal = 0;
                while ($row2 <= count($jumlah) - 1) {
                    if (
                        $jumlah[$row2]->Detail == $statuspasien[$row1]
                    ) {
                        $sumtotal = $sumtotal + $jumlah[$row2]->TOTAL;
                        $totalL = $totalL + $jumlah[$row2]->L;
                        $totalP = $totalP + $jumlah[$row2]->P;
                        $sumtotalallpas = $sumtotalallpas + $jumlah[$row2]->TOTAL;
                        $count++;
                    };
                    $row2++;
                }; ?>

                <th style="text-align: center;"><?= number_format($totalL, 0, ',', '.'); ?></th>
                <th style="text-align: center;"><?= number_format($totalP, 0, ',', '.'); ?></th>
                <th style="text-align: center;"><?= number_format($sumtotal, 0, ',', '.'); ?></th>

                <?php if ($count == 0) { ?>
                    <th style="text-align: center;">0</th>
                    <th style="text-align: center;">0</th>
                    <th style="text-align: center;">0</th>
            <?php }
                $row1++;
            }; ?>
            <th style="text-align: center;"><?= number_format($sumtotalallpas, 0, ',', '.'); ?></th>
        </table>
    <?php } else { ?>
        <div style="width:auto;">
            <canvas id="myChart"></canvas>
        </div>

        <script src="<?= base_url('assets/js/'); ?>jquery-3.5.1.js"> </script>

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

        function convertToJumlah(number) {
            if (number) {
                var jumlah = "";
                var numberrev = number
                    .toString()
                    .split("")
                    .reverse()
                    .join("");

                for (var i = 0; i < numberrev.length; i++)
                    if (i % 3 == 0) jumlah += numberrev.substr(i, 3) + ".";
                return (
                    jumlah
                    .split("", jumlah.length - 1)
                    .reverse()
                    .join("")
                );
            } else {
                return number;
            }
        }

        $.ajax({
            url: "<?= base_url('KunjunganStatusJenisPasien/Grafik') ?>",
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
                                // datahasil.push(convertToJumlah(dataawal[ii].JUMLAH))
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
                        display: true,
                        labels: {
                            boxWidth: 20
                        }
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
                                    ctx.fillText(convertToJumlah(datasets[i].data[j]), p._model.x, p._model.y - 10);
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