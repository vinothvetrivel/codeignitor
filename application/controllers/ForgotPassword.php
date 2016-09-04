<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/forgotPassword
	 *	- or -
	 * 		http://example.com/index.php/forgotPassword/index
	 *	- or -
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/forgotPassword/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->display();
	}

	public function requestPassword()
	{
		$input = $this->input->post();	
		$this->load->model('User_details');
		$this->User_details->username = $input['username'];
		$userResult = $this->User_details->getUserDetails();
			
		if(empty($userResult['user_id'])){
			$this->access->session->set_userdata('errorMessage','Invalid request.');
		}else{
			if(strcasecmp($userResult['is_account_active'],'N')==0){
				$this->access->session->set_userdata('errorMessage','Your account is in de-active state. Please contact support team to get more information.');
			}else if(strcasecmp($userResult['is_locked'], 'Y')==0){
				$this->access->session->set_userdata('errorMessage','Your credentials is in locked state. Please contact support team to get more information.');
			}else{
				sendEmail($userResult['email'],$userResult);
				$this->access->session->set_userdata('successMessage','Password reset link successfully sent to your registered email id. Please check you mail.');
			}
		}
		
		redirect('forgotPassword');
	}

	public function change()
	{
		$this->display();
	}

	public function display()
	{
		$this->smarty->view($this);
	}	
}
