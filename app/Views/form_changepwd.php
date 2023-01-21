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
                <?php
                // cek flash data untuk memberitahu status ubah password
                if (isset($_SESSION['changePasswordStatus'])) {
                    ?>
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <?= $session->getFlashdata('changePasswordStatus'); ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Form Ubah Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('followup-cbm/submit_changepwd') ?>">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="inputOldPassword" class="form-label">Password saat ini</label>
                                    <div class="input-group mb-3">
                                        <input id="inputOldPassword" type="password" class="form-control" name="inputOldPassword" required="" aria-label="Password saat ini" aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1" onclick="password1_show_hide();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>                           
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="inputNewPassword" class="form-label">Password baru</label>
                                    <div class="input-group mb-3">
                                        <input id="inputNewPassword" type="password" class="form-control" name="inputNewPassword" required="" aria-label="Password baru" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2" onclick="password2_show_hide();">
                                            <i class="fas fa-eye" id="show_eye2"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                                        </span>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">
                                    <label for="inputNewPassword2" class="form-label">Ketik ulang Password Baru</label>
                                    <div class="input-group mb-3">
                                        <input id="inputNewPassword2" type="password" class="form-control" name="inputNewPassword2" required="" aria-label="Password baru 2" aria-describedby="basic-addon3">
                                        <span class="input-group-text" id="basic-addon3" onclick="password3_show_hide();">
                                            <i class="fas fa-eye" id="show_eye3"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye3"></i>
                                        </span>
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
