<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Daftar Pasien Rawat Jalan</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
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
        <center><b>Daftar Pasien Rawat Jalan</b></center>
    </h2>
    <div class="mb-3">
        <p align="center">
            <?php $ruangan       = $this->db->get_where('Ruangan', ['KdRuangan' => $datafilter['Ruangan']])->result_array(); ?>
            Periode : <?= $datafilter['TglAwal'] ?> s.d <?= $datafilter['TglAkhir'] ?>
        </p>
    </div>
    <table class="table table-bordered mt-5">
        <tr style="text-align: center;">
            <th>No. Urut</th>
            <th>No. CM</th>
            <th>Nama Pasien</th>
            <th>Umur</th>
            <th>JK</th>
            <th>Jenis Pasien</th>
            <th>Ruangan</th>
            <th>Nama Diagnosa</th>
            <th>Tgl. Masuk</th>
            <th>Tgl. Lahir</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>
        <?php $no = 1;
        foreach ($datahasil as $row) : ?>
            <?php $TglMasuk = date('d-m-Y m:s', strtotime($row->TglMasuk)) ?>
            <?php $TglLahir = date('d-m-Y', strtotime($row->TglLahir)) ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->NoCM ?></td>
                <td><?php echo $row->NamaPasien ?></td>
                <td><?php echo $row->Umur ?></td>
                <td><?php echo $row->JK ?></td>
                <td><?php echo $row->JenisPasien ?></td>
                <td><?php echo $row->NamaRuangan ?></td>
                <td><?php echo $row->NamaDiagnosa ?></td>
                <td><?php echo $TglMasuk  ?></td>
                <td><?php echo $TglLahir ?></td>
                <td><?php echo $row->Telepon ?></td>
                <td><?php echo $row->Alamat ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>