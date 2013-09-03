<?php
/**
* Created by TiLo 2012-01-15
*/
class Walking extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->form_validation->set_rules('firstname', 'Förnamn', 'required');
		$this->form_validation->set_rules('lastname', 'Efternamn', 'required');
		$this->form_validation->set_rules('phone', 'Telefon', 'required|numeric');
		$this->form_validation->set_rules('email', 'Epost', 'required|valid_email');
		$this->form_validation->set_rules('walk','Nattvandring','required|greater_than[0]');
		
		$this->form_validation->set_message('required', '%s måste vara ifyllt.');
		$this->form_validation->set_message('valid_email', '%s måste vara i giltigt epost-format.');
		$this->form_validation->set_message('numeric', '%s får bra skrivas med siffror.');
		$this->form_validation->set_message('greater_than', '%s måste väljas');
	
    }

	function index() {
		$data['title'] = "Anmälan Nattvandring";
		$data['heading'] = "Anmälan Nattvandring"; 
		
		//$data['kitchen_date'] = "NÄSTA DATUM"//TODO getDate from adminsetting table call Function from some model
		
		
		$this->load->model('walking_model');
		$data['records'] = $this->walking_model->getBookings();
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('walking_view', $data);
		} else {
			$this->walking_model->createBooking();
		}

	}
}