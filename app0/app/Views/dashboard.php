<?= $this->extend('default') ?>

<?= $this->section('isiHalaman') ?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Isi top navigation -->
    <?= $this->include('topnavbar') ?>
</nav>
<div id="layoutSidenav">
    <!-- Isi side navigation -->
    <?= $this->include('sidenav') ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="font-weight: bold">
                <h1 class="mt-4">DASHBOARD PLANT ENGINEER</h1>
                <h2>PT. PPA - SITE MIP</h2>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard CBM</a></li>
                    <!--<li class="breadcrumb-item active">Sidenav Light</li>-->
                </ol>
                <?php
                // cek flash data untuk memberitahu status import data CBM (jika baru saja diimport)
                if (isset($_SESSION['inputCBMStatus'])) {
                    ?>
                    <div class="alert alert-light alert-dismissible border-success text-success fade show" role="alert">
                        <?= $session->getFlashdata('inputCBMStatus') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                
                    <?php
                }
                //var_dump($stat_dashboard);
                foreach ($stat_dashboard as $key => $value):
                    $pap_danger = $value->pap_danger;
                    //$pap_danger = 0;
                    $pap_urgent = $value->pap_urgent;
                    //$pap_urgent = 0;
                    $cfm_danger = $value->cfm_danger;
                    $cfm_urgent = $value->cfm_urgent;
                    $mpi_danger = $value->mpi_danger;
                    $mpi_urgent = $value->mpi_urgent;
                    
                endforeach
                ?>
                <div class="row">
                    <!--PAP Danger-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $pap_danger == '0' ? 'bg-light text-dark':'bg-dark text-white' ?> border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-droplet"></span>
                                        </td>
                                        <td>
                                            &nbsp;PAP Danger<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small <?= $pap_danger == '0' ? 'text-dark':'text-white' ?> stretched-link" href="<?= base_url('dashboard/cbm/PAP/D') ?>"><?= $pap_danger ?> Issue(s)</a>
                                <div class="small <?= $pap_danger == '0' ? 'text-dark':'text-white' ?>"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--PAP Urgent-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $pap_urgent == '0' ? 'bg-light text-dark':'bg-danger text-white' ?> border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-droplet"></span>
                                        </td>
                                        <td>
                                            &nbsp;PAP Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small <?= $pap_urgent == '0' ? 'text-dark':'text-white' ?> stretched-link" href="<?= base_url('dashboard/cbm/PAP/C') ?>"><?= $pap_urgent ?> Issue(s)</a>
                                <div class="small <?= $pap_urgent == '0' ? 'text-dark':'text-white' ?>"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--CFM Danger-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $cfm_danger == '0' ? 'bg-light text-dark' : 'bg-danger text-white' ?> border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="<?= $cfm_danger == '0' ? base_url('assets/img/icons8-air-filter-99.png') : base_url('assets/img/icons8-air-filter-99-white.png') ?>" height="50px" alt=""/>
                                        </td>
                                        <td>
                                            &nbsp;CFM Danger<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small <?= $cfm_danger == '0' ? 'text-dark':'text-white' ?> stretched-link" href="<?= base_url('dashboard/cbm/CFM/D') ?>"><?= $cfm_danger ?> Issue(s)</a>
                                <div class="small <?= $cfm_danger == '0' ? 'text-dark':'text-white' ?>"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--CFM Urgent-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $cfm_urgent == '0' ? 'bg-light text-dark' : 'bg-danger text-white' ?> border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="<?= $cfm_urgent == '0' ? base_url('assets/img/icons8-air-filter-99.png') : base_url('assets/img/icons8-air-filter-99-white.png') ?>" height="50px" alt=""/>
                                        </td>
                                        <td>
                                            &nbsp;CFM Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small <?= $cfm_urgent == '0' ? 'text-dark':'text-white' ?> stretched-link" href="<?= base_url('dashboard/cbm/CFM/C') ?>"><?= $cfm_urgent ?> Issue(s)</a>
                                <div class="small <?= $cfm_urgent == '0' ? 'text-dark':'text-white' ?>"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!--MagPlug Danger-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $mpi_danger == '0' ? 'bg-light text-dark' : 'bg-dark text-white' ?> border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-magnifying-glass"></span>
                                        </td>
                                        <td>
                                            &nbsp;MagPlug Danger<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small <?= $mpi_danger == '0' ? 'text-dark':'text-white' ?> stretched-link" href="<?= base_url('dashboard/cbm/MPI/D') ?>"><?= $mpi_danger ?> Issue(s)</a>
                                <div class="small  <?= $mpi_danger == '0' ? 'text-dark':'text-white' ?>"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--MagPlug Urgent-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $mpi_urgent == '0' ? 'bg-light text-dark' : 'bg-danger text-white' ?> border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-magnifying-glass"></span>
                                        </td>
                                        <td>
                                            &nbsp;MagPlug Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small  <?= $mpi_urgent == '0' ? 'text-dark':'text-white' ?> stretched-link" href="<?= base_url('dashboard/cbm/MPI/C') ?>"><?= $mpi_urgent ?> Issue(s)</a>
                                <div class="small  <?= $mpi_urgent == '0' ? 'text-dark':'text-white' ?>"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--PPM Urgent-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-gears"></span>
                                        </td>
                                        <td>
                                            &nbsp;PPM Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">XX Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--PPU Bad-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-truck-ramp-box"></span>
                                        </td>
                                        <td>
                                            &nbsp;PPU Bad<br>
                                            &nbsp;Condition
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">XX Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!--PAF Urgent-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-gas-pump"></span>
                                        </td>
                                        <td>
                                            &nbsp;PAF Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">XX Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!--PAC Urgent-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white border-dark mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <span class="fa fa-3x fa-temperature-low"></span>
                                        </td>
                                        <td>
                                            &nbsp;PAC Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">XX Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>

<?= $this->endSection() ?>
