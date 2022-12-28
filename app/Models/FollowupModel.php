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
    
    // get model unit
    public function getModelUnit() {
        // tampilkan data model unit menggunakan query builder
        $builder = $this->builder();
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
    
    // insert ke database
    public function insertFollowUp($data){
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        // insert data
        return $builder->insert($data);      
    }
    
    // update data follow up
    public function updateFollowUp($data, $noFollowup){
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        // update data
        $builder->set($data);
        $builder->set('input2_timestamp', 'now()', false);
        $builder->where('no_follow_up', $noFollowup);
        return $builder->update();
    }

}
