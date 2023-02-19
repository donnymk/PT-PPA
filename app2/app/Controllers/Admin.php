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

    public function submit_cwp() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
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
                    'max_dims[fotoUnitDepan,4000,3000]',
                ],
            ],
            'fotoUnitSamping' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoUnitSamping]',
                    'is_image[fotoUnitSamping]',
                    'mime_in[fotoUnitSamping,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoUnitSamping,2000]',
                    'max_dims[fotoUnitSamping,4000,3000]',
                ],
            ],
            'fotoSnUnit' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoSnUnit]',
                    'is_image[fotoSnUnit]',
                    'mime_in[fotoSnUnit,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoSnUnit,2000]',
                    'max_dims[fotoSnUnit,4000,3000]',
                ],
            ],
            'fotoHmKmUnit' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoHmKmUnit]',
                    'is_image[fotoHmKmUnit]',
                    'mime_in[fotoHmKmUnit,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoHmKmUnit,2000]',
                    'max_dims[fotoHmKmUnit,4000,3000]',
                ],
            ],
            'fotoKomponenRusak' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoKomponenRusak]',
                    'is_image[fotoKomponenRusak]',
                    'mime_in[fotoKomponenRusak,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoKomponenRusak,2000]',
                    'max_dims[fotoKomponenRusak,4000,3000]',
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
            $nama_foto1 = '';
            //echo 'foto1 tidak diupload';
        }
        // jika foto1 diupload dan berhasil
        elseif (!$foto1->hasMoved()) {
            $nama_foto1 = 'uploads/' . $foto1->store();
            //echo $nama_foto1;
            //$filepath1 = WRITEPATH . 'uploads/' . $foto1->store();
            //$data = ['uploaded_fileinfo' => new File($filepath1)];
        }

        // jika foto2 tidak diupload
        if ($foto2->getError() == 4) {
            $nama_foto2 = '';
        }
        // jika foto2 diupload dan berhasil
        elseif (!$foto2->hasMoved()) {
            $nama_foto2 = 'uploads/' . $foto2->store();
        }

        // jika foto3 tidak diupload
        if ($foto3->getError() == 4) {
            $nama_foto3 = '';
        }
        // jika foto3 diupload dan berhasil
        elseif (!$foto3->hasMoved()) {
            $nama_foto3 = 'uploads/' . $foto3->store();
        }

        // jika foto4 tidak diupload
        if ($foto4->getError() == 4) {
            $nama_foto4 = '';
        }
        // jika foto4 diupload dan berhasil
        elseif (!$foto4->hasMoved()) {
            $nama_foto4 = 'uploads/' . $foto4->store();
        }

        // jika foto5 tidak diupload
        if ($foto5->getError() == 4) {
            $nama_foto5 = '';
        }
        // jika foto5 diupload dan berhasil
        elseif (!$foto5->hasMoved()) {
            $nama_foto5 = 'uploads/' . $foto5->store();
        }

        $data = [
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
            'foto_unit_depan' => $nama_foto1,
            'foto_unit_samping' => $nama_foto2,
            'foto_sn_unit' => $nama_foto3,
            'foto_hm/km_unit' => $nama_foto4,
            'foto_komponen_rusak' => $nama_foto5
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

}
