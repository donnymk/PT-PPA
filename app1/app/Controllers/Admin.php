<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\FollowupModel;
use App\Models\LoginModel;

class Admin extends Controller {

    // fungsi yang pertama kali dan selalu dijalankan
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);

        // initialize the session
        $session = \Config\Services::session();

        // jika belum login
        if (!$session->has('logged_in')) {
            echo 'Anda harus login. Klik <a href="' . base_url('followup-cbm/login') . '">di sini</a> untuk login';
            exit();
        }
    }

    public function index() {
        return view('dasbor');
    }

    // tampilkan semua data model unit
    public function data_model_unit() {
        // initialize the session
        $session = \Config\Services::session();

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['populasi'] = $model->getAllModelUnit();

        return view('data_model_unit', $data);
    }

    // tampilkan semua data komponen
    public function data_komponen() {
        // initialize the session
        $session = \Config\Services::session();

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['komponen'] = $model->getKomponen();

        return view('data_komponen', $data);
    }

    // tampilkan semua data rekomendasi
    public function data_rekomendasi() {
        // initialize the session
        $session = \Config\Services::session();

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['rekomendasi'] = $model->getRekomendasi();

        return view('data_rekomendasi', $data);
    }

    // form input
    public function input() {
        // initialize the session
        $session = \Config\Services::session();
        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // GET MODEL UNIT UNTUK DITAMPILKAN DI SELECT INPUT
        //
        // KONEKSI DB DAN QUERY SECARA LANGSUNG
//        $db = \Config\Database::connect();
//        $builder = $db->table('populasi');
//        $query   = $builder->get();
//        print_r($query->getResult());
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['model_unit'] = $model->getModelUnit();
        $data['komponen'] = $model->getKomponen();
        $data['rekomendasi_followup'] = $model->getRekomendasiFollowup();

        return view('form_input_cbm', $data);
    }

    // input populasi
    public function input_populasi() {
        // terima data dari form input
        $inputModelUnit = $this->request->getPost('inputModelUnit');
        $inputCodeUnit = $this->request->getPost('inputCodeUnit');

        $data = [
            'model_unit' => $inputModelUnit,
            'code_unit' => $inputCodeUnit
        ];

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $insert = $model->insertPopulasi($data);
        if ($insert) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/data_model_unit'));
        }
    }

    // input komponen
    public function input_komponen() {
        // terima data dari form input
        $inputKomponen = $this->request->getPost('inputKomponen');

        $data = [
            'nama_komponen' => $inputKomponen
        ];

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $insert = $model->insertKomponen($data);
        if ($insert) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/data_komponen'));
        }
    }

    // insert rekomendasi
    public function input_rekomendasi() {
        // terima data dari form input
        $inputRekomendasi = $this->request->getPost('inputRekomendasi');

        $data = [
            'rekomendasi' => $inputRekomendasi
        ];

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $insert = $model->insertRekomendasi($data);
        if ($insert) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/data_rekomendasi'));
        }
    }

    // insert data follow up CBM
    public function input_cbm() {
        // terima data dari form input
        $inputModelUnit = $this->request->getPost('inputModelUnit');
        $inputCodeUnit = $this->request->getPost('inputCodeUnit');
        $inputKomponen = $this->request->getPost('inputKomponen');
        $inputTemuanCbm = $this->request->getPost('inputTemuanCbm');
        $inputDeskripsiProblem = $this->request->getPost('inputDeskripsiProblem');
        $selectRekomFollowUp = $this->request->getPost('selectRekomFollowUp');
        $inputRekomFollowUp = $this->request->getPost('inputRekomFollowUp');
        $inputPlanDate = $this->request->getPost('inputPlanDate');
        $inputRemarks = $this->request->getPost('inputRemarks');

        if ($selectRekomFollowUp == 'Lainnya') {
            $selectRekomFollowUp = $inputRekomFollowUp;
        }

        $data = [
            'code_unit' => $inputCodeUnit,
            'model' => $inputModelUnit,
            'komponen' => $inputKomponen,
            'cbm' => $inputTemuanCbm,
            'deskripsi_problem' => $inputDeskripsiProblem,
            'rekomendasi_follow_up' => $selectRekomFollowUp,
            'plan_date_follow_up' => $inputPlanDate,
            'remarks' => $inputRemarks
        ];

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $insert = $model->insertFollowUp($data);
        if ($insert) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/resume'));
        }
    }

    public function resume() {
        // initialize the session
        $session = \Config\Services::session();
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
    public function update($noFollowUp) {
        // initialize the session
        $session = \Config\Services::session();

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // GET DATA FOLLOW UP BY ID UNTUK DITAMPILKAN DI FORM UPDATE
        //
        // KONEKSI DB DAN QUERY SECARA LANGSUNG
//        $db = \Config\Database::connect();
//        $builder = $db->table('populasi');
//        $query   = $builder->get();
//        print_r($query->getResult());
//
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['followup'] = $model->getDataCbmById($noFollowUp);

        return view('form_update', $data);
    }

    // update follow up
    public function update_followup() {
        // data dari Ajax request
        $noFollowup = $this->request->getVar('noFollowup');
        $hasExecuted = $this->request->getVar('hasExecuted');
        $dateExecuted = $this->request->getVar('dateExecuted');
        $pic = $this->request->getVar('pic');
        $followupStatus = $this->request->getVar('followupStatus');
        $reasonCancelled = $this->request->getVar('reasonCancelled');

        $data = [
            'executed' => $hasExecuted,
            'date_executed' => $dateExecuted,
            'pic' => $pic,
            'follow_up_status' => $followupStatus,
            'reason_if_cancelled' => $reasonCancelled
        ];

        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $update = $model->updateFollowUp($data, $noFollowup);

        if ($update) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/resume'));
        }
    }

    // delete data follow up
    public function delete_followup($no_followup) {
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $del = $model->delFollowUp($no_followup);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/resume'));
        }
    }

    // delete data populasi
    public function delete_populasi($no) {
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $del = $model->delPopulasi($no);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/data_model_unit'));
        }
    }

    // delete data komponen
    public function delete_komponen($no) {
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $del = $model->delKomponen($no);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/data_komponen'));
        }
    }

    // delete data rekomendasi
    public function delete_rekomendasi($no) {
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $del = $model->delRekomendasi($no);

        if ($del) {
            // Go to specific URI
            return redirect()->to(base_url('followup-cbm/data_rekomendasi'));
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
    public function submit_changepwd() {
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
        return redirect()->to(base_url('followup-cbm/changepwd'));
    }

}
