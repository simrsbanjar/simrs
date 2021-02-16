<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahgelarModal"><i class="fa fa-plus"></i>Tambah Gelar</button>

            <table class=" table table-hover table-bordered table-sm">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">Kode</th>
                        <th scope="col">Title</th>
                        <th scope="col">Kode External</th>
                        <th scope="col">Nama External</th>
                        <th scope="col">Status Enabled</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gelar as $glr) : ?>
                        <tr>
                            <th scope="row" style="text-align: center;"><?= $glr['KdTitle']; ?></th>
                            <td><?= $glr['NamaTitle']; ?></td>
                            <td><?= $glr['KodeExternal']; ?></td>
                            <td><?= $glr['NamaExternal']; ?></td>
                            <?php if ($glr['StatusEnabled'] == '1') { ?>
                                <td style="text-align: center;"> Aktif </td>
                            <?php } else { ?>
                                <td style="text-align: center;"> Tidak Aktif </td>
                            <?php }; ?>
                            <td style="text-align: center;">
                                <a href="" class="badge-success">Edit</a>
                                <a href="" class="badge-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahgelarModal" tabindex="-1" aria-labelledby="tambahgelarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahgelarModalLabel">Form Tambah Gelar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('MasterGelar'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= set_value('judul'); ?>">
                            <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kodeexternal" class="col-sm-4 col-form-label">Kode External</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="kodeexternal" name="kodeexternal">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="statusaktif">Status Aktif</label>
                            <input class="form-check-input col-9" type="checkbox" value="1" id="statusaktif" name="statusaktif" checked <?= set_checkbox('statusaktif', '1'); ?>>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namaexternal" class="col-sm-4 col-form-label">Nama External</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="namaexternal" name="namaexternal">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>