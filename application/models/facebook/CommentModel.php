<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CommentModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function find_comment($id) {

        $this->db->select('comments.*, users.first_name, users.last_name');
        $this->db->from('comments');
        $this->db->join('users', 'users.id = comments.user_id', 'left');
        $this->db->where('comments.post_id', $id);
        $this->db->order_by('comments.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_new_comment($data)
    {
        return $this->db->insert('comments', $data);

    }

    public function get_comment_count($id){
        $this->db->select('posts.comment_count');
        $this->db->from('posts');
        $this->db->where('posts.id', $id);
        return $this->db->get()->row()->comment_count;
    }

    public function store_incresed_count($id){

        $this->db->set('comment_count', 'comment_count+1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('posts');

    }

}
