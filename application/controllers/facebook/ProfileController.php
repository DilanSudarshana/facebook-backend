<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ProfileController extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('facebook/ProfileModel');
        $this->load->helper('url');
    }

    //get profile details
    public function index_get($id){

        $profile=new ProfileModel;
        $result=$profile->get_profile_details($id);

        if($result){
            $this->response($result,200);
        }else{
            $this->response('error',404);
        }
       
    }

                        
}
