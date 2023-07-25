<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'cbm_item';
    protected $primaryKey = 'idcbm_item';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['idcbm_item',
        'id_upload',
        'jeniscbm',
        'workgroup',
        'unitcode',
        'model',
        'component',
        'date_pap',
        'hm_pap',
        'oil_change',
        'sample_result',
        'analysis_lab',
        'rekomendasi_lab'];
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
    public function insertCBM($data) {
        // tentukan tabel
        $builder = $this->builder();
        // insert data
        return $builder->insert_batch($data);
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
