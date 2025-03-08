<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StatusModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_status()
    {
        $this->db->select('status.*, users.first_name, users.last_name'); 
        $this->db->from('status');
        $this->db->join('users', 'users.id = status.user_id');
        $query = $this->db->get();
        return $query->result();
    }

}
