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
        a.program_study_id,
        a.title,
        a.abbreviation,
        a.accreditation,
        a.year,
        b.full_name as kaprodi_name,
        create_date');
        $this->datatables->from('program_study_lecturer a');
        $this->datatables->join('user b', 'b.userid = a.user_id_for_kaprodi', 'left');
        $this->datatables->join('program_study c', 'c.program_study_id = a.program_study_id', 'left');
        return $this->datatables->generate();
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
        $this->db->update('program_study_lecturer', $data, $id);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('program_study_lecturer_id', $id);
        $this->db->delete('program_study_lecturer');
    }
}

/* End of file Model_prodi_lecturer.php */
