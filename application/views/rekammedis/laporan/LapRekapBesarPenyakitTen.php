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

    <h3>
        <center><b>DAFTAR <?= $datafilter['JumlahData']; ?> BESAR PENYAKIT PASIEN <?= $datafilter['Kriteria']; ?>
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

    <table class="table table-bordered mt-5 border border-dark">
        <tr style="text-align: center;" class="align-middle">
            <th>No. Urut</th>
            <th>Kd. Diagnosa</th>
            <th>Diagnosa</th>
            <th>Jumlah</th>
            <th>Persentase</th>
        </tr>

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
</body>

</html>