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
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Statistik <?= $currentJobsite ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Status</th><th>Jumlah</th><th>Achievement CWP</th>
                                    </tr>
                                    <?php
                                    if (count($countCWP) == 0) {
                                        ?>
                                        <tr>
                                            <td colspan="3">Tidak ada data pada Jobsite <?= $currentJobsite ?></td>
                                        </tr>
                                        <?php
                                    }
                                    $warranty_decision = [];
                                    $jumlah_cwp = [];
                                    $i = 0;
                                    foreach ($countCWP as $row) {
                                        $warranty_decision[$i] = $row->warranty_decision;
                                        $jumlah_cwp[$i] = $row->jumlah_cwp;
                                        ?>
                                        <tr>
                                            <td><?= $warranty_decision[$i] ?></td>
                                            <td style="text-align: center"><?= $jumlah_cwp[$i] ?></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="col-xl-8">
                                <canvas id="myBarChart" width="100%" height="40"></canvas>
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

<!-- Chart.js -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var warranty_decision = <?= json_encode($warranty_decision) ?>;
    var jumlah_cwp = <?= json_encode($jumlah_cwp) ?>;


// tampilkan grafik Claim Warranty
    function chart_bar_cwp(label, value) {
// Set new default font family and font color to mimic Bootstrap's default styling
        //Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        //Chart.defaults.global.defaultFontColor = '#292b2c';

        const ctx = document.getElementById("myBarChart");
        const options = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        };

        new Chart(ctx, {
            type: 'bar',
            data: {
                //labels: label,
                labels: label,
                datasets: [{
                        label: 'Jumlah CWP',
                        //backgroundColor: 'rgb(252, 116, 101)',
                        data: value,
						backgroundColor: [
						  'rgba(255, 99, 132, 0.2)',
						  'rgba(255, 159, 64, 0.2)',
						  'rgba(75, 192, 192, 0.2)',
						  'rgba(54, 162, 235, 0.2)',
						  'rgba(153, 102, 255, 0.2)'
						],
						borderColor: [
						  'rgb(255, 99, 132)',
						  'rgb(255, 159, 64)',
						  'rgb(75, 192, 192)',
						  'rgb(54, 162, 235)',
						  'rgb(153, 102, 255)'
						],
                        borderWidth: 2
                    }]
            },
            options: options
        });
    }

    chart_bar_cwp(warranty_decision, jumlah_cwp);

</script>

<?= $this->endSection() ?>
