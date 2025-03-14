<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    public function get_profile_details($id) {
        $this->db->select('*');
        $this->db->from('profile');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    } 
    
    public function update_user_profile($id,$data){
        return $this->db->where('user_id', $id)->update('profile', $data);
    }

    public function update_user($id,$data){
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function add_post($data){
        return $this->db->insert('posts', $data);
    }

}
