<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowupModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'populasi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['model_unit', 'code_unit'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get data CBM
    public function getDataCbm() {
        // tampilkan data CBM menggunakan query builder
        $builder = $this->builder('resume_follow_up_cbm');
        $query = $builder->get();
        return $query->getResult();
    }

    // get data CBM by ID
    public function getDataCbmById($noFollowUp) {
        // tampilkan data CBM by ID menggunakan query builder
        $builder = $this->builder('resume_follow_up_cbm');
        $builder->where('no_follow_up', $noFollowUp);
        $query = $builder->get();
        return $query->getResult();
    }
    
    // get all model unit dan code unit
    public function getAllModelUnit() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $query = $builder->get();
        return $query->getResult();
    }    

    // get model unit group by model unit
    public function getModelUnit() {
        // tampilkan data model unit menggunakan query builder
        $builder = $this->builder();
        $builder->select('model_unit');
        $builder->groupBy('model_unit');
        $query = $builder->get();
        return $query->getResult();
    }

    // get code unit
    public function getCodeUnit($modelUnit) {
        // tampilkan data code unit menggunakan query builder
        $builder = $this->builder();
        $builder->select('code_unit');
        $builder->where('model_unit', $modelUnit);
        $query = $builder->get();
        return $query->getResult();
    }

    // get rekomendasi followup
    public function getRekomendasiFollowup() {
        // tampilkan data rekomendasi follow up menggunakan query builder
        $builder = $this->builder('rekomendasi_follow_up');
        $query = $builder->get();
        return $query->getResult();
    }

    // insert data populasi
    public function insertPopulasi($data) {
        // tentukan tabel
        $builder = $this->builder('populasi');
        // insert data
        return $builder->insert($data);
    }    
    
    // insert data follow up
    public function insertFollowUp($data) {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        // insert data
        return $builder->insert($data);
    }

    // update data follow up
    public function updateFollowUp($data, $noFollowup) {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        // update data
        $builder->set($data);
        $builder->set('input2_timestamp', 'now()', false);
        $builder->where('no_follow_up', $noFollowup);
        return $builder->update();
    }

    // delete data follow up by ID
    public function delFollowUp($noFollowup) {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        $builder->where('no_follow_up', $noFollowup);
        return $builder->delete();
    }
    
    // delete data Populasi by ID
    public function delPopulasi($no) {
        // tentukan tabel
        $builder = $this->builder();
        $builder->where('id', $no);
        return $builder->delete();
    }

    // count data followup by status
    public function countFollowUp() {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        $builder->select('COUNT(*) countAll, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status is NULL OR follow_up_status = \'Open\') countOpen, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status = \'Close\') countClose, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status = \'Cancel\') countCancel');
        //echo $builder->getCompiledSelect();
        $query = $builder->get();
        return $query->getResult();
    }

    // count data followup by status
    public function countFollowUpOpen() {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        $builder->select('DISTINCT(cbm), COUNT(no_follow_up) as jumlahdata');
        $where = "follow_up_status='Open' OR follow_up_status IS null";
        $builder->where($where);
        $builder->groupBy('cbm');
        $query = $builder->get();
        return $query->getResult();
    }

}
