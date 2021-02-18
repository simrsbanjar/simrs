<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <title>Master Status Pegawai</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container mt-3">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary m-2" onclick="add()">
            Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="formData">
                            <input type="hidden" id="kdstatus" name="kdstatus" value="">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" name="status" placeholder="Masukan Status Pegawai">

                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="status">Kode External</label>
                                <input type="text" class="form-control" id="kodeexternal" name="kodeexternal" placeholder="Masukan Kode External">
                            </div>
                            <div class="form-group">
                                <label for="status">Nama External</label>
                                <input type="text" class="form-control" id="namaexternal" name="namaexternal" placeholder="Masukan Nama External">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="statusaktif">Status Aktif</label>
                                <input class="form-check-input col-9" type="checkbox" value="1" id="statusaktif" name="statusaktif" checked>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
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

        function deleteQuestion(kode, Nama) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda yakin akan menghapus data " + Nama + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteData(kode);
                }
            })
        }

        function add() {
            saveData = 'tambah';
            formData[0].reset();
            modal.modal('show');
            modalTitle.text('Tambah Data');
        }

        function save() {
            btnsave.text('Mohon tunggu....');
            btnsave.attr('disabled', true);

            if (saveData == 'tambah') {
                url = "<?= base_url('MasterStatusPegawai/add') ?>"
            } else {
                url = "<?= base_url('MasterStatusPegawai/update') ?>"
            }

            $.ajax({
                type: "POST",
                url: url,
                data: formData.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        modal.modal('hide');
                        reloadTable();

                        if (saveData == 'tambah') {
                            message('success', 'Data Berhasil Disimpan');
                        } else {
                            message('success', 'Data Berhasil Diubah');
                        }
                    } else {
                        for (var i = 0; i < response.inputerror.length; i++) {
                            $('[name="' + response.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + response.inputerror[i] + '"]').next().text(response.error_string[i]);
                        }
                    }
                    btnsave.text('Simpan');
                    btnsave.attr('disabled', false);
                },
                error: function() {
                    message('error', 'Server gangguan, silahkan ulangi kembali.');
                }

            })

        }

        function byid(kode, type) {
            if (type == 'ubah') {
                saveData = 'ubah';
                formData[0].reset();
            }

            $.ajax({
                type: "GET",
                url: "<?= base_url('MasterStatusPegawai/byid/') ?>" + kode,
                dataType: "JSON",
                success: function(response) {
                    if (type == 'ubah') {
                        formData.find('input').removeClass('is-invalid');
                        modalTitle.text('Ubah Data');
                        btnsave.text('Ubah Data');
                        btnsave.attr('disabled', false);
                        $('[name="kdstatus"]').val(response.KdStatus);
                        $('[name="status"]').val(response.Status);
                        $('[name="kodeexternal"]').val(response.KodeExternal);
                        $('[name="namaexternal"]').val(response.NamaExternal);

                        if (response.StatusEnabled == '1') {
                            $('[name="statusaktif"]').prop('checked', true);
                        } else {
                            $('[name="statusaktif"]').prop('checked', false);
                        }

                        modal.modal('show');
                    } else {
                        deleteQuestion(response.KdStatus, response.Status);
                    }
                },
                error: function() {
                    message('error', 'Server gangguan, silahkan ulangi kembali.');
                }
            })
        }

        function deleteData(kode) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('MasterStatusPegawai/delete/') ?>" + kode,
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