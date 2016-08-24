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
        $this->table_name = 'user_details';
    }

    public function get()
    {
        if(!empty($this->user_id))
            $this->db->where('user_id',$this->user_id);
        if(!empty($this->username))
            $this->db->where('username',$this->username);

        return $this->db->get($this->table_name)->row_array();
    }

    public function insert()
    {
        $this->db->insert($this->table_name,$this);
        return $this->db->insert_id();
    }

    public function update()
    {
        if(!empty($this->user_id))
            $this->db->where('user_id',$this->user_id);
        if(!empty($this->username))
            $this->db->where('username',$this->username);

        return $this->db->update($this->table_name,$this);      
    }

    public function getUserDetails()
    {
        $query="SELECT 
                    ud.user_id,account_id,role_id,username,password,first_name,last_name,email,phone,is_locked,GROUP_CONCAT(access_user_id) as access_user_id,GROUP_CONCAT(access_account_id) as access_account_id
                FROM
                    user_details as ud
                    LEFT JOIN data_access_mapping as dam ON dam.user_id=ud.user_id
                WHERE 
                username = ".$this->db->escape($this->username);

        return $this->db->query($query)->row_array();
    }
}
?>