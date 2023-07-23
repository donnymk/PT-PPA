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
                <h1 class="mt-4">IMPORT DATA CBM</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Import Data CBM</li>
                </ol>
                <?php
                // cek flash data untuk memberitahu status ubah password
                if (isset($_SESSION['inputJobsiteStatus'])) {
                    ?>
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <?= $session->getFlashdata('inputJobsiteStatus') ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Import Data CBM
                    </div>
                    <div class="card-body table-responsive">
                        <form method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/submit_cbm') ?>">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="file" class="form-control" name="dataCbmExcel" required="">
                                <label>Data CBM (format Excel / .xlsx)</label>
                            </div>
                            <br>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>

<?= $this->endSection() ?>
