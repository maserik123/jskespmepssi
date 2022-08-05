<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_configuration_video extends CI_Model
{

    function getData()
    {
        $this->db->select('*');
        $this->db->from('configuration_video');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('
       configuration_video_id,
       title,
       remarks,
       create_date');
        $this->datatables->from('configuration_video');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('configuration_video', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('configuration_video');
        $this->db->where('configuration_video_id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('configuration_video_id', $id);
        $this->db->update('configuration_video', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('configuration_video_id', $id);
        $this->db->delete('configuration_video');
    }
}

/* End of file Model_configuration_video.php */
