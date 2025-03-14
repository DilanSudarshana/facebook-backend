<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user()
    {
       $query=$this->db->get('users');
        return $query->result();
    }

    public function find_user($id)
    {
        $this->db->where('id',$id);
        $query=$this->db->get('users');
        return $query->row();
    }

    public function insert_user($data){

        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }

    public function insert_profile($data){

        return $this->db->insert('profile',$data);
    }

    public function check_credentials($email,$password)
    {
        $this->db->where('mobile_or_email',$email);
        $query=$this->db->get('users');
        return $query->row();
    }

}
