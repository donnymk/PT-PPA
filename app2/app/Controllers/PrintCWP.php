<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\CWPModel;
use App\ThirdParty\fpdf185\FPDF;

class PrintCWP extends Controller {

    public function initController(
            RequestInterface $request,
            ResponseInterface $response,
            LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // initialize the session
        $session = \Config\Services::session();

        // jika belum login
        if (!$session->has('logged_in')) {
            echo 'Anda harus login. Klik <a href="' . base_url('claim-warranty/login') . '">di sini</a> untuk login';
            exit();
        }
    }

    public function index($id_cwp) {
        // QUERY MELALUI MODEL
        $model = new CWPModel();
        $data_cwp = $model->getDataCWPById($id_cwp);
//        $rekomendasi_followup = $model->getRekomendasiFollowup();
        $counter = 0;
//        $rekomendasi_lainnya = true;
        // get data followup
        foreach ($data_cwp as $row) {
            //$id = $row->id;
            // format nomor
            if ($id_cwp < 10) {
                $nomor_claim = '00' . $id_cwp;
            } elseif ($id_cwp >= 10 && $id_cwp < 100) {
                $nomor_claim = '0' . $id_cwp;
            } else {
                $nomor_claim = $id_cwp;
            }
            $claim_type = $row->what_is_claimed;
            $jobsite = $row->jobsite;
            $claim_date = $row->claim_date;
            $claim_to = $row->claim_to;
            $warranty_decision = $row->warranty_decision;
            //$closing_date = $row->closing_date;
            //$brand_unit = $row->brand_unit;
            $model_unit = $row->model_unit;
            $code_unit = $row->code_unit;
            $sn_unit = $row->sn_unit;
            //$major_component = $row->major_component;
            $component_model = $row->component_model;
            //$sn_component = $row->sn_component;
            $status_unit = $row->status_unit;
            //$amount_part = $row->amount_part;
            //$final_amount = $row->final_amount;
            $komponen = $row->component;
            $sub_component = $row->sub_component;
            $part_number = $row->part_number;
            $qty = $row->qty;
            $fitment_date = $row->fitment_date;
            $trouble_date = $row->trouble_date;
            $hmkm_fitment = $row->{'hm/km_fitment'};
            $hmkm_trouble = $row->{'hm/km_trouble'};
            $lifetime = $row->lifetime;
            $problem_issue = $row->problem_issue;
            $supporting_comments = $row->supporting_comments;
            $schedule_follow_up = $row->schedule_follow_up;
            //$remark_progress = $row->remark_progress;
            $created_by = $row->created_by;
            $approved_by1 = $row->approved_by1;
            $approved_by2 = $row->approved_by2;
            $follow_up_by = $row->follow_up_by;
            $foto_unit_depan = $row->foto_unit_depan;
            $foto_unit_samping = $row->foto_unit_samping;
            $foto_sn_unit = $row->foto_sn_unit;
            $foto_hmkm_unit = $row->{'foto_hm/km_unit'};
            $foto_komponen_rusak = $row->foto_komponen_rusak;
            $tahun_proposal = substr($claim_date, 0, 4);
        }

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 1.4);

        // HALAMAN PERTAMA
        $pdf->AddPage('P', 'A4');

