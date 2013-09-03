<?php
/**
* Created by TiLo 2012-01-15
*/
class Transport extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->form_validation->set_rules('firstname', 'Förnamn', 'required');
		$this->form_validation->set_rules('lastname', 'Efternamn', 'required');
		$this->form_validation->set_rules('phone', 'Telefon', 'required|numeric');
		$this->form_validation->set_rules('email', 'Epost', 'required|valid_email');
		
		$this->form_validation->set_message('required', '%s måste vara ifyllt.');
		$this->form_validation->set_message('valid_email', '%s måste vara i giltigt epost-format.');
		$this->form_validation->set_message('numeric', '%s får bra skrivas med siffror.');
    }
	
	function index() {
		$data['title'] = "Anmälan Transportera";	
		$data['heading'] = "Anmälan Transportera";
		

			$this->load->model('transport_model');
			$data['records'] = $this->transport_model->getBookings();

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('transport_view', $data);
			} else {
				$this->transport_model->createBooking();
			}
		
	}
	
}