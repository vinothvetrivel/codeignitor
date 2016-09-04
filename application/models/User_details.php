<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_details extends CI_Model {

    public $user_id;
    public $role_id;
    public $account_id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $secondary_phone;
    public $secondary_email;
    public $security_question;
    public $security_answer;
    public $theme;
    public $language;
    public $is_locked;
    public $created_by;
    public $creation_date;
    public $updated_by;
    public $updated_date;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        if(!empty($this->user_id))
            $this->db->where('user_id',$this->user_id);
        if(!empty($this->username))
            $this->db->where('username',$this->username);

        return $this->db->get('user_details')->result_array();
    }

    public function insert()
    {
        $this->db->insert('user_details',$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        if(!empty($this->user_id))
            $this->db->where('user_id',$this->user_id);
        if(!empty($this->username))
            $this->db->where('username',$this->username);

        return $this->db->update('user_details',$this);      
    }

    public function getUserDetails()
    {
        $query="SELECT 
                    ud.user_id,ud.account_id,role_id,username,password,first_name,last_name,ud.email,ud.phone,is_locked,is_account_active,GROUP_CONCAT(access_user_id) as access_user_id,GROUP_CONCAT(access_account_id) as access_account_id
                FROM
                    user_details as ud
                    LEFT JOIN data_access_mapping as dam ON dam.user_id=ud.user_id
                    LEFT JOIN account_details as ad ON ad.account_id=ud.account_id
                WHERE 
                username = ".$this->db->escape($this->username);

        return $this->db->query($query)->row_array();
    }

    public function checkUserExist()
    {
        if(!empty($this->email)){
            $this->db->or_where('email',$this->email);
        }
        if(!empty($this->phone)){
            $this->db->or_where('phone',$this->phone);
        }
        if(!empty($this->username)){
            $this->db->or_where('username',$this->username);
        }
        return $this->db->get('user_details')->result_array();
    }
}
?>