<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_support_standard extends CI_Model
{

    function getData()
    {
        $this->db->select('*');
        $this->db->from('support_standard');
        $this->db->order_by('support_standard_id', 'asc');
        return $this->db->get()->result();
    }
}

/* End of file Model_support_standard.php */
