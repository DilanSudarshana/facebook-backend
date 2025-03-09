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

        return $this->db->insert('users',$data);
    }

    public function check_credentials($email,$password)
    {
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $query=$this->db->get('users');
        return $query->row();
    }

}
