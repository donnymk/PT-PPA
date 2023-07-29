<?php

namespace App\Controllers;

use App\Models\CWPModel;
use App\Models\LoginModel;

class HomeCW extends BaseController {

    public function index($jobsite) {
        // initialize the session
        $session = \Config\Services::session();

        // get current url
        $uri = current_url(true);
        // Disable throwing exceptions
        $uri->setSilent();

        // default value
        $data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $data['username'] = $session->username;
            $data['role'] = $session->role;
        }

        // QUERY MELALUI MODEL
        $model = new CWPModel();
        $data['jobsiteData'] = $model->getJobsiteData();
		
		$totalSegments = $uri->getTotalSegments();
        //$data['currentJobsite'] = $uri->getSegment(4); // static
		$data['currentJobsite'] = $uri->getSegment($totalSegments); // dynamic menyesuaikan URL
		if($data['currentJobsite'] == 'index.php'){
			$data['currentJobsite'] = '';
		}
		//var_dump($data['currentJobsite']); exit();
		
        $countCWP = $model->countCWPByJobsite($jobsite);
        $data['countCWP'] = $countCWP;

        $rekap_cwp = [];
        $total_cwp = 0;
        foreach ($countCWP as $row) {
            $baris = array();
            $baris['warranty_decision'] = $row->warranty_decision;
            $baris['jumlah_cwp'] = $row->jumlah_cwp;
            // total
            $total_cwp = $total_cwp + $row->jumlah_cwp;
            $baris['total_cwp'] = $total_cwp;
            
            array_push($rekap_cwp, $baris);
        }
        //var_dump($rekap_cwp); exit();

        return view('dasborcwp', $data);
    }

    public function login() {
        // initialize the session
        $data['session'] = \Config\Services::session();
        return view('login_cwp', $data);
    }

    // proses login
    public function loginproses() {
        // terima data dari form login
        $inputUsername = $this->request->getPost('inputUsername');
        $inputPassword = $this->request->getPost('inputPassword');

        // initialize the session
        $session = \Config\Services::session();

        // default password db = null karena belum dilakukan query database
        $password_db = null;

        // QUERY MELALUI MODEL
        $model = new LoginModel();
        $select_admin = $model->authAdmin($inputUsername);

        // jika data ditemukan
        foreach ($select_admin as $value):
            $role = $value->role;
            $password_db = $value->password;
        endforeach;

        // jika password benar
        if (password_verify($inputPassword, $password_db)) {
            $newdata = [
                'username' => $inputUsername,
                'role' => $role,
                'logged_in' => true,
            ];
            $session->set($newdata);

            session_write_close();

            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/'));
        } else {
            $session->setFlashdata('login_gagal', 'Username atau Password salah');
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/login'));
        }
    }

    public function logout() {
        // initialize the session
        $session = \Config\Services::session();
        //$session->destroy();
        $array_items = ['username', 'role', 'logged_in'];
        $session->remove($array_items);

        // Go to specific URI
        return redirect()->to(base_url('claim-warranty/'));
    }

}
