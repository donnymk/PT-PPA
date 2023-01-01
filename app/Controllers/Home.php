<?php

namespace App\Controllers;

use App\Models\FollowupModel;

class Home extends BaseController {

    public function index() {
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        
        $data['countFollowUp'] = $model->countFollowUp();
        return view('dasbor', $data);
    }

    public function login() {
        return view('login');
    }

}
