<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container mt-3">
        <!-- Page Heading -->
        <h1 class="h3 text-gray-900"><?= $title; ?></h1>
        <hr>
        <br>

        <form style="font-size:15px" action="#" id="formData">
            <div class="form-inline">
                <div class="form-group mb-2">
                    <label for="awal">Periode</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2 mr-2" id="awal" name="awal" style="width:200px;">
                </div>
                <div class="form-group mb-2">
                    <label for="akhir">s/d</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2" id="akhir" name="akhir" style="width:200px;">
                </div>
                <div class="form-inline">
                    <div class="form-group mb-2 d-flex bd-highlight">
                        <div class="p-3 order-10 bd-highlight">
                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-book-dead"></i>
                                Lihat Laporan</button>
                        </div>
                        <div class="p-0 order-10 bd-highlight">
                            <a target="_blank"> <button type="button" class="btn btn-outline-primary"><i class="fa fa-print"></i>
                                    Cetak </button></a>
                        </div>

                    </div>
                </div>

                <!-- <buttons type="button" class="btn btn-success mb-3" id="print" onclick="AmbilData()">Lihat Laporan</buttons> -->


                <!-- <button type=" button" class="btn btn-primary ml-auto" id="cetak">Cetak</button> -->
        </form>

        <div class="table-responsive" style="width:100%">
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <div class="card-body">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No. Urut</th>
                            <th>No. CM</th>
                            <th>Nama Pasien</th>
                            <th>JK</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Tgl Meninggal</th>
                            <th>Penyebab</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Umur Tahun</th>
                            <th>Pekerjaan</th>
                            <th>Kode Kelas Akhir</th>
                            <th>Desk Kelas</th>
                            <th>Nama Diagnosa</th>
                            <th>Kode Kelompok Pasien</th>
                            <th>Jenis Pasien</th>
                            <th>Kota</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>RT/RW</th>
                            <th>Tgl Lahir</th>
                            <th>Id Pegawai</th>
                            <th>Nama Jabatan</th>
                        </tr>
                    </thead>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"> </script>


    <script>
        var saveData;
        var modal = $('#modalData');
        var tableData = $('#myTable');
        var formData = $('#formData');
        var modalTitle = $('#modalTitle');
        var btnsave = $('#btnSave');

        $(document).ready(function() {
            tableData.DataTable({
                "processing": true,
                "serverSide": true,
                "bFilter": false,
                "bLengthChange": false,
                "paging": false,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('DaftarPasienMeninggal/getData') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        });

        function AmbilData() {
            var awal = $('#awal').val();
            var akhir = $('#akhir').val();
            var jenispasien = $('#jenispasien').val();
            var ruangan = $('#ruangan').val();
            var caritext = $('#caritext').val();

            tableData.DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "bFilter": false,
                "bLengthChange": false,
                "paging": false,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('DaftarPasienMeninggal/AmbilData') ?>",
                    "type": "POST",
                    "data": {
                        "awal": awal,
                        "akhir": akhir,
                        "jenispasien": jenispasien,
                        "ruangan": ruangan,
                        "caritext": caritext
                    },
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        }

        function cetak() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('rekammedis/BukuRegister/cetak') ?>",
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    reloadTable();
                    message('success', 'Data Berhasil Dihapus');
                },
                error: function() {
                    message('error', 'Server gangguan, silahkan ulangi kembali.');
                }

            })
        }
    </script>

</body>

</html>