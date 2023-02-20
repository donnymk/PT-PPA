<?php

namespace App\Models;

use CodeIgniter\Model;

class CWPModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'warranty_proposal';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['id',
        'jobsite',
        'claim_date',
        'claim_to',
        'warranty_decision',
        'closing_date',
        'brand_unit',
        'model_unit',
        'code_unit',
        'sn_unit',
        'major_component',
        'sn_component',
        'status_unit',
        'amount_part',
        'final_amount',
        'component',
        'sub_component',
        'part_number',
        'qty',
        'fitment_date',
        'trouble_date',
        'hm/km_fitment',
        'hm/km_trouble',
        'lifetime',
        'problem_issue',
        'supporting_comments',
        'schedule_follow_up',
        'remark_progress',
        'created_by',
        'approved_by1',
        'approved_by2',
        'follow_up_by',
        'foto_unit_depan',
        'foto_unit_samping',
        'foto_sn_unit',
        'foto_hm/km_unit',
        'foto_komponen_rusak'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get data CWP
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
    public function insertCWP($data) {
        // tentukan tabel
        $builder = $this->builder();
        // insert data
        return $builder->insert($data);
    }

    // update data
    public function updateFollowUp($data, $noFollowup) {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        // update data
        $builder->set($data);
        $builder->set('input2_timestamp', 'now()', false);
        $builder->where('no_follow_up', $noFollowup);
        return $builder->update();
    }

    // delete data by ID
    public function delFollowUp($noFollowup) {
        // tentukan tabel
        $builder = $this->builder('resume_follow_up_cbm');
        $builder->where('no_follow_up', $noFollowup);
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
