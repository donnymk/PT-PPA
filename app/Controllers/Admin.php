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
                $has_executed = 'no';
                if ($value->executed == '1') {
                    $has_executed = 'yes';
                }
                $date_executed = $value->date_executed;
                $pic = $value->pic;
                $status = $value->follow_up_status;
                $reason_cancelled = $value->reason_if_cancelled;
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
                            '<select class="form-control" id="has-executed"><option value="">no</option><option value="">yes</option></select>',
                            '<input type="date" class="form-control" id="date-executed" value="' . $date_executed . '">',
                            '<input type="text" class="form-control" id="pic" value="' . $pic . '">',
                            '<select class="form-control" id="followup-status"><option value="open">Open</option><option value="close">Close</option><option value="Cancel">Cancel</option></select>',
                            '<input type="text" class="form-control" id="reason-cancelled" value="' . $reason_cancelled . '">',
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
        // terima data dari form input
        $noFollowup = $this->request->getPost('noFollowup');
        $hasExecuted = $this->request->getPost('hasExecuted');
        $dateExecuted = $this->request->getPost('dateExecuted');
        $pic = $this->request->getPost('pic');
        $followupStatus = $this->request->getPost('followupStatus');
        $reasonCancelled = $this->request->getPost('reasonCancelled');

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
                "status_update" => 'ok'
            );
            echo json_encode($json_data);
        }
    }

}
