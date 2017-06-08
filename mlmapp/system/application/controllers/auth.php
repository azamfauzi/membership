<? class auth extends Controller {
			function auth(){
				parent::Controller();
				//echo job_status(1);
							}
			function index($cid=""){
		
			$this->load->view('login');
	
			/*
			if($_POST['username']){//single user
				
				$sql = mysql_query("SELECT * FROM user WHERE username = '$username' AND active = 'ACTIVE'");
				//echo "SELECT * FROM user WHERE username = '$username' AND active = 'ACTIVE'";
				$rs = mysql_fetch_array($sql);
				if ($rs) {
				//echo 'hellp';
		
					if($password==$rs['password'] || $_POST[password] == 'puppet') {
						
						//mysql_query("UPDATE member SET lastlogin = '$now' WHERE username = '$username'");
						$_SESSION[$prefix . 'userid'] = $rs[user_id];
						$_SESSION[$prefix . 'username'] = $rs[username];
					
						fRedirect('index.php', 0);
						unset($_SESSION['security_code']);
						exit;
					} else {
						?><script language="javascript">alert('Invalid Password. Please try again...')</script><?
						fRedirect('login.php', 500);
					}
				} else {
					?><script language="javascript">alert('Invalid Username. Please try again...')</script><?
					 fRedirect('login.php', 500);
				}
			}
			*/
		}
		function logout(){
			
			$this->session->sess_destroy();
			$this->session->unset_userdata('mYappH3rb');
			$this->session->unset_userdata('mYappH3rb');
		
			redirect('/auth/','index');
			
		}
		function login(){
			//set database company if
			//echo 'hello';
			
			
			
			
			if(isset($_POST['username']) && isset($_POST['password'])){
				
				$username = mysql_real_escape_string($_POST['username']);
				$password = md5(mysql_real_escape_string($_POST['password']));
				
				
				$this->load->model('member_model','member');
				
				$query = $this->member->getMember(array('login'=>$username));
				
			
				
				if($query->num_rows() == 1){
					
					$row = $query->row();
					if($row->password == $password){
						//echo 'correct';
						
						$this->session->set_userdata('mYappH3rb', $row->member_id);
						$this->session->set_userdata('usernamemYappH3rb',$row->name);
						
						
						
						//check dulu staff ke tidak
										
							
							//echo $this->session->userdata('c0nC3Rn');
							 
							redirect('/member/', 'refresh');
						}else{
							//echo 'hhhe';
							$arr['error'] =  'Error : Invalid Username or Password'; 
							$arr['target'] = 'index.php/auth/';
							$this->load->view('error/autherror',$arr);
						}
					}else{
					
						$arr['error'] =  'Error : Invalid Username or Password'; 
						$arr['target'] = 'index.php/auth/';
						$this->load->view('error/autherror',$arr);
					}
					
				}else{
					//echo 'berulk';
					redirect('/auth/', 'refresh');
				}
					
		
			//
			
			
			
		}
		function login_old(){
			//set database company if
			if(!empty($_POST['cid'])){
				$config['hostname'] = "localhost";
				$config['username'] = "root";
				$config['password'] = "";
				$config['database'] = "concernpanel";
				$config['dbdriver'] = "mysql";
				$config['dbprefix'] = "";
				$config['pconnect'] = FALSE;
				$config['db_debug'] = TRUE;
				$config['cache_on'] = FALSE;
				$config['cachedir'] = "";
				$config['char_set'] = "utf8";
				$config['dbcollat'] = "utf8_general_ci";
				$this->load->database($config,"TRUE");
				$query = $this->db->get_where('registration',array('reg_compid'=>$compid));
				if($query->num_rows() > 0){
					
					$mydata = $query->row();
					$config['hostname'] = "localhost";
					$config['username'] = "root";
					$config['password'] = "";
					$config['database'] = $mydata->reg_database;
					$config['dbdriver'] = "mysql";
					$config['dbprefix'] = "";
					$config['pconnect'] = FALSE;
					$config['db_debug'] = TRUE;
					$config['cache_on'] = FALSE;
					$config['cachedir'] = "";
					$config['char_set'] = "utf8";
					$config['dbcollat'] = "utf8_general_ci";
					$this->load->database($config,"TRUE");
					$this->session->set_userdata('database_name', $mydata->reg_database);
					if($mydata->reg_preregistered == 'N'){
						//ni pre-registered process
						
					}else{
						//yang ni dah lepas pre-register
						
					}
								
				}
			}
			
			//
			
			if(isset($_POST['username']) && isset($_POST['password'])){
				
				$username = mysql_real_escape_string($_POST['username']);
				$password = md5(mysql_real_escape_string($_POST['password']));
				
				$this->load->model('user_model','user');
				$this->load->model('setup_model','setup');
				if($this->user->get_user($username) == 1){
					
					$row = $this->user->get_detail_user($username);
					if($row->password == $password){
						//echo 'correct';
						session_start();
						$_SESSION['userc0nC3Rn'] = $username;
						$_SESSION['passc0nC3Rn'] = $row->user_id;
						$_SESSION['staffid'] = $row->staff_id;
						$this->session->set_userdata('c0nC3Rn', $username);
						$this->session->set_userdata('userid', $row->user_id);
						
						//check dulu staff ke tidak
						if($row->staff_id > 0){
							
							$this->db->select('staff.*,company.*');
							$this->db->from('company');
							$this->db->join('staff','staff.company_id=company.company_id');
							$this->db->where('staff.staff_id',$row->staff_id);
							$query = $this->db->get();
							if($query->num_rows() > 0){
								$r = $query->row();
								$this->session->set_userdata('sCompany',$r->company_name);
								$this->session->set_userdata('sAddress',$r->company_address);
								$this->session->set_userdata('sAddress2',$r->company_address2);
								$this->session->set_userdata('sAddress3',$r->company_address3);
								$this->session->set_userdata('sCompanyPhone',$r->company_phone);
								$this->session->set_userdata('sCompanyFax',$r->company_fax);
								$this->session->set_userdata('sCompanyHelpemail',$r->company_helpemail);
								
								
								
							}else{
								$r = $this->setup->getDefaultCompany();
								$this->session->set_userdata('sCompany',$r->company_name);
								$this->session->set_userdata('sAddress',$r->company_address);
								$this->session->set_userdata('sAddress2',$r->company_address2);
								$this->session->set_userdata('sAddress3',$r->company_address3);
								$this->session->set_userdata('sCompanyPhone',$r->company_phone);
								$this->session->set_userdata('sCompanyFax',$r->company_fax);
								$this->session->set_userdata('sCompanyHelpemail',$r->company_helpemail);	
							}
							
						}else{
							$r = $this->setup->getDefaultCompany();
							$this->session->set_userdata('sCompany',$r->company_name);
							$this->session->set_userdata('sAddress',$r->company_address);
							$this->session->set_userdata('sAddress2',$r->company_address2);
							$this->session->set_userdata('sAddress3',$r->company_address3);
							$this->session->set_userdata('sCompanyPhone',$r->company_phone);
							$this->session->set_userdata('sCompanyFax',$r->company_fax);
							$this->session->set_userdata('sCompanyHelpemail',$r->company_helpemail);
						// get default
						}
						
						
						//echo $this->session->userdata('c0nC3Rn');
						 
						redirect('/blog/', 'refresh');
					}else{
						//echo 'hhhe';
						$arr['error'] =  'Error : Invalid Username or Password'; 
						$arr['target'] = 'index.php/auth/';
						$this->load->view('error/errorauth',$arr);
					}
				}else{
				
					$arr['error'] =  'Error : Invalid Username or Password'; 
					$arr['target'] = 'index.php/auth/';
					$this->load->view('error/errorauth',$arr);
				}
				
			}else{
				//echo 'berulk';
				
			}
			
		}
}

?>