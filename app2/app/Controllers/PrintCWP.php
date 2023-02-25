<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\FollowupModel;
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
        if(!$session->has('logged_in')){
            echo 'Anda harus login. Klik <a href="'. base_url('claim-warranty/login').'">di sini</a> untuk login';
            exit();
        }
    }    

    public function index($id_cwp) {
        // QUERY MELALUI MODEL
        $model = new FollowupModel();
        $data_followup = $model->getDataCbmById($id_cwp);
        $rekomendasi_followup = $model->getRekomendasiFollowup();
        $counter = 0;
        $rekomendasi_lainnya = true;

        // get data followup
        foreach ($data_followup as $row) {
            $code_unit = $row->code_unit;
            $model_unit = $row->model;
            $komponen = $row->komponen;
            $cbm = $row->cbm;
            $deskripsi_problem = $row->deskripsi_problem;
            $rekom_followup = $row->rekomendasi_follow_up;
            //$input_timestamp = $row->input_timestamp;
            $plan_date_follow_up = $row->plan_date_follow_up;
//            $executed = $row->executed;
//            $date_executed = $row->date_executed;
//            $pic = $row->pic;
//            $follow_up_status = $row->follow_up_status;
//            $reason_if_cancelled = $row->reason_if_cancelled;
//            $input2_timestamp = $row->input2_timestamp;
        }

        $pdf = new FPDF('P', 'cm', 'A4');
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 1.4);
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetLineWidth(0.08);
        $pdf->Rect(0.8, 0.8, 19.4, 27.8);
        $pdf->Image(base_url('assets/img/ptppa.jpg'), 1, 1.5, 1.5);
        $pdf->Cell(14, 0.4, '', 0, 0, 'C');
        $pdf->Cell(0, 0.4, 'No. Follow Up: ', 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->Cell(1.7, 0.66, '', 0, 0, 'L');
        $pdf->Cell(5.2, 0.66, 'PT. Putra Perkasa Abadi', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(7, 0.66, 'CONDITION BASED MONITORING', 0, 0, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetLineWidth(0.02);
        $pdf->Cell(0, 0.66, $id_cwp, 1, 0, 'C');
        $pdf->Ln(0.5);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->Cell(1.7, 0.66, '', 0, 0, 'L');
        $pdf->Cell(5.2, 0.66, 'Plant Departement', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(7, 0.66, 'Follow Up', 0, 0, 'C');
        $pdf->Cell(0, 0.66, '', 0, 0, 'C');
        $pdf->Ln(0.5);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->Cell(1.7, 0.66, '', 0, 0, 'L');
        $pdf->Cell(5.2, 0.66, 'MIP-Lahat', 0, 0, 'L');
        $pdf->Ln(1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(3.5, 0.5, 'CODE UNIT', 'LTB', 0, 'L');
        $pdf->Cell(5, 0.5, ': ' . $code_unit, 'RTB', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(3.5, 0.5, 'MODEL', 'LTB', 0, 'L');
        $pdf->Cell(5, 0.5, ': ' . $model_unit, 'RTB', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(3.5, 0.5, 'KOMPONEN', 'LTB', 0, 'L');
        $pdf->Cell(5, 0.5, ': ' . $komponen, 'RTB', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(3.5, 0.5, 'TEMUAN CBM APA?', 'LTB', 0, 'L');
        $pdf->Cell(5, 0.5, ': ' . $cbm, 'RTB', 0, 'L');
        $pdf->Ln();
        $pdf->Cell(3.5, 0.5, 'PLAN DATE F.U', 'LTB', 0, 'L');
        $pdf->Cell(5, 0.5, ': ' . $plan_date_follow_up, 'RTB', 0, 'L');
        // kembali ke posisi kanan atas untuk kolom HASIL ANALISA
        $pdf->SetXY(15, 2.5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(5, 0.5, 'HASIL ANALISA', 1, 0, 'C');
        $pdf->SetXY(15, 3);
        $pdf->SetFont('Arial', 'B', 22);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(2.45, 1.1, 'D', 'LR', 0, 'C');
        $pdf->Cell(2.55, 1.1, '', 'LR', 0, 'C');
        $pdf->SetXY(15, 4.1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(2.45, 0.5, 'Danger', 'LBR', 0, 'C');
        $pdf->Cell(2.55, 0.5, '', 'LBR', 0, 'C');
        $pdf->SetXY(15, 4.6);
        $pdf->SetFont('Arial', 'B', 22);
        $pdf->SetTextColor(255, 204, 0);
        $pdf->Cell(2.45, 1.1, 'C', 'LR', 0, 'C');
        $pdf->Cell(2.55, 1.1, '', 'LR', 0, 'C');
        $pdf->SetXY(15, 5.7);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(2.45, 0.5, 'Problem', 'LBR', 0, 'C');
        $pdf->Cell(2.55, 0.5, '', 'LBR', 0, 'C');
        $pdf->SetXY(1, 6.7);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 0.5, 'INDIKASI ABNORMAL DARI CBM:', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 0.5, $deskripsi_problem, 0, 'L');
        $pdf->Ln(0.4);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(14, 0.6, 'REKOMENDASI (LINGKARI/CHECK PADA DAFTAR REKOMENDASI BERIKUT)', 1, 0, 'C');
        $pdf->Cell(2.5, 0.6, 'FOLLOW UP', 1, 0, 'C');
        $pdf->Cell(2.5, 0.6, 'EXECUTED', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(51, 102, 204);

        foreach ($rekomendasi_followup as $row) {
            $pdf->Cell(14, 0.5, ($counter + 1) . '. ' . $row->rekomendasi, 1, 0, 'L');
            // jika rekomendasi follow up sama dengan salah satu yang ada di database
            // maka blok (arsir) cell
            // dan tandai bahwa tidak menggunakan rekomendasi lainnya
            if ($rekom_followup == $row->rekomendasi) {
                $pdf->Cell(2.5, 0.5, '', 1, 0, 'C', 1);
                $rekomendasi_lainnya = false;
            }
            // jika rekomendasi follow up tidak sama dengan salah satu yang ada di database
            // maka tampilan cell kosong
            else {
                $pdf->Cell(2.5, 0.5, '', 1, 0, 'C');
            }
            $pdf->Cell(2.5, 0.5, '', 1, 0, 'C');
            $pdf->Ln();
            $counter++;
        }
        // baris untuk menampilkan rekomendasi lainnya
        if ($rekomendasi_lainnya != true) {
            $pdf->Cell(14, 0.5, ($counter + 1) . '. Lainnya: ...............', 1, 0, 'L');
            $pdf->Cell(2.5, 0.5, '', 1, 0, 'C');
        } else {
            $pdf->Cell(14, 0.5, ($counter + 1) . '. Lainnya: ' . $rekom_followup, 1, 0, 'L');
            $pdf->Cell(2.5, 0.5, '', 1, 0, 'C', 1);
        }
        $pdf->Cell(2.5, 0.5, '', 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(0, 0.5, 'Keterangan:', 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(1, 0.5, 'V', 1, 0, 'C');
        $pdf->Cell(1, 0.5, 'Tanda "V" pada kotak apabila follow up sudah dilaksanakan', 0, 0, 'L');
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 0.5, 'KESIMPULAN DAN SARAN', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 3, '', 1, 0, 'L');        
        $pdf->Ln();
        $pdf->Cell(2, 2, 'TANGGAL', 1, 0, 'C');
        $pdf->Cell(4.3, 2, '', 1, 0, 'L');
        $pdf->Cell(2, 2, 'PIC', 1, 0, 'C');
        $pdf->Cell(4.5, 2, '', 1, 0, 'L');
        $pdf->Cell(2, 2, 'TTD', 1, 0, 'C');
        $pdf->Cell(4.2, 2, '', 1, 0, 'L');
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 2, '"SEGERA KUMPULKAN SAMPLE OLI SETELAH DIAMBIL"', 0, 0, 'C');         
        
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('form_cwp_' . $id_cwp . '.pdf', 'I');
    }

}
