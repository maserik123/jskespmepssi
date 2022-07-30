<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_prodi_lecturer extends CI_Model
{

    function getData()
    {
        $this->db->select('*');
        $this->db->from('program_study_lecturer');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('
        a.program_study_lecturer_id,
        b.full_name,
        b.initial,
        b.NIP,
        b.email,
        c.title as prodi,
        a.create_date');
        $this->datatables->from('program_study_lecturer a');
        $this->datatables->join('user b', 'b.userid = a.userid', 'inner');
        $this->datatables->join('program_study c', 'c.program_study_id = a.program_study_id', 'left');
        return $this->datatables->generate();
    }

    function calc_prodi_members($prodi_id)
    {
        $this->db->select('count(*) as total_members');
        $this->db->from('program_study_lecturer');
        $this->db->where('program_study_id', $prodi_id);
        return $this->db->get()->row();
    }

    function addData($data)
    {
        $this->db->insert('program_study_lecturer', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('program_study_lecturer');
        $this->db->where('program_study_lecturer_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('program_study_lecturer_id', $id);
        $this->db->update('program_study_lecturer', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('program_study_lecturer_id', $id);
        $this->db->delete('program_study_lecturer');
    }
}

/* End of file Model_prodi_lecturer.php */
