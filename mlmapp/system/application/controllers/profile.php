<?
class Profile extends Controller {
	var $userid;
	var $msg;
	function Profile()
	{
		parent::Controller();	
		$userid = $this->session->userdata('mYappH3rb');
		$this->userid = $userid;
		if(empty($userid)){
			//redirect('/auth/', 'refresh');
		}
	}
	function myprofile()
	{
		$userid = $this->userid;
		if(empty($userid)){
			redirect('/auth/', 'refresh');
		}
		$this->load->model('member_model','member');
		$queryUser = $this->member->getMemberDetail(array('member.member_id'=>$userid));
		$data['rsProfile'] = $queryUser->row();
		if(!empty($this->msg)){
			$data['msg'] = $this->msg;
		}
		$this->load->view('profile',$data);
		
	}
	function saveprofile(){
		$userid = $this->userid;
		$arr['name'] = $this->input->post('name');
		$arr['phoneno'] = $this->input->post('phoneno');
		$arr['nric'] = $this->input->post('nric');
		$arr['member_id'] = $userid;
		$this->load->model('member_model','member');
		$this->member->updateMember($arr);
		
		$arrDetail = $_POST;
		$arrDetail['dob'] = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
		$arrDetail['member_id'] = $userid;
		$this->member->updateMemberDetail($arrDetail);
		//echo $this->db->last_query();
		$this->msg = 'Profile Update';
		$this->myprofile();
		
		//$this->load->view('message',array('msg_title'=>'Update Profile Status','msg_status'=>'Profile Update Success','msg_notification'=>'Your profile has been updated...!!'));
	}
	function cpwd(){
		if(!empty($this->msg)){
			$data['msg'] = $this->msg;
			$this->load->view('pwd',$data);
		}else{
			$this->load->view('pwd');
		}
	
	}
	function updatepwd(){
		$userid = $this->userid;
		$password1 = $this->input->post('pwd');
		$password2 = $this->input->post('pwd1');
		if(!empty($password1) && !empty($password2)){
			if($password1 != $password2){
						$this->msg = 'Password Not Matched';
						$this->cpwd();
						
			}else{
				$this->load->model('member_model','member');
				$arr['member_id'] = $userid;
				$arr['password'] = md5($password1);
				$arr['password1'] = $password1;
				$this->member->updatePassword($arr);
				$this->msg = 'Password Updated';
				$this->cpwd();
   
			}
		}else{
			$this->msg = 'Field Not Complete';
			$this->cpwd();
						
		}
	}
}
?>