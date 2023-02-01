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

}
