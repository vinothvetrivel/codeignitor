<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_mapping_details extends CI_Model {

    public $module_id;
    public $manager_id;
    public $template_id;
    public $layout_id;
    public $role_id;
    public $order;
    public $status;
    public $action_name;
    public $module_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'module_mapping_details';
    }

    public function get()
    {
        $this->db->where('module_id',$this->module_id);
        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('module_id',$this->module_id);
        return $this->db->update($this->table_name,$this);      
    }

    public function getModules()
    {
        $query="SELECT
                    md.module_name,
                    td.template_name,
                    ld.layout_name,
                    mmd.order
                FROM 
                    module_details as md,
                    action_details as ad,
                    template_details as td,
                    layout_details as ld,
                    module_mapping_details as mmd
                WHERE
                    md.module_id = mmd.module_id
                    AND ad.action_id = mmd.action_id
                    AND td.template_id = mmd.template_id
                    AND ld.layout_id = mmd.layout_id
                    AND ld.status = mmd.status
                    AND (mmd.role_id = '{$this->role_id}' || mmd.role_id = 0)
                    AND ad.action_name = '{$this->action_name}'
                    AND md.module_name = '{$this->module_name}'
                    AND mmd.status ='Y'
                ORDER BY mmd.order asc";
        
        return $this->db->query($query)->row_array();
    }
}
?>