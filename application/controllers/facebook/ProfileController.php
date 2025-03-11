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
        
        $user=new ProfileModel;
        $json_data = json_decode($this->input->raw_input_stream, true);
        
        $data_profile = [
            'university' => $this->put('university'),
            'school' => $this->put('school'),
            'lives_in' => $this->put('lives_in'),
            'address' => $this->put('address'),
            'relationship' => $this->put('relationship'),
            'intro' => $this->put('intro'),
        ];

        echo json_encode($data_profile);

        $data_user = [
            'first_name' => $json_data['first_name'],
            'last_name' => $json_data['last_name'],
            'image' => $json_data['image'],
        ];

        $data_post = [
            'user_id' => $id,
            'description' => $json_data['first_name'].' '.$json_data['last_name'].' updated their profile picture.',
            'image' => $json_data['image'],
            'type' => 2,
        ];

        echo json_encode($data_user);
    
        $updated_result_profile = $user->update_user_profile($id, $data_profile);
        $updated_result_user = $user->update_user($id, $data_user);
        $update_post=$user->add_post($data_post);

        if ($updated_result_profile && $updated_result_user && $update_post) {
            $this->response([
                'status' => true,
                'message' => 'User updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to update.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

                        
}
