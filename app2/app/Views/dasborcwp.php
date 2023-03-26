<?= $this->extend('default') ?>

<?= $this->section('isiHalaman') ?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
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
                Jobsite: 
                <a href="<?= base_url('claim-warranty') ?>" class="btn <?= ($currentJobsite == '' ? 'active' : '') ?> btn-outline-danger">All</a>
                <?php
                foreach ($jobsiteData as $row) {
                    //
                    if ($currentJobsite == $row->jobsite) {
                        ?>
                        <a href="<?= base_url('claim-warranty/index/' . $row->jobsite) ?>" class="btn active btn-outline-success"><?= $row->jobsite ?></a>
                        <?php
                    }
                    //
                    else {
                        ?>
                        <a href="<?= base_url('claim-warranty/index/' . $row->jobsite) ?>" class="btn btn-outline-success"><?= $row->jobsite ?></a>
                        <?php
                    }
                }
                ?>
                <br><br>
                <div class="row">
                    <div class="col-xl-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Statistik <?= $currentJobsite ?>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Status</th><th>Jumlah</th><th>Achievement CWP</th>
                                    </tr>
                                    <?php
                                    if(count($countCWP) == 0){
                                        ?>
                                        <tr>
                                            <td colspan="3">Tidak ada data pada Jobsite <?= $currentJobsite ?></td>
                                        </tr>
                                        <?php                                        
                                    }
                                    foreach ($countCWP as $row) {
                                        $warranty_decision = $row->warranty_decision;
                                        $jumlah_cwp = $row->jumlah_cwp;
                                        ?>
                                        <tr>
                                            <td><?= $warranty_decision ?></td>
                                            <td style="text-align: center"><?= $jumlah_cwp ?></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>

                            </div>
                        </div>
                    </div>
<!--                    <div class="col-xl-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Claim Warranty Graphic
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
// tampilkan grafik Claim Warranty


</script>

<?= $this->endSection() ?>
