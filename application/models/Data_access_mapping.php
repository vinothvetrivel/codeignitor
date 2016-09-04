<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_access_mapping extends CI_Model {

	public $user_id;
	public $access_account_id;
	public $access_user_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
   		$this->db->where('user_id',$this->user_id);
   		return $this->db->get('data_access_mapping')->row_array();
    }

    public function insert()
    {
    	$this->db->insert('data_access_mapping',$this);
    	return $this->db->insert_id();
    }

    public function update()
    {
		$this->db->where('user_id',$this->user_id);
   		return $this->db->update('data_access_mapping',$this);    	
    }
}
?>