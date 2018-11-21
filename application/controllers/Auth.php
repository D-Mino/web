<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller {

    protected $status = 200;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_M', 'model');
    }

    public function index_post()
    {
        $response = [];
        $email = $this->post('email');
        $password = $this->post('password');

        $check = $this->model->login_admin($email);
        if ($check) {
            $passmatch = password_verify($password, $check->password);
            if (!$passmatch) {
                $response['error'] = error_msg('password');
                $this->status = 400;
            } else {
                // Yes, login successfully !
                $data['id'] = $check->id;
                $data['name'] = $check->name;
                $response['data'] = $data;
                $response['token'] = AUTHORIZATION::generateToken($data);
                $response['success'] = true;
            }
        } else {
            $response['error'] = error_msg('email');
            $this->status = 404;
        }

        $this->response($response, $this->status);
    }
}