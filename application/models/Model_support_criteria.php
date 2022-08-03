<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_support_criteria extends CI_Model
{

    function getData()
    {
        $this->db->select('');
        $this->db->from('support_criteria');
        $this->db->order_by('support_criteria_id', 'asc');
        return $this->db->get()->result();
    }
}

/* End of file Model_support_criteria.php */
