<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FollowupModel;
use CodeIgniter\I18n\Time;

class Admin extends Controller {

    public function index() {
        return view('dasbor');
    }

    public function input() {
        // GET MODEL UNIT UNTUK DITAMPILKAN DI SELECT INPUT
        //
        // KONEKSI DB DAN QUERY SECARA LANGSUNG
//        $db = \Config\Database::connect();
//        $builder = $db->table('populasi');
//        $query   = $builder->get();
//        print_r($query->getResult());
//        
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['model_unit'] = $model->getModelUnit();

        return view('form_input_cbm', $data);
    }

    public function get_code_unit() {
        $data_code_unit = [];

        // data dari Ajax request
        $modelUnit = $this->request->getVar('modelUnit');

        // Check for AJAX request
        if ($this->request->isAJAX()) {

            // QUERY MELALUI MODEL
            $model = new FollowupModel();
            $get_code_unit = $model->getCodeUnit($modelUnit);

            foreach ($get_code_unit as $key => $value):
                array_push($data_code_unit, $value->code_unit);
            endforeach;
        }

        echo json_encode($data_code_unit);
    }

    // input CBM
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
            'plan_date_follow_up' => $inputPlanDate
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
        return view('resume');
    }

    // get data follow up CBM
    public function data_cbm() {
        $data_cbm = [];

        // Check for AJAX request
        if ($this->request->isAJAX()) {
            // QUERY MELALUI MODEL
            $model = new FollowupModel();
            $get_data_cbm = $model->getdataCbm();

            foreach ($get_data_cbm as $key => $value):
                $has_executed = $value->executed;
                $status = $value->follow_up_status;
                
                // select option sudah dieksekusi apa belum
                $has_executed_option = '<select class="form-control" id="has-executed"><option value=0'.($has_executed === '0' ? ' selected' : '').'>no</option><option value=1'.($has_executed === '1' ? ' selected' : '').'>yes</option></select>';
                // select option status follow up
                $followup_status_option = '<select class="form-control" id="followup-status"><option value="open"'.($status === 'open' ? ' selected' : '').'>Open</option><option value="close"'.($status === 'close' ? ' selected' : '').'>Close</option><option value="cancel"'.($status === 'cancel' ? ' selected' : '').'>Cancel</option></select>';
              
                array_push($data_cbm,
                        array($value->no_follow_up,
                            $value->model,
                            $value->code_unit,
                            $value->komponen,
                            $value->cbm,
                            $value->deskripsi_problem,
                            $value->rekomendasi_follow_up,
                            $value->plan_date_follow_up,
                            '<a class="btn btn-primary" href="cetak_form/' . $value->no_follow_up . '"><span class="fa fa-2x fa-file-pdf"></span></a>',
                            $has_executed_option,
                            '<input type="date" class="form-control" id="date-executed" value="' . $value->date_executed . '">',
                            '<input type="text" class="form-control" id="pic" value="' . $value->pic . '">',
                            $followup_status_option,
                            '<input type="text" class="form-control" id="reason-cancelled" value="' . $value->reason_if_cancelled . '">',
                            '<a class="btn btn-primary btn-sm" onclick="updateFollowUp(' . $value->no_follow_up . ')">Update</a>',
                            '<a class="btn btn-secondary btn-sm" href="delete"><span class="fa fa-trash"></span></a>')
                );
            endforeach;

            $json_data = array(
                "data" => $data_cbm
            );
        }
        echo json_encode($json_data);
    }

    public function cetak_form($no_followup) {
        echo $no_followup;
        // QUERY MELALUI MODEL
//        $model = new FollowupModel();
//        $data['model_unit'] = $model->getModelUnit($no_followup);
//
//        return view('form_input_cbm', $data);        
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
            $json_data = array(
                "statusUpdate" => 'ok'
            );
            echo json_encode($json_data);
        }
    }

}
