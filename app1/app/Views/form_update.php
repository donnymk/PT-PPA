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
                <h1 class="mt-4">Update Follow Up</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('followup-cbm') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('followup-cbm/resume') ?>">Resume Follow Up</a></li>
                    <li class="breadcrumb-item active">Update Follow Up</li>
                </ol>
                <!--                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        Masukkan data
                                                    </div>
                                                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Form Update Follow Up CBM
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('followup-cbm/update_followup') ?>">
                            <?php
                            foreach ($followup as $row) {
                                $no_follow_up = $row->no_follow_up;
                                $code_unit = $row->code_unit;
                                $model = $row->model;
                                $komponen = $row->komponen;
                                $cbm = $row->cbm;
                                $deskripsi_problem = $row->deskripsi_problem;
                                $rekomendasi_follow_up = $row->rekomendasi_follow_up;
                                $input_timestamp = $row->input_timestamp;
                                $plan_date_follow_up = $row->plan_date_follow_up;
                                $executed = $row->executed;
                                $date_executed = $row->date_executed;
                                $pic = $row->pic;
                                $follow_up_status = $row->follow_up_status;
                                $reason_if_cancelled = $row->reason_if_cancelled;
                                $input2_timestamp = $row->input2_timestamp;
                            }
                            ?>
                            <div class="row mb-3">
                                <label style="font-size: small">Input time: <?= $input_timestamp ?></label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="noFollowup" value="<?= $no_follow_up ?>">
                                        <input type="text" class="form-control" value="<?= $model ?>" disabled>
                                        <label>Model Unit</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="<?= $code_unit ?>" disabled>
                                        <label>Code Unit</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="<?= $komponen ?>" disabled>
                                        <label>Komponen</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="<?= $cbm ?>" disabled>
                                        <label>Temuan CBM Apa?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" disabled><?= $deskripsi_problem ?></textarea>
                                <label>Dekripsi Problem</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control" value="<?= $rekomendasi_follow_up ?>" disabled>
                                        <label>Rekomendasi Follow Up</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="date" class="form-control" value="<?= $plan_date_follow_up ?>" disabled>
                                        <label>Plan Date Follow Up</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <hr>
                                <label style="font-size: small">Input time: <?= $input2_timestamp ?></label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="hasExecuted" name="hasExecuted" required="">
                                            <option value="0"<?= ($executed === '0' ? ' selected' : '') ?>>No</option>
                                            <option value="1"<?= ($executed === '1' ? ' selected' : '') ?>>Yes</option>
                                        </select>
                                        <label for="hasExecuted">Has Follow Up Executed?</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="date" class="form-control" id="dateExecuted" name="dateExecuted" value="<?= $date_executed ?>">
                                        <label for="dateExecuted">Date Executed (if yes)</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control" id="pic" name="pic" value="<?= $pic ?>">
                                        <label for="pic">PIC</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="followupStatus" name="followupStatus" required="">
                                            <option value="Open"<?= ($follow_up_status === 'Open' ? ' selected' : '') ?>>Open</option>
                                            <option value="Close"<?= ($follow_up_status === 'Close' ? ' selected' : '') ?>>Close</option>
                                            <option value="Cancel"<?= ($follow_up_status === 'Cancel' ? ' selected' : '') ?>>Cancel</option>
                                        </select>
                                        <label for="followupStatus">Follow Up Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control" id="reasonCancelled" name="reasonCancelled" value="<?= $reason_if_cancelled ?>">
                                        <label for="reasonCancelled">Reason if cancelled</label>
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
