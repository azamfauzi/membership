<?php
class Report extends Controller {

	function Report()
	{
		parent::Controller();	
		$user = $this->session->userdata('mYappH3rb');
		if(empty($user)){
			redirect('/auth/', 'refresh');
		}
	}
	function sponsor(){
		//if(empty($_SESSION['x'])){
			//redirect('/auth/', 'refresh');
		//}
		$user = $this->session->userdata('mYappH3rb');
		if(empty($user)){
			redirect('/auth/', 'refresh');
		}
		$memberid = $this->session->userdata('mYappH3rb');
		$this->db->select('member.*,bonus_sponsor.*');
		$this->db->from('bonus_sponsor');
		$this->db->join('member','member.member_id = bonus_sponsor.bonussponsorfrom_id');
		$this->db->where('bonus_sponsor.member_id',$memberid);
		$query = $this->db->get();
		
		$data['qbonus'] = $query->result();
		$this->load->view('report/bonussponsor',$data);
		
	}
	function unilevel(){
		$memberid = $this->session->userdata('mYappH3rb');
		$this->db->select('member.*,bonus_unilevel.*');
		$this->db->from('bonus_unilevel');
		$this->db->join('member','member.member_id = bonus_unilevel.bonusunilevelfrom_id');
		$this->db->where('bonus_unilevel.member_id',$memberid);
		$query = $this->db->get();
		
		$data['qbonus'] = $query->result();
		$this->load->view('report/bonusunilevel',$data);
		
	}
	function account(){
		$memberid = $this->session->userdata('mYappH3rb');
    $this->load->model('account_model','account');
    $this->db->select('member_account.*');
		$this->db->from('member_account');
		$this->db->where('member_account.member_id',$memberid);
		$query = $this->db->get();
		$data['balance'] = $this->account->get_lastbalance($memberid)->balance;
		$data['qbonus'] = $query->result();
		$this->load->view('report/account',$data);
	}
	function directsponsor(){
		$user = $this->session->userdata('mYappH3rb');
		$this->load->model('member_model','member');
		$query = $this->member->getMember(array('sponsor'=>$user));
		$data['qsponsor'] = $query->result();
		$this->load->view('report/directsponsor',$data);
		
	}
	function hierarchy(){
		$this->load->model('member_model','member');
		$user = $this->session->userdata('mYappH3rb');
		$query = $this->member->getMember(array('member_id'=>$user))->result();
		//$str = '<ul id="test" class="tree categories">';
			$str = "";
			//--------------------------------- LEVEL 1 -----------------------------------------------------
			foreach($query as $item){
				
				$str .= '<li  class="tree-item-main parent">
								<span class="item box-slide-head">HOME</span>';
								$query1 = $this->member->getMember(array('placement'=>$item->member_id))->result();
								$begin1 = false;
								//------------------------------------- LEVEL 2 ----------------------------------------
								foreach($query1 as $item1){
									if($begin1 == false){
										$begin1 = true;
										$str .= '<ul class="item box-slide-head">';
									}
									$str .=	'<li class="tree-item parent last">
											 <span class="item box-slide-head">' . $item1->login . '-' . $item1->name . '- Level 1</span>';
											//------------------------------------ LEVEL 3 ---------------------------------------
													$query2 = $this->member->getMember(array('placement'=>$item1->member_id))->result();
													$begin2 = false;
													foreach($query2 as $item2){
														if($begin2 == false){
															$begin2 = true;
															$str .= '<ul class="box-slide-body hidden">';
														}
														$str .=	'<li class="tree-item parent last">
														 <span class="item box-slide-head">' . $item2->login . '-' . $item2->name . '- Level 2</span>';
														 //------------------------------------ LEVEL 4 -----------------------------------------
														 		$query3 = $this->member->getMember(array('placement'=>$item2->member_id))->result();
																$begin3 = false;
																	foreach($query3 as $item3){
																		if($begin3 == false){
																			$begin3 = true;
																			$str .= '<ul class="box-slide-body hidden">';
																		}
																		$str .=	'<li class="tree-item parent last">
																		<span class="item box-slide-head">' . $item3->login . '-' . $item3->name . '- Level 3</span>';
																			//------------------------------------ LEVEL 5 -----------------------------------------
																				$query4 = $this->member->getMember(array('placement'=>$item3->member_id))->result();
																				$begin4 = false;
																					foreach($query4 as $item4){
																						if($begin4 == false){
																							$begin4 = true;
																							$str .= '<ul class="box-slide-body hidden">';
																						}
																						$str .=	'<li class="tree-item parent last">
																						<span class="item box-slide-head">' . $item4->login . '-' . $item4->name . '- Level 4</span>';
																							//------------------------------------ LEVEL 6 -----------------------------------------
																								$query5 = $this->member->getMember(array('placement'=>$item4->member_id))->result();
																								$begin5 = false;
																									foreach($query5 as $item5){
																										if($begin5 == false){
																											$begin5 = true;
																											$str .= '<ul class="box-slide-body hidden">';
																										}
																										$str .=	'<li class="tree-item parent last">
																										<span class="item box-slide-head">' . $item5->login . '-' . $item5->name . '- Level 5</span>';
																											//------------------------------------ LEVEL 7 -----------------------------------------
																													$query6 = $this->member->getMember(array('placement'=>$item5->member_id))->result();
																													$begin6 = false;
																														foreach($query6 as $item6){
																															if($begin6 == false){
																																$begin6 = true;
																																$str .= '<ul class="box-slide-body hidden">';
																															}
																															$str .=	'<li class="tree-item parent last">
																															<span class="item box-slide-head">' . $item6->login . '-' . $item6->name . '- Level 6</span>';
																																//------------------------------------ LEVEL 8 -----------------------------------------
																																	$query7 = $this->member->getMember(array('placement'=>$item6->member_id))->result();
																																	$begin7 = false;
																																		foreach($query7 as $item7){
																																			if($begin7 == false){
																																				$begin7 = true;
																																				$str .= '<ul class="box-slide-body hidden">';
																																			}
																																			$str .=	'<li class="tree-item parent last">
																																			<span class="item box-slide-head">' . $item7->login . '-' . $item7->name . '- Level 7</span>';
																																				//------------------------------------ LEVEL 9 -----------------------------------------
																																						$query8 = $this->member->getMember(array('placement'=>$item7->member_id))->result();
																																						$begin8 = false;
																																							foreach($query8 as $item8){
																																								if($begin8 == false){
																																									$begin8 = true;
																																									$str .= '<ul class="box-slide-body hidden">';
																																								}
																																								$str .=	'<li class="tree-item parent last">
																																								<span class="item box-slide-head">' . $item8->login . '-' . $item8->name . '- Level 8</span>';
																																									//------------------------------------ LEVEL 10 -----------------------------------------
																																										$query9 = $this->member->getMember(array('placement'=>$item8->member_id))->result();
																																										$begin9 = false;
																																											foreach($query9 as $item9){
																																												if($begin9 == false){
																																													$begin9 = true;
																																													$str .= '<ul class="box-slide-body hidden">';
																																												}
																																												$str .=	'<li class="tree-item parent last">
																																												<span class="item box-slide-head">' . $item9->login . '-' . $item9->name . '- Level 9</span>';
																																													//------------------------------------ LEVEL 11 -----------------------------------------
																																															$query10 = $this->member->getMember(array('placement'=>$item9->member_id))->result();
																																															$begin10 = false;
																																																foreach($query10 as $item10){
																																																	if($begin10 == false){
																																																		$begin10 = true;
																																																		$str .= '<ul class="box-slide-body hidden">';
																																																	}
																																																	$str .=	'<li class="tree-item parent last">
																																																	<span class="item box-slide-head">' . $item10->login . '-' . $item10->name . '- Level 10</span>';
																																																		//------------------------------------ LEVEL 8 -----------------------------------------
																																																			
																																																			
																																																		//------------------------------------- END LEVEL 8
																																																	$str .= '</li>';
																																																}
																																															
																																															if($begin10 == true){
																																																$str .= '</ul>';
																																															}
																																														
																																													//------------------------------------- END LEVEL 8
																																												$str .= '</li>';
																																											}
																																										
																																										if($begin9 == true){
																																											$str .= '</ul>';
																																										}
																																										
																																									//------------------------------------- END LEVEL 8
																																								$str .= '</li>';
																																							}
																																						
																																						if($begin8 == true){
																																							$str .= '</ul>';
																																						}
																																					
																																				//------------------------------------- END LEVEL 8
																																			$str .= '</li>';
																																		}
																																	
																																	if($begin7 == true){
																																		$str .= '</ul>';
																																	}
																																	
																																//------------------------------------- END LEVEL 8
																															$str .= '</li>';
																														}
																													
																													if($begin6 == true){
																														$str .= '</ul>';
																													}
																											//------------------------------------- END LEVEL 7
																										$str .= '</li>';
																									}
																								
																								if($begin5 == true){
																									$str .= '</ul>';
																								}
																							//------------------------------------- END LEVEL 6
																						$str .= '</li>';
																					}
																				
																				if($begin4 == true){
																					$str .= '</ul>';
																				}
																			//------------------------------------- END LEVEL 5
																		$str .= '</li>';
																	}
																
																if($begin3 == true){
																	$str .= '</ul>';
																}
														 //------------------------------------ END LEVEL 4 -------------------------------------
														 
														$str .= '</li>';
													}
												
													if($begin2 == true){
														$str .= '</ul>';
													}
											//------------------ end level 3 ----------------------------
									$str .= '</li>';
								}
								if($begin1 == true){
									$str .= '</ul>';
								}
								//-------------------------- end level 2
						
						
				$str .='</li>';	
			}
		//$str .= '</ul>';
		
		$data['hierarchy'] = $str;
		
		$this->load->view('report/hierarchy',$data);
	}
	
	
	
}
?>