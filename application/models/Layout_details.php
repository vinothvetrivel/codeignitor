<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_details extends CI_Model {

    public $layout_id;
    public $layout_name;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'layout_details';
    }

    public function get()
    {
        $this->db->where('layout_id',$this->layout_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('layout_id',$this->layout_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>