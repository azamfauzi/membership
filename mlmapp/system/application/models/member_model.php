<?php
class Member_model extends Model{
	var $title   = '';
    var $content = '';
    var $date    = '';

    function Member_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	function getMember($arr=""){
		  $this->db->select('member.*');
		  $this->db->from('member');
		   // 
		  if(!empty($arr)){
		  	foreach($arr as $key=>$val){
				 $this->db->where($key,$val);
			}
		  }
		  $query = $this->db->get();
		  return $query;
	}
	function getMatchField($arr,$tablename){
  			$result = mysql_query("SHOW COLUMNS FROM " . $tablename);
			if (!$result) {
			    echo 'Could not run query: ' . mysql_error();
			    exit;
			}
			if (mysql_num_rows($result) > 0) {
			    while ($row = mysql_fetch_array($result)) {
			        foreach($arr as $key => $value) {
			        	if($key == $row[0]){ //kalau match kena set kat sini
							//echo $key;    
							$arrR[$key] = mysql_real_escape_string($value);
			        	}
					}
			       	
			    }
			    return $arrR;
			}

    }
	function str_counter($str)
	{
		$count = strlen($str);
		$strZero = '';
		if($count < 5)
		{	
			$zero = 5 - $count;
			for ($i =1;$i<= $zero; $i++)
			{
				$strZero = $strZero . "0" ;
			}
			$result = $strZero . $str;
		}
		else
		{
			$result = $str;
		}
		return $result;
		
	}
	function getMemberCounter(){
		$this->db->select('member_counter.*');
		$this->db->from('member_counter');
		$query = $this->db->get();
		return $query->row()->membercounter_no;
	}
	function updateMemberCounter(){
		$sql = "update member_counter set membercounter_no = membercounter_no + 1";
		$this->db->query($sql);
	}
	function insertMember($arr){
		$arrRecord = $arr = $this->getMatchField($arr,"member");
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->insert('member',$arrRecord);
		return $this->db->insert_id();
	}
	function updateMember($arr){
		$arrRecord = $arr = $this->getMatchField($arr,"member");
		$this->db->set('updated_date','NOW()',FALSE);
		$this->db->set('updated_datetime','NOW()',FALSE);
		$this->db->where('member_id',$arrRecord['member_id']);
		$this->db->update('member',$arrRecord);
		return $this->db->insert_id();
	}
	function insertMemberDetail($arr){
		$arrRecord = $arr = $this->getMatchField($arr,"member_detail");
		$this->db->set('created_date','NOW()',FALSE);
		$this->db->set('created_datetime','NOW()',FALSE);
		$this->db->insert('member_detail',$arrRecord);
	}
	function updateMemberDetail($arr){
		$arrRecord = $arr = $this->getMatchField($arr,"member_detail");
		$this->db->set('updated_date','NOW()',FALSE);
		$this->db->set('updated_datetime','NOW()',FALSE);
		$this->db->where('member_id',$arrRecord['member_id']);
		$this->db->update('member_detail',$arrRecord);
	}
	function updatePassword($arr){
		$arrRecord =  $this->getMatchField($arr,"member");
		$this->db->set('updated_date','NOW()',FALSE);
		$this->db->set('updated_datetime','NOW()',FALSE);
		$this->db->where('member_id',$arrRecord['member_id']);
		$this->db->update('member',$arrRecord);
		return $this->db->insert_id();
	}
	function getMemberDetail($arr){
		 $this->db->select('member_detail.*,member.*');
		  $this->db->from('member');
		  $this->db->join('member_detail','member_detail.member_id = member.member_id','LEFT');
		  
		   // 
		  if(!empty($arr)){
		  	foreach($arr as $key=>$val){
				 $this->db->where($key,$val);
			}
		  }
		  $query = $this->db->get();
		  return $query;
	}
    
	
}