<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('assets/img/simrs/logo rsu.png'); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
    <title>Surat Meninggal</title>
</head>

<body onload="window.print()">
    <?php $profil = $this->db->query("SELECT * FROM ProfilRS")->row(); ?>
    <table style="width: 100%;">
        <tr>
            <td style="text-align: center;">
                <span style="line-height: 1.6; font-weight: bold; font-size: 16px;">
                    <?= $profil->NamaRS ?>
                    <br>
                    <?= $profil->Alamat ?>, <?= $profil->KotaKodyaKab ?> - <?= $profil->KodePos ?> Telp. <?= $profil->Telepon ?>
                    <br>
                </span>
                <div>
                    <hr style="border-top:2px solid black">
                    <hr style="border-top:1px solid black">
                </div>
                <div>
                    <span style="font-size: 16px; line-height: 1.6; text-decoration: underline; font-weight: bold; text-transform: uppercase;">
                        Surat Keterangan Meninggal Dunia
                    </span>
                    <br>
                    <span>
                        Nomor : RSU / <?= date('Y'); ?> / <?= $pasien->NoCM ?>
                    </span>
                </div>
                <p style="text-align: justify; margin-top: 60px; text-align-last: auto; word-spacing: normal;">
                    Yang bertanda tangan dibawah ini, dokter <?= $profil->NamaRS ?> , menerangkan dengan
                    sesungguhnya bahwa :
                </p>

                <table>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Nama</td>
                        <td style="text-align: left; text-indent: 70px;">: <?= $pasien->NamaPasien ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Umur / Jenis Kelamin</td>
                        <td style="text-align: left; text-indent: 70px;">: <?= $pasien->Umur ?> / <?= $pasien->JK ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Pekerjaan</td>
                        <td style="text-align: left; text-indent: 70px;">: <?= $pasien->Pekerjaan ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Alamat</td>
                        <td style="text-align: left; text-indent: 70px;">: <?= $pasien->Alamat ?></td>
                    </tr>
                </table>
                <p style="text-align: justify; text-align-last: auto;">
                    Setelah dilakukan pemeriksaan dengan teliti pada Jam <?= date('h:m:s', strtotime($pasien->TglMeninggal)) ?> WIB, tanggal <?= date('d M Y', strtotime($pasien->TglMeninggal)) ?> orang/penderita tersebut telah
                    <b><i>MENINGGAL DUNIA</i></b>. Demikian, surat keterangan ini dibuat dengan sebenarnya.
                </p>
                <p style="text-indent: 500px; margin-top: 80px;" class="col mr-5">
                    Banjar, <?= date('d M Y', strtotime($pasien->TglMeninggal)) ?>
                    <br>
                <p style="text-indent: 500px;">Dokter RSUD <?= $profil->KotaKodyaKab ?></p>
                </p>
                <br>
                <hr style="width:25%;text-align:right;margin-right:10px; margin-top: 50px;">



            </td>
        </tr>
    </table>
</body>

</html>