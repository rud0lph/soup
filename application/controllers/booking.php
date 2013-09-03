<?php
/**
* Created by TiLo 2013-01-15
* Updated by TiLo 2013-03-10
*/
class Booking extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->form_validation->set_rules('firstname', 'Förnamn', 'required');
		$this->form_validation->set_rules('lastname', 'Efternamn', 'required');
		$this->form_validation->set_rules('phone', 'Telefon', 'required|numeric');
		$this->form_validation->set_rules('email', 'Epost', 'required|valid_email');
		$this->form_validation->set_rules('section','Sektion','required|greater_than[0]');
		$this->form_validation->set_rules('shift','Pass','required|greater_than[0]');

		$this->form_validation->set_message('required', '%s måste vara ifyllt.');
		$this->form_validation->set_message('valid_email', '%s måste vara i giltigt epost-format.');
		$this->form_validation->set_message('numeric', '%s får bra skrivas med siffror.');
		$this->form_validation->set_message('greater_than', '%s måste väljas');
	
	
    }

	
	function index() {
		$data['title'] = "Anmälan Soppköket";
		$data['heading'] = "Anmälan Soppköket"; 
		
		//$data['kitchen_date'] = "NÄSTA DATUM"//TODO getDate from adminsetting table call Function from some model
		
		
		$this->load->model('booking_model');
		$data['records'] = $this->booking_model->getBookings();
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('booking_view', $data);
		} else {
			$this->booking_model->createBooking();
		}

	}
	
	//Returns valid sections 
	function section() {
		
		$shift = $this->input->post('shift');
		
		//Hämta de sektioner som har pass 1 på sig
		
		//echo $shift;
		$this->load->model('booking_model');
	    $this->booking_model->getValidSections();
		
	}
}