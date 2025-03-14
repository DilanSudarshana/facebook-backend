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
        $this->db->order_by('status.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function create_new_status($data){
        return $this->db->insert('status',$data);
    }

}
