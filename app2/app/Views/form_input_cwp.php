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
                <h1 class="mt-4">Input Claim Warranty</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('claim-warranty') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Input Claim Warranty</li>
                </ol>
                <?php
                // cek flash data untuk memberitahu status input foto
                if (isset($_SESSION['errorMessage'])) {
                    ?>
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <?= $session->getFlashdata('errorMessage') ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Form Input Claim Warranty Proposal
                    </div>
                    <div class="card-body">
                        <p class="breadcrumb-item active">Tanda bintang (<span class="wajib-diisi">*</span>) wajib diisi</p>
                        <?= form_open_multipart(base_url('claim-warranty/submit_cwp')) ?>
                        <!-- Claim identification -->
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" id="inputJobsite" name="inputJobsite" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($jobsite as $value): ?>

                                            <option value="<?= $value->job_site ?>"><?= $value->job_site ?></option>

                                        <?php endforeach ?>
                                    </select>
                                    <label for="inputJobsite">Jobsite <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" type="date" id="inputClaimDate" name="inputClaimDate" required="">
                                    <label for="inputClaimDate">Claim Date <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" type="text" id="inputClaimTo" name="inputClaimTo" oninput="fill_inputFollowupBy()" required="">
                                    <label for="inputClaimTo">Claim To <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" id="inputWarrantyDecision" name="inputWarrantyDecision" required="">
                                        <option value="">--Pilih--</option>
                                        <option value="Accepted">Accepted</option>
                                        <option value="Prorate">Prorate</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Open">Open</option>
                                        <option value="Cancel">Cancel</option>
                                    </select>
                                    <label for="inputWarrantyDecision">Warranty Decision <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" type="date" id="inputClosingDate" name="inputClosingDate">
                                    <label for="inputClosingDate">Closing Date</label>
                                </div>
                            </div>
                        </div>

                        <!-- Unit identification -->
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" id="inputBrandUnit" name="inputBrandUnit" onchange="getModelUnit()" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($brand_unit as $key => $value): ?>

                                            <option value="<?= $value->machine_maker ?>"><?= $value->machine_maker ?></option>

                                        <?php endforeach ?>
                                    </select>
                                    <label for="inputBrandUnit">Brand Unit <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" id="inputModelUnit" name="inputModelUnit" onchange="getCodeUnit()" required="">
                                        <option value="">--Pilih dahulu Brand Unit--</option>
                                    </select>
                                    <label for="inputModelUnit">Model Unit <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" id="inputCodeUnit" name="inputCodeUnit" required="">
                                        <option value="">--Pilih dahulu Model Unit--</option>
                                    </select>
                                    <label for="inputCodeUnit">Code Unit <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputSNUnit" name="inputSNUnit">
                                    <label for="inputSNUnit">S.N Unit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputMajorComp" name="inputMajorComp" required="">
                                    <label for="inputMajorComp">Major Comp. <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputCompModel" name="inputCompModel">
                                    <label for="inputCompModel">Comp. Model</label>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputSNComp" name="inputSNComp">
                                    <label for="inputSNComp">S.N Comp. (If ANY)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" id="inputStatusUnit" name="inputStatusUnit" required="">
                                        <option value="">--Pilih--</option>
                                        <option value="Operasi">Operasi</option>
                                        <option value="Breakdown">Breakdown</option>
                                    </select>
                                    <label for="inputStatusUnit">Status Unit <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="number" min="0" class="form-control" id="inputAmountPart" name="inputAmountPart">
                                    <label for="inputAmountPart">Amount Part (Estimated)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="number" min="0" class="form-control" id="inputFinalAmount" name="inputFinalAmount">
                                    <label for="inputFinalAmount">Final Amount</label>
                                </div>
                            </div>
                        </div>

                        <!-- Component and Sub Component identification -->
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputComponent" name="inputComponent">
                                    <label for="inputComponent">Component</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputPartNumber" name="inputPartNumber">
                                    <label for="inputPartNumber">Part Number</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="date" class="form-control" id="inputFitmentDate" name="inputFitmentDate" required="">
                                    <label for="inputFitmentDate">Fitment Date <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="number" min="0" class="form-control" id="inputHmKmFitment" name="inputHmKmFitment" onchange="hitung_lifetime()" required="">
                                    <label for="inputHmKmFitment">HM/KM Fitment <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputSubComponent" name="inputSubComponent">
                                    <label for="inputSubComponent">Sub Component</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputQty" name="inputQty">
                                    <label for="inputQty">Qty</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="date" class="form-control" id="inputTroubleDate" name="inputTroubleDate" required="">
                                    <label for="inputTroubleDate">Trouble Date <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="number" min="0" class="form-control" id="inputHmKmTrouble" name="inputHmKmTrouble" onchange="hitung_lifetime()" required="">
                                    <label for="inputHmKmTrouble">HM/KM Trouble <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="number" class="form-control" id="inputLifetime" name="inputLifetime" required="" readonly="">
                                    <label for="inputLifetime">Lifetime <span class="wajib-diisi">*</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Problem explanation -->
                        <div class="form-floating mb-1">
                            <textarea class="form-control" id="inputDeskripsiProblem" name="inputDeskripsiProblem" required=""></textarea>
                            <label for="inputDeskripsiProblem">Problem Issue <span class="wajib-diisi">*</span></label>
                        </div>
                        <div class="form-floating mb-1">
                            <textarea class="form-control" id="inputComments" name="inputComments" required=""></textarea>
                            <label for="inputComments">Supporting Comments <span class="wajib-diisi">*</span></label>
                        </div>
                        <div class="form-floating mb-1">
                            <textarea class="form-control" id="inputSchedule" name="inputSchedule" required=""></textarea>
                            <label for="inputSchedule">Schedule Follow Up <span class="wajib-diisi">*</span></label>
                        </div>
                        <div class="form-floating mb-1">
                            <textarea class="form-control" id="inputRemarkProgress" name="inputRemarkProgress"></textarea>
                            <label for="inputRemarkProgress">Remark Progress</label>
                        </div>

                        <!-- Approval -->
                        <div class="mt-4 mb-1">
                            <div class="d-grid text-center badge bg-light text-dark">Approval</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputCreatedBy" name="inputCreatedBy">
                                    <label for="inputCreatedBy">Created By</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputApprovedBy" name="inputApprovedBy">
                                    <label for="inputApprovedBy">Approved By</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputApprovedBy2" name="inputApprovedBy2">
                                    <label for="inputApprovedBy2">Approved By</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="inputFollowupBy" name="inputFollowupBy" readonly="">
                                    <label for="inputFollowupBy">Follow Up By</label>
                                </div>
                            </div>
                        </div>

                        <!-- Lampiran Foto -->
                        <div class="mt-4 mb-1">
                            <div class="d-grid text-center badge bg-light text-dark">Lampiran</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="file" class="form-control" id="fotoUnitDepan" name="fotoUnitDepan" accept="image/*" onchange="return validasiFoto('fotoUnitDepan', 'pratinjauFoto1')">
                                    <label for="fotoUnitDepan">Foto Unit Tampak Depan</label>
                                </div>
                                <div id="pratinjauFoto1"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="file" class="form-control" id="fotoUnitSamping" name="fotoUnitSamping" accept="image/*" onchange="return validasiFoto('fotoUnitSamping', 'pratinjauFoto2')">
                                    <label for="fotoUnitSamping">Foto Unit Tampak Samping</label>
                                </div>
                                <div id="pratinjauFoto2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="file" class="form-control" id="fotoSnUnit" name="fotoSnUnit" accept="image/*" onchange="return validasiFoto('fotoSnUnit', 'pratinjauFoto3')">
                                    <label for="fotoSnUnit">Foto SN Unit/Komponen</label>
                                </div>
                                <div id="pratinjauFoto3"></div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="file" class="form-control" id="fotoHmKmUnit" name="fotoHmKmUnit" accept="image/*" onchange="return validasiFoto('fotoHmKmUnit', 'pratinjauFoto4')">
                                    <label for="fotoHmKmUnit">Foto HM/KM Unit</label>
                                </div>
                                <div id="pratinjauFoto4"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="file" class="form-control" id="fotoKomponenRusak" name="fotoKomponenRusak" accept="image/*" onchange="return validasiFoto('fotoKomponenRusak', 'pratinjauFoto5')">
                                    <label for="fotoKomponenRusak">Foto Komponen yang Rusak</label>
                                </div>
                                <div id="pratinjauFoto5"></div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-0">
                            <div class="col-md-6">
                                <div class="d-grid">
                                    <button onclick="preview_cwp()" class="btn btn-secondary btn-block">Preview</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-danger btn-block"><span class="fa fa-floppy-disk"></span> Simpan</button>
                                </div>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </main>

        <!-- Include footer -->
        <?= $this->include('footer') ?>
    </div>
</div>

<script>
    function getModelUnit() {
        var brandunit = document.getElementById("inputBrandUnit").value;
        const data = {"brandUnit": brandunit};

        fetch("<?= base_url('claim-warranty/get_model_unit') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data)
        })
                .then((response) => response.json())
                .then((jsondata) => {
                    //console.log('Success:', data);
                    drawModelUnit(jsondata);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
    }

    // draw option model unit to form
    function drawModelUnit(data) {
        let optionModelUnit = '<option value="">--Pilih--</option>';
        let indeks;
        for (indeks = 0; indeks < data.length; indeks++) {
            optionModelUnit += '<option value="' + data[indeks] + '">' + data[indeks] + '</option>';
        }

        document.getElementById("inputModelUnit").innerHTML = optionModelUnit;
    }

    function getCodeUnit() {
        var modelunit = document.getElementById("inputModelUnit").value;
        const data = {"modelUnit": modelunit};

        fetch("<?= base_url('claim-warranty/get_code_unit') ?>", {
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

    // lifetime = hm/km trouble - hm/km fitment
    function hitung_lifetime() {
        var input_hmkm_fitment = document.getElementById("inputHmKmFitment").value;
        var input_hmkm_trouble = document.getElementById("inputHmKmTrouble").value;
        var lifetime = (input_hmkm_trouble - input_hmkm_fitment);

        document.getElementById("inputLifetime").value = lifetime;
    }

// auto isi inputan Follow Up By
    function fill_inputFollowupBy() {
        let text = document.getElementById("inputClaimTo").value;
        document.getElementById("inputFollowupBy").value = text;
    }

    function validasiFoto(idFoto, idPratinjau) {
        var inputFoto = document.getElementById(idFoto);
        var pathFile = inputFoto.value;
        var file = inputFoto.files[0];
        var size_file = file.size;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;

        //alert(size_file);
        if (!ekstensiOk.exec(pathFile)) {
            alert('Silakan upload file dengan format jpg, jpeg atau png');
            inputFoto.value = '';
            return false;
        } else {
            if (size_file > 2000000) {
                alert('Cek kembali ukuran file Anda. Ukuran file maksimal 2 MB');
                inputFoto.value = '';
                return false;
            } else {
                //Pratinjau gambar
                if (inputFoto.files && inputFoto.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById(idPratinjau).innerHTML = '<img style="max-width:100%" src="' + e.target.result + '"/><a href="javascript:void(0)" onclick="return delfoto(\'' + idFoto + '\', \'' + idPratinjau + '\')"><span class="fa fa-xmark"></span></a>';
                    };
                    reader.readAsDataURL(inputFoto.files[0]);
                }
            }
        }
    }


    // Hapus pratinjau gambar
    function delfoto(targetFoto, targetPratinjau) {
        var inputFile = document.getElementById(targetFoto);
        inputFile.value = '';
        document.getElementById(targetPratinjau).innerHTML = '';
    }

</script>

<?= $this->endSection() ?>
