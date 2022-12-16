<?php
class FollowUpCBM extends CI_Model{
    
    // get model unit
    function get_model_unit(){        
        $this->db->select('model_unit');
        $this->db->from('tb_admin');
        $this->db->groupBy('model_unit');
        return $this->db->get();
    }    
}
