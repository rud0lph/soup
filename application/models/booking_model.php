<?php
class Booking_model extends CI_Model {

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
					   'shiftId' => $this->input->post('shift') ,
					   'sectionId' => $this->input->post('section')
		         );
		
				//We successfully inserted a row in kitchenTable
				if($this->db->insert('bookedKitchen', $data)){
					
					// Now lets insert or update shift_section table with sectionId, shiftId and a counter
					$shift = $this->input->post('shift');
					$section = $this->input->post('section');
					
					$record = array('shiftId' => $shift,'sectionId' => $section,'counter' => 'counter'+1);
			
					// Check if a record exists for this specific shift-section combo
					$array = array('shiftId' => $shift, 'sectionId' => $section);
					$this->db->where($array);
					$this->db->from('shift_section');
					    
					//If we get records back update row
					if ($this->db->count_all_results() != 0) {
					  
					      // A record does exist, update it.
						  $data = array('counter' => 'counter'+1);
						  $this->db->where(array('shiftId' => $shift ,'sectionId' => $section));
						  $this->db->set('counter', 'counter+1', FALSE);
						  $this->db->update('shift_section');
					 }
					 $this->db->flush_cache();
					 // Check to see if the query actually performed correctly
					 if ($this->db->affected_rows() > 0) {
					      	//SUCCESS
							$this->session->set_flashdata('message', 'success');
					 } else {
						$this->session->set_flashdata('message', 'failure');
					}
					    
				} else {
					$this->session->set_flashdata('message', 'failure');	
				}

				redirect('booking/index');

	}
	
	function getBookings(){
		$this->db->select('bookedKitchen.firstname, bookedKitchen.lastname, bookedKitchen.shiftId, section.sectionName, shift.shiftName');
		$this->db->from('bookedKitchen');
		$this->db->join('section', 'section.sectionId = bookedKitchen.sectionId');
		$this->db->join('shift', 'shift.shiftId = bookedKitchen.shiftId');

		$query = $this->db->get();
		
	//	$query = $this->db->get('bookedKitchen');
		
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
	//retrives valid sections based on shift choosen by user
	function getValidSections(){
		$shift = $this->input->post('shift');
		$this->db->where('shiftId', $shift);
		$this->db->from('shift_section');
		$this->db->join('section', 'section.sectionId = shift_section.sectionId');
		$query = $this->db->get();
		
		$array = array();
		foreach ($query->result() as $row) {
			
			$c = $row->counter;
			$m = $row->maxNoVol;
		    if ($c < $m){
			   $array[$row->sectionId]  =  $row->sectionName;
				//$array[]  =  $row->sectionId;
				//array_push($array, $row->sectionId);
			} 
		} 
		//print_r($query->result());
		//echo 'Total Results: ' . $query->num_rows();
		echo json_encode($array);
	}
}

	
