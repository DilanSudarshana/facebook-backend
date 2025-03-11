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

    public function addComment_post($id){

        $json_data = json_decode($this->input->raw_input_stream, true);
        $comment=new CommentModel();

        $comment_data=[
            'user_id'=>$this->input->post('user_id'),
            'post_id'=>$id,
            'comment'=>$this->input->post('comment'),
            'status'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
        ];

        $result=$comment->add_new_comment($comment_data);

        if( $result>0){
            $this->response([
                'status'=>true,
                'message'=>'Comment added successfully'
            ],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'=>false,
                'message'=>'Failed to add comment'
            ],REST_Controller::HTTP_OK);
        }
    }
                        
}
