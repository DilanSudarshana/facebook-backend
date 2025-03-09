<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UserController extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('facebook/UserModel');
        $this->load->helper('url');
    }

    //get all users
    public function index_get(){
        $user=new UserModel;
        $result=$user->get_user();
        $this->response($result,200);
    }

    //get user by id
    public function find_get($id){
        $user=new UserModel;
        $result=$user->find_user($id);
        $this->response($result,200);
    }

    //store user
    public function index_post(){

        $user=new UserModel;

        $json_data = json_decode($this->input->raw_input_stream, true);

        $data=[
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'dob'=>$this->input->post('dob'),
            'gender'=>$this->input->post('gender'),
            'mobile_or_email'=>$this->input->post('mobile_or_email'),
            'password'=>$this->input->post('password'),
        ];

        $result=$user->insert_user($data);

        if( $result>0){
            $this->response([
                'status'=>true,
                'message'=>'User created'
            ],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'=>false,
                'message'=>'Failed user created'
            ],REST_Controller::HTTP_OK);
        }
        
    }

    //login  user
    public function loginUser_post(){

        $json_data = json_decode($this->input->raw_input_stream, true);
        $user=new UserModel;

        $email = (string)$this->input->post('email');
        $password = (string)$this->input->post('password');
        
        if (!$email || !$password) {
            $this->response([
                'status' => false,
                'message' => 'Input invalid'
            ], REST_Controller::HTTP_OK);
            return;
        }

        $result = $this-> $user->check_credentials($email, $password);

        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Login success'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Login failed. Invalid credentials.'
            ], REST_Controller::HTTP_OK);
        }
    }
                        
}
