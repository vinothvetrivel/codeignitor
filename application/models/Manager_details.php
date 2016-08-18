<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_details extends CI_Model {

    public $manager_id;
    public $manager_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'manager_details';
    }

    public function get()
    {
        $this->db->where('manager_id',$this->manager_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('manager_id',$this->manager_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>