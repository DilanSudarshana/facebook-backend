<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ImageController extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('facebook/ImageModel');
        $this->load->helper('url');
    }

    //get all images of a user
    public function index_get($id){

        $image=new ImageModel;

        $result=$image->get_all_images($id);

        if($result){
            $this->response($result,200);
        }
       
    }

                        
}
