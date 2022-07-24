<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_assessment extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('assessment_schedule');
        $this->db->get();
        return $this->db->result();
    }

    function getAllData()
    {
        $this->datatables->select('
        a.assessment_schedule_id,
        b.title as title_prodi,
        b.accreditation as accreditation_prodi,
        b.year as year_prodi,
        a.period,
        a.start,
        a.end,
       (select count(*) as team from program_study_lecturer where program_study_id = a.prodi_id) as team,
        a.create_date');
        $this->datatables->from('assessment_schedule a');
        $this->datatables->join('program_study b', 'b.program_study_id = a.prodi_id', 'inner');
        $this->datatables->join('program_study_lecturer c', 'c.program_study_id = a.prodi_id', 'inner');
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


/* End of file Model_assessment.php */