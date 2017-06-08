<?php
class Member extends Controller {

	function Member()
	{
		parent::Controller();	
		$user = $this->session->userdata('mYappH3rb');
		
		if(empty($user)){
			redirect('/auth/', 'refresh');
		}
	}
	function index()
	{
		$this->load->view('dashboard');
	}
	function register(){
		$this->load->view('member/registerform');
	}
	function getmember(){ //check placement
		$this->load->model('member_model','member');
		$query = $this->member->getMember(array('login'=>$this->input->post("items")));
		if($query->num_rows > 0){
			$data['somefield'] = $query->row()->name;
			$data['memberid'] = $query->row()->member_id;
		}else{
			$data['somefield'] = 'INVALID ID';
			$data['memberid'] = 0;
		}
		echo json_encode($data);
	}
	function validatePlacement($placement){
		$superuser = 1;
		
		$user = $this->session->userdata("mYappH3rb");
		if($placement == 1){ //yang ni upline adalah sama dengan 
			if($user == $superuser){
				$placement = 'valid';	
			}else{
				$placement = 'invalid';
			}
		}else{
			//checkplacement 
			
			$sponsor = 1;
			do{
				//$this->db->get_where('member',array('placement_id',$
			}while($x = 0);
		}
		
		
	}
	function getpin(){
		$this->load->model('pin_model','pin');
		
		$query = $this->pin->getPinPackage(array('pin.pin_no'=>$this->input->post("items"),'pin.pin_active'=>'SOLD','product.product_type'=>'MEMBERSHIP'));
		if($query->num_rows > 0){
			
			$data['pinpackage'] = $query->row()->product_name . '(' . $query->row()->product_desc . ')';
			$data['pinid'] = $query->row()->pin_no;
		}else{
			$data['pinpackage'] = 'INVALID PIN';
			$data['pinid'] = 0;
		}
		echo json_encode($data);
	}
	function getpinmaintain(){
		$this->load->model('pin_model','pin');
		
		$query = $this->pin->getPinPackage(array('pin.pin_no'=>$this->input->post("items"),'pin.pin_active'=>'SOLD','product.product_type'=>'MAINTAIN'));
		if($query->num_rows > 0){
			
			$data['pinpackage'] = $query->row()->product_name . '(' . $query->row()->product_desc . ')';
			$data['pinid'] = $query->row()->pin_no;
		}else{
			$data['pinpackage'] = 'INVALID PIN';
			$data['pinid'] = 0;
		}
		echo json_encode($data);
	}
	function getsponsor(){
		$this->load->model('member_model','member');
		$query = $this->member->getMember(array('login'=>$this->input->post("items")));
		if($query->num_rows > 0){
			//chech level 
			$data['somefield'] = $query->row()->name;
			$data['placementid'] = $query->row()->member_id;
		}else{
			$data['somefield'] = 'INVALID SPONSOR';
			$data['placementid'] = 0;
		}
		echo json_encode($data);
	}
	function registerx(){
		$this->load->view('member/ajaxpost');
	}
	function savemember(){
		$this->load->model('member_model','member');
		$this->load->model('bonus_model','bonus');
		
		$user = $this->session->userdata('mYappH3rb');
		//check hidden sponsor
		//echo $_POST['hiddensponsor'];
		$sponsor = $this->input->post('hiddensponsor');
		$error = FALSE;
		if(!empty($sponsor)){
			$query = $this->member->getMember(array('member_id'=>mysql_real_escape_string($sponsor)));
			if($query->num_rows() == 0){
				$err[] = "INVALID SPONSOR ID";
				$error = TRUE;
			}
		}else{
			$arr[] = "INVALID SPONSOR ID";
			$error = TRUE;
		}
		
		//check hidden placement
		$placement = $this->input->post('hiddenplacement');
		if(!empty($placement)){
			$query = $this->member->getMember(array('member_id'=>mysql_real_escape_string($placement)));
			if($query->num_rows() == 0){
				$err[] = "INVALID PLACEMENT ID";
				$error = TRUE;
			}else{
				$placement_level = $query->row()->member_level + 1;
			}
		}else{
			$arr[] = "INVALID PLACEMENT ID";
			$error = TRUE;
		}
		//check hidden pin
		$this->load->model('pin_model','pin');
		$pin = $this->input->post('hiddenpin');
		if(!empty($sponsor)){
			$query = $this->pin->getPinPackage(array('pin.pin_no'=>mysql_real_escape_string($pin),'pin_active'=>'SOLD','product.product_type'=>'MEMBERSHIP'));
			if($query->num_rows() == 0){
				$err[] = "INVALID PIN ID";
				$error = TRUE;
			}else{
				$pintype = $query->row()->pin_type;
			}
			
		}else{
			$arr[] = "INVALID PIN ID";
			$error = TRUE;
		}
		$name = $this->input->post('name');
		$nric = $this->input->post('nric');
		$password = $this->input->post('password');
		$mobilephone = $this->input->post('mobilephone');
		
		if(empty($name) || empty($nric) || empty($password) || empty($mobilephone)){
			$error = TRUE;
			$err[] = "MEMBER PARTICULAR NOT COMPLETE";
		}
		if($error == TRUE){
			$data['error'] = $err;
			 $this->load->view('error',$data);
		}else{
			//------------------ free from error --------------------------------------------------------------
			
			
			
			$arr1["sponsor"] = $sponsor;
			$arr1["placement"] = $placement;
			$arr1["pin"] = $pin;
			$arr1["password"] = md5($password);
			$arr1["password1"] = mysql_real_escape_string($password);
			
			// save member data
			$counterMember = $this->member->getMemberCounter();
			$counterMember = $counterMember + 1;
			$stringcounter = $this->member->str_counter($counterMember);
			
			//-------------------------------- insert record member ------------------------------------------------------
			$arrMember['login'] = 'M' . $stringcounter;
			$arrMember['name'] = $name;
			$arrMember['nric'] = $nric;
			$arrMember['password'] = md5($password);
			$arrMember['password2'] = mysql_real_escape_string($password);
			$arrMember['pin_type'] = $pintype; //ni pin type member
			$arrMember['placement'] = $placement;
			$arrMember['sponsor'] = $sponsor;
			$arrMember['member_level'] = $placement_level;
            $arrMember['pin_no'] = $pin;
			$newmemberid = $this->member->insertMember($arrMember);
			$this->member->updateMemberCounter();
			//--------------------------------- insert detail member record -------------------------------------------
			
			$arrMemberDetail = $_POST;
			$arrMemberDetail['member_id'] = $newmemberid;
			$this->member->insertMemberDetail($arrMemberDetail);
			            
			//--------------------------------- get detail sponsor ----------------------------------------------------
			$detSponsor = $this->member->getMember(array('member_id'=>$sponsor))->row();
      		$jenispakejsponsor = $detSponsor->pin_type; //pin type ni dah tukar kepada product level
        
            $detSponsorPinType = $this->db->get_where('product',array('pin_type'=>$jenispakejsponsor ))->row()->product_level;
            
            
                    
      
      
			// -------------------------------- get package detail -----------------------------------------------------
			$qpin = $this->pin->getPinPackage(array('pin_no'=>$pin));
            
      
			//echo $qpin->row()->pin_type;
			
			
			$packagetype = $qpin->row()->pin_type;
            //echo $packagetype;
            
            $jenispackagepin = $qpin->row()->pin_type;
            $jenispackagelevel = $qpin->row()->product_level;
            
            
            $stockistid = $qpin->row()->stockist_id;
			if($packagetype == 1){
				$totalbonus = 68;
        
				$uni_bonus[0] = 4;
				$uni_bonus[1] = 4;
				$uni_bonus[2] = 3;
				$uni_bonus[3] = 3;
				$uni_bonus[4] = 2;
				$uni_bonus[5] = 2;
				$uni_bonus[6] = 2;
				$uni_bonus[7] = 2;
				$uni_bonus[8] = 2;
				$uni_bonus[9] = 2;
				$bonuspin = 20;
                if($detSponsorPinType == $jenispackagelevel){
                  $bonussponsor = 80;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai packahtype
                  $bonussponsor = $this->pin->getBonusSponsor($jenispackagepin);
                }else if($detSponsorPinType > $jenispackagelevel){
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
				
			}else if($packagetype == 2){
				$totalbonus = 68;
				$uni_bonus[0] = 4;
				$uni_bonus[1] = 4;
				$uni_bonus[2] = 3;
				$uni_bonus[3] = 3;
				$uni_bonus[4] = 3;
				$uni_bonus[5] = 2;
				$uni_bonus[6] = 2;
				$bonuspin = 15;
				
                if($detSponsorPinType == $jenispackagelevel){
                 $bonussponsor = 50;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai packahtype
                  $bonussponsor = $this->pin->getBonusSponsor($jenispackagepin);
                }else if($detSponsorPinType > $jenispackagelevel){
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
        
			}else if($packagetype == 3){
				$totalbonus = 68;
				$uni_bonus[0] = 4;
				$uni_bonus[1] = 4;
				$uni_bonus[2] = 3;
				$uni_bonus[3] = 3;
				$uni_bonus[4] = 2;
				$bonuspin = 10;
				
                if($detSponsorPinType == $jenispackagelevel){
                  $bonussponsor = 30;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai packahtype
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejpin);
                }else if($detSponsorPinType > $jenispackagelevel){
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
        
			}else if($packagetype == 4){
				$totalbonus = 68;
				$uni_bonus[0] = 4;
				$uni_bonus[1] = 4;
				$uni_bonus[2] = 3;
				$bonuspin = 7;
				
                if($detSponsorPinType == $jenispackagelevel){
                $bonussponsor = 20;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai packahtype
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejpin);
                }else if($detSponsorPinType > $jenispackagelevel){
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
        
			}else if($packagetype == 5){
				$totalbonus = 68;
				$uni_bonus[0] = 4;
				$uni_bonus[1] = 4;
				$bonuspin = 3;
				if($detSponsorPinType == $jenispackagelevel){
                  $bonussponsor = 10;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai pangkat member
                  $bonussponsor = $this->pin->getBonusSponsor($jenispackagepin);
                }else if($detSponsorPinType > $jenispackagelevel){ // ke pakai pangkat sponsor
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
        
			}else if($packagetype == 12){
               	$totalbonus = 68;
        		$bonuspin = 20;
                if($detSponsorPinType == $jenispackagelevel){
                  $bonussponsor = 500;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai packahtype
                  $bonussponsor = $this->pin->getBonusSponsor($jenispackagepin);
                }else if($detSponsorPinType > $jenispackagelevel){
                  
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
			    
                
                
			}
            else if($packagetype == 13){
               	$totalbonus = 68;
        		$bonuspin = 10;
                
                if($detSponsorPinType == $jenispackagelevel){
                  $bonussponsor = 50;
                }else if($detSponsorPinType < $jenispackagelevel){ //kena pakai packahtype
                  //pakai pakacag type yang baru
                  $bonussponsor = $this->pin->getBonusSponsor($jenispackagepin);
                }else if($detSponsorPinType > $jenispackagelevel){
                  //pakai pakej type sponsor punya
                  
                  $bonussponsor = $this->pin->getBonusSponsor($jenispakejsponsor);
                }//kena pakai packahtype
			    
			}
			//--------------------------------- distribute bonus -------------------------------------------
			//$this->bonus->saveBonusUnilevel($placement,$uni_bonus,$newmemberid,$totalbonus);
			$this->bonus->saveBonusSponsor($sponsor,$newmemberid,$bonussponsor,$pin);
			$this->bonus->payPinStockist($pin,$bonuspin,$newmemberid,$user);
    	     
           // ------------------------ update pin to member -----------------------------------------------
           $this->pin->updatePin(array('pin_no'=>$pin),array('member_id'=>$newmemberid));
           //------------------------- end update pin ----------------------------------
    			
			
			$data1['rs'] = $this->member->getMember(array('member_id'=>$newmemberid))->row();
			
			$this->load->view('member/createmembersuccess',$data1);
		}
		
	
	}
	function savemaintain(){
		
		$this->load->model('member_model','member');
		$this->load->model('bonus_model','bonus');
		$this->load->model('account_model','account');
        
		$user = $this->session->userdata('mYappH3rb');
		//check hidden sponsor
		//echo $_POST['hiddensponsor'];
		
		$error = FALSE;
		//check hidden pin
		$this->load->model('pin_model','pin');
		$pin = $this->input->post('hiddenpin');
		if(!empty($pin)){
			$query = $this->pin->getPinPackage(array('pin.pin_no'=>mysql_real_escape_string($pin),'pin_active'=>'SOLD','product.product_type'=>'MAINTAIN'));
			//echo $this->db->last_query();
			if($query->num_rows() == 0){
				$err[] = "INVALID PIN ID";
				$error = TRUE;
			}else{
				$pintype = $query->row()->pin_type;
			}
			
		}else{
			$err[] = "PIN CODE NOT FOUND";
			$error = TRUE;
		}
		
		if($error == TRUE){
			$data['error'] = $err;
			 $this->load->view('error',$data);
		}else{
			//------------------ free from error --------------------------------------------------------------
			
			//get user data first nak kena check membership jenis apa.
			
			$memberRs = $this->member->getMember(array('member.member_id'=>$user))->row();
			$packagetype = $memberRs->pin_type;
			$placement = $memberRs->placement;
			
			$arr1["pin"] = $pin;
	
			// save member data
		
			
			// -------------------------------- get package detail -----------------------------------------------------
			$qpin = $this->pin->getPinPackage(array('pin_no'=>$pin));
			//echo $qpin->row()->pin_type;
			//first kena check pakej 
			//
			
			
			$packagepintype = $qpin->row()->pin_type; //package maintain yang dibeli.
			$stockistid = $qpin->row()->stockist_id;
			$masterid = $qpin->row()->master_id;
			if($masterid > 0){ //ni pin kalau ada master
				
				if($packagepintype == 6){ //ni arrijal
					if($packagetype == 1){ //jenis membership pakej mana yang didaftarkan
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$uni_bonus[7] = 2;
						$uni_bonus[8] = 2;
						$uni_bonus[9] = 2;
						$bonuspin = 3;
						$bonuspinmaster = 2;
						
					
					}else if($packagetype == 2){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 3;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$bonuspin = 3;
						$bonuspinmaster = 2;
						
					}else if($packagetype == 3){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$bonuspin = 3;
						$bonuspinmaster = 2;
						
					}else if($packagetype == 4){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$bonuspin = 3;
						$bonuspinmaster = 2; 
						
					}else if($packagetype == 5){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$bonuspin = 3;
						$bonuspinmaster = 2;
				
					}
					$bonusrebet = 10.8;
					
					
				}else if($packagepintype == 7){ //pin susu kambing
					$totalbonus = 20;
					$uni_bonus[0] = 4;
					$uni_bonus[1] = 4;
					$uni_bonus[2] = 3;
					$bonuspin = 1;
					$bonusrebet = 3;
					$bonuspinmaster = 1;	
				}else if($packagepintype == 8){ // pakej kopi
					$totalbonus = 15;
					$uni_bonus[0] = 4;
					$uni_bonus[1] = 4;
					$uni_bonus[2] = 3;
					$bonuspin = 0.5;
					$bonusrebet = 2.7;
					$bonuspinmaster = 0.5;
				}else if($packagepintype == 9){ //pakej susu kambing
					if($packagetype == 1){ //jenis membership pakej mana yang didaftarkan
						$totalbonus = 28;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$uni_bonus[7] = 2;
						$uni_bonus[8] = 2;
						$uni_bonus[9] = 2;
						$bonuspin = 1;
						$bonuspinmaster = 1;
						
					
					}else if($packagetype == 2){
						$totalbonus = 28;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 3;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$bonuspin = 1;
						$bonuspinmaster = 1;
						
					}else if($packagetype == 3){
						$totalbonus = 28;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$bonuspin = 1;
						$bonuspinmaster = 1;
						
					}else if($packagetype == 4){
						$totalbonus = 28;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$bonuspin = 1;
						$bonuspinmaster = 1; 
						
					}else if($packagetype == 5){
						$totalbonus = 28;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$bonuspin = 1;
						$bonuspinmaster = 1;
				
					}
					$bonusrebet = 3;
					
				}else if($packagepintype == 10){
					 //pakej susu kambing
					if($packagetype == 1){ //jenis membership pakej mana yang didaftarkan
						$totalbonus = 34;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$uni_bonus[7] = 2;
						$uni_bonus[8] = 2;
						$uni_bonus[9] = 2;
						$bonuspin = 1;
						$bonuspinmaster = 1;
						
					
					}else if($packagetype == 2){
						$totalbonus = 34;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 3;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$bonuspin = 1;
						$bonuspinmaster = 1;
						
					}else if($packagetype == 3){
						$totalbonus = 34;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$bonuspin = 1;
						$bonuspinmaster = 1;
						
					}else if($packagetype == 4){
						$totalbonus = 34;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$bonuspin = 1;
						$bonuspinmaster = 1; 
						
					}else if($packagetype == 5){
						$totalbonus = 34;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$bonuspin = 1;
						$bonuspinmaster = 1;
				
					}
					$bonusrebet = 5.4;
					
				
				}
			
				
			}else{ // ni kalau pin bukan dari master.
				if($packagepintype == 6){ //ni arrijal
					if($packagetype == 1){ //jenis membership pakej mana yang didaftarkan
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$uni_bonus[7] = 2;
						$uni_bonus[8] = 2;
						$uni_bonus[9] = 2;
						$bonuspin = 3;
					
					}else if($packagetype == 2){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 3;
						$uni_bonus[5] = 2;
						$uni_bonus[6] = 2;
						$bonuspin = 3;
						
					}else if($packagetype == 3){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$uni_bonus[3] = 3;
						$uni_bonus[4] = 2;
						$bonuspin = 3;
						
					}else if($packagetype == 4){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$uni_bonus[2] = 3;
						$bonuspin = 3;
						
					}else if($packagetype == 5){
						$totalbonus = 60;
						$uni_bonus[0] = 4;
						$uni_bonus[1] = 4;
						$bonuspin = 3;
						
					}
					$bonusrebet = 10.8;
					
					
				}else if($packagepintype == 7){ //pin susu kambing
					$totalbonus = 20;
					$uni_bonus[0] = 4;
					$uni_bonus[1] = 4;
					$uni_bonus[2] = 3;
					$bonuspin = 1;
					$bonusrebet = 3;
					
				}else if($packagepintype == 8){ // pakej kopi
					$totalbonus = 15;
					$uni_bonus[0] = 4;
					$uni_bonus[1] = 4;
					$uni_bonus[2] = 3;
					$bonuspin = 0.5;
					$bonusrebet = 2.7;
				}else if($packagepintype == 11){ //pakej hi goat
                    $totalbonus = 68;
                    $uni_bonus[0] = 4;
					$uni_bonus[1] = 4;
					$uni_bonus[2] = 3;
					$uni_bonus[3] = 3;
					$uni_bonus[4] = 2;
					$uni_bonus[5] = 2;
					$uni_bonus[6] = 2;
					$uni_bonus[7] = 2;
					$uni_bonus[8] = 2;
					$uni_bonus[9] = 2;
					$uni_bonus[10] = 1;
                    $uni_bonus[11] = 1;
                    $uni_bonus[12] = 1;
                    $uni_bonus[13] = 1;
                    $uni_bonus[14] = 1;
                    $uni_bonus[15] = 1;
                    $uni_bonus[16] = 1;
                    $uni_bonus[17] = 1;
                    $uni_bonus[18] = 1;
                    $uni_bonus[19] = 1;
                    $uni_bonus[20] = 1;
                    $uni_bonus[21] = 1;
                    $uni_bonus[22] = 1;
                    $uni_bonus[23] = 1;
                    $uni_bonus[24] = 1;
                    $bonuspin = 3;
                    $bonusrebet = 10.8;
                    
                    
				}
			}
			//--------------------------------- distribute bonus -------------------------------------------
			if($placement > 0){
                $this->bonus->saveBonusUnilevel($placement,$uni_bonus,$user,$totalbonus,$pin,$packagepintype);
			}
		    if($masterid > 0){//ni untuk distribute bonus kepada master
		    	$this->bonus->payPinStockist($pin,$bonuspin,$user,$user,'MAINTAIN',$masterid,$bonuspinmaster);
		    }else{
		    	$this->bonus->payPinStockist($pin,$bonuspin,$user,$user,'MAINTAIN');	
		    }
			//$this->bonus->saveBonusSponsor($sponsor,$newmemberid,$bonussponsor);
			
			
			//--------------------------------- genereate bonus --------------------------------------------
			$this->bonus->saveBonusRebet($user,$user,$bonusrebet,$pin);
			
		      //--------------------------------- update member_id to assign id;
		      
		      $this->pin->updatePin(array('pin_no'=>$pin),array('member_id'=>$memberRs->member_id));
      
			$data1['rs'] = $this->member->getMember(array('member_id'=>$user))->row();
			$this->load->view('member/maintainproduct',$data1);
      
      
		}
		
	}
	function maintain(){
		$data1['empty'] = "";
		$this->load->view('member/maintainform',$data1);
	}
	
	
}

?>
