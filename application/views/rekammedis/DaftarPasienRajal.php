<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien Rawat Jalan</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container mt-3">
        <!-- Page Heading -->
        <h1 class="h3 text-gray-900"><?= $title; ?></h1>
        <hr>
        <br>

        <form style="font-size:15px" action="rekammedis/BukuRegister/cetak">
            <div class="form-inline">
                <div class="form-group">
                    <label for="awal">Periode</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2 mr-2" id="awal" style="width:200px;">
                </div>
                <div class="form-group">
                    <label for="akhir">s/d</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2" id="akhir" style="width:200px;">
                </div>

                <?php $jenispasien  = $this->db->query("SELECT * FROM KelompokPasien  WHERE StatusEnabled = '1' ORDER BY JenisPasien ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group">
                        <label for=" instalasi" style="margin-left:5px;">Jenis Pasien</label>
                        <select name="Instalasi" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="0">- Semua Jenis Pasien -</option>
                            <?php foreach ($jenispasien as $key) { ?>
                                <option value="<?php echo $key->JenisPasien ?>"><?php echo $key->JenisPasien ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <buttons type="button" class="btn btn-success ml-auto" id="print">Lihat Laporan</buttons>
                <br><br><br>
                <?php $ruangan  = $this->db->query("SELECT * FROM Ruangan ORDER BY NamaRuangan ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group">
                        <label for=" instalasi">Ruangan</label>
                        <select name="Instalasi" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="0">- Semua Ruangan -</option>
                            <?php foreach ($ruangan as $key) { ?>
                                <option value="<?php echo $key->KdRuangan ?>"><?php echo $key->NamaRuangan ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-inline" style="margin-left:10px;">
                            <label for="format">Nama Pasien / No. CM</label>
                            <input type="text" class="form-control" style="margin-left:10px;" id="status" name="status">
                        </div>
                    </div>
                </div>
                <button type=" button" class="btn btn-primary ml-auto" id="cetak">Cetak</button>
        </form>

        <div class="card" style="width:100%">
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <div class="card-body">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No. Urut</th>
                            <th>No. CM</th>
                            <th>Nama Pasien</th>
                            <th>Umur</th>
                            <th>JK</th>
                            <th>Jenis Pasien</th>
                            <th>Nama Diagnosa</th>
                            <th>Tgl. Masuk</th>
                            <th>Tgl. Lahir</th>
                            <th>Telepon</th>
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
                "order": [],
                "ajax": {
                    "url": "<?= base_url('rekammedis/DaftarPasienRajal/getData') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        });

        function ambildata() {
            tableData.DataTable({
                "processing": true,
                "serverSide": true,
                "bFilter": false,
                "bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('rekammedis/DaftarPasienRajal/ambildata') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        }

        function reloadTable() {
            tableData.DataTable().ajax.reload();
        }

        function message(icon, text) {
            Swal.fire({
                icon: icon,
                title: 'Informasi',
                text: text,
                showConfirmButton: false,
                showCancelButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
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