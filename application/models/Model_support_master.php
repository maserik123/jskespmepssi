<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_support_master extends CI_Model
{

    function getData()
    {
        $this->db->select('*');
        $this->db->from('support_master');
        return $this->db->get()->result();
    }

    function getAllData($criteria_id, $support_documents_id)
    {
        $this->datatables->select('
          a.support_master_id,
          a.number,
          a.title,
          a.link,
          a.remarks,
          a.create_date  
        ');
        $this->datatables->from('support_master a');
        $this->datatables->join('support_standard b', 'b.support_standard_id = a.support_standard_id', 'inner');
        $this->datatables->join('support_criteria c', 'c.support_criteria_id = a.support_criteria_id', 'inner');
        $this->datatables->join('support_documents d', 'd.support_documents_id = a.support_documents_id', 'inner');
        $this->datatables->where('a.support_documents_id', $support_documents_id);
        $this->datatables->where('a.support_criteria_id', $criteria_id);
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('support_master', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('support_master');
        $this->db->where('support_master_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('support_master_id', $id);
        $this->db->update('support_master', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('support_master_id', $id);
        $this->db->delete('support_master');
    }
}

/* End of file Model_support_master.php */
