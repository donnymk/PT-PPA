<?php

namespace App\Controllers;

class Admin extends BaseController {

    public function index() {
        return view('dasbor_admin');
    }

    public function resume() {
        return view('resume');
    }

}
