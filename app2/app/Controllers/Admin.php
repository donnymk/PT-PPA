<?php

namespace App\Controllers;

use App\Models\JobsiteModel;
use App\Models\PopulasiModel;
use App\Models\CWAModel;
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
        //$session = \Config\Services::session();
        //
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

        $validationRule = [
            'fotoUnitDepan' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[fotoUnitDepan]',
                    'is_image[fotoUnitDepan]',
                    'mime_in[fotoUnitDepan,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoUnitDepan,2000]',
                    'max_dims[fotoUnitDepan,4000,3000]',
                ],
            ],
        ];
        // jika yang diupload tidak sesuai rule
        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            var_dump($errors);
        }

        $foto1 = $this->request->getFile('fotoUnitDepan');
        $foto2 = $this->request->getFile('fotoUnitSamping');
        $foto3 = $this->request->getFile('fotoSnUnit');
        $foto4 = $this->request->getFile('fotoHmKmUnit');
        $foto5 = $this->request->getFile('fotoKomponenRusak');
        
        // jika upload berhasil
        if (!$foto1->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $foto1->store();

            $data = ['uploaded_fileinfo' => new File($filepath)];
            return view('upload_success', $data);

            //return redirect()->to(base_url('claim-warranty/resume'));
        }

        $errors = 'The file has already been moved.';
        echo esc($errors);
    }

    public function resume() {
        return view('resume');
    }

}
