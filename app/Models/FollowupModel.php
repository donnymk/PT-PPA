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

    // get model unit
    public function get_model_unit() {
        $model = new FollowupModel();
        
        // tampilkan data model unit dengan query builder
        $builder = $model->builder();
        $builder->groupBy('model_unit');
        $query = $builder->get();
        return $query->getResult();
    }

}
