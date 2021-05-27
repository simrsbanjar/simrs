<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Kunjungan Pasien Berdasarkan Status dan Kondisi Pasien</title>
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
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>

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
    <?php if ($datafilter['tombol'] == '1') { ?>
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
    <?php } ?>

    <?php if ($datafilter['format'] == '1') { ?>
        <?php
        $periode_old = '';
        $periode[] = '';
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '1') { ?>

                <?php if ($periode_old != $row->TANGGAL) { ?>
                    <?php $periode[] = $row->TANGGAL; ?>
                <?php } ?>
                <?php $periode_old = $row->TANGGAL;  ?>
            <?php } ?>
        <?php endforeach ?>
        <?php
        $periode    = array_values(array_unique($periode));
        unset($periode[0]);
        $periode = array_values($periode);
        ?>

        <?php
        $ruangan_old = '';
        $ruangan[] = '';
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '1') { ?>
                <?php if ($ruangan_old != $row->RuanganPelayanan) { ?>
                    <?php $ruangan[] = $row->RuanganPelayanan; ?>
                <?php } ?>
                <?php $ruangan_old = $row->RuanganPelayanan;  ?>
            <?php } ?>
        <?php endforeach ?>
        <?php
        $ruangan    = array_values(array_unique($ruangan));
        unset($ruangan[0]);
        $ruangan = array_values($ruangan);
        ?>

        <?php
        $kondisipulang_old = '';
        $kondisipulang[] = '';
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '1') { ?>
                <?php if ($kondisipulang_old != $row->Detail) { ?>
                    <?php $kondisipulang[] = $row->Detail ?>
                <?php } ?>
                <?php $kondisipulang_old = $row->Detail;  ?>
            <?php } ?>
        <?php endforeach ?>
        <?php array_splice($kondisipulang, 0, 1); ?>
        <?php $kondisipulang    = array_values(array_unique($kondisipulang)); ?>

        <?php
        $statuspasien[] = null;
        $statuspasien_old = null;
        foreach ($jumlah as $row) : ?>
            <?php if ($row->STS_FORMAT == '2') { ?>
                <?php if ($statuspasien_old != $row->Detail) { ?>
                    <?php $statuspasien[] = $row->Detail; ?>
                <?php } ?>
                <?php $statuspasien_old = $row->Detail;  ?>
            <?php } ?>
        <?php endforeach ?>
        <?php array_splice($statuspasien, 0, 1); ?>
        <?php $statuspasien    = array_values(array_unique($statuspasien)); ?>

        <?php
        $no = 0;
        foreach ($kondisipulang as $row) : ?>
            <?php $no++ ?>
        <?php endforeach ?>
        <?php
        $no1 = 0;
        foreach ($statuspasien as $row) : ?>
            <?php $no1++ ?>
        <?php endforeach ?>

        <table class="table table-bordered mt-5 border border-dark" id="testTable">
            <?php if ($datafilter['tombol'] != '1') { ?>
                <caption>
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
                </caption>
            <?php } ?>
            <thead>
                <tr style="text-align: center;" class="align-middle">
                    <th rowspan="3">Periode</th>
                    <th rowspan="3">Ruangan</th>
                    <th colspan="<?= ($no * 3) + 1; ?>">Kondisi Pulang</th>
                    <th colspan="<?= ($no1 * 3) + 1; ?>">Status Pasien</th>
                </tr>

                <tr style="text-align: center;" class="align-middle">
                    <?php foreach ($kondisipulang as $row) : ?>
                        <th colspan="3"><?= $row; ?></th>
                    <?php endforeach ?>
                    <th rowspan="2">Total</th>
                    <?php foreach ($statuspasien as $row1) : ?>
                        <th colspan="3"><?= $row1; ?></th>
                    <?php endforeach ?>
                    <th rowspan="2">Total</th>
                </tr>

                <tr style="text-align: center;" class="align-middle">
                    <?php foreach ($kondisipulang as $row) : ?>
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
            </thead>

            <?php if ($no1 > 0) { ?>
                <?php
                $row3 = 0;
                while ($row3    <= count($periode) - 1) { ?>
                    <?php
                    if ($datafilter['nilaifilter'] == '2') {
                        if ($periode[$row3] == '01') {
                            $periodebln = 'JANUARI';
                        } else if ($periode[$row3] == '02') {
                            $periodebln = 'FEBRUARI';
                        } else if ($periode[$row3] == '03') {
                            $periodebln = 'MARET';
                        } else if ($periode[$row3] == '04') {
                            $periodebln = 'APRIL';
                        } else if ($periode[$row3] == '05') {
                            $periodebln = 'MEI';
                        } else if ($periode[$row3] == '06') {
                            $periodebln = 'JUNI';
                        } else if ($periode[$row3] == '07') {
                            $periodebln = 'JULI';
                        } else if ($periode[$row3] == '08') {
                            $periodebln = 'AGUSTUS';
                        } else if ($periode[$row3] == '09') {
                            $periodebln = 'SEPTEMBER';
                        } else if ($periode[$row3] == '10') {
                            $periodebln = 'OKTOBER';
                        } else if ($periode[$row3] == '11') {
                            $periodebln = 'NOVEMBER';
                        } else {
                            $periodebln = 'DESEMBER';
                        }
                    }

                    $noruangan = 0;
                    foreach ($ruangan as $rowruangan) : ?>
                        <?php $noruangan++ ?>
                    <?php endforeach ?>

                    <tr>
                        <?php if ($datafilter['nilaifilter'] == '2') { ?>
                            <td style="text-align: center; vertical-align: middle;" rowspan='<?= $noruangan ?>'><?php echo $periodebln;            ?></td>
                        <?php } else { ?>
                            <td style="text-align: center; vertical-align: middle;" rowspan='<?= $noruangan ?>'><?php echo $periode[$row3];            ?></td>
                        <?php }
                        $row = 0;

                        while ($row <= count($ruangan) - 1) { ?>
                            <?php $sumtotal = 0; ?>
                            <td style="text-align: center; vertical-align: middle;"><?= $ruangan[$row];            ?></td>

                            <?php if ($no > 0) { ?>
                                <?php
                                $row1 = 0;
                                while ($row1 <= count($kondisipulang) - 1) { ?>
                                    <?php
                                    $row2 = 0;
                                    $count = 0;
                                    while ($row2 <= count($jumlah) - 1) {
                                        if (
                                            $jumlah[$row2]->Detail == $kondisipulang[$row1] and
                                            $jumlah[$row2]->RuanganPelayanan == $ruangan[$row] and
                                            $jumlah[$row2]->TANGGAL == $periode[$row3]
                                        ) { ?>
                                            <td style="text-align: center; vertical-align: middle;"><?= number_format($jumlah[$row2]->L, 0, ',', '.'); ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= number_format($jumlah[$row2]->P, 0, ',', '.'); ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= number_format($jumlah[$row2]->TOTAL, 0, ',', '.'); ?></td>

                                            <?php $sumtotal = $sumtotal + $jumlah[$row2]->TOTAL  ?>
                                            <?php $count++ ?>
                                        <?php
                                        }

                                        $row2++;
                                    }
                                    if ($count == 0) { ?>
                                        <td style="text-align: center; vertical-align: middle;">0</td>
                                        <td style="text-align: center; vertical-align: middle;">0</td>
                                        <td style="text-align: center; vertical-align: middle;">0</td>
                                <?php }
                                    $row1++;
                                }; ?>
                                <td style="text-align: center; vertical-align: middle;"><?= number_format($sumtotal, 0, ',', '.'); ?></td>
                            <?php } ?>

                            <?php if ($no1 > 0) { ?>
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
                                            $jumlah[$row2]->RuanganPelayanan == $ruangan[$row] and
                                            $jumlah[$row2]->TANGGAL == $periode[$row3]
                                        ) { ?>
                                            <td style="text-align: center; vertical-align: middle;"><?= number_format($jumlah[$row2]->L, 0, ',', '.'); ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= number_format($jumlah[$row2]->P, 0, ',', '.'); ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= number_format($jumlah[$row2]->TOTAL, 0, ',', '.'); ?></td>

                                            <?php $sumpastotal = $sumpastotal + $jumlah[$row2]->TOTAL  ?>
                                            <?php $count++ ?>
                                        <?php
                                        }

                                        $row2++;
                                    }
                                    if ($count == 0) { ?>
                                        <td style="text-align: center; vertical-align: middle;">0</td>
                                        <td style="text-align: center; vertical-align: middle;">0</td>
                                        <td style="text-align: center; vertical-align: middle;">0</td>
                                <?php }
                                    $row1++;
                                }; ?>
                                <td style="text-align: center; vertical-align: middle;"><?= number_format($sumpastotal, 0, ',', '.'); ?></td>

                            <?php } ?>
                    </tr>
                    <?php $row++; ?>
                <?php }; ?>

            <?php $row3++;
                } ?>
        <?php } ?>

        <th style="text-align: center; vertical-align: middle;" colspan="2">Total</th>

        <?php
        if ($no > 0) {
            $sumtotalall = 0;
            $row1 = 0;
            while ($row1 <= count($kondisipulang) - 1) { ?>
                <?php
                $row2 = 0;
                $count = 0;
                $totalL = 0;
                $totalP = 0;
                $sumtotal = 0;
                while ($row2 <= count($jumlah) - 1) {
                    if (
                        $jumlah[$row2]->Detail == $kondisipulang[$row1]
                    ) {
                        $sumtotal = $sumtotal + $jumlah[$row2]->TOTAL;
                        $totalL = $totalL + $jumlah[$row2]->L;
                        $totalP = $totalP + $jumlah[$row2]->P;
                        $sumtotalall = $sumtotalall + $jumlah[$row2]->TOTAL;
                        $count++;
                    };
                    $row2++;
                }; ?>

                <?php if ($count == 0) { ?>
                    <th style="text-align: center; vertical-align: middle;">0</th>
                    <th style="text-align: center; vertical-align: middle;">0</th>
                    <th style="text-align: center; vertical-align: middle;">0</th>
                <?php } else { ?>
                    <th style="text-align: center; vertical-align: middle;"><?= number_format($totalL, 0, ',', '.'); ?></th>
                    <th style="text-align: center; vertical-align: middle;"><?= number_format($totalP, 0, ',', '.'); ?></th>
                    <th style="text-align: center; vertical-align: middle;"><?= number_format($sumtotal, 0, ',', '.'); ?></th>
                <?php } ?>
            <?php $row1++;
            }; ?>
            <th style="text-align: center; vertical-align: middle;"><?= number_format($sumtotalall, 0, ',', '.'); ?></th>
        <?php } ?>

        <?php if ($no1 > 0) { ?>
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

                <?php if ($count == 0) { ?>
                    <th style="text-align: center; vertical-align: middle;">0</th>
                    <th style="text-align: center; vertical-align: middle;">0</th>
                    <th style="text-align: center; vertical-align: middle;">0</th>
                <?php } else { ?>
                    <th style="text-align: center; vertical-align: middle;"><?= number_format($totalL, 0, ',', '.'); ?></th>
                    <th style="text-align: center; vertical-align: middle;"><?= number_format($totalP, 0, ',', '.'); ?></th>
                    <th style="text-align: center; vertical-align: middle;"><?= number_format($sumtotal, 0, ',', '.'); ?></th>
            <?php }
                $row1++;
            }; ?>

            <th style="text-align: center; vertical-align: middle;"><?= number_format($sumtotalallpas, 0, ',', '.'); ?></th>
        <?php } ?>
        </table>
    <?php } else { ?>
        <div style="width:auto;">
            <canvas id="myChart"></canvas>
        </div>

        <script src="<?= base_url('assets/js/'); ?>jquery-3.5.1.js"> </script>

    <?php } ?>
