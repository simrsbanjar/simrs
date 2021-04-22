<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container mt-3">
        <!-- Page Heading -->

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $laporan; ?></li>
        </ol>

        <hr>
        <br>
        <form style="font-size:15px" action="<?php echo base_url('DaftarPasienMeninggal/Cetak') ?>" id="formData" method="POST" target="_blank">
            <div class="form-inline">
                <div class="form-group">
                    <label for="awal">Periode</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2 mr-2" id="awal" name="awal" style="width:200px;">
                </div>
                <div class="form-group">
                    <label for="akhir">s/d</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2" id="akhir" name="akhir" style="width:200px;">
                </div>
                <!-- Cetak daftar pasien meninggal dan surat keterangan meninggal -->
                <div class="form-inline">
                    <div class="form-group d-flex bd-highlight">
                        <div class="p-3 order-10 bd-highlight">
                            <buttons type="button" class="btn btn-success" id="print" onclick="AmbilData()"><i class="fas fa-book-dead"></i> Lihat Laporan</buttons>
                        </div>
                        <div class="p-0 order-10 bd-highlight">
                            <button type="submit" value="1" name="tombolcetak" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-inline">
                <div class="form-group">
                    <label for="format">Cari Nama Pasien / No. CM</label>
                    <input type="text" class="form-control" style="margin-left:10px;" id="caritext" name="caritext">
                </div>
            </div>
        </form>


        <div class="table-responsive" style="width:100%">
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <div class="card-body">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Action</th>
                            <th>No. Urut</th>
                            <th>No Pendaftaran</th>
                            <th>No. CM</th>
                            <th>Nama Pasien</th>
                            <th>JK</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Tgl Meninggal</th>
                            <th>Penyebab</th>
                            <th>Tempat Meninggal</th>
                            <th>Dokter Pemeriksa</th>
                            <th>KdRuangan</th>
                            <th>NamaSubInstalasi</th>
                            <th>Umur Tahun</th>
                            <th>Pekerjaan</th>
                            <th>Kd Kelas Akhir</th>
                            <th>DeskKelas</th>
                            <th>Nama Diagnosa</th>
                            <th>KdKelompokPasien</th>
                            <th>Jenis Pasien</th>
                            <th>Kota</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>RTRW</th>
                            <th>Tgl Lahir</th>
                            <th>Id Pegawai</th>
                            <th>Nama Jabatan</th>
                        </tr>
                    </thead>
            </table>
        </div>
    </div>

    <script>
        var saveData;
        var modal = $('#modalData');
        var tableData = $('#myTable');
        var formData = $('#formData');
        var modalTitle = $('#modalTitle');
        var btnsave = $('#btnSave');

        function AmbilData() {
            var awal = $('#awal').val();
            var akhir = $('#akhir').val();
            var caritext = $('#caritext').val();

            tableData.DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('DaftarPasienMeninggal/AmbilData') ?>",
                    "type": "POST",
                    "data": {
                        "awal": awal,
                        "akhir": akhir,
                        "caritext": caritext
                    },
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });

        }
    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->