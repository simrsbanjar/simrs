<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-hospital-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMRS</div>
    </a>

    <?php $menu          = $this->db->query("SELECT * FROM ListMenuWeb WHERE StatusEnabled = '1' ")->result();  ?>

    <!-- Divider -->
    <br>
    <hr class="sidebar-divider my-0">
    <br>

    <?php foreach ($menu as $key) { ?>
        <div class="sidebar-heading" style="font-size: 12px;">
            <?php echo $key->NamaMenu; ?>
        </div>

        <li class="nav-item">
            <?php $mensub       = $this->db->get_where('SubListMenuWeb', ['NoIndex_p' => $key->NoIndex])->result(); ?>

            <?php if ($mensub) { ?>
                <?php foreach ($mensub as $key_s) { ?>
                    <?php $mendsub       = $this->db->query("SELECT * FROM DtlSubListMenuWeb WHERE NoIndex_p = '" . $key->NoIndex . "' AND NoIndex_p_s = '" . $key_s->NoIndex . "' AND StatusEnabled ='1'")->result(); ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span style="font-size: 13px;"><?php echo $key_s->NamaMenu; ?></span>
            </a>
            <?php foreach ($mendsub as $key_ds) { ?>
                <?php $menrdsub       = $this->db->query("SELECT * FROM RincDtlSubListMenuWeb WHERE NoIndex_p = '" . $key->NoIndex . "' AND NoIndex_p_s = '" . $key_s->NoIndex . "' AND NoIndex_p_s_d ='" . $key_ds->NoIndex . "'AND StatusEnabled ='1'")->result(); ?>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-header"><?php echo $key_ds->NamaMenu; ?></a>
                            <?php foreach ($menrdsub as $key_rds) { ?>
                                <a style="font-size: 12px;" class="collapse-item" href="<?php echo $key_rds->Object; ?>"><?php echo $key_rds->NamaMenu; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </li>
    <?php } ?>

<?php } else { ?>
    <a class="nav-link" href="<?= base_url('submenu'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>
            <?php echo $key->NamaMenu; ?>
        </span>
    <?php } ?>
    </a>
    </li>
<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->