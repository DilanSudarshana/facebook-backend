<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImageModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    public function get_all_images($id) {
        
        $this->db->select('image,id,user_id');
        $this->db->from('posts');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }  

}
