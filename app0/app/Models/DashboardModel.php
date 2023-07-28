<?php

namespace App\Models;

use CodeIgniter\Model;
//use CodeIgniter\Database\RawSql;

class DashboardModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'cbm_item';
    protected $primaryKey = 'idcbm_item';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['jeniscbm',
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
    /*    public function getDataCWP() {
      // tampilkan data CWP menggunakan query builder
      $builder = $this->builder();
      $query = $builder->get();
      return $query->getResult();
      } */
    
    // count data CBM by jenis
    public function countCBMByJenis() {
        // tentukan tabel
        $builder = $this->builder();
       $builder->select('COUNT(*),
    (SELECT 
            COUNT(*)
        FROM
            cbm_item
        WHERE
            jeniscbm = \'PAP\' AND sample_result = \'D\') AS pap_danger,
    (SELECT 
            COUNT(*)
        FROM
            cbm_item
        WHERE
            jeniscbm = \'PAP\' AND sample_result = \'C\') AS pap_urgent,
    (SELECT 
            COUNT(*)
        FROM
            cbm_item
        WHERE
            jeniscbm = \'CFM\' AND sample_result = \'D\') AS cfm_danger,
    (SELECT 
            COUNT(*)
        FROM
            cbm_item
        WHERE
            jeniscbm = \'CFM\' AND sample_result = \'C\') AS cfm_urgent,
    (SELECT 
            COUNT(*)
        FROM
            cbm_item
        WHERE
            jeniscbm = \'MPI\' AND sample_result = \'D\') AS mpi_danger,
    (SELECT 
            COUNT(*)
        FROM
            cbm_item
        WHERE
            jeniscbm = \'MPI\' AND sample_result = \'C\') AS mpi_urgent');
        $query = $builder->get();

        return $query;
    }

    // get data CBM by jenis
    public function getCBMByJenis($item) {
        // tampilkan data by ID menggunakan query builder
        $builder = $this->builder();
        $builder->where('jeniscbm', $item);
        $query = $builder->get();
        return $query->getResult();
    }

    // get data CBM by jenis and result
    public function getCBMByJenisnResult($item, $result) {
        // tampilkan data by ID menggunakan query builder
        $builder = $this->builder();
        $array = ['jeniscbm' => $item, 'sample_result' => $result];
        $builder->where($array);
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query->getResult();
    }    
    
    // insert data
    public function insertCBM($data) {
        // tentukan tabel
        $builder = $this->builder();
        // insert data
        return $builder->insertBatch($data);
    }

    // update data
    /*    public function updateCWP($data, $id) {
      // tentukan tabel
      $builder = $this->builder();
      // update data
      $builder->set($data);
      $builder->set('last_update', 'now()', false);
      $builder->where('id', $id);
      return $builder->update();
      } */

    // delete data by ID
    /*    public function delCWP($noCWP) {
      // tentukan tabel
      $builder = $this->builder();
      $builder->where('id', $noCWP);
      return $builder->delete();
      } */

    // count data CWP
//    public function countCWP() {
//        // tentukan tabel
//        $builder = $this->builder();
//        $builder->select('COUNT(*) countAll, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status is NULL OR follow_up_status = \'Open\') countOpen, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status = \'Close\') countClose, (SELECT COUNT(*) FROM resume_follow_up_cbm WHERE follow_up_status = \'Cancel\') countCancel');
//        //echo $builder->getCompiledSelect();
//        $query = $builder->get();
//        return $query->getResult();
//    }

    // get jobsite in CWP data
    /*    public function getJobsiteData() {
      // tampilkan menggunakan query builder
      $builder = $this->builder();
      $builder->select('jobsite');
      $builder->groupBy('jobsite');

      //return print_r($builder->getCompiledSelect());
      $query = $builder->get();
      return $query->getResult();
      } */
}
