<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">

                            <div class="text-center">
                                <img src="<?= base_url('assets/') ?>img/simrs/logo.png" width="320px"><img>
                            </div>
                            <!-- <hr> -->
                            <div class="p-2">

                                <center>
                                    <!-- <h4 class="shadow-sm p-3 bg-white" style="color: black;">Sistem Informasi Manajamen Rumah Sakit</h4> -->
                                    <img src="<?= base_url('assets/'); ?>img/simrs/kata simrs.png">
                                    <h4>Sistem Informasi Manajamen Rumah Sakit</h4>
                                </center>
                                <br>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" name="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <?php $ruangan  = $this->db->query("SELECT * FROM Ruangan ORDER BY NamaRuangan ASC")->result(); ?>

                                    <div class="form-group">
                                        <select name="ruangan" class='form-control'>
                                            <option value="0">- Pilih Ruangan -</option>
                                            <?php foreach ($ruangan as $key) { ?>
                                                <option value="<?php echo $key->KdRuangan ?>"><?php echo $key->NamaRuangan ?> </option>
                                            <?php } ?>
                                        </select>
                                        <?= form_error('ruangan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span style="color: white;">Copyright &copy; SIMRS RSU Kota Banjar <?= date('Y'); ?></span>
        </div>
    </div>

</div>

<script>
    document.onkeydown = function(evt) {
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if (keyCode == 13) {
            //your function call here
            document.user.submit();
        }
    }
</script>