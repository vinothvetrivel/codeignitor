<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->smarty->view($this);
	}	
}
