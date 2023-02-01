<?php

namespace App\Controllers;

use App\Models\JobsiteModel;
use App\Models\PopulasiModel;
use App\Models\CWAModel;

class Admin extends BaseController {

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

    public function input() {
        return view('form_input_cbm');
    }

    public function resume() {
        return view('resume');
    }

}
