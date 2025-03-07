<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class PostController extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('facebook/PostModel');
        $this->load->helper('url');
    }

    public function index_get(){
        $user=new PostModel;
        $result=$user->get_posts();
        if($result){
            $this->response($result,200);
        }else{
            echo "error";
        }
       
    }

    public function index_delete($id){

        $user=new PostModel;
        $result=$user->delete_post($id);

        if($result){
            $this->response($result,200);
        }else{
            $this->response('error',404);
        }
       
    }
                        
}
