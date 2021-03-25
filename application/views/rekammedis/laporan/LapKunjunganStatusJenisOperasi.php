<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Kunjungan Pasien Berdasarkan Status dan Jenis Operasi</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
</head>

<body onload="window.print()">
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
        <center><b>Laporan Kunjungan Pasien Berdasarkan Status dan Jenis Operasi</b></center>
    </h2>
    <div class="mb-3">
        <p align="center">
            <?php $instalasi       = $this->db->query("SELECT * FROM Instalasi WHERE KdInstalasi ='" . $instalasi . "'")->row(); ?>
            Periode : <?= $subtitle ?> <br>
            Instalasi : <?= $instalasi->NamaInstalasi  ?>
        </p>
    </div>

    <?php
    $no = 0;
    foreach ($jenisoperasi as $row) : ?>
        <?php $no++ ?>
    <?php endforeach ?>
    <?php
    $no1 = 0;
    foreach ($statuspasien as $row) : ?>
        <?php $no1++ ?>
    <?php endforeach ?>

    <table class="table table-bordered mt-5">
        <tr style="text-align: center;">
            <th rowspan="3">Ruangan</th>
            <?php if ($no > 0) { ?>
                <th colspan="<?= ($no * 3) + 1; ?>">Jenis Operasi</th>
            <?php } ?>
            <?php if ($no1 > 0) { ?>
                <th colspan="<?= ($no1 * 3) + 1; ?>">Status Pasien</th>
            <?php } ?>
        </tr>

        <tr style="text-align: center;">
            <?php foreach ($jenisoperasi as $row) : ?>
                <th colspan="3"><?= $row->Detail; ?></th>
            <?php endforeach ?>
            <?php if ($no > 0) { ?>
                <th rowspan="2">Total</th>
            <?php } ?>
            <?php foreach ($statuspasien as $row1) : ?>
                <th colspan="3"><?= $row1->Detail; ?></th>
            <?php endforeach ?>
            <?php if ($no1 > 0) { ?>
                <th rowspan="2">Total</th>
            <?php } ?>
        </tr>

        <tr style="text-align: center;">
            <?php foreach ($jenisoperasi as $row) : ?>
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
        $sumtotal = 0;
        foreach ($ruangan as $row) : ?>
            <tr>
                <?php $sumtotal = 0; ?>
                <td style="text-align: center;"><?php echo $row->RuanganPelayanan;            ?></td>
                <?php foreach ($jenisoperasi as $row1) : ?>
                    <?php if ($datafilter['nilaifilter'] == '1') {
                        $data = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where TglPendaftaran BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row1->Detail . "'")->row();
                    } else if ($datafilter['nilaifilter'] == '2') {
                        $data = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) = '" . $datafilter['tahun'] . "' and MONTH(TglPendaftaran) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row1->Detail . "'")->row();
                    } else {
                        $data = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row1->Detail . "'")->row();
                    }; ?>
                    <td style="text-align: center;"><?= $data->L; ?></td>
                    <td style="text-align: center;"><?= $data->P; ?></td>
                    <td style="text-align: center;"><?= $data->TOTAL; ?></td>

                    <?php $sumtotal = $sumtotal + $data->TOTAL  ?>
                <?php endforeach ?>
                <?php if ($no > 0) { ?>
                    <td style="text-align: center;"><?= $sumtotal; ?></td>
                <?php } ?>
                <?php $sumpastotal = 0; ?>
                <?php foreach ($statuspasien as $row2) : ?>
                    <?php if ($datafilter['nilaifilter'] == '1') {
                        $data1 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where TglPendaftaran BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row2->Detail . "'")->row();
                    } else if ($datafilter['nilaifilter'] == '2') {
                        $data1 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) = '" . $datafilter['tahun'] . "' and MONTH(TglPendaftaran) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row2->Detail . "'")->row();
                    } else {
                        $data1 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where  YEAR(TglPendaftaran) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND KdRuanganPelayanan = '" . $row->KdRuanganPelayanan . "' AND Detail = '" . $row2->Detail . "'")->row();
                    }; ?>
                    <td style="text-align: center;"><?= $data1->L; ?></td>
                    <td style="text-align: center;"><?= $data1->P; ?></td>
                    <td style="text-align: center;"><?= $data1->TOTAL; ?></td>

                    <?php $sumpastotal = $sumpastotal + $data1->TOTAL  ?>
                <?php endforeach ?>
                <?php if ($no1 > 0) { ?>
                    <td style="text-align: center;"><?= $sumpastotal; ?></td>
                <?php } ?>
            </tr>
        <?php endforeach ?>

        <th style="text-align: center;">Total</th>
        <?php if ($no > 0) { ?>
            <?php $sumtotalall = 0; ?>
            <?php foreach ($jenisoperasi as $row3) : ?>
                <?php if ($datafilter['nilaifilter'] == '1') {
                    $data2 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where TglPendaftaran BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row3->Detail . "'")->row();
                } else if ($datafilter['nilaifilter'] == '2') {
                    $data2 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) = '" . $datafilter['tahun'] . "' and MONTH(TglPendaftaran) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row3->Detail . "'")->row();
                } else {
                    $data2 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row3->Detail . "'")->row();
                }; ?>
                <th style="text-align: center;"><?= $data2->L; ?></th>
                <th style="text-align: center;"><?= $data2->P; ?></th>
                <th style="text-align: center;"><?= $data2->TOTAL; ?></th>
                <?php $sumtotalall = $sumtotalall + $data2->TOTAL ?>
            <?php endforeach ?>


            <th style="text-align: center;"><?= $sumtotalall; ?></th>
        <?php } ?>
        <?php if ($no1 > 0) { ?>
            <?php $sumtotalallpas = 0; ?>
            <?php foreach ($statuspasien as $row4) : ?>
                <?php if ($datafilter['nilaifilter'] == '1') {
                    $data3 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where TglPendaftaran BETWEEN '" . $datafilter['tanggalawal'] . " 00:00:00" . "' and '" . $datafilter['tanggalakhir'] . " 23:59:59' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row4->Detail . "'")->row();
                } else if ($datafilter['nilaifilter'] == '2') {
                    $data3 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) = '" . $datafilter['tahun'] . "' and MONTH(TglPendaftaran) BETWEEN '" . $datafilter['bulanawal'] . "' and '" . $datafilter['bulanakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row4->Detail . "'")->row();
                } else {
                    $data3 = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), TOTAL	= ISNULL(SUM(JmlPasien),0) from V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus where YEAR(TglPendaftaran) between '" . $datafilter['tahun'] . "' and '" . $datafilter['tahunakhir'] . "' and KdInstalasi ='" . $instalasi->KdInstalasi . "' AND Detail = '" . $row4->Detail . "'")->row();
                }; ?>
                <th style="text-align: center;"><?= $data3->L; ?></th>
                <th style="text-align: center;"><?= $data3->P; ?></th>
                <th style="text-align: center;"><?= $data3->TOTAL; ?></th>
                <?php $sumtotalallpas = $sumtotalallpas + $data3->TOTAL ?>
            <?php endforeach ?>
            <th style="text-align: center;"><?= $sumtotalallpas; ?></th>
        <?php } ?>
    </table>

</body>

</html>