<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_details extends CI_Model {

    public $account_id;
    public $category_id;
    public $type;
    public $name;
    public $domain;
    public $address;
    public $city;
    public $country;
    public $postal_code;
    public $account_contact_name;
    public $email;
    public $phone;
    public $secondary_phone;
    public $secondary_email;
    public $is_account_active;
    public $creation_date;
    public $updated_date;

    public  function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        if(!empty($this->account_id)){
            $this->db->where('account_id',$this->account_id);
        }
        return $this->db->get('account_details')->result_array();
    }

    public function insert()
    {
        $this->db->insert('account_details',$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->db->where('account_id',$this->account_id);
        return $this->db->update('account_details',$this);      
    }

    public function getIn($start = 0, $length = 0)
    {
        if(!empty($this->account_id)){
            $this->db->where_in('account_id',$this->account_id);
        }
        if(!empty($start) && !empty($length)){
            $this->db->limit($start, $length);
        }
        return $this->db->get('account_details')->result_array(); 
    }

    public function getCount()
    {
        if(!empty($this->account_id)){
            $this->db->where_in('account_id',$this->account_id);
        }
        return $this->db->count_all_results('account_details');
    }

    public function checkAccountExist()
    {
        if(!empty($this->name)){
            $this->db->or_where('name',$this->name);
        }
        if(!empty($this->email)){
            $this->db->or_where('email',$this->email);
        }
        if(!empty($this->phone)){
            $this->db->or_where('phone',$this->phone);
        }
        return $this->db->get('account_details')->result_array();
    }
}
?>