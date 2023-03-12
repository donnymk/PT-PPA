<?php

namespace App\Controllers;

use App\Models\JobsiteModel;
use App\Models\PopulasiModel;
use App\Models\CWPModel;
use CodeIgniter\Files\File;

class Admin extends BaseController {

    protected $helpers = ['form'];

    public function index() {
        return view('dasbor');
    }

    // tampilkan semua data jobsite
    public function data_jobsite() {
        // initialize the session
        $session = \Config\Services::session();
        $data['session'] = $session;

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // QUERY MELALUI MODEL
        $model = new JobsiteModel();
        $data['jobsite'] = $model->getJobsite();

        return view('data_jobsite', $data);
    }

    // input jobsite
    public function input_jobsite() {
        // terima data dari form input
        $inputJobsite = $this->request->getPost('inputJobsite');

        // initialize the session
        $session = \Config\Services::session();

        $data = [
            'job_site' => $inputJobsite
        ];

        // QUERY MELALUI MODEL
        $model = new JobsiteModel();
        $insert = $model->insertJobsite($data);
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputJobsiteStatus', 'Jobsite berhasil ditambahkan');
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/data_jobsite'));
        }
    }

    // delete jobsite
    public function delete_jobsite($no) {
        // QUERY MELALUI MODEL
        $model = new JobsiteModel();
        $del = $model->delJobsite($no);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/data_jobsite'));
        }
    }

    // tampilkan semua data populasi
    public function data_populasi() {
        // initialize the session
        $session = \Config\Services::session();
        $data['session'] = $session;

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // QUERY MELALUI MODEL
        $model = new PopulasiModel();
        $data['populasi'] = $model->getPopulasi();

        return view('data_populasi', $data);
    }

    // input populasi
    public function input_populasi() {
        // terima data dari form input
        $inputMachineMaker = $this->request->getPost('inputMachineMaker');
        $inputModelUnit = $this->request->getPost('inputModelUnit');
        $inputCodeUnit = $this->request->getPost('inputCodeUnit');

        // initialize the session
        $session = \Config\Services::session();

        $data = [
            'machine_maker' => $inputMachineMaker,
            'model_unit' => $inputModelUnit,
            'code_unit' => $inputCodeUnit
        ];

        // QUERY MELALUI MODEL
        $model = new PopulasiModel();
        $insert = $model->insertPopulasi($data);
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputPopulasiStatus', 'Populasi berhasil ditambahkan');
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/data_populasi'));
        }
    }

    // delete data populasi
    public function delete_populasi($no) {
        // QUERY MELALUI MODEL
        $model = new PopulasiModel();
        $del = $model->delPopulasi($no);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/data_populasi'));
        }
    }

    // change password
    public function changepwd() {
        // initialize the session
        $session = \Config\Services::session();
        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
            $data['session'] = $session;
        }

        return view('form_changepwd', $data);
    }

    // update password
    public function changepwd_submit() {
        // terima data dari form update
        $inputOldPassword = $this->request->getPost('inputOldPassword');
        $inputNewPassword = $this->request->getPost('inputNewPassword');
        $inputNewPassword2 = $this->request->getPost('inputNewPassword2');

        // initialize the session
        $session = \Config\Services::session();

        // CEK USERNAME
        $username = $session->username;
        // QUERY MELALUI MODEL
        $model = new LoginModel();
        $select_admin = $model->authAdmin($username);

        // jika data ditemukan
        foreach ($select_admin as $value):
            $password_db = $value->password;
        endforeach;

        // jika password lama benar
        if (password_verify($inputOldPassword, $password_db)) {
            // dan password baru yang diketikkan dua kali benar
            if ($inputNewPassword == $inputNewPassword2) {
                // update password baru di database
                $model->updatePassword($username, $inputNewPassword);

                $session->setFlashdata('changePasswordStatus', 'Ubah Password baru berhasil');
            }
            // tapi password baru yang diketikkan dua kali tidak sama
            else {
                $session->setFlashdata('changePasswordStatus', 'Password baru yang diketikkan dua kali tidak sama');
                $session->setFlashdata('oldPassword', $inputOldPassword);
                $session->setFlashdata('newPassword', $inputNewPassword);
                $session->setFlashdata('newPassword2', $inputNewPassword2);
            }
        }
        // jika password lama salah
        else {
            $session->setFlashdata('changePasswordStatus', 'Password lama tidak sesuai');
            $session->setFlashdata('oldPassword', $inputOldPassword);
            $session->setFlashdata('newPassword', $inputNewPassword);
            $session->setFlashdata('newPassword2', $inputNewPassword2);
        }

        // go to previous page
        return redirect()->to(base_url('claim-warranty/changepwd'));
    }

    // form input
    public function input_cwp() {
        // load the form helper
        helper('form');
        // initialize the session
        $session = \Config\Services::session();
        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // KONEKSI DB DAN QUERY SECARA LANGSUNG
//        $db = \Config\Database::connect();
//        $builder = $db->table('populasi');
//        $query   = $builder->get();
//        print_r($query->getResult());
        // QUERY MELALUI MODEL
        $model = new JobsiteModel();
        $model2 = new PopulasiModel();
        $data['jobsite'] = $model->getJobsite();
        $data['brand_unit'] = $model2->getBrandUnit();

        return view('form_input_cwp', $data);
    }

    public function buat_folder_tanggal() {
        // WIB
        date_default_timezone_set('Asia/Jakarta');

        //Year in YYYY format.
        $year = date("Y");
        //Month in mm format, with leading zeros.
        $month = date("m");
        //Day in dd format, with leading zeros.
        $day = date("d");

        //The folder name for our file should be YYYYMMDD
        $foldername = "$year$month$day";
        $directory = "uploads/" . $foldername;

        //If the directory doesn't already exists.
        if (!is_dir($directory)) {
            //Create our directory
            mkdir($directory, 755, true);
        }

        return $foldername;
    }

    public function submit_cwp() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $inputClaimType = $this->request->getPost('inputClaimType');
        $inputJobsite = $this->request->getPost('inputJobsite');
        $inputClaimDate = $this->request->getPost('inputClaimDate');
        $inputClaimTo = $this->request->getPost('inputClaimTo');
        $inputWarrantyDecision = $this->request->getPost('inputWarrantyDecision');
        $inputClosingDate = $this->request->getPost('inputClosingDate');
        $inputBrandUnit = $this->request->getPost('inputBrandUnit');
        $inputModelUnit = $this->request->getPost('inputModelUnit');
        $inputCodeUnit = $this->request->getPost('inputCodeUnit');
        $inputSNUnit = $this->request->getPost('inputSNUnit');
        $inputMajorComp = $this->request->getPost('inputMajorComp');
        $inputCompModel = $this->request->getPost('inputCompModel');
        $inputSNComp = $this->request->getPost('inputSNComp');
        $inputStatusUnit = $this->request->getPost('inputStatusUnit');
        $inputAmountPart = $this->request->getPost('inputAmountPart');
        $inputFinalAmount = $this->request->getPost('inputFinalAmount');
        $inputComponent = $this->request->getPost('inputComponent');
        $inputPartNumber = $this->request->getPost('inputPartNumber');
        $inputFitmentDate = $this->request->getPost('inputFitmentDate');
        $inputHmKmFitment = $this->request->getPost('inputHmKmFitment');
        $inputSubComponent = $this->request->getPost('inputSubComponent');
        $inputQty = $this->request->getPost('inputQty');
        $inputTroubleDate = $this->request->getPost('inputTroubleDate');
        $inputHmKmTrouble = $this->request->getPost('inputHmKmTrouble');
        $inputLifetime = $this->request->getPost('inputLifetime');
        $inputDeskripsiProblem = $this->request->getPost('inputDeskripsiProblem');
        $inputComments = $this->request->getPost('inputComments');
        $inputSchedule = $this->request->getPost('inputSchedule');
        $inputRemarkProgress = $this->request->getPost('inputRemarkProgress');
        $inputCreatedBy = $this->request->getPost('inputCreatedBy');
        $inputApprovedBy = $this->request->getPost('inputApprovedBy');
        $inputApprovedBy2 = $this->request->getPost('inputApprovedBy2');
        $inputFollowupBy = $this->request->getPost('inputFollowupBy');

        $foto1 = $this->request->getFile('fotoUnitDepan');
        $foto2 = $this->request->getFile('fotoUnitSamping');
        $foto3 = $this->request->getFile('fotoSnUnit');
        $foto4 = $this->request->getFile('fotoHmKmUnit');
        $foto5 = $this->request->getFile('fotoKomponenRusak');

        // aturan file upload (salah satunya foto tidak wajib diupload)
        $validationRule = [
            'fotoUnitDepan' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoUnitDepan]',
                    'is_image[fotoUnitDepan]',
                    'mime_in[fotoUnitDepan,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoUnitDepan,2000]',
                    'max_dims[fotoUnitDepan,8000,6000]',
                ],
            ],
            'fotoUnitSamping' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoUnitSamping]',
                    'is_image[fotoUnitSamping]',
                    'mime_in[fotoUnitSamping,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoUnitSamping,2000]',
                    'max_dims[fotoUnitSamping,8000,6000]',
                ],
            ],
            'fotoSnUnit' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoSnUnit]',
                    'is_image[fotoSnUnit]',
                    'mime_in[fotoSnUnit,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoSnUnit,2000]',
                    'max_dims[fotoSnUnit,8000,6000]',
                ],
            ],
            'fotoHmKmUnit' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoHmKmUnit]',
                    'is_image[fotoHmKmUnit]',
                    'mime_in[fotoHmKmUnit,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoHmKmUnit,2000]',
                    'max_dims[fotoHmKmUnit,8000,6000]',
                ],
            ],
            'fotoKomponenRusak' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoKomponenRusak]',
                    'is_image[fotoKomponenRusak]',
                    'mime_in[fotoKomponenRusak,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoKomponenRusak,2000]',
                    'max_dims[fotoKomponenRusak,8000,6000]',
                ],
            ],
        ];

        // jika yang diupload tidak sesuai rule
        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            return var_dump($errors);
        }

        // JIKA FILE TIDAK DIUPLOAD = ERROR CODE 4
        //
        // jika foto1 tidak diupload
        if ($foto1->getError() == 4) {
            $direktori_foto1 = '';
        }
        // jika foto1 berhasil diupload dan masih ada di temporary folder
        elseif (!$foto1->hasMoved()) {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto1->getRandomName();
            $direktori_foto1 = $nama_folder . '/' . $nama_foto;

            $foto1->move('uploads/' . $nama_folder, $nama_foto);
            //$filepath1 = WRITEPATH . 'uploads/' . $foto1->store();
            //$data = ['uploaded_fileinfo' => new File($filepath1)];
        }

        // jika foto2 tidak diupload
        if ($foto2->getError() == 4) {
            $direktori_foto2 = '';
        }
        // jika foto2 diupload dan berhasil
        elseif (!$foto2->hasMoved()) {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto2->getRandomName();
            $direktori_foto2 = $nama_folder . '/' . $nama_foto;

            $foto2->move('uploads/' . $nama_folder, $nama_foto);
        }

        // jika foto3 tidak diupload
        if ($foto3->getError() == 4) {
            $direktori_foto3 = '';
        }
        // jika foto3 diupload dan berhasil
        elseif (!$foto3->hasMoved()) {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto3->getRandomName();
            $direktori_foto3 = $nama_folder . '/' . $nama_foto;

            $foto3->move('uploads/' . $nama_folder, $nama_foto);
        }

        // jika foto4 tidak diupload
        if ($foto4->getError() == 4) {
            $direktori_foto4 = '';
        }
        // jika foto4 diupload dan berhasil
        elseif (!$foto4->hasMoved()) {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto4->getRandomName();
            $direktori_foto4 = $nama_folder . '/' . $nama_foto;

            $foto4->move('uploads/' . $nama_folder, $nama_foto);
        }

        // jika foto5 tidak diupload
        if ($foto5->getError() == 4) {
            $direktori_foto5 = '';
        }
        // jika foto5 diupload dan berhasil
        elseif (!$foto5->hasMoved()) {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto5->getRandomName();
            $direktori_foto5 = $nama_folder . '/' . $nama_foto;

            $foto5->move('uploads/' . $nama_folder, $nama_foto);
        }

        $data = [
            'jobsite' => $inputJobsite,
            'what_is_claimed' => $inputClaimType,
            'claim_date' => $inputClaimDate,
            'claim_to' => $inputClaimTo,
            'warranty_decision' => $inputWarrantyDecision,
            'closing_date' => $inputClosingDate,
            'brand_unit' => $inputBrandUnit,
            'model_unit' => $inputModelUnit,
            'code_unit' => $inputCodeUnit,
            'sn_unit' => $inputSNUnit,
            'major_component' => $inputMajorComp,
            'component_model' => $inputCompModel,
            'sn_component' => $inputSNComp,
            'status_unit' => $inputStatusUnit,
            'amount_part' => $inputAmountPart,
            'final_amount' => $inputFinalAmount,
            'component' => $inputComponent,
            'sub_component' => $inputSubComponent,
            'part_number' => $inputPartNumber,
            'qty' => $inputQty,
            'fitment_date' => $inputFitmentDate,
            'trouble_date' => $inputTroubleDate,
            'hm/km_fitment' => $inputHmKmFitment,
            'hm/km_trouble' => $inputHmKmTrouble,
            'lifetime' => $inputLifetime,
            'problem_issue' => $inputDeskripsiProblem,
            'supporting_comments' => $inputComments,
            'schedule_follow_up' => $inputSchedule,
            'remark_progress' => $inputRemarkProgress,
            'created_by' => $inputCreatedBy,
            'approved_by1' => $inputApprovedBy,
            'approved_by2' => $inputApprovedBy2,
            'follow_up_by' => $inputFollowupBy,
            'foto_unit_depan' => $direktori_foto1,
            'foto_unit_samping' => $direktori_foto2,
            'foto_sn_unit' => $direktori_foto3,
            'foto_hm/km_unit' => $direktori_foto4,
            'foto_komponen_rusak' => $direktori_foto5
        ];

        // QUERY MELALUI MODEL
        $model = new CWPModel();
        $insert = $model->insertCWP($data);
        //var_dump($data); exit();
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputCWPStatus', 'Claim Warranty Proposal berhasil ditambahkan');
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/resume'));
        }

        $errors = 'The file has already been moved.';
        return var_dump($errors);
    }

    public function resume() {
        // initialize the session
        $session = \Config\Services::session();
        $data['session'] = $session;

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }
        return view('resume', $data);
    }

    // form update
    public function update($id) {
        // initialize the session
        $session = \Config\Services::session();
        //helper('html');
        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // GET DATA UNTUK DITAMPILKAN DI FORM UPDATE
        // QUERY MELALUI MODEL
        $JobsiteModel = new JobsiteModel();
        $PopulasiModel = new PopulasiModel();
        $CWPModel = new CWPModel();
        $data['jobsite_master'] = $JobsiteModel->getJobsite();
        $data['brand_unit_master'] = $PopulasiModel->getBrandUnit();

        // get current data
        // untuk ditampilkan di form edit
        $dataCWP = $CWPModel->getDataCWPById($id);
        $data['cwp'] = $dataCWP;

        $brandUnit = $dataCWP[0]->brand_unit;
        $modelUnit = $dataCWP[0]->model_unit;
        // menampilkan data Model Unit sesuai Brand Unit di select option
        $data['get_model_unit'] = $PopulasiModel->getModelUnitbyBrandUnit($brandUnit);
        // menampilkan data Code Unit sesuai Model Unit di select option
        $data['get_code_unit'] = $PopulasiModel->getCodeUnitbyModelUnit($modelUnit);

        return view('form_update', $data);
    }

    public function update_cwp() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $inputId = $this->request->getPost('inputId');
        $inputClaimType = $this->request->getPost('inputClaimType');
        $inputJobsite = $this->request->getPost('inputJobsite');
        $inputClaimDate = $this->request->getPost('inputClaimDate');
        $inputClaimTo = $this->request->getPost('inputClaimTo');
        $inputWarrantyDecision = $this->request->getPost('inputWarrantyDecision');
        $inputClosingDate = $this->request->getPost('inputClosingDate');
        $inputBrandUnit = $this->request->getPost('inputBrandUnit');
        $inputModelUnit = $this->request->getPost('inputModelUnit');
        $inputCodeUnit = $this->request->getPost('inputCodeUnit');
        $inputSNUnit = $this->request->getPost('inputSNUnit');
        $inputMajorComp = $this->request->getPost('inputMajorComp');
        $inputCompModel = $this->request->getPost('inputCompModel');
        $inputSNComp = $this->request->getPost('inputSNComp');
        $inputStatusUnit = $this->request->getPost('inputStatusUnit');
        $inputAmountPart = $this->request->getPost('inputAmountPart');
        $inputFinalAmount = $this->request->getPost('inputFinalAmount');
        $inputComponent = $this->request->getPost('inputComponent');
        $inputPartNumber = $this->request->getPost('inputPartNumber');
        $inputFitmentDate = $this->request->getPost('inputFitmentDate');
        $inputHmKmFitment = $this->request->getPost('inputHmKmFitment');
        $inputSubComponent = $this->request->getPost('inputSubComponent');
        $inputQty = $this->request->getPost('inputQty');
        $inputTroubleDate = $this->request->getPost('inputTroubleDate');
        $inputHmKmTrouble = $this->request->getPost('inputHmKmTrouble');
        $inputLifetime = $this->request->getPost('inputLifetime');
        $inputDeskripsiProblem = $this->request->getPost('inputDeskripsiProblem');
        $inputComments = $this->request->getPost('inputComments');
        $inputSchedule = $this->request->getPost('inputSchedule');
        $inputRemarkProgress = $this->request->getPost('inputRemarkProgress');
        $inputCreatedBy = $this->request->getPost('inputCreatedBy');
        $inputApprovedBy = $this->request->getPost('inputApprovedBy');
        $inputApprovedBy2 = $this->request->getPost('inputApprovedBy2');
        $inputFollowupBy = $this->request->getPost('inputFollowupBy');

        $foto1_lama = $this->request->getPost('fotoUnitDepan_lama');
        $foto2_lama = $this->request->getPost('fotoUnitSamping_lama');
        $foto3_lama = $this->request->getPost('fotoSnUnit_lama');
        $foto4_lama = $this->request->getPost('fotoHmKmUnit_lama');
        $foto5_lama = $this->request->getPost('fotoKomponenRusak_lama');

        $foto1 = $this->request->getFile('fotoUnitDepan');
        $foto2 = $this->request->getFile('fotoUnitSamping');
        $foto3 = $this->request->getFile('fotoSnUnit');
        $foto4 = $this->request->getFile('fotoHmKmUnit');
        $foto5 = $this->request->getFile('fotoKomponenRusak');

        // aturan file upload (salah satunya foto tidak wajib diupload)
        $validationRule = [
            'fotoUnitDepan' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoUnitDepan]',
                    'is_image[fotoUnitDepan]',
                    'mime_in[fotoUnitDepan,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoUnitDepan,2000]',
                    'max_dims[fotoUnitDepan,8000,6000]',
                ],
            ],
            'fotoUnitSamping' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoUnitSamping]',
                    'is_image[fotoUnitSamping]',
                    'mime_in[fotoUnitSamping,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoUnitSamping,2000]',
                    'max_dims[fotoUnitSamping,8000,6000]',
                ],
            ],
            'fotoSnUnit' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoSnUnit]',
                    'is_image[fotoSnUnit]',
                    'mime_in[fotoSnUnit,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoSnUnit,2000]',
                    'max_dims[fotoSnUnit,8000,6000]',
                ],
            ],
            'fotoHmKmUnit' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoHmKmUnit]',
                    'is_image[fotoHmKmUnit]',
                    'mime_in[fotoHmKmUnit,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoHmKmUnit,2000]',
                    'max_dims[fotoHmKmUnit,8000,6000]',
                ],
            ],
            'fotoKomponenRusak' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoKomponenRusak]',
                    'is_image[fotoKomponenRusak]',
                    'mime_in[fotoKomponenRusak,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoKomponenRusak,2000]',
                    'max_dims[fotoKomponenRusak,8000,6000]',
                ],
            ],
        ];

        // jika yang diupload tidak sesuai rule
        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            return var_dump($errors);
        }

        // JIKA FILE TIDAK DIUPLOAD = ERROR CODE 4
        //
        // jika foto1 tidak diupload dan foto lama tidak diupload sebelumnya
        if ($foto1->getError() == 4 && $foto1_lama == '') {
            $direktori_foto1 = '';
        }
        // jika foto1 tidak diupload dan foto lama diupload sebelumnya
        elseif ($foto1->getError() == 4 && $foto1_lama != '') {
            $direktori_foto1 = $foto1_lama;
        }
        // jika foto1 berhasil diupload, masih di temporary folder
        // dan foto lama tidak diupload sebelumnya
        elseif (!$foto1->hasMoved() && $foto1_lama == '') {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto1->getRandomName();
            $direktori_foto1 = $nama_folder . '/' . $nama_foto;

            $foto1->move('uploads/' . $nama_folder, $nama_foto);
        }
        // jika foto1 berhasil diupload, masih di temporary folder
        // dan foto lama diupload sebelumnya
        elseif (!$foto1->hasMoved() && $foto1_lama != '') {
            // hapus foto lama
            if (file_exists('uploads/' . $foto1_lama) && is_file('uploads/' . $foto1_lama)) {
                unlink('uploads/' . $foto1_lama);
            }

            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto1->getRandomName();
            $direktori_foto1 = $nama_folder . '/' . $nama_foto;

            $foto1->move('uploads/' . $nama_folder, $nama_foto);
        }


        // jika foto2 tidak diupload dan foto lama tidak diupload sebelumnya
        if ($foto2->getError() == 4 && $foto2_lama == '') {
            $direktori_foto2 = '';
        }
        // jika foto2 tidak diupload dan foto lama diupload sebelumnya
        elseif ($foto2->getError() == 4 && $foto2_lama != '') {
            $direktori_foto2 = $foto2_lama;
        }
        // jika foto2 berhasil diupload, masih di temporary folder
        // dan foto lama tidak diupload sebelumnya
        elseif (!$foto2->hasMoved() && $foto2_lama == '') {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto2->getRandomName();
            $direktori_foto2 = $nama_folder . '/' . $nama_foto;

            $foto2->move('uploads/' . $nama_folder, $nama_foto);
        }
        // jika foto2 berhasil diupload, masih di temporary folder
        // dan foto lama diupload sebelumnya
        elseif (!$foto2->hasMoved() && $foto1_lama != '') {
            // hapus foto lama
            if (file_exists('uploads/' . $foto2_lama) && is_file('uploads/' . $foto2_lama)) {
                unlink('uploads/' . $foto2_lama);
            }

            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto2->getRandomName();
            $direktori_foto2 = $nama_folder . '/' . $nama_foto;

            $foto2->move('uploads/' . $nama_folder, $nama_foto);
        }


        // jika foto3 tidak diupload dan foto lama tidak diupload sebelumnya
        if ($foto3->getError() == 4 && $foto3_lama == '') {
            $direktori_foto3 = '';
        }
        // jika foto3 tidak diupload dan foto lama diupload sebelumnya
        elseif ($foto3->getError() == 4 && $foto3_lama != '') {
            $direktori_foto3 = $foto3_lama;
        }
        // jika foto3 berhasil diupload, masih di temporary folder
        // dan foto lama tidak diupload sebelumnya
        elseif (!$foto3->hasMoved() && $foto3_lama == '') {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto3->getRandomName();
            $direktori_foto3 = $nama_folder . '/' . $nama_foto;

            $foto3->move('uploads/' . $nama_folder, $nama_foto);
        }
        // jika foto3 berhasil diupload, masih di temporary folder
        // dan foto lama diupload sebelumnya
        elseif (!$foto3->hasMoved() && $foto3_lama != '') {
            // hapus foto lama
            if (file_exists('uploads/' . $foto3_lama) && is_file('uploads/' . $foto3_lama)) {
                unlink('uploads/' . $foto3_lama);
            }

            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto3->getRandomName();
            $direktori_foto3 = $nama_folder . '/' . $nama_foto;

            $foto3->move('uploads/' . $nama_folder, $nama_foto);
        }


        // jika foto4 tidak diupload dan foto lama tidak diupload sebelumnya
        if ($foto4->getError() == 4 && $foto4_lama == '') {
            $direktori_foto4 = '';
        }
        // jika foto4 tidak diupload dan foto lama diupload sebelumnya
        elseif ($foto4->getError() == 4 && $foto4_lama != '') {
            $direktori_foto4 = $foto4_lama;
        }
        // jika foto4 berhasil diupload, masih di temporary folder
        // dan foto lama tidak diupload sebelumnya
        elseif (!$foto4->hasMoved() && $foto4_lama == '') {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto4->getRandomName();
            $direktori_foto4 = $nama_folder . '/' . $nama_foto;

            $foto4->move('uploads/' . $nama_folder, $nama_foto);
        }
        // jika foto4 berhasil diupload, masih di temporary folder
        // dan foto lama diupload sebelumnya
        elseif (!$foto4->hasMoved() && $foto4_lama != '') {
            // hapus foto lama
            if (file_exists('uploads/' . $foto4_lama) && is_file('uploads/' . $foto4_lama)) {
                unlink('uploads/' . $foto4_lama);
            }

            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto4->getRandomName();
            $direktori_foto4 = $nama_folder . '/' . $nama_foto;

            $foto4->move('uploads/' . $nama_folder, $nama_foto);
        }

        // jika foto5 tidak diupload dan foto lama tidak diupload sebelumnya
        if ($foto5->getError() == 4 && $foto5_lama == '') {
            $direktori_foto5 = '';
        }
        // jika foto5 tidak diupload dan foto lama diupload sebelumnya
        elseif ($foto5->getError() == 4 && $foto5_lama != '') {
            $direktori_foto5 = $foto1_lama;
        }
        // jika foto5 berhasil diupload, masih di temporary folder
        // dan foto lama tidak diupload sebelumnya
        elseif (!$foto5->hasMoved() && $foto5_lama == '') {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto5->getRandomName();
            $direktori_foto5 = $nama_folder . '/' . $nama_foto;

            $foto5->move('uploads/' . $nama_folder, $nama_foto);
        }
        // jika foto5 berhasil diupload, masih di temporary folder
        // dan foto lama diupload sebelumnya
        elseif (!$foto5->hasMoved() && $foto5_lama != '') {
            // hapus foto lama
            if (file_exists('uploads/' . $foto5_lama) && is_file('uploads/' . $foto5_lama)) {
                unlink('uploads/' . $foto5_lama);
            }

            $nama_folder = $this->buat_folder_tanggal();
            $nama_foto = $foto5->getRandomName();
            $direktori_foto5 = $nama_folder . '/' . $nama_foto;

            $foto5->move('uploads/' . $nama_folder, $nama_foto);
        }


        $data = [
            'what_is_claimed' => $inputClaimType,
            'jobsite' => $inputJobsite,
            'claim_date' => $inputClaimDate,
            'claim_to' => $inputClaimTo,
            'warranty_decision' => $inputWarrantyDecision,
            'closing_date' => $inputClosingDate,
            'brand_unit' => $inputBrandUnit,
            'model_unit' => $inputModelUnit,
            'code_unit' => $inputCodeUnit,
            'sn_unit' => $inputSNUnit,
            'major_component' => $inputMajorComp,
            'component_model' => $inputCompModel,
            'sn_component' => $inputSNComp,
            'status_unit' => $inputStatusUnit,
            'amount_part' => $inputAmountPart,
            'final_amount' => $inputFinalAmount,
            'component' => $inputComponent,
            'sub_component' => $inputSubComponent,
            'part_number' => $inputPartNumber,
            'qty' => $inputQty,
            'fitment_date' => $inputFitmentDate,
            'trouble_date' => $inputTroubleDate,
            'hm/km_fitment' => $inputHmKmFitment,
            'hm/km_trouble' => $inputHmKmTrouble,
            'lifetime' => $inputLifetime,
            'problem_issue' => $inputDeskripsiProblem,
            'supporting_comments' => $inputComments,
            'schedule_follow_up' => $inputSchedule,
            'remark_progress' => $inputRemarkProgress,
            'created_by' => $inputCreatedBy,
            'approved_by1' => $inputApprovedBy,
            'approved_by2' => $inputApprovedBy2,
            'follow_up_by' => $inputFollowupBy,
            'foto_unit_depan' => $direktori_foto1,
            'foto_unit_samping' => $direktori_foto2,
            'foto_sn_unit' => $direktori_foto3,
            'foto_hm/km_unit' => $direktori_foto4,
            'foto_komponen_rusak' => $direktori_foto5
        ];

        // QUERY MELALUI MODEL
        $model = new CWPModel();
        $insert = $model->updateCWP($data, $inputId);
        //var_dump($data); exit();
        if ($insert) {
            // set flash data
            $session->setFlashdata('editCWPStatus', 'Claim Warranty Proposal berhasil diedit');
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/resume'));
        }

        $errors = 'The file has already been moved.';
        return var_dump($errors);
    }

    // delete cwp
    public function delete_cwp($no) {
        // QUERY MELALUI MODEL
        $CWPModel = new CWPModel();

        // get current data
        // untuk cek foto yang diupload
        $dataCWP = $CWPModel->getDataCWPById($no);

        foreach ($dataCWP as $row) {
            $id = $row->id;
            $follow_up_by = $row->follow_up_by;
            $foto_unit_depan = $row->foto_unit_depan;
            $foto_unit_samping = $row->foto_unit_samping;
            $foto_sn_unit = $row->foto_sn_unit;
            $foto_hmkm_unit = $row->{'foto_hm/km_unit'};
            $foto_komponen_rusak = $row->foto_komponen_rusak;
        }
        // hapus foto lama
        if (file_exists('uploads/' . $foto_unit_depan) && is_file('uploads/' . $foto_unit_depan)) {
            unlink('uploads/' . $foto_unit_depan);
        }
        if (file_exists('uploads/' . $foto_unit_samping) && is_file('uploads/' . $foto_unit_samping)) {
            unlink('uploads/' . $foto_unit_samping);
        }
        if (file_exists('uploads/' . $foto_sn_unit) && is_file('uploads/' . $foto_sn_unit)) {
            unlink('uploads/' . $foto_sn_unit);
        }
        if (file_exists('uploads/' . $foto_hmkm_unit) && is_file('uploads/' . $foto_hmkm_unit)) {
            unlink('uploads/' . $foto_hmkm_unit);
        }
        if (file_exists('uploads/' . $foto_komponen_rusak) && is_file('uploads/' . $foto_komponen_rusak)) {
            unlink('uploads/' . $foto_komponen_rusak);
        }

        $del = $CWPModel->delCWP($no);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/resume'));
        }
    }

}
