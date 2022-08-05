<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_accreditation extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('accreditation_document');
        $this->db->get();
        return $this->db->result();
    }

    function getAllData()
    {
        $this->datatables->select('
       accreditation_document_id,
       title,
       link,
       remarks,
       create_date');
        $this->datatables->from('accreditation_document');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('accreditation_document', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('accreditation_document');
        $this->db->where('accreditation_document_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('accreditation_document_id', $id);
        $this->db->update('accreditation_document', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('accreditation_document_id', $id);
        $this->db->delete('accreditation_document');
    }
}
