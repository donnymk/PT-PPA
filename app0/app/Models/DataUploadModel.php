<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

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
    
    // get difference of the time zone from database server
    public function getTimeDiff(){
        $builder = $this->builder();
        $builder->select('timediff(now(),convert_tz(now(),@@session.time_zone,\'+00:00\')) AS time_diff', false);
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;        
    }

    // get all data upload including including converted timezone from timestamp
    public function getDataUpload($from_timezone, $to_timezone) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        
        // use raw sql
        $sql = 'nama_file_ori, lokasi, DATE_FORMAT(CONVERT_TZ(timestamp,\''.$from_timezone.'\',\''.$to_timezone.'\'), \'%d %b %Y %H:%i:%s\') AS converted_time';
        $builder->select(new RawSql($sql));
        $builder->orderBy('timestamp', 'DESC');
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }
    
    // get all data upload
    public function getDataUploadSimple() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        
        //return $builder->getCompiledSelect();
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
