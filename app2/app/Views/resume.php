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
                <h1 class="mt-4">Resume CWP</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('claim-warranty') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Resume CWP</li>
                </ol>
                <!--                <div class="card mb-4">
                                    <div class="card-body">
                                        DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                        <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                        .
                                    </div>
                                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Resume Claim Warranty Proposal
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-bordered" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No.</th>
                                    <th>Jobsite</th>
                                    <th>Claim Date</th>
                                    <th>Claim To</th>
                                    <th>Model Unit</th>
                                    <th>Code Unit</th>
                                    <th>Komponen</th>
                                    <th>Sub Komponen</th>
                                    <th>Fitment Date</th>
                                    <th>HM/KM Fitment</th>
                                    <th>Trouble Date</th>
                                    <th>HM/KM Trouble</th>
                                    <th>Lifetime</th>
                                    <th>Problem Issue</th>
                                    <th>Supporting Comments</th>
                                    <th>Part Number</th>
                                    <!--<th>Desc</th>-->
                                    <th>Qty</th>
                                    <th>Amount Part (USD)</th>
                                    <th>Warranty Status</th>
                                    <th>Final Amount (USD)</th>
                                    <th>Closing Date</th>
                                    <th>Remark Progress</th>
                                    <th>Leadtime Warranty (Days)</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>

<script>
function confirm_del(id){
    return confirm('Apakah Anda yakin ingin menghapus data dengan no. '+id+'?');
}
</script>

<?= $this->endSection() ?>
