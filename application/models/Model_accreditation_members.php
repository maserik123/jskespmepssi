<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_accreditation_members extends CI_Model
{
    function getData()
    {
        $this->db->select('
         a.accreditation_members_id,
         b.full_name,
         b.initial,
         b.NIP,
         b.email,
         b.phone_number,
         c.role
        ');
        $this->db->from('accreditation_members a');
        $this->db->join('user b', 'b.userid = a.userid', 'inner');
        $this->db->join('user_role c', 'c.user_role_id = a.user_role_id', 'inner');
        $this->db->order_by('a.accreditation_members_id', 'asc');
        return $this->db->get()->result();
    }

    function getAllData($criteria_id, $support_documents_id)
    {
        $this->datatables->select('
         a.accreditation_members_id,
         b.full_name,
         b.initial,
         b.NIP,
         b.email,
         a.level
        ');
        $this->datatables->from('accreditation_members a');
        $this->datatables->join('user b', 'b.userid = a.userid', 'inner');
        $this->datatables->join('user_role c', 'c.user_role_id = a.user_role_id', 'inner');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('accreditation_members', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('accreditation_members');
        $this->db->where('accreditation_members_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('accreditation_members_id', $id);
        $this->db->update('accreditation_members', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('accreditation_members_id', $id);
        $this->db->delete('accreditation_members');
    }
}

/* End of file Model_support_master.php */
