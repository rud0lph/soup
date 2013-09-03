<?php
class Sorting_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function createBooking() {
	
				if($this->db->insert('bookedSort', $_POST)){
					$this->session->set_flashdata('message', 'success');
				} else {
					$this->session->set_flashdata('message', 'failure');	
				}

				redirect('sorting/index');

	}
	
	function getBookings(){
		$query = $this->db->get('bookedSort');
		
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
}
