<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Umum</div>
                <a class="nav-link" href="<?= base_url('followup-cbm') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Admin</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                    Master
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('followup-cbm/data_model_unit') ?>">Populasi</a>
                        <a class="nav-link" href="<?= base_url('followup-cbm/data_komponen') ?>">Komponen</a>
                        <a class="nav-link" href="<?= base_url('followup-cbm/data_rekomendasi') ?>">Rekomendasi</a>
                    </nav>
                </div>
                <a class="nav-link" href="<?= base_url('followup-cbm/input') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                    Input Follow Up
                </a>
                <a class="nav-link" href="<?= base_url('followup-cbm/resume') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Resume Follow Up
                </a>
            </div>
        </div>
        <?php
        if($username != null){
        ?>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $username.' ('.$role.')' ?>
        </div>
        <?php
        }
        ?>
    </nav>
</div>