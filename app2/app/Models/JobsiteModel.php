<?php

namespace App\Models;

use CodeIgniter\Model;

class JobsiteModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'job_site';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['job_site'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get all jobsite
    public function getJobsite() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $query = $builder->get();
        return $query->getResult();
    }
    
    // insert data jobsite
    public function insertJobsite($data) {
        $builder = $this->builder();
        // insert data
        return $builder->insert($data);
    }
    
    // delete Jobsite by ID
    public function delJobsite($no) {
        $builder = $this->builder();
        $builder->where('id', $no);
        return $builder->delete();
    }

}
