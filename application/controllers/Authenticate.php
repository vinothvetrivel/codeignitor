<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

	public $error;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/authenticate
	 *	- or -
	 * 		http://example.com/index.php/authenticate/index
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/authenticate/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//Get post values
		$input = $this->input->post();
		if(!isset($input['username']) || empty($input['username'])){
			$this->error['username'] = "Invalid Username";
		}
		if(!isset($input['userPassword']) || empty($input['userPassword'])){
			$this->error['userPassword'] = "Invalid Password";
		}
		if(empty($this->error)){
			// Get entered user details from database
			$this->load->model('User_details');
			$this->User_details->username = $input['username'];
			$result = $this->User_details->getUserDetails();

			// Creating password hash value to compare
			$password = $input['userPassword'].'-'.$this->config->config['passwordSalt'];
			
			//Password check
			if(!empty($result) && strcasecmp($result['password'],hash($this->config->config['passwordAlg'],$password))==0){
				if(strcasecmp($result['access_account_id'],'Y')==0){
					$this->access->session->set_userdata('errorMessage','User credentials locked. Please contact administrator.');
					redirect('logout');
				}else{
					//Setting session details
					$this->access->session->set_userdata('user_id',$result['user_id']);
					$this->access->session->set_userdata('firstname',$result['first_name']);
					$this->access->session->set_userdata('account_id',$result['account_id']);
					$this->access->session->set_userdata('role_id',$result['role_id']);
					$this->access->session->set_userdata('accessUserId',$result['access_user_id']);
					$this->access->session->set_userdata('accessAccountId',$result['access_account_id']);
					redirect('home');
				}
			}else{
				$this->access->session->set_userdata('errorMessage','Invalid credentials.');
				redirect('logout');
			}
		}else{
			$this->access->session->set_userdata('error',$this->error);
			$this->access->session->set_userdata('errorMessage','Invalid credentials.');
			redirect('logout');
		}
	}
}
