<?php

namespace App\Controllers;

//use CodeIgniter\Controller;
use App\Models\FollowupModel;

class Admin extends BaseController {

    public function index() {
        return view('dasbor');
    }

    public function input() {
        // GET MODEL UNIT UNTUK DITAMPILKAN DI SELECT INPUT
        // KONEKSI DB DAN QUERY SECARA LANGSUNG
//        $db = \Config\Database::connect();
//        $builder = $db->table('populasi');
//        $query   = $builder->get();
//        print_r($query->getResult());        
        
        // KONEKSI DB DAN QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data['model_unit'] = $model->get_model_unit();

        return view('form_input_cbm', $data);
    }
    
    public function get_code_unit(){
        echo 'hai';
    }

    public function resume() {
        return view('resume');
    }

}
