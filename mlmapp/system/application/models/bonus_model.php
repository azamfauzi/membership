<?php
class Bonus_model extends Model{
	var $title   = '';
    var $content = '';
    var $date    = '';

    function Bonus_model()
    {
        // Call the Model constructor
        parent::Model();
    }
    function checkmaintainance($member,$month,$year){
       $sqlstr = "select * from pin where member_id = '" . mysql_real_escape_string($member) . "'";
       $sqlstr .= " AND YEAR(pinregistered_datetime) = '" . $month . "' AND MONTH(pinregistered_datetime) = '" . $year . "'";
       $sqlstr .= " and (pin_type = 6 or pin_type = 7 or pin_type = 8 or pin_type = 9 or pin_type = 11)";
       
       $query = $this->db->query($sqlstr);
       return $query;
             
  
    }
	function saveBonusUnilevel($placement,$uni_bonus,$bonusfrom,$totalbonus,$pin,$packagepintype=0){
		//check pin type dulu 
        $pintypes = $packagepintype;
        //------------
		$stoploop = false;
        $counterlevel = 0;
		foreach($uni_bonus as $key=>$val){
		    $counterlevel = 0;
			//$sql = "select member where placement = '" . $placement . "'";
			if($stoploop == false){
			    $counterlevel = $counterlevel + 1;
                
				$q = $this->db->get_where('member',array('member_id'=>$placement)); //current member
                
                //kalu pin type == 11 then
                if($pintypes == 11){ //pakej hi goat
                     
                     $startloop = false;
                     $startloopbegin = false;
                     while ($startloop == false){
                         $q = $this->db->get_where('member',array('member_id'=>$placement)); //current member
                       //  echo $this->db->last_query();
                         $allow = true;
                         
                         $totalsponsor = $this->db->get_where('member',array('sponsor'=>$placement))->num_rows(); //check total sponsor
                         $qmaintain = $this->checkmaintainance($placement,date('Y'),date('m'))->num_rows(); //check total maintainance
                         /*
                         echo $this->db->last_query();
                         echo "USER ID " . $q->row()->member_id;
                         echo "TOTAL SPONSOR :"  . $totalsponsor;
                         echo "TOTAL MAINTAIN :" . $qmaintain;
                         */
                         if($q->row()->pin_type == 13){ //pin 140
                            if($qmaintain > 0 && $totalsponsor >= 1){ 
                                if($key <= 2 ){ //ni sampai level 3 (array 0 - 2)
                                    $startloop = true;
                                    $allow = true;         
                                }else if($key >= 3 && $key <= 5){ //ni sampai level 6 (array 3 - 5)
                                    $startloop = true;
                                    $allow = true;    
                                }else if($key >=6 ){ //ni sampai level 6 (array 7 - 5)
                                    $startloop = true;
                                    $allow = true;
                                }
                            }else{
                                $startloop = false;
                                $allow = false;
                            }
                         }else if($q->row()->pin_type == 12){ //pin 1000
                            if($qmaintain > 0){
                                $startloop = true;
                                $allow = true;
                            }else{
                                $startloop = false;
                                $allow = false;
                            }
                         }
                         
                         
                         $placement = $q->row()->placement;
                         if($startloop == false){
                            if($placement == 0){
            					$stoploop = true; //ni idicator stop loop bagi uni_level array
                                $allow = false; //ni untuk allow masuk ke dalam bonus.
                                $startloop = true; //ni unutk stop loop jum user ke atas.
            					//$this->db->insert(array('	
                                
            				}else{
                                $placement = $q->row()->placement;
                            }
                             
                         }else{
                             if($placement == 0){
            					$stoploop = true; //ni idicator stop loop bagi uni_level array
                               // $allow = false; //ni untuk allow masuk ke dalam bonus.
                                $startloop = true; //ni unutk stop loop jum user ke atas.
            					//$this->db->insert(array('	
                                
            				}
                         }
                         
                         
                     }
                                                                      
                                          
                     //yang ni temporary untuk sahaja
                     
                     
                     
                     if($allow == true){
                       	$curbonus = ($val/100)* $totalbonus;
        				$arr['member_id'] = $q->row()->member_id;
        				$arr['bonusunilevelfrom_id'] = $bonusfrom;
        				$arr['bonusunilevel_value'] = $curbonus;
        				$arr['bonusunilevel_level'] = $key + 1;
        				$arr['pin_no'] = $pin;
        				$this->db->set('created_datetime','NOW()',FALSE);
        				$this->db->set('created_date','NOW()',FALSE);
        				$this->db->insert('bonus_unilevel',$arr);
        				$sqlid = $this->db->insert_id();
        				$accmerge = array('bonusunilevel_id'=>$sqlid);
        				//masukkan bonus ke dalam akaun member
        				//bonusunilevel_level
        				$qMemberFrom = $this->db->get_where('member',array('member_id'=>$bonusfrom));
                       	$placement = $q->row()->placement;
			
				        $this->saveAccount($curbonus,0,$q->row()->member_id,'UNILEVEL BONUS FROM ' . $qMemberFrom->row()->login . ' LEVEL ' . $arr['bonusunilevel_level'],$accmerge);
                        //echo $this->db->last_query();
                      }  
				                        
                }else{
                    	$curbonus = ($val/100)* $totalbonus;
        				$arr['member_id'] = $q->row()->member_id;
        				$arr['bonusunilevelfrom_id'] = $bonusfrom;
        				$arr['bonusunilevel_value'] = $curbonus;
        				$arr['bonusunilevel_level'] = $key + 1;
        				$arr['pin_no'] = $pin;
        				$this->db->set('created_datetime','NOW()',FALSE);
        				$this->db->set('created_date','NOW()',FALSE);
        				$this->db->insert('bonus_unilevel',$arr);
        				$sqlid = $this->db->insert_id();
        				$accmerge = array('bonusunilevel_id'=>$sqlid);
        				//masukkan bonus ke dalam akaun member
        				//bonusunilevel_level
        				$qMemberFrom = $this->db->get_where('member',array('member_id'=>$bonusfrom));
                        $placement = $q->row()->placement;
			
			         	$this->saveAccount($curbonus,0,$q->row()->member_id,'UNILEVEL BONUS FROM ' . $qMemberFrom->row()->login . ' LEVEL ' . $arr['bonusunilevel_level'],$accmerge);
             
				
                    
                }
                //kena check ada maintain dan berapa dier pan te 
                
				//echo $this->db->last_query();
				//distribute bonus to member
				if($placement == 0){
					$stoploop = true;
					//$this->db->insert(array('	
				}
				//echo $placement;
			}
			
			
		}
	}
function payPinStockist($pin,$val,$memberid,$regby,$paymenttype="",$valmaster=0,$masterid=0){
		$q = $this->db->get_where('pin',array('pin_no'=>$pin));
		
		$arr['stockist_id'] = $q->row()->stockist_id;
		$arr['bonuspinfrom_id'] = $memberid;
		$arr['bonuspin_value'] = $val;
		$arr['pin_no'] = $pin;
		//echo $arr['stockist_id'];
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->insert('bonus_pin',$arr);
		$sqlid = $this->db->insert_id();
		$accmerge = array('bonuspin_id'=>$sqlid);
		//echo $this->db->last_query();
		
		$this->db->set('pin_active','REGISTERED');
		$this->db->set('pinregistered_by',$regby,FALSE);
		$this->db->set('pinregistered_datetime','NOW()',FALSE);
		$this->db->where('pin_no',$pin);
		$this->db->update('pin');
		
		$member = $this->db->get_where('member',array('member_id'=>$memberid));
		$rsMember = $member;
		//echo $this->db->last_query();
		//insert into account stockist
		if($paymenttype == 'MAINTAIN'){
			$statement = 'PRODUCT MAINTAIN FROM ' . $rsMember->row()->login;
			
		}else{
			$statement = 'MEMBER REGISTRATION FROM  '. $rsMember->row()->login;
		}
		$this->saveAccountStockist($val,0,$q->row()->stockist_id,$statement,$accmerge);
		if($masterid > 0 && $valmaster > 0){
			$this->saveAccountMaster($valmaster, 0, $masterid,$statement, $accmerge);
			
		}
		//$this->saveAccountMaster($val,0,$q->row()->master_id,$statement,$accmerge);
	
		
		
	}
	function saveAccountStockist($in,$out,$stockist,$statement,$arr_merge=""){
		$this->db->select('stockist_account.*');
		$this->db->from('stockist_account');
		$this->db->where('stockist_id',$stockist);
		$this->db->order_by('stockistacc_id','DESC');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$r = $q->row();
			$arr['balance'] = $r->balance;
			if($in > 0){
				$arr['debit'] = $in;
				$arr['credit'] = 0;
				$arr['balance'] = $arr['balance'] + $in;
			}else if($out > 0){
				$arr['debit'] = 0;
				$arr['credit'] = $out;
				$arr['balance'] = $arr['balance'] - $out;
			}
		}else{
			if($in > 0){
				$arr['debit'] = $in;
				$arr['credit'] = 0;
				$arr['balance'] = $in;
			}else if($out > 0){
				$arr['debit'] = 0;
				$arr['credit'] = $out;
				$arr['balance'] = $out;
			}
			
		}
		if(!empty($arr_merge)){
			foreach($arr_merge as $key=>$val){
				$arr[$key] = $val;
			}
		}
		$arr['statement'] = $statement;
		$arr['stockist_id'] = $stockist;
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->insert('stockist_account',$arr);
    $this->updateBalanceStockist($stockist);
    
	}
	
  function get_lastbalanceStockist($stockistid){
     
      $this->db->select('stockist_account.*');
      $this->db->from('stockist_account'); 
      $this->db->where('stockist_id',$stockistid);
      $this->db->order_by('stockistacc_id','DESC');
      $query = $this->db->get();
      $rs = $query->row();
      return $rs->balance;
  }
 function updateBalanceStockist($stockistid){
    if($stockistid > 0){
      $lastbalance = $this->get_lastbalanceStockist($stockistid);
      $this->db->where('stockist.stockist_id',$stockistid);
      $this->db->update('stockist',array('ewallet'=>$lastbalance));
    }
 }
 // ni untuk master processing
