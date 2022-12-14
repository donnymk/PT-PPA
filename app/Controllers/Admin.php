<?php

namespace App\Controllers;

class Admin extends BaseController {

    public function index() {
        return view('dasbor');
    }

    public function input() {
        return view('form_input_cbm');
    }    
    
    public function resume() {
        return view('resume');
    }

}
