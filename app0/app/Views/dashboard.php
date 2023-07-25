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
            <div class="container-fluid px-4">
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
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <?= $session->getFlashdata('inputCBMStatus') ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-dark text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">99 Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">99 Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="<?= base_url('assets/img/icons8-air-filter-99-white.png') ?>" height="50px" alt=""/>
                                        </td>
                                        <td>
                                            &nbsp;CFM Danger<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="<?= base_url('assets/img/icons8-air-filter-99-white.png') ?>" height="50px" alt=""/>
                                        </td>
                                        <td>
                                            &nbsp;CFM Urgent<br>
                                            &nbsp;Still Open
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-dark text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">99 Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">99 Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">99 Issue(s)</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
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
                                <a class="small text-white stretched-link" href="#">99 Issue(s)</a>
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
