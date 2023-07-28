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
                <h1 class="mt-4">Kelola CBM Item</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola CBM Item</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Import Data CBM
                    </div>
                    <div class="card-body table-responsive">
                        <?php
                        foreach ($data_excel as $key => $value):
                            ?>
                            <h4>Terakhir import data CBM</h4>
                            Waktu: <?= $value->timestamp ?><br>
                            File Excel: <a href="uploads/<?= $value->lokasi ?>"><?= $value->nama_file_ori ?></a>
                            <?php
                        endforeach
                        ?>
                        <br><br>
                        <h4>Import data CBM baru</h4>
                        <p>Import data akan menambahkan data ke database dan tidak akan menghapus data yang sudah ada.</p>
                        <form method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/submit_cbm') ?>">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="file" class="form-control" name="dataCbmExcel" required="">
                                <label>Data CBM (format Excel / .xlsx)</label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Kosongkan Data CBM
                    </div>
                    <div class="card-body table-responsive">
                        <h4>Kosongkan data CBM</h4>
                        <p>Klik tombol di bawah ini untuk mengosongkan semua data CBM.</p>
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Kosongkan data CBM</a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>

<?= $this->endSection() ?>
