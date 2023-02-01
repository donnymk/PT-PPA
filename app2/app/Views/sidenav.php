<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Umum</div>
                <a class="nav-link" href="<?= base_url('claim-warranty') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <?php
                // jika sudah login
                if($username != null){
                ?>
                <div class="sb-sidenav-menu-heading">Admin</div>
                <?php
                // jika role = owner
                if($role == 'owner'){
                ?>                
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Master
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('claim-warranty/data_jobsite') ?>">Jobsite</a>
                            <a class="nav-link" href="<?= base_url('claim-warranty/data_populasi') ?>">Populasi</a>
                        </nav>
                    </div>
                <?php
                }
                ?>                
                <a class="nav-link" href="<?= base_url('claim-warranty/input_cwp') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                    Input Claim Warranty
                </a>
                <a class="nav-link" href="<?= base_url('claim-warranty/resume') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Resume Claim Warranty
                </a>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        // jika sudah login
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