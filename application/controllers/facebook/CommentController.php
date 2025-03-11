<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class CommentController extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('facebook/CommentModel');
        $this->load->helper('url');
    }

    public function index_get(){
        echo "Hellow world";
    }

    public function addComment_post(){

        $comment=new CommentModel();

        $json_data = json_decode($this->input->raw_input_stream, true);

        $comment_data=[
            'user_id'=>$this->input->post('user_id'),
            'post_id'=>$this->input->post('post_id'),
            'comment'=>$this->input->post('comment'),
        ];

        echo json_encode($comment_data);

        $result=$comment->add_new_comment($comment_data);

        if( $result>0){
            $this->response([
                'status'=>true,
                'message'=>'Post created'
            ],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'=>false,
                'message'=>'Failed to create user'
            ],REST_Controller::HTTP_OK);
        }
    }
                        
}
