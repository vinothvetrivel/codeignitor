<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_exception_details extends CI_Model {

    public $menu_exception_id;
    public $account_id;
    public $role_id ;
    public $user_id;
    public $menu_id;
    public $target_menu_id;
    public $menu_status;
    public $menu_order;
    public $submenu_id;
    public $target_submenu_id;
    public $submenu_parent_id;
    public $submenu_order;
    public $submenu_status;
    public $display_order;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'menu_exception_details';
    }

    public function get()
    {
        $this->db->where('menu_exception_id',$this->menu_exception_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('menu_exception_id',$this->menu_exception_id);
        return $this->db->update($this->table_name,$this);      
    }
}
?>