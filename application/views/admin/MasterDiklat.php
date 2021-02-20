<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Status Pegawai</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
</head>

<body>

    <div class="container">
        <h2>
            <center>
                <h2 class="h2 mb-4 text-gray-900 btn-d-md-block"><?= $title; ?></h2>
            </center>
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size: medium;">
                <li class="nav-item">
                    <a class="nav-link active" id="jenisdiklat-tab" data-toggle="tab" href="#jenisdiklat" role="tab" aria-controls="jenisdiklat" aria-selected="true">Jenis Diklat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="diklat-tab" data-toggle="tab" href="#diklat" role="tab" aria-controls="diklat" aria-selected="false">Diklat</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent" style="font-size: medium;">
                <div class="tab-pane fade show active" id="jenisdiklat" role="tabpanel" aria-labelledby="jenisdiklat-tab">
                    <button type="button" class="btn btn-primary m-2" onclick="add()">
                        Tambah Data
                    </button>

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
                                        <input type="hidden" id="kdjenisdiklat" name="kdjenisdiklat" value="">
                                        <div class="form-group">
                                            <label for="status">Jenis Diklat</label>
                                            <input type="text" class="form-control" id="jenisdiklat" name="jenisdiklat" placeholder="Masukan Jenis Diklat">

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
                                        <th>Kode</th>
                                        <th>Jenis Diklat</th>
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
                <div class="tab-pane fade" id="diklat" role="tabpanel" aria-labelledby="diklat-tab">
                    <button type="button" class="btn btn-primary m-2" onclick="add1()">
                        Tambah Data
                    </button>

                    <div class="modal fade" id="modalData1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle1">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form action="#" id="formData1">
                                        <input type="hidden" id="kddiklat" name="kddiklat" value="">
                                        <div class="form-group">
                                            <label for="diklat">Nama Diklat</label>
                                            <input type="text" class="form-control" id="diklat" name="diklat" placeholder="Masukan Diklat">

                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <?php $jenisdiklat  = $this->db->order_by('JenisDiklat', 'ASC'); ?>
                                        <?php $jenisdiklat  = $this->db->get('JenisDiklat')->result(); ?>
                                        <div class="form-group">
                                            <label for="jenisdiklat">Jenis Diklat</label>
                                            <select name="jenisdiklat" class='form-control'>
                                                <?php foreach ($jenisdiklat as $key) { ?>
                                                    <option value="<?php echo $key->KdJenisDiklat ?>"><?php echo $key->JenisDiklat ?> </option>
                                                <?php } ?>
                                            </select>
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
                                    <button type="button" class="btn btn-primary" id="btnSave1" onclick="save1()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <table id="myTable1" class="table table-striped table-bordered" style="width:100%">
                            <div class="card-body">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Kode</th>
                                        <th>Diklat</th>
                                        <th>Jenis Diklat</th>
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

        </h2>
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
        var modal1 = $('#modalData1');
        var tableData = $('#myTable');
        var tableData1 = $('#myTable1');
        var formData = $('#formData');
        var formData1 = $('#formData1');
        var modalTitle = $('#modalTitle');
        var modalTitle1 = $('#modalTitle1');
        var btnsave = $('#btnSave');
        var btnsave1 = $('#btnSave1');

        $(document).ready(function() {
            tableData.DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('MasterDiklat/getData') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });

            tableData1.DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('MasterDiklat/getData1') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });


        });

        function reloadTable(status) {
            if (status == 'tab1') {
                tableData.DataTable().ajax.reload();
            } else {
                tableData1.DataTable().ajax.reload();
            }
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

        function deleteQuestion(kode, Nama, status) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda yakin akan menghapus data " + Nama + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (status == 'tab1') {
                        deleteData(kode);
                    } else {
                        deleteData1(kode);
                    }
                }
            })
        }

        function add() {
            saveData = 'tambah';
            formData[0].reset();
            modal.modal('show');
            modalTitle.text('Tambah Data');
        }

        function add1() {
            saveData = 'tambah';
            formData1[0].reset();
            modal1.modal('show');
            modalTitle1.text('Tambah Data');
        }

        function save() {
            btnsave.text('Mohon tunggu....');
            btnsave.attr('disabled', true);

            if (saveData == 'tambah') {
                url = "<?= base_url('MasterDiklat/add') ?>"
            } else {
                url = "<?= base_url('MasterDiklat/update') ?>"
            }

            $.ajax({
                type: "POST",
                url: url,
                data: formData.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        modal.modal('hide');
                        reloadTable('tab1');

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

        function save1() {
            btnsave.text('Mohon tunggu....');
            btnsave.attr('disabled', true);

            if (saveData == 'tambah') {
                url = "<?= base_url('MasterDiklat/add1') ?>"
            } else {
                url = "<?= base_url('MasterDiklat/update1') ?>"
            }

            $.ajax({
                type: "POST",
                url: url,
                data: formData1.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        modal1.modal('hide');
                        reloadTable('tab2');

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
                url: "<?= base_url('MasterDiklat/byid/') ?>" + kode,
                dataType: "JSON",
                success: function(response) {
                    if (type == 'ubah') {
                        formData.find('input').removeClass('is-invalid');
                        modalTitle.text('Ubah Data');
                        btnsave.text('Ubah Data');
                        btnsave.attr('disabled', false);
                        $('[name="kdjenisdiklat"]').val(response.KdJenisDiklat);
                        $('[name="jenisdiklat"]').val(response.JenisDiklat);
                        $('[name="kodeexternal"]').val(response.KodeExternal);
                        $('[name="namaexternal"]').val(response.NamaExternal);

                        if (response.StatusEnabled == '1') {
                            $('[name="statusaktif"]').prop('checked', true);
                        } else {
                            $('[name="statusaktif"]').prop('checked', false);
                        }

                        modal.modal('show');
                    } else {
                        deleteQuestion(response.KdJenisDiklat, response.JenisDiklat, 'tab1');
                    }
                },
                error: function() {
                    message('error', 'Server gangguan, silahkan ulangi kembali.');
                }
            })
        }

        function byid1(kode, type) {
            if (type == 'ubah') {
                saveData = 'ubah';
                formData[0].reset();
            }

            $.ajax({
                type: "GET",
                url: "<?= base_url('MasterDiklat/byid1/') ?>" + kode,
                dataType: "JSON",
                success: function(response) {
                    if (type == 'ubah') {
                        formData1.find('input').removeClass('is-invalid');
                        modalTitle1.text('Ubah Data');
                        btnsave.text('Ubah Data');
                        btnsave.attr('disabled', false);
                        $('[name="kddiklat"]').val(response.KdDiklat);
                        $('[name="diklat"]').val(response.NamaDiklat);
                        $('[name="jenisdiklat"]').val(response.KdJenisDiklat);
                        $('[name="kodeexternal"]').val(response.KodeExternal);
                        $('[name="namaexternal"]').val(response.NamaExternal);

                        if (response.StatusEnabled == '1') {
                            $('[name="statusaktif"]').prop('checked', true);
                        } else {
                            $('[name="statusaktif"]').prop('checked', false);
                        }

                        modal1.modal('show');
                    } else {
                        deleteQuestion(response.KdDiklat, response.NamaDiklat, 'tab2');
                    }
                },
                error: function() {
                    message('error', 'Server gangguan, silahkan ulangi kembali.');
                }
            })
        }

        function deleteData(kode) {
            type: "POST",
            $.ajax({
                url: "<?= base_url('MasterDiklat/delete/') ?>" + kode,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    reloadTable('tab1');
                    message('success', 'Data Berhasil Dihapus');
                },
                error: function() {
                    message('error', 'Server gangguan, silahkan ulangi kembali.');
                }

            })
        }

        function deleteData1(kode) {
            type: "POST",
            $.ajax({
                url: "<?= base_url('MasterDiklat/delete1/') ?>" + kode,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    reloadTable('tab2');
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