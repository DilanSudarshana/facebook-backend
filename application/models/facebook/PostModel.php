<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_posts()
    {
       $query=$this->db->get('posts');
        return $query->result();
    }

    public function create_post($data){

        return $this->db->insert('posts',$data);
    }

    public function delete_post($id){
        
        return $this->db->where('id', $id)->delete('posts');
    }

}
