<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$user = $this->session->userdata('mYappH3rb');
		
		if(empty($user)){
			redirect('/auth/', 'refresh');
		}else{
		$this->load->view('dashboard');
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */