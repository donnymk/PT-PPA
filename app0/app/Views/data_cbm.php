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
                <h1 class="mt-4">CBM Item</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">CBM Item (<?= $jenis_cbm ?>)</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header form-inline" style="font-weight: bold">
                        <i class="fas fa-table me-1"></i>
                        Data CBM <?= $jenis_cbm ?>
                    </div>
                    <div class="card-body table-responsive">
                        <ul class="nav nav-tabs nav-fill">
                            <li class="nav-item">
                                <a class="nav-link<?= $result == 'All' ? ' active' : '' ?>" <?= $result == 'All' ? 'aria-current="page"' : '' ?> href="<?= base_url('dashboard/cbm/' . $jenis_cbm) ?>">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= $result == 'D' ? ' active' : '' ?>" <?= $result == 'D' ? 'aria-current="page"' : '' ?> href="<?= base_url('dashboard/cbm/' . $jenis_cbm . '/D') ?>">Danger</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= $result == 'C' ? ' active' : '' ?>" <?= $result == 'C' ? 'aria-current="page"' : '' ?> href="<?= base_url('dashboard/cbm/' . $jenis_cbm . '/C') ?>">Urgent</a>
                            </li>
                        </ul>
                        <!-- Button trigger modal -->
                        <!--                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Tambah Populasi
                                                </button>
                                                <br><br>-->
                        <!-- Untuk filtering data, yang didefinisikan melalui javascript -->
                        <div class="row g-3 mt-auto mb-2">
                            <div class="col-auto">
                                <label class="form-control-plaintext">Workgroup</label>
                            </div>
                            <div class="col-auto">
                               <span id="filter1"></span>
                            </div>
                            <div class="col-auto">
                                <label class="form-control-plaintext">Model</label>
                            </div>
                            <div class="col-auto">
                                <span id="filter2"></span>
                            </div>
                        </div>
                        <!--/ Untuk filtering data, yang didefinisikan melalui javascript -->

                        <table class="table table-bordered" id="dataCbm">
                            <thead>
                                <tr style="vertical-align: middle">
                                    <th>#</th>
                                    <th>Workgroup</th>
                                    <th>Unit Code</th>
                                    <th>Model</th>
                                    <th>Component</th>
                                    <th>Date <?= $jenis_cbm ?></th>
                                    <th>HM <?= $jenis_cbm ?></th>
                                    <th><?= $jenis_cbm ?> Result</th>
                                    <th>Analisis Lab</th>
                                    <th>Rekomendasi Lab</th>
                                    <th>Follow Up</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($cbm_item as $key => $value):
                                    $no++;
                                    $need_followup = ['B', 'C', 'D'];
                                    $fontcolor = 'black';
                                    switch($value->sample_result){
                                        case 'D': $bgcolor = '#111'; //black lighter
                                            $fontcolor = 'white';
                                            break;
                                        case 'C': $bgcolor = 'red';
                                            $fontcolor = 'white';
                                            break;
                                        case 'B': $bgcolor = 'yellow';
                                            break;
                                        default: $bgcolor = 'green';
                                            $fontcolor = 'white';
                                            break;
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->workgroup ?></td>
                                        <td><?= $value->unitcode ?></td>
                                        <td><?= $value->model ?></td>
                                        <td><?= $value->component ?></td>
                                        <td><?= $value->date_pap ?></td>
                                        <td><?= $value->hm_pap ?></td>
                                        <td style="background-color:  <?= $bgcolor ?>; color: <?= $fontcolor ?>; text-align: center"><?= $value->sample_result ?></td>
                                        <td><?= $value->analysis_lab ?></td>
                                        <td><?= $value->rekomendasi_lab ?></td>
                                        <td>
                                            <?php
                                            if (in_array($value->sample_result, $need_followup)) {
                                                ?>
                                            <a href="<?= base_url('followup-cbm/input') ?>" target="_blank">Follow Up</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach
                                ?>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Populasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('claim-warranty/input_populasi') ?>">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-2">
                                <input type="text" class="form-control" name="inputMachineMaker" required="">
                                <label>Machine Maker</label>
                            </div>
                        </div></div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="text" class="form-control" name="inputModelUnit" required="">
                                <label>Model Unit</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="text" class="form-control" name="inputCodeUnit" required="">
                                <label>Code Unit</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <!--            <div class="modal-footer">

                        </div>-->
        </div>
    </div>
</div>

<?= $this->endSection() ?>
