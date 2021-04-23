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

        <form style="font-size:15px" action="<?php echo base_url('DaftarPasienRajal/Cetak') ?>" id="formData" method="POST" target="_blank">
            <div class="form-inline">
                <div class="form-group">
                    <label for="awal">Periode</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2 mr-2" id="awal" name="awal" style="width:200px;">
                </div>
                <div class="form-group">
                    <label for="akhir">s/d</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2" id="akhir" name="akhir" style="width:200px;">
                </div>

                <?php $jenispasien  = $this->db->query("SELECT * FROM KelompokPasien  WHERE StatusEnabled = '1' ORDER BY JenisPasien ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group">
                        <label for=" jenispasien" style="margin-left:5px;">Jenis Pasien</label>
                        <select id="jenispasien" name="jenispasien" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="%">- Semua Jenis Pasien -</option>
                            <?php foreach ($jenispasien as $key) { ?>
                                <option value="<?php echo $key->JenisPasien ?>"><?php echo $key->JenisPasien ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="form-group d-flex bd-highlight">
                        <div class="p-3 order-10 bd-highlight">
                            <buttons type="button" class="btn btn-success" id="print" onclick="AmbilData()"><i class="fas fa-book-medical"></i> Lihat Laporan</buttons>
                        </div>
                        <div class="p-0 order-10 bd-highlight">
                            <button type="submit" value="Cetak" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </div>


                <br><br>
                <?php $ruangan  = $this->db->query("SELECT * FROM Ruangan WHERE KdInstalasi = '02' ORDER BY NamaRuangan ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group mt-0">
                        <label for=" ruangan">Ruangan</label>
                        <select id="ruangan" name="ruangan" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="%">- Semua Ruangan -</option>
                            <?php foreach ($ruangan as $key) { ?>
                                <option value="<?php echo $key->KdRuangan ?>"><?php echo $key->NamaRuangan ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <div class="form-inline" style="margin-left:10px;">
                            <!-- <label for="format">Nama Pasien / No. CM</label> -->
                            <input type="hidden" class="form-control" style="margin-left:10px;" id="caritext" name="caritext">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive" style="width:100%">
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
                            <th>Ruangan</th>
                            <th>Nama Diagnosa</th>
                            <th>Tgl. Masuk</th>
                            <th>Tgl. Lahir</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                </div>
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
            var jenispasien = $('#jenispasien').val();
            var ruangan = $('#ruangan').val();
            var caritext = $('#caritext').val();

            tableData.DataTable({
                // "dom": "<'row'<'col-sm-2'l><'col-sm-5'f>>" +
                //     "<'row'<'col-sm-12'tr>>" +
                //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('DaftarPasienRajal/AmbilData') ?>",
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
    </script>

    <!-- </div> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->