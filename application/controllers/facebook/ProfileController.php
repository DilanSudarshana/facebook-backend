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

    //update profile details
    public function updateUser_put($id) {
        $user = new ProfileModel;
        $json_data = json_decode($this->input->raw_input_stream, true);
    
        $data_profile = [];
        $data_user = [];
    
        if (!empty($json_data['university'])) {
            $data_profile['university'] = $json_data['university'];
        }
        if (!empty($json_data['school'])) {
            $data_profile['school'] = $json_data['school'];
        }
        if (!empty($json_data['lives_in'])) {
            $data_profile['lives_in'] = $json_data['lives_in'];
        }
        if (!empty($json_data['address'])) {
            $data_profile['address'] = $json_data['address'];
        }
        if (!empty($json_data['relationship'])) {
            $data_profile['relationship'] = $json_data['relationship'];
        }
        if (!empty($json_data['intro'])) {
            $data_profile['intro'] = $json_data['intro'];
        }
    
        if (!empty($json_data['first_name'])) {
            $data_user['first_name'] = $json_data['first_name'];
        }
        if (!empty($json_data['last_name'])) {
            $data_user['last_name'] = $json_data['last_name'];
        }
        if (!empty($json_data['image'])) {
            $data_user['image'] = $json_data['image'];
        }
    
        $updated_result_profile = !empty($data_profile) ? $user->update_user_profile($id, $data_profile) : true;
        $updated_result_user = !empty($data_user) ? $user->update_user($id, $data_user) : true;
    
        $update_post = true;
        if (!empty($json_data['image'])) {
            $data_post = [
                'user_id' => $id,
                'description' => $json_data['first_name'] . ' ' . $json_data['last_name'] . ' updated their profile picture.',
                'image' => $json_data['image'],
                'type' => 2,
            ];
            $update_post = $user->add_post($data_post);
        }
    
        if ($updated_result_profile && $updated_result_user && $update_post) {
            $this->response([
                'status' => true,
                'message' => 'User updated successfully.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to update user.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
                        
}
