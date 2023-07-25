<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\DataUploadModel;
//use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\RawSql;
use Psr\Log\LoggerInterface;

class AdminDashboard extends BaseController {

    protected $helpers = ['form'];

    public function initController(
            RequestInterface $request,
            ResponseInterface $response,
            LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // cek login
        $this->cek_login();
    }

    public function cek_login() {
        // initialize the session
        $session = \Config\Services::session();

        // jika belum login
        if (!$session->has('logged_in')) {
            echo '<script>window.location="' . base_url('dashboard/login') . '"</script>';
            exit();
        }
    }

    public function index() {
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

        return view('dashboard', $data);
    }

    // form import data CBM
    public function import_cbm() {
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
        $model = new DataUploadModel();
        $data['data_excel'] = $model->getDataUpload();

        return view('form_import', $data);
    }

    // input jobsite
    /*    public function input_jobsite() {
      // terima data dari form input
      $inputJobsite = $this->request->getPost('inputJobsite');

      // initialize the session
      $session = \Config\Services::session();

      $data = [
      'job_site' => $inputJobsite
      ];

      // QUERY MELALUI MODEL
      $model = new DataUploadModel();
      $insert = $model->insertJobsite($data);
      if ($insert) {
      // set flash data
      $session->setFlashdata('inputJobsiteStatus', 'Jobsite berhasil ditambahkan');
      // Go to specific URI
      return redirect()->to(base_url('claim-warranty/data_jobsite'));
      }
      } */

    // delete jobsite
    /*    public function delete_jobsite($no) {
      // QUERY MELALUI MODEL
      $model = new DataUploadModel();
      $del = $model->delJobsite($no);

      if ($del) {
      // Go to specific URI
      return redirect()->to(base_url('claim-warranty/data_jobsite'));
      }
      } */

    // tampilkan semua data populasi
    /*    public function data_populasi() {
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
      } */

    // input populasi
    /*    public function input_populasi() {
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
      } */

    // delete data populasi
    /*    public function delete_populasi($no) {
      // QUERY MELALUI MODEL
      $model = new PopulasiModel();
      $del = $model->delPopulasi($no);

      if ($del) {
      // Go to specific URI
      return redirect()->to(base_url('claim-warranty/data_populasi'));
      }
      } */

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

    public function submit_cbm() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        //$inputClaimType = $this->request->getPost('inputClaimType');
        $fileExcel = $this->request->getFile('dataCbmExcel');
        $ori_filename = $fileExcel->getName();

        // aturan file upload
        $validationRule = [
            'dataCbmExcel' => [
                'label' => 'Excel File',
                'rules' => [
                    'uploaded[dataCbmExcel]', // file wajib diupload
                    'mime_in[dataCbmExcel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]', // format file excel 2007 (.xlsx)           
                    'max_size[dataCbmExcel,9000]' // max 9 MB
                ],
            ]
        ];

        // jika yang diupload tidak sesuai rule
        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            return var_dump($errors);
        }

        // jika file excel berhasil diupload dan masih ada di temporary folder
        elseif (!$fileExcel->hasMoved()) {
            $nama_folder = $this->buat_folder_tanggal();
            $nama_file = $fileExcel->getRandomName();
            $dir_file_excel = $nama_folder . '/' . $nama_file;
            
            // pindahkan file excel ke folder uploads/yyyymmdd/
            $fileExcel->move('uploads/' . $nama_folder, $nama_file);
        }

        // baca file excel
        $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $render->load('uploads/'.$dir_file_excel);

        $data_cbm = [];
        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            // skip first row
            if ($x == 0) {
                continue;
            }
            // tentukan kolom
            //$no[$x-1] = $row[0];
            $data_cbm[$x-1]['jenis_cbm'] = $row[1];
            $data_cbm[$x-1]['workgroup'] = $row[2];
            $data_cbm[$x-1]['unit_code'] = $row[3];
            $data_cbm[$x-1]['model'] = $row[4];
            $data_cbm[$x-1]['component'] = $row[5];
            $data_cbm[$x-1]['sample_date'] = $row[6];
            $data_cbm[$x-1]['hm_sample'] = $row[7];
            $data_cbm[$x-1]['oil_change'] = $row[8];
            $data_cbm[$x-1]['sample_result'] = $row[9];
            $data_cbm[$x-1]['analysis_lab'] = $row[10];
            $data_cbm[$x-1]['rekomendasi_lab'] = $row[11];
        }
        //echo var_dump($data_cbm); exit();
        
        $data_excel = [
            'nama_file_ori' => $ori_filename, // get nama file original
            'lokasi' => $dir_file_excel,
            'timestamp' => new RawSql('CURRENT_TIMESTAMP()')
        ];
        // INSERT DATA FILE EXCEL
        $dataUploadModel = new DataUploadModel();
        $insertDataExcel = $dataUploadModel->insertDataUpload($data_excel);

        // INSERT DATA CBM YG ADA DI DALAM FILE EXCEL
        $dashboardModel = new DashboardModel();
        $insert = $dashboardModel->insertCBM($data_cbm);
        var_dump($insertDataExcel); exit();
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputCBMStatus', 'Data CBM berhasil diimport');
            // Go to specific URI
            return redirect()->to(base_url('dashboard'));
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

    // delete cwp
    /*    public function delete_cwp($no) {
      // QUERY MELALUI MODEL
      $DashboardModel = new DashboardModel();

      // get current data
      // untuk cek foto yang diupload
      $dataCWP = $DashboardModel->getDataCWPById($no);

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

      $del = $DashboardModel->delCWP($no);

      if ($del) {
      // Go to specific URI
      return redirect()->to(base_url('claim-warranty/resume'));
      }
      } */
}
