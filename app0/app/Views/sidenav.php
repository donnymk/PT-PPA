<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
<!--                <div class="sb-sidenav-menu-heading">Umum</div>
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>-->
                <?php
                // jika sudah login dan sebagai owner
                if ($username != null && $role == 'owner') {
                    ?>
                    <div class="sb-sidenav-menu-heading">CBM PLANT-MIP</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        CBM Item
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/PAP') ?>">Program Analisa Pelumas (PAP)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/PM') ?>">Program Pemeriksaan Mesin (PM)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/PPU') ?>">Program Pemeriksaan Undercarriage(PPU)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/CFM') ?>">Cutting Filter (CFM)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/MPI') ?>">Mag Plug Inspection (MPI)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/P2C') ?>">Program Pemeriksaan Cylinder (P2C)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/PAC') ?>">Program Analisa Coolant (PAC)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/VHMS') ?>">On Board Monitoring (OBM) VHMS</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/PAF') ?>">Program Analisa Fuel (PAF)</a>
                            <a class="nav-link" href="<?= base_url('dashboard/cbm/#') ?>">Follow Up CBM (FU CBM)</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="<?= base_url('dashboard/import_cbm') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                        Import CBM Item
                    </a>
                    
                    <div class="sb-sidenav-menu-heading">CLAIM WARRANTY</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCWP" aria-expanded="false" aria-controls="collapseCWP">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        CWP Item
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCWP" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('dashboard/') ?>">Input Claim Warranty</a>
                            <a class="nav-link" href="<?= base_url('dashboard/') ?>">Resume Claim Warranty</a>
                        </nav>
                    </div>
                    
                    <div class="sb-sidenav-menu-heading">FORM</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                        <div class="sb-nav-link-icon"><i class="fas fa-form"></i></div>
                        List Form
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseForm" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('dashboard/') ?>">Form CBM</a>
                            <a class="nav-link" href="<?= base_url('dashboard/') ?>">Form Technical Analysis Report</a>
                        </nav>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        // jika sudah login
        if ($username != null) {
            ?>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $username . ' (' . $role . ')' ?>
            </div>
            <?php
        }
        ?>
    </nav>
</div>