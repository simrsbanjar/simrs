<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Surveilens Morbiditas Pasien</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap-v5.min.css">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
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


    <table class="table table-bordered mt-5 border border-dark" id="testTable">
        <caption>
            <h3>
                <center><b>Laporan Surveilens Morbiditas Pasien</b></center>
            </h3>
            <?php $instalasi       = $this->db->query("SELECT * FROM Instalasi WHERE KdInstalasi ='" . $datafilter['instalasi'] . "'")->row(); ?>
            <?php $ruangan       = $this->db->query("SELECT * FROM Ruangan WHERE KdRuangan ='" . $datafilter['ruangan'] . "'")->row(); ?>

            <div class="mb-3">
                <p align="center"> Instalasi :
                    <?php if ($datafilter['instalasi'] != '%') {
                        echo  $instalasi->NamaInstalasi;
                    } else {
                        echo  'Semua Instalasi';
                    }; ?> <br> Ruangan :
                    <?php if ($datafilter['ruangan'] != '%') {
                        echo  $ruangan->NamaRuangan;
                    } else {
                        echo  'Semua Ruangan';
                    }; ?> <br>
                    Periode : <?= $datafilter['bulan'] ?> <?= $datafilter['tahun'] ?> <br>

                </p>
            </div>

        </caption>

        <thead>
            <tr style="text-align: center;" class="align-middle">
                <th rowspan="3" style="background-color: rgb(204, 192, 218)">No</th>
                <th rowspan="3" style="background-color: rgb(255, 255, 0)">DIAGNOSA</th>
                <th rowspan="3" style="background-color: rgb(255, 192, 0)">KODE PENYAKIT</th>
                <th colspan="6" style="background-color: rgb(252, 213, 180)">KUNJUNGAN (KASUS)</th>
                <th colspan="11" style="background-color: rgb(220, 230, 241)">CARA PEMBAYARAN (BARU + LAMA)</th>
                <th colspan="27" style="background-color: rgb(196, 215, 155)">GOLONGAN UMUR (HIDUP + MATI)</th>
                <th colspan="27" style="background-color: rgb(204, 192, 218)">GOLONGAN UMUR ( HIDUP)</th>
                <th colspan="27" style="background-color: rgb(242, 220, 219)">GOLONGAN UMUR ( MATI)</th>
                <th colspan="9" style="background-color: rgb(196, 189, 151)">TOTAL</th>
            </tr>

            <tr style="text-align: center;" class="align-middle">
                <th colspan="3" style="background-color: rgb(252, 213, 180)">BARU</th>
                <th colspan="3" style="background-color: rgb(252, 213, 180)">LAMA</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">BPJS</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">BPJS PBI</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">JAMKESDA</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">SKTM LUAR BANJAR</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">SKTM KOTA BANJAR</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">PERUSAHAAN</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">UMUM</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">UMUM ODS</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">BANJAR SEHAT</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">JAMPERSAL</th>
                <th rowspan="2" style="background-color: rgb(220, 230, 241)">LAIN-LAIN</th>
                <?php
                $x = 1;
                while ($x <= 3) { ?>
                    <?php
                    $warna = '';
                    if ($x == 1) { ?>
                        <?php $warna = 'style="background-color: rgb(196, 215, 155)"'; ?>
                    <?php  } elseif ($x == 2) { ?>
                        <?php $warna = 'style="background-color: rgb(204, 192, 218)"'; ?>
                    <?php  } else { ?>
                        <?php $warna = 'style="background-color: rgb(242, 220, 219)"'; ?>
                    <?php  } ?>

                    <th colspan="3" <?= $warna; ?>>0 - 6 HR</th>
                    <th colspan="3" <?= $warna; ?>>7 - 28 HR</th>
                    <th colspan="3" <?= $warna; ?>>28 < 1 TH</th>
                    <th colspan="3" <?= $warna; ?>>1 - 4 TH</th>
                    <th colspan="3" <?= $warna; ?>>5 - 14 TH</th>
                    <th colspan="3" <?= $warna; ?>>15 - 24 TH</th>
                    <th colspan="3" <?= $warna; ?>>25 - 44 TH</th>
                    <th colspan="3" <?= $warna; ?>>45 - 64 TH</th>
                    <th colspan="3" <?= $warna; ?>>>= 65 TH</th>
                <?php $x++;
                }  ?>
                <th colspan="3" style="background-color: rgb(196, 189, 151)">HIDUP</th>
                <th colspan="3" style="background-color: rgb(196, 189, 151)">MATI</th>
                <th rowspan="2" style="background-color: rgb(196, 189, 151)">LAKI-LAKI</th>
                <th rowspan="2" style="background-color: rgb(196, 189, 151)">PEREMPUAN</th>
                <th rowspan="2" style="background-color: rgb(196, 189, 151)">KUNJUNGAN</th>
            </tr>

            <tr style="text-align: center;" class="align-middle">
                <?php
                $x = 1;
                while ($x <= 31) { ?>
                    <?php
                    $warna = '';
                    if ($x >= 1 && $x <= 2) { ?>
                        <?php $warna = 'style="background-color: rgb(252, 213, 180)"'; ?>
                    <?php  } elseif ($x >= 3 && $x <= 11) { ?>
                        <?php $warna = 'style="background-color: rgb(196, 215, 155)"'; ?>
                    <?php  } elseif ($x >= 12 && $x <= 20) { ?>
                        <?php $warna = 'style="background-color: rgb(204, 192, 218)"'; ?>
                    <?php  } elseif ($x >= 21 && $x <= 29) { ?>
                        <?php $warna = 'style="background-color: rgb(242, 220, 219)"'; ?>
                    <?php  } else { ?>
                        <?php $warna = 'style="background-color: rgb(196, 189, 151)"'; ?>
                    <?php  } ?>

                    <th <?= $warna; ?>>L</th>
                    <th <?= $warna; ?>>P</th>
                    <th <?= $warna; ?>>T</th>
                <?php $x++;
                }  ?>
            </tr>

            <tr style="text-align: center;" class="align-middle">
                <?php
                $x = 1;
                while ($x <= 110) { ?>
                    <?php
                    $warna = '';
                    if ($x == 1) { ?>
                        <?php $warna = 'style="background-color: rgb(204, 192, 218)"'; ?>
                    <?php  } elseif ($x == 2) { ?>
                        <?php $warna = 'style="background-color: rgb(255, 255, 0)"'; ?>
                    <?php  } elseif ($x == 3) { ?>
                        <?php $warna = 'style="background-color: rgb(255, 192, 0)"'; ?>
                    <?php  } elseif ($x >= 4 && $x <= 9) { ?>
                        <?php $warna = 'style="background-color: rgb(252, 213, 180)"'; ?>
                    <?php  } elseif ($x >= 10 && $x <= 20) { ?>
                        <?php $warna = 'style="background-color: rgb(220, 230, 241)"'; ?>
                    <?php  } elseif ($x >= 21 && $x <= 47) { ?>
                        <?php $warna = 'style="background-color: rgb(196, 215, 155)"'; ?>
                    <?php  } elseif ($x >= 48 && $x <= 74) { ?>
                        <?php $warna = 'style="background-color: rgb(204, 192, 218)"'; ?>
                    <?php  } elseif ($x >= 75 && $x <= 101) { ?>
                        <?php $warna = 'style="background-color: rgb(242, 220, 219)"'; ?>
                    <?php  } else { ?>
                        <?php $warna = 'style="background-color: rgb(196, 189, 151)"'; ?>
                    <?php  } ?>

                    <th <?= $warna; ?>><?= $x ?></th>
                <?php $x++;
                }  ?>

            </tr>
        </thead>

        <tr>
            <?php
            $x = 0;
            foreach ($hasildata as $row) :
                $x++ ?>
                <td style="text-align: center;" class="align-middle"><?= $x ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->NamaDiagnosa ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->KdDiagnosa ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->StatusKasusB_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->StatusKasusB_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->StatusKasusB ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->StatusKasusL_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->StatusKasusL_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->StatusKasusL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->BPJS ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->BPJS_BPI ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->JAMKESDA ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->SKTM_LUAR_BANJAR ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->SKTM_KOTA_BANJAR ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->PERUSAHAAN ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->UMUM ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->UMUM_ODS ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->BANJAR_SEHAT ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->JAMPERSAL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->OTHER ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9 ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur1_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur2_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur3_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur4_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur5_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur6_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur7_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur8_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_Umur9_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_L ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_P ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_HL ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_HP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_H ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_ML ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_MP ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_M ?></td>
                <td style="text-align: center;" class="align-middle"><?= $row->Kel_JmlKunj ?></td>
        </tr>
    <?php endforeach ?>
    </table>
</body>

<script>
    $(document).ready(function() {
        tableToExcel('testTable', 'Sheet1')
        setTimeout(window.close, 50);
    });
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
            link.download = "Laporan Surveilens Morbiditas Pasien.xls";
            link.href = uri + base64(format(template, ctx));
            link.click();
        }
    })()
</script>

</html>