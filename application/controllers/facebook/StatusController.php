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


}
