<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(BASEPATH.'core/Common.php');

class CI_Access {

	public $exeception_control;

	public function __construct()
	{

		$CI =& get_instance();
		$CI = $this;

		foreach (is_loaded() as $var => $class)
		{
			if(strcasecmp($class, 'ACCESS')!=0)
				$this->$var =& load_class($class);
		}
		$this->load =& load_class('Loader', 'core');
		$this->load->library('session');
		$this->load->database();
		$this->load->helper('url');
		
		$this->exeception_control = array('welcome','logout','authenticate','forgotPassword');
		
		if(!isset($this->session->userdata['user_id']) && !in_array($this->router->class, $this->exeception_control)){
			redirect('logout');
		}else{
			$this->_getModuleMapping();
		}
	}

	private function _getDataAccessMaping()
	{
		$this->load->model('Data_access_mapping');
		$this->Data_access_mapping->user_id = $this->session->user_id;
		$result = $this->Data_access_mapping->get();
	}

	private function _getModuleMapping()
	{
		$this->load->model('Module_exception_details');
		$this->Module_exception_details->account_id = (isset($this->session->userdata['account_id']))?$this->session->userdata('account_id'):0;
		$this->Module_exception_details->role_id = (isset($this->session->userdata['role_id']))?$this->session->userdata('role_id'):0;
		$this->Module_exception_details->user_id = (isset($this->session->userdata['user_id']))?$this->session->userdata('user_id'):0;
		$this->Module_exception_details->action_name = strtolower($this->router->method);
		$this->Module_exception_details->module_name = strtolower($this->router->class);
		$result = $this->Module_exception_details->getModules();
		if(empty($result)){
			$this->load->model('Module_mapping_details');
			$this->Module_mapping_details->role_id = (isset($this->session->userdata['role_id']))?$this->session->userdata('role_id'):0;
			$this->Module_mapping_details->action_name = strtolower($this->router->method);
			$this->Module_mapping_details->module_name = strtolower($this->router->class);
			$result = $this->Module_mapping_details->getModules();
		}

		$this->router->class = $result['module_name'];
		$this->router->layoutTemplate = $result['layout_name'];
		$this->router->template = $result['template_name'];
	}	
}
?>