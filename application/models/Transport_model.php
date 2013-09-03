<?php
class Transport_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function createBooking() {
	
				if($this->db->insert('bookedTransport', $_POST)){
					$this->session->set_flashdata('message', 'success');
				} else {
					$this->session->set_flashdata('message', 'failure');	
				}

				redirect('transport/index');

	}
	
	function getBookings(){
		$query = $this->db->get('bookedTransport');
		
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
}
