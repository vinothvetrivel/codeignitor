<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu_details extends CI_Model {

    public $submenu_id
    public $submneu_name;
    public $link;
    public $icon;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'submenu_details';
    }

    public function get()
    {
        $this->db->where('submenu_id',$this->submenu_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('submenu_id',$this->submenu_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>