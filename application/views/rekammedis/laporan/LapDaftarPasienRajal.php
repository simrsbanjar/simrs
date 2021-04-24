<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Pasien Rawat Jalan</title>
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap-v5.min.css">

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
        <center><b>Daftar Pasien Rawat Jalan</b></center>
    </h2>
    <div class="mb-3">
        <p align="center">
            Periode : <?= date('d-m-Y', strtotime($datafilter['TglAwal'])) ?> s.d <?= date('d-m-Y', strtotime($datafilter['TglAkhir'])) ?>
        </p>
    </div>
    <table class="table table-bordered mt-5 border border-dark">
        <thead>
            <tr style="text-align: center;" class="align-middle">
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
        </thead>
        <?php $no = 1;
        foreach ($datahasil as $row) : ?>
            <?php $TglMasuk = date('d-m-Y m:s', strtotime($row->TglMasuk)) ?>
            <?php $TglLahir = date('d-m-Y', strtotime($row->TglLahir)) ?>

            <tr>
                <td style="text-align: center;" class="align-middle"><?php echo $no++; ?></td>
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

<script type="text/javascript">
    window.print();
    window.onafterprint = function() {
        window.close();
    }
</script>

</html>