<?php
class Pin_model extends Model{
	var $title   = '';
    var $content = '';
    var $date    = '';

    function Pin_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	function getPin($arr=""){
		  $this->db->select('pin.*');
		  $this->db->from('pin');
		   // 
		  if(!empty($arr)){
		  	foreach($arr as $key=>$val){
				 $this->db->where($key,$val);
			}
		  }
		  $query = $this->db->get();
		  return $query;
	}
	function getPinPackage($arr=""){
		$this->db->select('product.*,pin.*');
		$this->db->from('pin');
		$this->db->join('product','product.pin_type=pin.pin_type');
		if(!empty($arr)){
		  	foreach($arr as $key=>$val){
				 $this->db->where($key,$val);
			}
		  }
		  $query = $this->db->get();
		  return $query;
	}
  function getBonusSponsor($packagetype){ //bonus sponsor ikut package
      if($packagetype == 1){
        $bonussponsor = 80;
      }else if($packagetype == 2){
        $bonussponsor = 50;
      }else if($packagetype == 3){
        $bonussponsor = 30;
      }else if($packagetype == 4){
        $bonussponsor = 20;
      }else if($packagetype == 5){
        $bonussponsor = 10;
      }else if($packagetype == 12){ //package 10000
        $bonussponsor = 500;
      }else if($packagetype == 13){ //package 140
        $bonussponsor = 50;
      }
      return $bonussponsor;
  }
  function updatePin($where,$arr){
      
      if(!empty($where)){
        foreach($where as $key=>$val){
          $this->db->where($key,$val);
        }
      }
      
     
      $this->db->update('pin',$arr);
      
      
  }
}