<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Register Pasien</title>
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
                <buttons type="button" class="btn btn-success ml-auto" id="print">Lihat Laporan</buttons>
            </div>
            <br>
            <div class="form-inline">
                <div class="form-group">
                    <label for=" instalasi">Instalasi</label>
                    <select name="Instalasi" class='form-control' style="width:200px; margin-left:2px;">
                        <option value="0">- Pilih Instalasi -</option>
                        <?php foreach ($ruangan as $key) { ?>
                            <option value="<?php echo $key->KdRuangan ?>"><?php echo $key->NamaRuangan ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-inline" style="margin-left:10px;">
                        <label for="format">Format :</label>
                        <input type="radio" id="0" name="format" value="1" <?php if (isset($format) && $format == "0") echo "checked"; ?> style="margin-left:10px;" checked>
                        <label for="rekap" style="margin-left:10px;">Rekap</label><br>
                        <input type="radio" id="1" name="format" value="2" style="margin-left:10px;" <?php if (isset($format) && $format == "1") echo "checked"; ?>>
                        <label for="female" style="margin-left:10px;">Rincian</label>
                    </div>
                </div>
                <button type=" button" class="btn btn-primary ml-auto" id="saveas">Cetak</button>
            </div>

        </form>
        <br>

        <div class="card">
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <div class="card-body">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Kode Status</th>
                            <th>Status</th>
                            <th>QStatus</th>
                            <th>Kode External</th>
                            <th>Nama External</th>
                            <th>Status Enabled</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
                "order": [],
                "ajax": {
                    "url": "<?= base_url('MasterStatusPegawai/getData') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        });

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