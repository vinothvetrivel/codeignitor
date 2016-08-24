<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/logout
	 *	- or -
	 * 		http://example.com/index.php/logout/index
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/logout/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//unset session details to make logout
		$this->access->session->unset_userdata('user_id');
		$this->access->session->unset_userdata('firstname');
		$this->access->session->unset_userdata('account_id');
		$this->access->session->unset_userdata('role_id');
		$this->access->session->unset_userdata('accessUserId');
		$this->access->session->unset_userdata('accessAccountId');

		//  Destory session
		//$this->access->session->sess_destroy();

		// Redirect to home page
		redirect('welcome');
	}
}