</body>

<script>
    <?php if ($datafilter['format'] == '2') { ?>
        var periode = "<?= $datafilter['nilaifilter'] ?>";
        var instalasi = "<?= $datafilter['instalasi'] ?>";

        var tanggalawal = "<?= $datafilter['tanggalawal'] ?>";
        var tanggalakhir = "<?= $datafilter['tanggalakhir'] ?>";
        var tahun1 = "<?= $datafilter['tahun1'] ?>";
        var bulanawal = "<?= $datafilter['bulanawal'] ?>";
        var bulanakhir = "<?= $datafilter['bulanakhir'] ?>";
        var tahun2 = "<?= $datafilter['tahun2'] ?>";
        var tahun3 = "<?= $datafilter['tahun3'] ?>";
        var tombol = "<?= $datafilter['tombol'] ?>";
        var tampil = null;

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
                                ctx.font = "10px Lobster Two";
                                ctx.fillStyle = "#4F4C4D";

                                chart.getDatasetMeta(i).data.forEach(function(p, j) {
                                    ctx.fillText(convertToJumlah(datasets[i].data[j]), p._model.x, p._model.y - 10)

                                });
                            });
                        }
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
                            categoryPercentage: 10,
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
                tampil = msg.hasil;
            }
        });

        if (tampil === null) {
            var myVar = setInterval(myMethod, 700);
        }

        function myMethod() {
            if (tampil != null) {
                setTimeout(window.print(), 5000);
                clearInterval(myVar);
                window.close();
            }
        }
    <?php } else { ?>
        <?php if ($datafilter['tombol'] == '1') { ?>
            window.print();
            window.onafterprint = function() {
                window.close();
            }
        <?php } else { ?>
            $(document).ready(function() {
                tableToExcel('testTable', 'Sheet1')
                setTimeout(window.close, 50);
            });
        <?php } ?>
    <?php } ?>

    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table cellspacing="0" rules="rows" border="1" style="color:Black;background-color:White;border-color:#CCCCCC;border-width:1px;border-style:None;width:100%;border-collapse:collapse;font-size:9pt;text-align:center;">{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            var link = document.createElement("a");
            link.download = "Laporan Kunjungan Pasien Berdasarkan Status dan Kondisi Pulang.xls";
            link.href = uri + base64(format(template, ctx));
            link.click();
        }
    })()
</script>

</html>