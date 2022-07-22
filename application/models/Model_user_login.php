<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user_login extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->get();
        return $this->db->result();
    }

    function getAllData()
    {
        $this->datatables->select('userid,full_name,nick_name,initial,NIP,email,address,phone_number,create_date');
        $this->datatables->from('user');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('user');
        $this->db->where('userid', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->update('user', $data, $id);
        return $this->db->affected_rows();
    }

    function deleteById($id)
    {
        $this->db->where('userid', $id);
        $this->db->delete('user');
    }
}

/* End of file Model_user.php */
