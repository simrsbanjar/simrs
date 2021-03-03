<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Daftar Pasien Meninggal</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">

</head>

<body>
    <table style="width: 100%;" class="mb-5">
        <tr>
            <td align="Left">
                <span style="line-height: normal; font-size: 12px;">
                    <div>
                        BADAN LAYANAN UMUM DAERAH RUMAH SAKIT UMUM KOTA BANJAR
                    </div>
                    <div>
                        Jl. Rumah Sakit No. 5, Telp. (0265) 741 032 Fax. (0265) 744730
                    </div>
                    <div>
                        E-mail: rsubanjarjabar@gmail.com / online: rsu_kotabanjar@yahoo.co.id
                    </div>
                </span>
            </td>
        </tr>
    </table>
    <br>
    <h2>
        <center><b>Daftar Pasien Meninggal</b></center>
    </h2>
    <div class="mb-3">
        <p align="center">
            Tanggal Meninggal : <?= date('d-m-Y', strtotime($datafilter['TglAwal'])) ?> s.d <?= date('d-m-Y', strtotime($datafilter['TglAkhir'])) ?>
        </p>
    </div>
    <table class="table mt-5" onload="window.print()">
        <thead>
            <tr style="text-align: center;">
                <th>No</th>
                <th>No. CM</th>
                <th>Nama Pasien</th>
                <th>Umur</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Jenis Pasien</th>
                <th>Tgl. Masuk</th>
                <th>Tgl. Meninggal</th>
                <th>Tempat Meninggal</th>
                <th>Nama Diagnosa</th>
                <th>Dokter Pemeriksa</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($datahasil as $row) : ?>
            <?php $TglMasuk = date('d-m-Y m:s', strtotime($row->TglPendaftaran)) ?>
            <?php $TglMeninggal = date('d-m-Y', strtotime($row->TglMeninggal)) ?>

            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo $row->NoCM ?></td>
                <td><?php echo $row->NamaPasien ?></td>
                <td><?php echo $row->Umur ?></td>
                <td><?php echo $row->JK ?></td>
                <td><?php echo $row->Alamat ?></td>
                <td><?php echo $row->JenisPasien ?></td>
                <td><?php echo $TglMasuk  ?></td>
                <td><?php echo $TglMeninggal ?></td>
                <td><?php echo $row->TempatMeninggal ?></td>
                <td><?php echo $row->NamaDiagnosa ?></td>
                <td><?php echo $row->DokterPemeriksa ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>