        //$pdf->SetLineWidth(0.08);
        $pdf->Rect(8.4, 8, 193.6, 12);
        $pdf->Rect(9, 8.6, 192.2, 10.8);
        $pdf->Image(base_url('assets/img/ptppa.jpg'), 56, 8.8, 10);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 17);
        $pdf->Cell(0, 4, 'PUTRA PERKASA ABADI', 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 10.5);
        $pdf->Cell(28, 6.6, 'CLAIM TO:', 1, 0, 'C');
        $pdf->Cell(55, 6.6, $claim_to, 1, 0, 'C');
        $pdf->Cell(7, 6.6, '', 0, 0, 'C');
        $pdf->Cell(28, 6.6, 'CLAIM NO:', 1, 0, 'C');
        $pdf->Cell(72, 6.6, $nomor_claim . ' / PLT-' . $jobsite . ' / CWR / ' . $tahun_proposal, 1, 0, 'C');
        $pdf->Ln(17);
        $pdf->SetFont('Arial', 'BU', 13);
        //$pdf->SetLineWidth(0.2);
        $pdf->Cell(0, 6.6, 'WARRANTY/POLICY CLAIM FORM', 0, 0, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Helvetica', 'B', 9);

        $pdf->Cell(28, 5, '', 0, 0, 'L');
        if ($claim_type == 'Component/Part') {
            $pdf->Cell(5, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(37, 5, 'COMPONENT / PART', 0, 0, 'L');
        $pdf->Cell(9, 5, '', 0, 0, 'L');
        if ($claim_type == 'Conmon (PAP, PPM, VHMS, MAGPLUG, FLUID CONSUPMTION,DLL)') {
            $pdf->Cell(5, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(0, 5, 'COMMON (PAP, PPM, VHMS, MAGPLUG, FLUID CONSUMPTION, DLL)', 0, 0, 'L');
        $pdf->Line(10, 60, 200, 60);
        $pdf->Line(10, 60.6, 200, 60.6);
        $pdf->Ln(14);

        $pdf->Cell(22, 6, 'CLAIM DATE', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $claim_date, 'B', 0, 'L');
        $pdf->Cell(15, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'COMP. MODEL', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $component_model, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(22, 6, 'CODE UNIT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $code_unit, 'B', 0, 'L');
        $pdf->Cell(15, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'HM FAILURE', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $hmkm_trouble, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(22, 6, 'MODEL UNIT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $model_unit, 'B', 0, 'L');
        $pdf->Cell(15, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'LOCATION UNIT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $jobsite, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(22, 6, 'SN UNIT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $sn_unit, 'B', 0, 'L');
        $pdf->Cell(15, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'STATUS UNIT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Ln();

        // ke posisi XY untuk kolom isian STATUS UNIT
        $pdf->SetXY(132, 84);
        if ($status_unit == 'Operasi') {
            $pdf->Cell(6, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(6, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(25.5, 5, 'Operasi', 0, 0, 'L');
        $pdf->SetXY(132, 89);
        if ($status_unit == 'Breakdown') {
            $pdf->Cell(6, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(6, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(25.5, 5, 'Breakdown', 0, 0, 'L');
        $pdf->Ln(8);

//        $pdf->SetFillColor(105, 105, 105);
//        $pdf->SetDrawColor(105, 105, 105);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'PROBLEM ISSUE', 1, 0, 'C', 1);
        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->MultiCell(0, 5, $problem_issue, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'SUPPORTING COMMENTS', 1, 0, 'C', 1);
        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->MultiCell(0, 5, $supporting_comments, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'FAILED COMPONENT INFORMATION', 1, 0, 'C', 1);
        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(28, 6, 'COMPONENT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $komponen, 'B', 0, 'L');
        $pdf->Cell(9, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'SUB COMPONENT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $sub_component, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(28, 6, 'PART NUMBER', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $part_number, 'B', 0, 'L');
        $pdf->Cell(9, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'QTY', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $qty, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(28, 6, 'HM/KM FITMENT', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $hmkm_fitment, 'B', 0, 'L');
        $pdf->Cell(9, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'HM/KM TROUBLE', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $hmkm_trouble, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(28, 6, 'FITMENT DATE', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $fitment_date, 'B', 0, 'L');
        $pdf->Cell(9, 6, '', 0, 0, 'L');
        $pdf->Cell(28, 6, 'TROUBLE DATA', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(69, 6, $trouble_date, 'B', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(28, 6, 'LIFETIME', 0, 0, 'L');
        $pdf->Cell(3, 6, ': ', 0, 0, 'L');
        $pdf->Cell(50, 6, $lifetime, 'B', 0, 'L');
        $pdf->Ln(10);

        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'WARRANTY DECISION', 1, 0, 'C', 1);
        $pdf->Ln(10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(40, 5, '', 0, 0, 'L');
        if ($warranty_decision == 'Accept') {
            $pdf->Cell(5, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(40, 5, 'ACCEPT', 0, 0, 'L');
        if ($warranty_decision == 'Prorate') {
            $pdf->Cell(5, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(40, 5, 'POLICY/PRORATE', 0, 0, 'L');
        if ($warranty_decision == 'Rejected') {
            $pdf->Cell(5, 5, 'X', 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, '', 1, 0, 'C');
        }
        $pdf->Cell(40, 5, 'REJECT', 0, 0, 'L');
        $pdf->Line(10, 60, 200, 60);
        $pdf->Line(10, 60.6, 200, 60.6);
        $pdf->Ln(10);

//        foreach ($rekomendasi_followup as $row) {
//            $pdf->Cell(14, 5, ($counter + 1) . '. ' . $row->rekomendasi, 1, 0, 'L');
//            // jika rekomendasi follow up sama dengan salah satu yang ada di database
//            // maka blok (arsir) cell
//            // dan tandai bahwa tidak menggunakan rekomendasi lainnya
//            if ($rekom_followup == $row->rekomendasi) {
//                $pdf->Cell(25, 5, '', 1, 0, 'C', 1);
//                $rekomendasi_lainnya = false;
//            }
//            // jika rekomendasi follow up tidak sama dengan salah satu yang ada di database
//            // maka tampilan cell kosong
//            else {
//                $pdf->Cell(25, 5, '', 1, 0, 'C');
//            }
//            $pdf->Cell(25, 5, '', 1, 0, 'C');
//            $pdf->Ln();
//            $counter++;
//        }
        // baris untuk menampilkan rekomendasi lainnya
//        if ($rekomendasi_lainnya != true) {
//            $pdf->Cell(14, 5, ($counter + 1) . '. Lainnya: ...............', 1, 0, 'L');
//            $pdf->Cell(25, 5, '', 1, 0, 'C');
//        } else {
//            $pdf->Cell(14, 5, ($counter + 1) . '. Lainnya: ' . $rekom_followup, 1, 0, 'L');
//            $pdf->Cell(25, 5, '', 1, 0, 'C', 1);
//        }
        $pdf->Cell(0, 5, 'SCHEDULE FOLLOW UP', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->MultiCell(0, 5, $schedule_follow_up, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'APPROVAL', 1, 0, 'C', 1);
        $pdf->Ln(10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(38, 5, 'CREATED BY', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, 'APPROVED BY', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, 'APPROVE BY', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, 'FOLLOW UP BY', 0, 0, 'C');
        $pdf->Ln(24);
        $pdf->Cell(38, 5, $created_by, 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, $approved_by1, 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, $approved_by2, 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, '(......................................)', 0, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(38, 5, 'PLANT PLANNER', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, 'PLANT GROUP LEADER/PE', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, 'DEPT/SECTION HEAD PLANT', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(38, 5, $follow_up_by, 0, 0, 'C');
//        $pdf->SetFont('Times', 'B', 12);
//        $pdf->Cell(0, 20, '"SEGERA KUMPULKAN SAMPLE OLI SETELAH DIAMBIL"', 0, 0, 'C');
        // HALAMAN KEDUA
        $pdf->AddPage('P', 'A4');

        $pdf->Rect(8.4, 8, 193.6, 12);
        $pdf->Rect(9, 8.6, 192.2, 10.8);
        $pdf->Image(base_url('assets/img/ptppa.jpg'), 56, 8.8, 10);
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 17);
        $pdf->Cell(0, 4, 'PUTRA PERKASA ABADI', 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 10.5);
        $pdf->Cell(28, 6.6, 'CLAIM TO:', 1, 0, 'C');
        $pdf->Cell(55, 6.6, $claim_to, 1, 0, 'C');
        $pdf->Cell(7, 6.6, '', 0, 0, 'C');
        $pdf->Cell(28, 6.6, 'CLAIM NO:', 1, 0, 'C');
        $pdf->Cell(72, 6.6, $nomor_claim . ' / PLT-' . $jobsite . ' / CWR / ' . $tahun_proposal, 1, 0, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', 'B', 9);

        // header kotak
        $pdf->Cell(90, 5, 'FOTO UNIT DEPAN', 1, 0, 'C');
        $pdf->Cell(10, 60, '', 0, 0, 'C');
        $pdf->Cell(90, 5, 'FOTO UNIT SAMPING', 1, 0, 'C');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);

        // foto 1
        if ($foto_unit_depan != "") {
            //$pdf->Image($file, $x, $y, $w, $h);
            $pdf->Cell(90, 60, '', 1, 0, 'C');
            $pdf->Image(base_url() . '/claim-warranty/uploads/' . $foto_unit_depan, 12, 40, 85);
        } else {
            $pdf->Cell(90, 60, 'Tidak ada foto', 1, 0, 'C');
        }
        $pdf->Cell(10, 60, '', 0, 0, 'C');
        // foto 2
        if ($foto_unit_samping != "") {
            //$pdf->Image($file, $x, $y, $w, $h);
            $pdf->Cell(90, 60, '', 1, 0, 'C');
            $pdf->Image(base_url() . '/claim-warranty/uploads/' . $foto_unit_samping, 112, 40, 85);
        } else {
            $pdf->Cell(90, 60, 'Tidak ada foto', 1, 0, 'C');
        }
        $pdf->Ln(65);

        $pdf->SetFont('Arial', 'B', 9);
        
        // header kotak
        $pdf->Cell(90, 5, 'FOTO SN KOMPONEN/UNIT', 1, 0, 'C');
        $pdf->Cell(10, 60, '', 0, 0, 'C');
        $pdf->Cell(90, 5, 'FOTO HM/KM UNIT', 1, 0, 'C');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);
        
        // foto 3
        if ($foto_sn_unit!= "") {
            //$pdf->Image($file, $x, $y, $w, $h);
            $pdf->Cell(90, 60, '', 1, 0, 'C');
            $pdf->Image(base_url() . '/claim-warranty/uploads/' . $foto_sn_unit, 12, 110, 85);
        } else {
            $pdf->Cell(90, 60, 'Tidak ada foto', 1, 0, 'C');
        }
        $pdf->Cell(10, 60, '', 0, 0, 'C');
        // foto 4
        if ($foto_hmkm_unit != "") {
            //$pdf->Image($file, $x, $y, $w, $h);
            $pdf->Cell(90, 60, '', 1, 0, 'C');
            $pdf->Image(base_url() . '/claim-warranty/uploads/' . $foto_hmkm_unit, 112, 110, 85);
        } else {
            $pdf->Cell(90, 60, 'Tidak ada foto', 1, 0, 'C');
        }
        $pdf->Ln(65);
        
        $pdf->SetFont('Arial', 'B', 9);
        
        // header kotak
        $pdf->Cell(0, 5, 'FOTO KOMPONEN YANG RUSAK', 1, 0, 'C');
        $pdf->Ln(5);
        
        $pdf->SetFont('Arial', '', 10);
        
        // foto 5
        if ($foto_komponen_rusak!= "") {
            //$pdf->Image($file, $x, $y, $w, $h);
            $pdf->Cell(0, 105, '', 1, 0, 'C');
            $pdf->Image(base_url() . '/claim-warranty/uploads/' . $foto_komponen_rusak, 25, 180, 155);
        } else {
            $pdf->Cell(0, 105, 'Tidak ada foto', 1, 0, 'C');
        }

        // RENDER
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('FORM_CWP_' . $id_cwp . '.pdf', 'I');
    }

}
