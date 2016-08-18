<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_mapping_details extends CI_Model {

    public $role_id ;
    public $menu_id;
    public $submenu_id;
    public $submenu_parent_id;
    public $menu_order;
    public $submenu_order;
    public $display_order;
    public $menu_status;
    public $submenu_status;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'menu_mapping_details';
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

    public function _getMenuMappingDetails()
    {
        $query = "SELECT
                        m.menu_id,
                        m.menu_name,
                        m.link,
                        m.icon,
                        sm.submenu_id,
                        sm.submneu_name,
                        sm.link as submenu_link,
                        sm.icon as submenu_icon,
                        mmd.submenu_parent_id,
                        mmd.menu_order,
                        mmd.submenu_order as submenu_pos,
                        mmd.display_order as submenu_display_order,
                        mmd.menu_status,
                        mmd.submenu_status
                 FROM
                        menu_details m,
                        submenu_details sm,
                        menu_mapping_details mmd
                 WHERE
                        m.menu_id = mmd.menu_id
                        AND sm.submenu_id = mmd.submenu_id
                        AND m.status = mmd.menu_status
                        AND sm.status = mmd.submenu_status
                        AND m.status = 'Y'
                        AND sm.status = 'Y'
                        AND mmd.role_id = ".$this->role_id."
                        ORDER BY mmd.menu_order";
        
        return $this->db->query($query)->result_array();
    }

    public function _getExceptionMenuMappingDetails()
    {
        $query = "SELECT
                        m.menu_exception_id,
                        m.role_id,
                        m.account_id,
                        m.user_id,
                        m.menu_id,
                        m.target_menu_id,
                        m.menu_status,
                        m.menu_order,
                        m.submenu_id,
                        m.target_submenu_id,
                        m.submenu_parent_id,
                        m.submenu_order as submenu_pos,
                        m.display_order as submenu_display_order,
                        m.submenu_status
                  FROM
                        menu_exception_details m
                  WHERE
                        1
                        AND ( m.account_id IN(0,".$this->account_id.") OR m.role_id IN(0,".$this->role_id.") OR m.user_id IN(0,".$this->user_id.") )" ;
            
        return $this->db->query($query)->result_array();
    }
    
    public function _getMenuDetails()
    {
        $query = "SELECT
                        m.menu_id as target_menu_id,
                        m.menu_name as target_menu_name,
                        m.link as target_menu_link,
                        m.icon as target_menu_icon,
                        m.status as target_menu_status
                  FROM
                        menu_details m
                  WHERE
                        1
                        AND m.menu_id = ".$this->menu_id;
                        
        return $this->db->query($query)->result_array();
    }
    
    public function _getSubmenuDetails()
    {
        $query = "SELECT
                        s.submenu_id as target_submenu_id,
                        s.submneu_name as target_submneu_name,
                        s.link as target_submenu_link,
                        s.icon as target_submenu_icon,
                        s.status as target_submenu_status
                  FROM
                        submenu_details s
                  WHERE
                        1
                        AND s.submenu_id = ".$this->submenu_id;
                        
        return $this->db->query($query)->result_array();
    }
}