<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends CI_Model {

    public $role_id 
    public $role_name;
    public $role_code;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'user_role';
    }

    public function get()
    {
        $this->db->where('role_id',$this->role_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('role_id',$this->role_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>