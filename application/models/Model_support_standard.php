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

    function getAllData()
    {
        $this->datatables->select('
     support_standard_id,
     title,
     remarks,
     create_date
        ');
        $this->datatables->from('support_standard');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('support_standard', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('support_standard');
        $this->db->where('support_standard_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('support_standard_id', $id);
        $this->db->update('support_standard', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('support_standard_id', $id);
        $this->db->delete('support_standard');
    }
}

/* End of file Model_support_standard.php */
