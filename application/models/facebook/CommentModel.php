<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CommentModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_new_comment($data)
    {
        return $this->db->insert('comments', $data);

    }

}
