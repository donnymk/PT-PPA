<?php

namespace App\Controllers;

use App\Models\FollowupModel;

class Ajax extends BaseController {

    public function index() {
        echo 'hai';
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
