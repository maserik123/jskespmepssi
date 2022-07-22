<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menu extends CI_Model
{
    function getListMenu()
    {
        $this->db->select('*');
        $this->db->from('menu a');
        $this->db->join('menu_logo b', 'b.menu_logo_id = a.menu_logo_id', 'left');
        $this->db->order_by('menu_hierarki', 'asc');
        return $this->db->get()->result();
    }
}

/* End of file Model_menu.php */
