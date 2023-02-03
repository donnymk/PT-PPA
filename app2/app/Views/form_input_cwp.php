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
                <!--                <div class="card mb-4">
                                    <div class="card-body">
                                        Masukkan data
                                    </div>
                                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Form Input Claim Warranty Proposal
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('claim-warranty/input_cwp') ?>">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="inputJobsite" name="inputJobsite" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($jobsite as $value): ?>

                                                <option value="<?= $value->job_site ?>"><?= $value->job_site ?></option>

                                            <?php endforeach ?>
                                        </select>
                                        <label for="inputJobsite">Jobsite</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" type="date" id="inputClaimDate" name="inputClaimDate" required="">
                                        <label for="inputClaimDate">Claim Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" type="text" id="inputClaimTo" name="inputClaimTo" required="">
                                        <label for="inputClaimTo">Claim To</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="inputWarrantyDecision" name="inputWarrantyDecision">
                                            <option value="Accepted">Accepted</option>
                                            <option value="Prorate">Prorate</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Open">Open</option>
                                            <option value="Cancel">Cancel</option>
                                        </select>
                                        <label for="inputWarrantyDecision">Warranty Decision</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="date" id="inputClosingDate" name="inputClosingDate" required="">
                                    <label for="inputClosingDate">Closing Date</label>                                    <div class="form-floating mb-3 mb-md-0">

                                    </div>
                                </div>                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" id="inputBrandUnit" name="inputBrandUnit" onchange="getCodeUnit()" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($brand_unit as $key => $value): ?>

                                                <option value="<?= $value->machine_maker ?>"><?= $value->machine_maker ?></option>

                                            <?php endforeach ?>
                                        </select>
                                        <label for="inputBrandUnit">Brand Unit</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-control" id="inputModelUnit" name="inputModelUnit" required="">
                                            <option value="">--Pilih dahulu Brand Unit--</option>
                                        </select>
                                        <label for="inputModelUnit">Model Unit</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-control" id="inputCodeUnit" name="inputCodeUnit" required="">
                                            <option value="">--Pilih dahulu Model Unit--</option>
                                        </select>
                                        <label for="inputCodeUnit">Code Unit</label>
                                    </div>
                                </div>                        
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control" id="inputSNUnit" name="inputSNUnit" placeholder="Isikan jika lainnya">
                                        <label for="inputSNUnit">S.N Unit</label>
                                    </div>       
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control" id="inputMajorComp" name="inputMajorComp" placeholder="Isikan jika lainnya">
                                        <label for="inputMajorComp">Major Comp.</label>
                                    </div>       
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control" id="inputSNComp" name="inputSNComp" placeholder="Isikan jika lainnya">
                                        <label for="inputSNComp">S.N Comp. (If ANY)</label>
                                    </div>       
                                </div>                        
                            </div>                    
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="inputDeskripsiProblem" name="inputDeskripsiProblem" required=""></textarea>
                                <label for="inputDeskripsiProblem">Dekripsi Problem</label>
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
