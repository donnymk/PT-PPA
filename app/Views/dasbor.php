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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <?php
                foreach ($countFollowUp as $row) {
                    $countAll = $row->countAll;
                    $countOpen = $row->countOpen;
                    $countClose = $row->countClose;
                    $countCancel = $row->countCancel;
                }
                ?>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Jumlah Data
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body text-center"><h3><?= $countAll ?></h3></div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="<?= base_url('followup-cbm/resume') ?>">Jumlah Follow Up</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card bg-danger text-white mb-4">
                                            <div class="card-body text-center"><h3><?= $countOpen ?></h3></div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <span class="small text-white stretched-link">Status Open</span>
                                                <!--<div class="small text-white"><i class="fas fa-angle-right"></i></div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card bg-success text-white mb-4">
                                            <div class="card-body text-center"><h3><?= $countClose ?></h3></div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <span class="small text-white stretched-link">Status Close</span>
                                                <!--<div class="small text-white"><i class="fas fa-angle-right"></i></div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card bg-warning text-white mb-4">
                                            <div class="card-body text-center"><h3><?= $countCancel ?></h3></div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <span class="small text-white stretched-link">Status Cancel</span>
                                                <!--<div class="small text-white"><i class="fas fa-angle-right"></i></div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Jumlah Follow Up dengan status Open
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
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
