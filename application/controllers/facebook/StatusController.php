<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class StatusController extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('facebook/StatusModel');
        $this->load->helper('url');
    }

    public function index_get(){
        $user=new StatusModel;
        $result=$user->get_status();
        if($result){
            $this->response($result,200);
        }else{
            echo "error";
        }
       
    }

    public function createStatus_post(){

        $status=new StatusModel();

        $status_data=[
            'user_id'=>$this->input->post('user_id'),
            'image'=>$this->input->post('image')
        ];

        $result=$status->create_new_status($status_data);

        if( $result>0){
            $this->response([
                'status'=>true,
                'message'=>'Status created'
            ],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'=>false,
                'message'=>'Failed to create status'
            ],REST_Controller::HTTP_OK);
        }
    }


}
