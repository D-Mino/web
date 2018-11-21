<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Token.php';

class Product extends Token {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_M', 'model');
    }

    public function index_get()
    {
        $response = [];
        $id = $this->get('id');
        if ($id) {
            $data = $this->model->get_by_id($id);
            if ($data) {
                $response['data'] = $data;
                $response['success'] = true;
            } else {
                $response['error'] = error_msg('id');
                $this->status = 404;
            }
        } else {
            $response['data'] = $this->model->get_all();
            $response['success'] = true;
        }
        $this->response($response, $this->status);
    }

    public function index_post()
    {
        $response = [];
        $data = $this->post();
        $id = $this->model->insert($data);
        $response['success'] = true;
        $this->response($response);
    }

    public function index_put()
    {
        $response = [];
        $data = $this->put();
        $response['success'] = entry_put($data);
        $this->response($response);

    }

    public function index_delete()
    {
        $response = [];
        $id = explode(',', $this->input->get('id'));
        $response['success'] = $this->model->delete_entry($id);
        $this->response($response);
    }
}
