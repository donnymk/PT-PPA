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
                <!--                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Input Follow Up</li>
                                </ol>
                                <div class="card mb-4">
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
                                            <option value="Engine">Engine</option>
                                            <option value="Power Take Off">Power Take Off</option>
                                            <option value="Damper">Damper</option>
                                            <option value="Transmission">Transmission</option>
                                            <option value="Brake Cooling">Brake Cooling</option>
                                            <option value="Front Swing Machinery">Front Swing Machinery</option>
                                            <option value="Swing Machinery">Swing Machinery</option>
                                            <option value="Left Final Drive">Left Final Drive</option>
                                            <option value="Differential">Differential</option>
                                            <option value="Front Differential">Front Differential</option>
                                            <option value="Rear Swing Machinery">Rear Swing Machinery</option>
                                            <option value="Right Final Drive">Right Final Drive</option>
                                            <option value="Right Tandem">Right Tandem</option>
                                            <option value="Circle">Circle</option>
                                            <option value="Rear Differential">Rear Differential</option>
                                            <option value="Rear Left Final Drive">Rear Left Final Drive</option>
                                            <option value="Right Right Final Drive">Right Right Final Drive</option>
                                            <option value="All Axle (Diff & Final Drive)">All Axle (Diff & Final Drive)</option>
                                            <option value="Battery">Battery</option>
                                            <option value="Front Suspension RH">Front Suspension RH</option>
                                            <option value="Front Suspension LH">Front Suspension LH</option>
                                            <option value="Rear Suspension RH">Rear Suspension RH</option>
                                            <option value="Rear Suspension LH">Rear Suspension LH</option>
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
                                            <option value="Resampling (Tanpa penggantian oli)">Resampling (Tanpa penggantian oli)</option>
                                            <option value="Cek apakah ada partikel logam kasar pada Drain magnetic plug">Cek apakah ada partikel logam kasar pada Drain magnetic plug</option>
                                            <option value="Periksa Apakah ada Rembesan Pada Floating Seal">Periksa Apakah ada Rembesan Pada Floating Seal</option>
                                            <option value="Periksa Apakah Ada Abnormal Noise">Periksa Apakah Ada Abnormal Noise</option>
                                            <option value="Lakukan Cutting Filter & Analisa partikel pada elementnya">Lakukan Cutting Filter & Analisa partikel pada elementnya</option>
                                            <option value="Lakukan penambahan Oli">Lakukan penambahan Oli</option>
                                            <option value="Buka & Periksa Oil Pan">Buka & Periksa Oil Pan</option>
                                            <option value="Check Oil Pressure">Check Oil Pressure</option>
                                            <option value="Lakukan PPM">Lakukan PPM</option>
                                            <option value="Lakukan penggantian Oli & Resampling">Lakukan penggantian Oli & Resampling</option>
                                            <option value="Lakukan Adjustment">Lakukan Adjustment</option>
                                            <option value="Lakukan Flushing">Lakukan Flushing</option>
                                            <option value="Lakukan pemeriksaan pada Fuel System">Lakukan pemeriksaan pada Fuel System</option>
                                            <option value="Cek Kebocoran Cooling System menggunakan Radiator Cap Tester">Cek Kebocoran Cooling System menggunakan Radiator Cap Tester</option>
                                            <option value="Cek Floating Seal Dari Indikasi Kebocoran">Cek Floating Seal Dari Indikasi Kebocoran</option>
                                            <option value="Buatkan TI sebagai data dan bukti dasar melakukan claim waranty">Buatkan TI sebagai data dan bukti dasar melakukan claim waranty</option>
                                            <option value="Ukur Ulang SOH/SOC, Ganti Terminal Battery Jika Rusak/Berjamur">Ukur Ulang SOH/SOC, Ganti Terminal Battery Jika Rusak/Berjamur</option>
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
