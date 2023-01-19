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
                <h1 class="mt-4">Ubah Password</h1>
<!--                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('followup-cbm') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Input Follow Up</li>
                </ol>-->
<!--                <div class="card mb-4">
                    <div class="card-body">
                        Masukkan data
                    </div>
                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Form Ubah Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('followup-cbm/submit_changepwd') ?>">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" class="form-control" id="inputOldPassword" name="inputOldPassword" required="">
                                        <label for="inputOldPassword">Password Lama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" class="form-control" id="inputNewPassword" name="inputNewPassword" required="">
                                        <label for="inputNewPassword">Password Baru</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" class="form-control" id="inputNewPassword2" name="inputNewPassword2" required="">
                                        <label for="inputNewPassword2">Ketik ulang Password Baru</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block"><span class="fa fa-floppy-disk"></span> Simpan</button></div>
                            </div>
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
