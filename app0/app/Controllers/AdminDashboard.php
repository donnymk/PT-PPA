<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\DataUploadModel;
use App\Models\AuthModel;
//use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
//use CodeIgniter\Database\RawSql;
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
        //var_dump($session); exit();
        // QUERY MELALUI MODEL
        $model = new DashboardModel();
        $data['stat_dashboard'] = $model->countCBMByJenis()->getResult();

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

        // get the time diff
        $timediff = $model->getTimeDiff()->getResult();
        $timeDiff = $timediff[0]->time_diff;

        // lakukan konversi time zone ke GMT+7
        $from_timezone = '+' . substr($timeDiff, 0, 5);
        $to_timezone = '+07:00';

        $data['data_excel'] = $model->getDataUpload($from_timezone, $to_timezone)->getResult();

        //return var_dump($data['data_excel']);
        return view('form_import', $data);
    }

    // empty data from table
    public function empty_data_cbm() {
        // initialize the session
        $session = \Config\Services::session();

        // QUERY MELALUI MODEL
        $model_dashboard = new DashboardModel();
        $model_up = new DataUploadModel();

        // get current data
        // to check excel files uploaded to server to be deleted
        $dataUpload = $model_up->getDataUploadSimple()->getResult();
        foreach ($dataUpload as $row) {
            $file_excel = $row->lokasi;
            // delete excel files
            if (file_exists('uploads/' . $file_excel) && is_file('uploads/' . $file_excel)) {
                unlink('uploads/' . $file_excel);
            }
        }

        // empty 2 tables
        $truncate_data_cbm = $model_dashboard->empty_data_cbm();
        $truncate_data_upload = $model_up->empty_data_up();

        if ($truncate_data_cbm && $truncate_data_upload) {
            // set flash data
            $session->setFlashdata('truncateStatus', 'Data CBM berhasil dikosongkan');
            // Go to specific URI
            return redirect()->to(base_url('dashboard/import_cbm'));
        }
    }

    // tampilkan semua data CBM sesuai jenis
    public function viewcbm($jenis) {
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
        $model = new DashboardModel;
        $data['cbm_item'] = $model->getCBMByJenis($jenis);

        $data['jenis_cbm'] = $jenis;
        $data['result'] = 'All';

        $view = 'data_cbm';
        // view khusus CBM PAP
        if ($jenis == 'PAP') {
            $view = 'data_cbm_pap';
        }
        return view($view, $data);
    }

    // tampilkan data CBM sesuai jenis dan result
    public function viewcbm_by_result($jenis, $result) {
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
        $model = new DashboardModel;
        $data['jenis_cbm'] = $jenis;
        $data['result'] = $result;
        $data['cbm_item'] = $model->getCBMByJenisnResult($jenis, $result);
        //var_dump($data['cbm_item']); exit();

        $view = 'data_cbm';
        // view khusus CBM PAP
        if ($jenis == 'PAP') {
            $view = 'data_cbm_pap';
        }
        return view($view, $data);
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
        $model = new AuthModel();
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
        return redirect()->to(base_url('dashboard/changepwd'));
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

    // import data from Excel 2007 to MySQL
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
        $spreadsheet = $render->load('uploads/' . $dir_file_excel);

        $data_cbm = [];
        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            // skip first row
            if ($x == 0) {
                continue;
            }
            // tentukan kolom
            //$no[$x-1] = $row[0];
            $data_cbm[$x - 1]['jeniscbm'] = $row[1];
            $data_cbm[$x - 1]['workgroup'] = $row[2];
            $data_cbm[$x - 1]['unitcode'] = $row[3];
            $data_cbm[$x - 1]['model'] = $row[4];
            $data_cbm[$x - 1]['component'] = $row[5];
            $data_cbm[$x - 1]['date_pap'] = $row[6];
            $data_cbm[$x - 1]['hm_pap'] = $row[7];
            $data_cbm[$x - 1]['oil_change'] = $row[8];
            $data_cbm[$x - 1]['sample_result'] = $row[9];
            $data_cbm[$x - 1]['analysis_lab'] = $row[10];
            $data_cbm[$x - 1]['rekomendasi_lab'] = $row[11];
        }
        //echo var_dump($data_cbm); exit();

        $data_excel = [
            'nama_file_ori' => $ori_filename, // get nama file original
            'lokasi' => $dir_file_excel,
                //'timestamp' => new RawSql('CURRENT_TIMESTAMP()')
        ];
        // INSERT DATA FILE EXCEL
        $dataUploadModel = new DataUploadModel();
        $insertDataExcel = $dataUploadModel->insertDataUpload($data_excel);
        //var_dump($insertDataExcel); exit();
        // INSERT DATA CBM YG ADA DI DALAM FILE EXCEL
        $dashboardModel = new DashboardModel();
        $insert = $dashboardModel->insertCBM($data_cbm);
        //var_dump($data_excel); exit();

        if ($insertDataExcel && $insert) {
            // set flash data
            $session->setFlashdata('inputCBMStatus', 'Data CBM berhasil diimport');
            // Go to specific URI
            return redirect()->to(base_url('dashboard'));
        }

        $errors = 'There was an error.';
        return var_dump($errors);
    }

    // set theme (tampilan)
    public function set_theme($theme) {
        // initialize the session
        $session = \Config\Services::session();

        $changedata = [
            'theme' => $theme
        ];
        $session->set($changedata);

        session_write_close();

        // Go to specific URI
        return redirect()->to(base_url('dashboard/'));
    }
}
