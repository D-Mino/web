<?php

class Auth_M extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login_admin($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('admin');
        $result = $query->result();
        return $result ? $result[0] : null;
    }
}