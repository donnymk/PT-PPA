<?php

namespace App\Models;

use CodeIgniter\Model;

class CWPModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'warranty_proposal';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['id',
        'what_is_claimed',
        'jobsite',
        'claim_date',
        'claim_to',
        'warranty_decision',
        'closing_date',
        'brand_unit',
        'model_unit',
        'code_unit',
        'sn_unit',
        'major_component',
        'sn_component',
        'status_unit',
        'amount_part',
        'final_amount',
        'component',
        'sub_component',
        'part_number',
        'qty',
        'fitment_date',
        'trouble_date',
        'hm/km_fitment',
        'hm/km_trouble',
        'lifetime',
        'problem_issue',
        'supporting_comments',
        'schedule_follow_up',
        'remark_progress',
        'created_by',
        'approved_by1',
        'approved_by2',
        'follow_up_by',
        'foto_unit_depan',
        'foto_unit_samping',
        'foto_sn_unit',
        'foto_hm/km_unit',
        'foto_komponen_rusak'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get all data CWP
    public function getDataCWP() {
        // tampilkan data CWP menggunakan query builder
        $builder = $this->builder();
        $query = $builder->get();
        return $query->getResult();
    }

    // get data CWP by ID
    public function getDataCWPById($id) {
        // tampilkan data by ID menggunakan query builder
        $builder = $this->builder();
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    // insert data
    public function insertCWP($data) {
        // tentukan tabel
        $builder = $this->builder();
        // insert data
        return $builder->insert($data);
    }

    // update data
    public function updateCWP($data, $id) {
        // tentukan tabel
        $builder = $this->builder();
        // update data
        $builder->set($data);
        $builder->set('last_update', 'now()', false);
        $builder->where('id', $id);
        return $builder->update();
    }

    // delete data by ID
    public function delCWP($noCWP) {
        // tentukan tabel
        $builder = $this->builder();
        $builder->where('id', $noCWP);
        return $builder->delete();
    }

    // count data CWP
//    public function countCWP() {
//        // tentukan tabel
//        $builder = $this->builder();
//        $builder->select('COUNT(*) countAll, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status is NULL OR follow_up_status = \'Open\') countOpen, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status = \'Close\') countClose, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status = \'Cancel\') countCancel');
//        //echo $builder->getCompiledSelect();
//        $query = $builder->get();
//        return $query->getResult();
//    }

    // count data followup by status
    public function countCWPByJobsite($jobsite) {
        // tentukan tabel
        $builder = $this->builder();
        $builder->select('warranty_decision, COUNT(*) AS jumlah_cwp');
       
        // Jika jobsite tertentu
        if($jobsite != 'All'){
            $builder->where('jobsite', $jobsite);
        }
        $builder->groupBy('warranty_decision');
        $query = $builder->get();
        
        return $query->getResult();
    }
    
    // get jobsite in CWP data
    public function getJobsiteData() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->select('jobsite');
        $builder->groupBy('jobsite');
        
        //return print_r($builder->getCompiledSelect());
        $query = $builder->get();
        return $query->getResult();
    }    

}
