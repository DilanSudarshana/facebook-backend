<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_posts() {
        $this->db->select('posts.*, users.first_name, users.last_name, users.image as user_image'); 
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->order_by('posts.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function create_post($data){

        return $this->db->insert('posts',$data);
    }

    public function delete_post($id){
        
        return $this->db->where('id', $id)->delete('posts');
    }

    public function get_post_by_id($id) {
        $this->db->select('posts.*, users.first_name, users.last_name, users.image AS pro_image');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id', 'left');
        $this->db->where('posts.user_id', $id);
        $this->db->order_by('posts.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }    

    public function create_new_post($data){

        return $this->db->insert('posts',$data);
    }

}
