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

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
// tamppilkan grafik jumlah follow up yang berstatus "Open"
    function chart_bar_followup_open() {
// Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';


        var ctx = document.getElementById("myBarChart");

        fetch("jumlah_followup_open", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        })
                .then((response) => response.json())
                .then((data) => {
                    var label = [];
                    var value = [];
                    for (var i in data) {
                        label.push(data[i].cbm);
                        value.push(data[i].jumlahdata);
                    }
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: label,
                            datasets: [{
                                    label: 'Jumlah Follow Up',
                                    backgroundColor: 'rgb(252, 116, 101)',
                                    borderColor: 'rgb(255, 255, 255)',
                                    data: value
                                }]
                        },
                        options: {scales: {
                                xAxes: [{
                                        time: {
                                            unit: 'month'
                                        },
                                        gridLines: {
                                            display: false
                                        },
                                        ticks: {
                                            maxTicksLimit: 6
                                        }
                                    }],
                                yAxes: [{
                                        ticks: {
                                            maxTicksLimit: 1
                                        },
                                        gridLines: {
                                            display: true
                                        }
                                    }],
                            },
                            legend: {
                                display: false
                            }}
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
    }
    
    chart_bar_followup_open();
    
</script>

<?= $this->endSection() ?>
