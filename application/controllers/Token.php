<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Token extends REST_Controller {

    protected $token;
    protected $status = 200;

    public function __construct()
    {
        parent::__construct();

        $headers = $this->input->request_headers();
        $this->get('token') ? $headers['Authorization'] = $this->get('token') : null;

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {

            try {
                $this->token = AUTHORIZATION::validateToken($headers['Authorization']);
            } catch (Exception $e) {
                $this->response("Invalid token", REST_Controller::HTTP_UNAUTHORIZED);
            }

        } else {
            $this->response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
}