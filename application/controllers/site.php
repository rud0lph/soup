<?php
class Site extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
    }
	
	function index() {
	 	$this->load->model('site_model');
	    $this->load->view('home');
	}