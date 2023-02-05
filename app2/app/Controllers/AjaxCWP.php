<?php

namespace App\Controllers;

use App\Models\PopulasiModel;

class AjaxCWP extends BaseController {

    public function index() {
        echo 'hai';
    }

    // get data follow up CBM
    public function data_cbm() {
        // initialize the session
        $session = \Config\Services::session();

        // cek session login untuk mengetahui role access
        if ($session->has('username')) {
            $role = $session->role;
        }        
        
        $data_cbm = [];

        // Check for AJAX request
        if ($this->request->isAJAX()) {
            // QUERY MELALUI MODEL
            $model = new FollowupModel();
            $get_data_cbm = $model->getdataCbm();

            foreach ($get_data_cbm as $key => $value):
                // select option sudah dieksekusi apa belum
                $has_executed = ($value->executed === '1' ? ' Yes' : 'No');
                $follow_up_status = $value->follow_up_status;
                if ($follow_up_status == '') {
                    $follow_up_status = 'Open';
                }
                
                // button update dan delete
                $update_button = '<a class="btn btn-primary btn-sm" href="update/' . $value->no_follow_up . '">Update...</a>';
                $delete_button = '<a class="btn btn-secondary btn-sm" href="delete/' . $value->no_follow_up . '" onclick="return confirm_del(' . $value->no_follow_up . ')"><span class="fa fa-trash"></span></a>';

                array_push($data_cbm,
                        array($value->no_follow_up,
                            $value->model,
                            $value->code_unit,
                            $value->komponen,
                            $value->cbm,
                            $value->deskripsi_problem,
                            $value->rekomendasi_follow_up,
                            $value->plan_date_follow_up,
                            '<a class="btn btn-primary" href="cetak_form/' . $value->no_follow_up . '" target="_blank"><span class="fa fa-2x fa-file-pdf"></span></a>',
                            $has_executed,
                            $value->date_executed,
                            $value->pic,
                            $follow_up_status,
                            $value->reason_if_cancelled,
                            $update_button,
                            $delete_button)
                );
            endforeach;

            $json_data = array(
                "data" => $data_cbm
            );
            echo json_encode($json_data);
        }
        return false;
    }

    // get model unit berdasarkan brand unit
    public function get_model_unit() {
        $data_model_unit = [];

        // data dari Ajax request
        $brandUnit = $this->request->getVar('brandUnit');

        // Check for AJAX request
        if ($this->request->isAJAX()) {

            // QUERY MELALUI MODEL
            $model = new PopulasiModel();
            $get_model_unit = $model->getModelUnitbyBrandUnit($brandUnit);

            foreach ($get_model_unit as $key => $value):
                array_push($data_model_unit, $value->model_unit);
            endforeach;
        }

        echo json_encode($data_model_unit);
    }    
    
    // get code unit berdasarkan model unit
    public function get_code_unit() {
        $data_code_unit = [];

        // data dari Ajax request
        $modelUnit = $this->request->getVar('modelUnit');

        // Check for AJAX request
        if ($this->request->isAJAX()) {

            // QUERY MELALUI MODEL
            $model = new PopulasiModel();
            $get_code_unit = $model->getCodeUnitbyModelUnit($modelUnit);

            foreach ($get_code_unit as $key => $value):
                array_push($data_code_unit, $value->code_unit);
            endforeach;
        }

        echo json_encode($data_code_unit);
    }

    // get jumlah follow up by CBM dengan status open
    public function jumlah_followup_open() {
        // Check for AJAX request
        if ($this->request->isAJAX()) {
            // QUERY MELALUI MODEL
            $model = new FollowupModel();
            //$get_data_cbm = $model->getdataCbm();
            $get_jumlah_followup = $model->countFollowUpOpen();

            echo json_encode($get_jumlah_followup);
        }
        return false;
    }
}
