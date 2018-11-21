<?php

class Product_M extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
    |--------------------------------------------------------------------------
    | GET
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('products');
        $query = $this->db->get();
        $result = $query->result();
        return count($result) > 0 ? $result : [];
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('products.id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return count($result) > 0 ? $result[0] : null;
    }

    /*
    |--------------------------------------------------------------------------
    | Insert
    |--------------------------------------------------------------------------
    */

    public function insert_entry($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update_entry($ids, $data)
    {
        $this->db->where_in('id', $ids);
        $this->db->update('products', $data);

        // Sync payslip
        foreach ($ids as $id) {
            $this->sync_main($id);
        }
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function delete_entry($id)
    {
        $this->delete_deduction($id);
        $this->db->where_in('id', $id);
        return $this->db->delete('products');
    }

}
