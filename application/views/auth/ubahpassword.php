<!-- Begin Page Content -->
<div class="container-fluid">



    <div class="container-fluid">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $laporan; ?></li>
        </ol>

        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="row">
            <div class="col-lg-6">
                <?= $this->session->flashdata('message'); ?>
                <form action="<?= base_url('UbahPassword') ?>" method="post">
                    <div class="form-group">
                        <label for="currentpassword">Password Lama</label>
                        <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                        <?= form_error('currentpassword', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword1">Password Baru</label>
                        <input type="password" class="form-control" id="newpassword1" name="newpassword1">
                        <?= form_error('newpassword1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword2">Ulangi Password</label>
                        <input type="password" class="form-control" id="newpassword2" name="newpassword2">
                        <?= form_error('newpassword2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->