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
                <?php
                // cek flash data untuk memberitahu status truncate data CBM
                if (isset($_SESSION['truncateStatus'])) {
                    ?>
                    <div class="alert alert-light alert-dismissible border-success text-success fade show" role="alert">
                        <?= $session->getFlashdata('truncateStatus') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <h4>Riwayat import data CBM</h4>
                        <?php
                        $line_count = 0;
                        $upload_count = count($data_excel);
                        foreach ($data_excel as $key => $value):
                            $line_count++;
                            ?>
                            Waktu: <?= $value->timestamp ?><br>
                            File Excel: <a href="uploads/<?= $value->lokasi ?>"><?= $value->nama_file_ori ?></a>
                            <?php
                            if ($line_count != $upload_count) {
                                echo '<hr>';
                            }
                        endforeach;
                        if ($upload_count == 0) {
                            echo 'Tidak ada';
                        }
                        ?>
                        <br><br>
                        <h4>Import data CBM baru</h4>
                        <ul>
                            <li style="font-weight: bold">Import data akan menambahkan data ke database dan tidak akan menghapus data yang sudah ada.</li>
                            <li>Format file Excel harus .xlsx (Office 2007 ke atas)</li>
                            <li>Contoh isi file Excel <b>untuk PAP</b> silahkan <a href="<?= base_url('assets/xlsx/sample-upload-pap.xlsx') ?>" target="_blank">klik di sini</a>.</li>
							<li>Contoh isi file Excel <b>selain PAP</b> silahkan <a href="<?= base_url('assets/xlsx/sample-upload-non-pap.xlsx') ?>" target="_blank">klik di sini</a>.</li>
                        </ul>

                        <form method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/submit_cbm') ?>">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="file" class="form-control" name="dataCbmExcel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required="">
                                <label>Data CBM (format Excel .xlsx)</label>
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
                        <p>Klik tombol di bawah ini untuk mengosongkan semua data CBM (yang sudah diupload sebelumnya).</p>
                        <a class="btn btn-secondary" href="<?= base_url('dashboard/truncate_data_cbm') ?>" onclick="return confirm_truncate()">Kosongkan data CBM</a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>
<script>
    function confirm_truncate() {
        return confirm('Yakin ingin mengosongkan data?');
    }
</script>
<?= $this->endSection() ?>
