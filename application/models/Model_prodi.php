<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_prodi extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('program_study');
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
        a.create_date');
        $this->datatables->from('program_study a');
        $this->datatables->join('user b', 'b.userid = a.user_id_for_kaprodi', 'left');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('program_study', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('program_study');
        $this->db->where('program_study_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('program_study_id', $id);
        $this->db->update('program_study', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('program_study_id', $id);
        $this->db->delete('program_study');
    }
}


/* End of file Model_prodi.php */