function saveAccountMaster($in,$out,$master,$statement,$arr_merge=""){
		$this->db->select('master_account.*');
		$this->db->from('master_account');
		$this->db->where('master_id',$master);
		$this->db->order_by('masteracc_id','DESC');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$r = $q->row();
			$arr['balance'] = $r->balance;
			if($in > 0){
				$arr['debit'] = $in;
				$arr['credit'] = 0;
				$arr['balance'] = $arr['balance'] + $in;
			}else if($out > 0){
				$arr['debit'] = 0;
				$arr['credit'] = $out;
				$arr['balance'] = $arr['balance'] - $out;
			}
		}else{
			if($in > 0){
				$arr['debit'] = $in;
				$arr['credit'] = 0;
				$arr['balance'] = $in;
			}else if($out > 0){
				$arr['debit'] = 0;
				$arr['credit'] = $out;
				$arr['balance'] = $out;
			}
			
		}
		if(!empty($arr_merge)){
			foreach($arr_merge as $key=>$val){
				$arr[$key] = $val;
			}
		}
		$arr['statement'] = $statement;
		$arr['master_id'] = $master;
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->insert('master_account',$arr);
    	$this->updateBalanceMaster($master);
    
 } 
 function get_lastbalanceMaster($masterid){
     
      $this->db->select('master_account.*');
      $this->db->from('master_account'); 
      $this->db->where('master_id',$masterid);
      $this->db->order_by('masteracc_id','DESC');
      $query = $this->db->get();
      $rs = $query->row();
      return $rs->balance;
  }
 function updateBalanceMaster($masterid){
    if($masterid > 0){
      $lastbalance = $this->get_lastbalanceMaster($masterid);
      $this->db->where('master.master_id',$masterid);
      $this->db->update('master',array('ewallet'=>$lastbalance));
    }
 }
 // end master function processing ---------
 // start member processing
 function get_lastbalanceMember($memberid){
     
      $this->db->select('member_account.*');
      $this->db->from('member_account'); 
      $this->db->where('member_id',$memberid);
      $this->db->order_by('memberacc_id','DESC');
      $query = $this->db->get();
      
      $rs = $query->row();
      return $rs->balance;
  }
  function updateBalanceMember($memberid){
    if($memberid > 0){
      $lastbalance = $this->get_lastbalanceMember($memberid);
      $this->db->where('member.member_id',$memberid);
      $this->db->update('member',array('ewallet'=>$lastbalance));
    }
  }
	function saveAccount($in,$out,$member,$statement,$arr_merge=""){
		$this->db->select('member_account.*');
		$this->db->from('member_account');
		$this->db->where('member_id',$member);
		$this->db->order_by('memberacc_id','DESC');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$r = $q->row();
			$arr['balance'] = $r->balance;
			if($in > 0){
				$arr['debit'] = $in;
				$arr['credit'] = 0;
				$arr['balance'] = $arr['balance'] + $in;
			}else if($out > 0){
				$arr['debit'] = 0;
				$arr['credit'] = $out;
				$arr['balance'] = $arr['balance'] - $out;
			}
		}else{
			if($in > 0){
				$arr['debit'] = $in;
				$arr['credit'] = 0;
				$arr['balance'] = $in;
			}else if($out > 0){
				$arr['debit'] = 0;
				$arr['credit'] = $out;
				$arr['balance'] = $out;
			}
			
		}
		if(!empty($arr_merge)){
			foreach($arr_merge as $key=>$val){
				$arr[$key] = $val;
			}
		}
		$arr['member_id'] = $member;
		$arr['statement'] = $statement;
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->insert('member_account',$arr);
    
    
    //update ewallet
    $this->updateBalanceMember($member);
    
	}
	function saveBonusSponsor($sponsor,$bonusfrom,$bonusval,$pin_no){
		
		$q = $this->db->get_where('member',array('member_id'=>$sponsor));
		$membername = $q->row()->login;
		
		$arr['member_id'] = $sponsor;
		$arr['bonussponsorfrom_id'] = $bonusfrom;
		$arr['bonussponsor_value'] = $bonusval;
		$arr['pin_no'] = $pin_no;
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->insert('bonus_sponsor',$arr);
		$sqlid = $this->db->insert_id();
		$accmerge = array('bonusponsor_id'=>$sqlid);
		$qMemberFrom = $this->db->get_where('member',array('member_id'=>$bonusfrom));
		
		
		$this->saveAccount($bonusval,0,$sponsor,'SPONSOR BONUS FROM ' . $qMemberFrom->row()->login,$accmerge);
				
	}
	function saveBonusRebet($owner,$bonusfrom,$bonusval,$pin){
		
		$q = $this->db->get_where('member',array('member_id'=>$owner));
		$membername = $q->row()->login;
		
		$arr['member_id'] = $owner;
		$arr['bonusrebatefrom_id'] = $bonusfrom;
		$arr['bonusrebate_value'] = $bonusval;
		$arr['pin_no'] = $pin;
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->insert('bonus_rebate',$arr);
		$sqlid = $this->db->insert_id();
		$accmerge = array('bonusrebate_id'=>$sqlid);
		$qMemberFrom = $this->db->get_where('member',array('member_id'=>$bonusfrom));
		
		
		$this->saveAccount($bonusval,0,$owner,'REBATE PRODUCT MAINTAIN',$accmerge);
				
	}
	
	
}
?>