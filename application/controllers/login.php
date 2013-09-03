<?php

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	function index() {
		$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);
	}
}
	