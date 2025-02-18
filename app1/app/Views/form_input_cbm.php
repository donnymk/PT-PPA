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
                <h1 class="mt-4">Input Follow Up</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('followup-cbm') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Input Follow Up</li>
                </ol>
<!--                <div class="card mb-4">
                    <div class="card-body">
                        Masukkan data
                    </div>
                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Form Input Follow Up CBM
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('followup-cbm/input_cbm') ?>">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="inputModelUnit" name="inputModelUnit" onchange="getCodeUnit()" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($model_unit as $key => $value): ?>

                                                <option value="<?= $value->model_unit ?>"><?= $value->model_unit ?></option>

                                            <?php endforeach ?>
                                        </select>
                                        <label for="inputModelUnit">Model Unit</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-control" id="inputCodeUnit" name="inputCodeUnit" required="">
                                            <option value="">--Pilih dahulu Model Unit--</option>
                                        </select>
                                        <label for="inputLastName">Code Unit</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="inputKomponen" name="inputKomponen" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($komponen as $value): ?>

                                                <option value="<?= $value->nama_komponen ?>"><?= $value->nama_komponen ?></option>

                                            <?php endforeach ?>
                                        </select>
                                        <label for="inputKomponen">Komponen</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="inputTemuanCbm" name="inputTemuanCbm">
                                            <option value="PAP">PAP</option>
                                            <option value="PPM">PPM</option>
                                            <option value="PPU">PPU</option>
                                            <option value="Visual Inspection">Visual Inspection</option>
                                            <option value="P2C">P2C</option>
                                            <option value="PPE">PPE</option>
                                        </select>
                                        <label for="inputTemuanCbm">Temuan CBM Apa?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="inputDeskripsiProblem" name="inputDeskripsiProblem" required=""></textarea>
                                <label for="inputDeskripsiProblem">Dekripsi Problem</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="selectRekomFollowUp" name="selectRekomFollowUp" onchange="switch_input()" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($rekomendasi_followup as $value): ?>

                                                <option value="<?= $value->rekomendasi ?>"><?= $value->rekomendasi ?></option>

                                            <?php endforeach ?>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <label for="selectRekomFollowUp">Rekomendasi Follow Up</label>
                                    </div>
                                    <input type="text" class="form-control" id="inputRekomFollowUp" name="inputRekomFollowUp" placeholder="Isikan jika lainnya">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" type="date" id="inputPlanDate" name="inputPlanDate" required="">
                                        <label for="inputPlanDate">Plan Date Follow Up</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="inputRemarks" name="inputRemarks" required=""></textarea>
                                <label for="inputRemarks">Remarks or Note</label>
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

<script>
    function getCodeUnit() {
        var modelunit = document.getElementById("inputModelUnit").value;
        const data = {"modelUnit": modelunit};

        fetch("<?= base_url('followup-cbm/get_code_unit') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data)
        })
                .then((response) => response.json())
                .then((data) => {
                    //console.log('Success:', data);
                    drawCodeUnit(data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
    }

    // draw option code unit to form
    function drawCodeUnit(data) {
        let optionCodeUnit = '';
        let indeks;
        for (indeks = 0; indeks < data.length; indeks++) {
            optionCodeUnit += '<option value="' + data[indeks] + '">' + data[indeks] + '</option>';
        }

        document.getElementById("inputCodeUnit").innerHTML = optionCodeUnit;
    }

    // jika select option yabg dipilih adalah 'Lainnya' maka tampilkan input manual
    function switch_input() {
        var rekom = document.getElementById("selectRekomFollowUp").value;
        if (rekom !== 'Lainnya') {
            document.getElementById("inputRekomFollowUp").style.display = "none";
            document.getElementById("inputRekomFollowUp").removeAttribute("required");
        } else {
            document.getElementById("inputRekomFollowUp").style.display = "block";
            document.getElementById("inputRekomFollowUp").setAttribute("required", "required");
        }
    }

    // tampilkan input manual dan sembunyikan input dari master
    function show_input_manual() {
        $('#namabangkom_from_master').removeAttr('required');
        $('#namabangkom_from_master').selectpicker('hide');
        // reset input dari master
        $('#namabangkom_from_master').selectpicker('val', '');

        $('#namabangkom_manual').attr('required', '');
        $('#namabangkom_manual').show();
    }

    // sembunyikan input manual dan tampilkan input dari master
    function hide_input_manual() {
        $('#namabangkom_from_master').attr('required', '');
        $('#namabangkom_from_master').selectpicker('show');

        $('#namabangkom_manual').removeAttr('required');
        $('#namabangkom_manual').hide();
        // reset input manual
        $('#namabangkom_manual').val('');

    }

</script>

<?= $this->endSection() ?>
