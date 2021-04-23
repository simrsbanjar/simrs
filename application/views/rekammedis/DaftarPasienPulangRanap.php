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

        <form style="font-size:15px" action="<?php echo base_url('DaftarPasienPulangRanap/Cetak') ?>" id="formData" method="POST" target="_blank">
            <div class="form-inline">
                <div class="form-group m-lg-1">
                    <label for="awal">Periode</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2 mr-2" id="awal" name="awal" style="width:200px;">
                </div>
                <div class="form-group">
                    <label for="akhir">s/d</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control ml-2" id="akhir" name="akhir" style="width:200px;">
                </div>

                <?php $jenispasien  = $this->db->query("SELECT * FROM KelompokPasien  WHERE StatusEnabled = '1' ORDER BY JenisPasien ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group mx-sm-4">
                        <label for=" jenispasien" style="margin-left:5px;">Jenis Pasien</label>
                        <select id="jenispasien" name="jenispasien" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="%">- Semua Jenis Pasien -</option>
                            <?php foreach ($jenispasien as $key) { ?>
                                <option value="<?php echo $key->JenisPasien ?>"><?php echo $key->JenisPasien ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <br><br>
                <?php $ruangan  = $this->db->query("SELECT * FROM Ruangan WHERE KdInstalasi = '03' ORDER BY NamaRuangan ASC")->result(); ?>
                <div class="form-inline">
                    <div class="form-group mt-1">
                        <label for=" ruangan">Ruangan</label>
                        <select id="ruangan" name="ruangan" class='form-control' style="width:200px; margin-left:2px;">
                            <option value="%">- Semua Ruangan -</option>
                            <?php foreach ($ruangan as $key) { ?>
                                <option value="<?php echo $key->NamaRuangan ?>"><?php echo $key->NamaRuangan ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <div class="form-inline" style="margin-left:10px;">
                            <!-- <label for="format">Nama Pasien / No. CM</label> -->
                            <input type="hidden" class="form-control" style="margin-left:10px;" id="caritext" name="caritext">
                        </div>
                    </div>
                    <div class="form-group mx-sm-4">
                        <div class="form-inline" style="margin-left:10px;">
                            <label for="format" style="margin-right:10px;">Kondisi Pulang</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radiokondisipulang" id="hidupmati" value="1" checked />
                                <label class="form-check-label" for="inlineRadio1">Hidup dan Mati</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radiokondisipulang" id="hidup" value="2" />
                                <label class="form-check-label" for="inlineRadio2">Hidup</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radiokondisipulang" id="mati" value="3" />
                                <label class="form-check-label" for="inlineRadio3">Mati</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="form-inline" style="margin-top: 10px;">
                <div class="form-group d-flex bd-highlight">
                    <div class="p-3 order-10 bd-highlight">
                        <buttons type="button" class="btn btn-success" id="print" onclick="AmbilData()"><i class="fas fa-book-medical"></i> Lihat Laporan</buttons>
                    </div>
                    <div class="p-0 order-10 bd-highlight">
                        <button type="submit" value="1" name='tombolcetak' class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                    </div>
                    <div class="p-0 order-10 bd-highlight" style="margin-left:15px;">
                        <button type="submit" value="2" name='tombolcetak' class="btn btn-primary"><i class="fa fa-print"></i> Cetak Kondisi Pulang</button>
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
                            <th>JK</th>
                            <th>Tgl. Lahir</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Tgl. Masuk</th>
                            <th>Jenis Pasien</th>
                            <th>Ruangan</th>
                            <th>Tgl. Pulang</th>
                            <th>Lama Dirawat</th>
                            <th>Jenis Diagnosa</th>
                            <th>Kode Diagnosa</th>
                            <th>Nama Diagnosa</th>
                            <th>Dokter</th>
                            <th>Status Pulang</th>
                            <th>Kondisi Pulang</th>
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
            var jenispasien = $('#jenispasien').val();
            var ruangan = $('#ruangan').val();
            var caritext = $('#caritext').val();
            var kondisipulang = $("input:radio[name=radiokondisipulang]:checked").val()

            tableData.DataTable({
                // "dom": "<'row'<'col-sm-2'l><'col-sm-7'f>>" +
                //     "<'row'<'col-sm-12'tr>>" +
                //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('DaftarPasienPulangRanap/AmbilData') ?>",
                    "type": "POST",
                    "data": {
                        "awal": awal,
                        "akhir": akhir,
                        "jenispasien": jenispasien,
                        "ruangan": ruangan,
                        "caritext": caritext,
                        "kondisipulang": kondisipulang
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

<!-- </div> -->
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->