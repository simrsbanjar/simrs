<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Meninggal</title>
</head>

<body>
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
                        Nomor : RSU / <?= date('Y'); ?> /
                    </span>
                </div>
                <p style="text-align: left; text-indent: 50px; margin-top: 60px;">
                    Yang bertanda tangan dibawah ini, dokter <?= $profil->NamaRS ?> , menerangkan dengan sesungguhnya bahwa :
                </p>

                <table>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Nama</td>
                        <td style="text-align: left; text-indent: 70px;">:</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Umur / Jenis Kelamin</td>
                        <td style="text-align: left; text-indent: 70px;">:</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Pekerjaan</td>
                        <td style="text-align: left; text-indent: 70px;">:</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-indent: 50px;">Alamat</td>
                        <td style="text-align: left; text-indent: 70px;">:</td>
                    </tr>
                </table>
                <p style="text-align: left; text-indent: 50px;">
                    Setelah dilakukan pemeriksaan dengan teliti pada Jam <?= date('h:m:s') ?> WIB, tanggal
                </p>
                <p style="text-align: left; text-indent: 50px;">
                    <?= date('Y-m-d') ?> orang/penderita tersebut
                </p>



            </td>
        </tr>
    </table>
</body>

</html>