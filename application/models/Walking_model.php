<?php
class Walking_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function createBooking() {
		$data = array(
					   'firstname' => $this->input->post('firstname') ,
					   'lastname' => $this->input->post('lastname') ,
					   'phone' => $this->input->post('phone') ,
					   'email' => $this->input->post('email') ,
					   'walkId' => $this->input->post('walk') 
		         );

				if($this->db->insert('bookedWalk', $data)){
					$this->session->set_flashdata('message', 'success');
				} else {
					$this->session->set_flashdata('message', 'failure');	
				}

				redirect('walking/index');

	}
	
	function getBookings(){
		$query = $this->db->get('bookedWalk');
		
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
}
