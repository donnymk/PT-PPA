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
                <h1 class="mt-4">Resume Follow Up</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('followup-cbm') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Resume Follow Up</li>
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
                        Resume Follow Up
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th class="dt-head-center" colspan="10">Data Follow Up</th>
                                    <th class="dt-head-center" colspan="6">Ekseksusi Follow Up</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Model Unit</th>
                                    <th>Code Unit</th>
                                    <th>Komponen</th>
                                    <th>CBM</th>
                                    <th>Deskripsi Problem</th>
                                    <th>Rekomendasi Follow Up</th>
                                    <th>Plan Date Follow Up</th>
                                    <th>Remarks</th>
                                    <th>Cetak form</th>
                                    <th>Has Follow Up Executed?</th>
                                    <th>Date Executed (if yes)</th>
                                    <th>PIC</th>
                                    <th>Follow Up Status</th>
                                    <th>Reason if Cancelled</th>
                                    <th>Action</th>
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
    return confirm('Apakah Anda yakin ingin menghapus data dengan no. follow up '+id+'?');
}
</script>

<?= $this->endSection() ?>
