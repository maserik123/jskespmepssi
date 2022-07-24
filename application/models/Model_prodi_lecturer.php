<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_prodi_lecturer extends CI_Model
{

    function getData()
    {
        $this->db->select('*');
        $this->db->from('program_study_lecturer');
        $this->db->get();
        return $this->db->result();
    }

    function getAllData()
    {
        $this->datatables->select('
        a.program_study_id,
        a.title,
        a.abbreviation,
        a.accreditation,
        a.year,
        b.full_name as kaprodi_name,
        create_date');
        $this->datatables->from('program_study a');
        $this->datatables->join('user b', 'b.userid = a.user_id_for_kaprodi', 'left');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('assessment_schedule', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('assessment_schedule');
        $this->db->where('assessment_schedule_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->update('assessment_schedule', $data, $id);
        return $this->db->affected_rows();
    }

    function deleteById($id)
    {
        $this->db->where('user_role_id', $id);
        $this->db->delete('assessment_schedule');
    }
}

/* End of file Model_prodi_lecturer.php */
