<?php

namespace App\Models;

use CodeIgniter\Model;

class DataUploadModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'data_upload';
    protected $primaryKey = 'id_upload';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['nama_file_ori', 'lokasi', 'timestamp'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get all jobsite
    public function getDataUpload() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->orderBy('timestamp', 'DESC');
        $query = $builder->get();
        return $query;
    }
    
    // insert data CBM items
    public function insertDataUpload($data) {
        $builder = $this->builder();
        // insert data
        //return $builder->set($data)->getCompiledInsert();
        return $builder->insert($data);
    }
    
    // kosongkan data upload
    public function empty_data_up() {
        // tentukan tabel
        $builder = $this->builder();
        return $builder->truncate();
    }

}
