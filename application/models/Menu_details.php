<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_details extends CI_Model {

    public $menu_id;
    public $menu_name;
    public $link;
    public $icon;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'menu_details';
    }

    public function get()
    {
        $this->db->where('menu_id',$this->menu_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('menu_id',$this->menu_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>