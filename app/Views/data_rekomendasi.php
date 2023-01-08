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
                <h1 class="mt-4">Data Rekomendasi</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('followup-cbm') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Rekomendasi</li>
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
                        Data Rekomendasi
                    </div>
                    <div class="card-body table-responsive">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Rekomendasi
                        </button>
                        <br><br>
                        <table class="table table-bordered" id="dataMaster">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Rekomendasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rekomendasi as $key => $value):
                                    ?>
                                    <tr>
                                        <td><?= $value->id ?></td>
                                        <td><?= $value->rekomendasi ?></td>
                                        <td><a class="btn btn-secondary btn-sm" href="delete_rekomendasi/<?= $value->id ?>" onclick="return confirm_del(<?= $value->id ?>)"><span class="fa fa-trash"></span></a></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Rekomendasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('followup-cbm/input_rekomendasi') ?>">
                    <div class="form-floating mb-3 mb-md-0">
                        <input type="text" class="form-control" name="inputRekomendasi" required="">
                        <label>Rekomendasi</label>
                    </div>
                    <br>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <!--            <div class="modal-footer">

                        </div>-->
        </div>
    </div>
</div>

<script>
    function confirm_del(id) {
        return confirm('Apakah Anda yakin ingin menghapus data dengan no. ' + id + '?');
    }
</script>

<?= $this->endSection() ?>
