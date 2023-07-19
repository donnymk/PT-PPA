<?php

namespace App\Models;

use CodeIgniter\Model;

class PopulasiModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'populasi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['machine_maker', 'model_unit', 'code_unit'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get all populasi
    public function getPopulasi() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $query = $builder->get();
        return $query->getResult();
    }
    
    // insert data
    public function insertPopulasi($data) {
        $builder = $this->builder();
        // insert data
        return $builder->insert($data);
    }
    
    // delete by ID
    public function delPopulasi($no) {
        $builder = $this->builder();
        $builder->where('id', $no);
        return $builder->delete();
    }
    
    // get brand unit (machine maker)
    public function getBrandUnit() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->select('machine_maker');
        //$builder->groupBy('machine_maker');
        $builder->distinct();
        $query = $builder->get();
        return $query->getResult();
    }
    
    // get model unit by brand unit (machine maker)
    public function getModelUnitbyBrandUnit($brandUnit) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->select('model_unit');
        $builder->where('machine_maker', $brandUnit);
        //$builder->groupBy('model_unit');
        $builder->distinct();
        $query = $builder->get();
        return $query->getResult();
    }
    
    // get code unit by model unit
    public function getCodeUnitbyModelUnit($modelUnit) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->select('code_unit');
        $builder->where('model_unit', $modelUnit);
        //$builder->groupBy('model_unit');
//        $builder->distinct();
        $query = $builder->get();
        return $query->getResult();
    }

}
