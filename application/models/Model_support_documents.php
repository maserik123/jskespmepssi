<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_support_documents extends CI_Model
{

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('support_documents');
        return $this->db->get()->result();
    }
}

/* End of file Model_support_documents.php */
