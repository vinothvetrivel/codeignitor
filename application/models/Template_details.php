<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_details extends CI_Model {

    public $template_id
    public $template_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'template_details';
    }

    public function get()
    {
        $this->db->where('template_id',$this->template_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('template_id',$this->template_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>