<?
class Account_model extends Model{
   function Account_model()
   {
        // Call the Model constructor
        parent::Model();
   }
   function get_lastbalance($memberid){
      $this->db->select('member_account.*');
      $this->db->from('member_account'); 
      $this->db->where('member_id',$memberid);
      $this->db->order_by('memberacc_id','DESC');
      $query = $this->db->get();
      
      $rs = $query->row();
      return $rs;
  }
  function updateBalance($memberid){
    if($memberid > 0){
      $lastbalance = $this->get_lastbalance($memberid)->balance;
      $this->db->where('member.member_id',$memberid);
      $this->db->update('member',array('ewallet'=>$lastbalance));
      
    }
  }
  function withdraw($memberid,$amount){
    $arr['member_id'] = mysql_real_escape_string($memberid);
    $arr['withdraw_amount'] = mysql_real_escape_string($amount);
    $arr['withdraw_status'] = 'PROCESS'; 
    $this->db->set('created_datetime','NOW()',FALSE);
    $this->db->set('created_date','NOW()',FALSE);
    $this->db->insert('withdraw',$arr);
    $id = $this->db->insert_id();
    return $id;
  }
  function getWithdraw($memberid){
    $this->db->select('withdraw.*');
    $this->db->from('withdraw');
    $this->db->where('member_id',$memberid);
    return $this->db->get();
  }
  function transfer($memberid,$amount,$transferto){
    $arr['member_id'] = mysql_real_escape_string($memberid);
    $arr['transfer_amount'] = mysql_real_escape_string($amount);
    $arr['transfer_status'] = 'SUCCESS';
    $arr['transfer_to'] = mysql_real_escape_string($transferto); 
    $this->db->set('created_datetime','NOW()',FALSE);
    $this->db->set('created_date','NOW()',FALSE);
    $this->db->insert('transfer',$arr);
    $id = $this->db->insert_id();
    return $id;
  }
  
   
}
?>