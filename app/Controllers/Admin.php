<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FollowupModel;

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
        // KONEKSI DB DAN QUERY MELALUI MODEL
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

            // KONEKSI DB DAN QUERY MELALUI MODEL
            $model = new FollowupModel();
            $get_code_unit = $model->getCodeUnit($modelUnit);

            foreach ($get_code_unit as $key => $value):
                array_push($data_code_unit, $value->code_unit);
            endforeach;
        }

        echo json_encode($data_code_unit);
    }
    
    // input CBM
    public function input_cbm(){
        $inputModelUnit = $this->request->getPost('inputModelUnit');
        echo $inputModelUnit;
    }

    public function resume() {
        return view('resume');
    }

}
