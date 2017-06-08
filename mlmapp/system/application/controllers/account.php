<?php
class Account extends Controller {
    var $user;
    function Account(){
      parent::Controller();
      $user = $this->session->userdata('mYappH3rb');
      if(empty($user)){
        redirect('/auth/', 'refresh');
      }else{
        $this->user = $user;
      }
      
     
    }
    function ewallet(){
      $this->load->model('account_model','account');
      $rsBalance = $this->account->get_lastbalance($this->user);
      $data['balance'] = $rsBalance->balance;
      $this->load->view('account/ewallet',$data);
    }
    function checkwithdraw(){
      $amount = $this->input->post('amount');
      if(!is_numeric($amount) || empty($amount)){
          $this->load->model('account_model','account');
           $rsBalance = $this->account->get_lastbalance($this->user);
           $data['balance'] = $rsBalance->balance;
           $data['msg'] = 'Amount Cannot be empty';
           
           $this->load->view('account/withdraw',$data);  
      }else{
        if($amount < 50){
          //error
          $this->load->model('account_model','account');
           $rsBalance = $this->account->get_lastbalance($this->user);
           $data['balance'] = $rsBalance->balance;
           $data['msg'] = 'Minimum transfer is RM 50';
           $this->load->view('account/withdraw',$data);  
        }else{
           $this->load->model('account_model','account');
           $rsBalance = $this->account->get_lastbalance($this->user);
           
            if($rsBalance->balance < $amount){
           //erro
              $data['msg'] = 'Insufficient Amount';
              $this->load->view('account/withdraw',$data);  
            }else{
             
              $data['available'] = $rsBalance->balance;
              $data['amount'] = $amount;
              $data['balance'] = $rsBalance->balance - $amount;
              $this->load->view('account/withdrawconfirm',$data);
            }
         
           
        }
      }
    }
    function withdraw(){
      $this->load->model('account_model','account');
      $rsBalance = $this->account->get_lastbalance($this->user);
      $data['balance'] = $rsBalance->balance;
      $data['qwithdraw'] = $this->account->getWithdraw($this->user)->result();
      $this->load->view('account/withdraw',$data);
      
      //$this->saveWithdraw($arr);
      
    }
    function saveWithdraw(){
       $amount = $this->input->post('amount');
       $memberid = $this->user;
      
       $this->load->model('account_model','account');
       //update ewallet terlebih dahulu
       $this->account->updateBalance($memberid);
       $balance = $this->account->get_lastbalance($memberid)->balance;
       if(!is_numeric($amount) || empty($amount)){
           $msg['msg'] = 'Amount Cannot be empty';
           $this->load->view('account/withdraw',$data);  
       }else {
         if($balance < $amount){
         //erro
            $msg['msg'] = 'Minimum transfer is RM 50';
           $this->load->view('account/withdraw',$data);  
         }else{
            //make processing  
             
            $this->load->model('bonus_model','bonus');
            
            //create account to withdraw
            $withdrawid = $this->account->withdraw($memberid,$amount);
            
            
            //transaction to ledger..
            $statement = 'WITHDRAW TO BANK ACCOUNT';
            $arr_merge['withdraw_id'] = $withdrawid;
            //echo $withdrawid;
           //// exit();
            $this->bonus->saveAccount(0,$amount,$memberid,$statement,$arr_merge);
            
            
            
            //create account to withdraw
            $data['balance'] = $this->account->get_lastbalance($memberid)->balance;
            $data['msg'] = 'Your Withdraw Successfully Apply!';
            $data['qwithdraw'] = $this->account->getWithdraw($memberid)->result();
            $this->load->view('account/withdraw',$data);  
            
         }
       }
      
       
       
    }
    function transfer(){
          $this->load->model('account_model','account');
          $rsBalance = $this->account->get_lastbalance($this->user);
          $data['balance'] = $rsBalance->balance;
          $data['qwithdraw'] = $this->account->getWithdraw($this->user)->result();
          $this->load->view('account/transfer',$data);
            
    }
    function checktransfer(){
      $amount = $this->input->post('amount');
      $member = $this->input->post('member');
      $this->load->model('member_model','member');
      
      if(empty($member)){
       // $query = $this->member->get
        //$data['msg'] = 'Please Insert Member ID';
        
        
        $this->load->view('account/transfer',$data);
        
          
      }else{
          $query = $this->member->getMember(array('login'=>$member));
          if($query->num_rows() > 0 ){
            if( $query->row()->member_id == $this->session->userdata('mYappH3rb')){
              $this->load->model('account_model','account');
                 $rsBalance = $this->account->get_lastbalance($this->user);
                 $data['balance'] = $rsBalance->balance;
                
                $data['msg'] = 'Invalid Member ID';
                $this->load->view('account/transfer',$data);
            }else{
                if(!is_numeric($amount) || empty($amount)){
                 $this->load->model('account_model','account');
                 $rsBalance = $this->account->get_lastbalance($this->user);
                 $data['balance'] = $rsBalance->balance;
                 $data['msg'] = 'Amount Cannot be empty';
                 
                 $this->load->view('account/transfer',$data);  
                }else{
                  if($amount < 50){
                    //error
                     $this->load->model('account_model','account');
                     $rsBalance = $this->account->get_lastbalance($this->user);
                     $data['balance'] = $rsBalance->balance;
                     $data['msg'] = 'Minimum transfer is RM 50';
                     $this->load->view('account/transfer',$data);  
                  }else{
                     $this->load->model('account_model','account');
                     $rsBalance = $this->account->get_lastbalance($this->user);
                     
                      if($rsBalance->balance < $amount){
                     //erro
                        $data['msg'] = 'Insufficient Amount';
                        $this->load->view('account/transfer',$data);  
                      }else{
                        $data['membername'] = $query->row()->name;
                        $data['member'] = $query->row()->login;
                        $data['available'] = $rsBalance->balance;
                        $data['amount'] = $amount;
                        $data['balance'] = $rsBalance->balance - $amount;
                        $this->load->view('account/transferconfirm',$data);
                      }
                   
                     
                  }
                }  
            }
            
            
          }else{
             $this->load->model('account_model','account');
             $rsBalance = $this->account->get_lastbalance($this->user);
             $data['balance'] = $rsBalance->balance;
             $data['msg'] = 'Amount Cannot be empty';
            $data['msg'] = 'Invalid Member ID';
            $this->load->view('account/transfer',$data);
            
          }
          
                 
          
           
          
      }
     
    
    }
    function savetransfer(){
    
      $amount = $this->input->post('amount');
      $member = $this->input->post('membername');
      $this->load->model('bonus_model','bonus');
      $this->load->model('member_model','member');
      
      if(empty($member)){
       // $query = $this->member->get
        //$data['msg'] = 'Please Insert Member ID';
        
        $data['Invalid Member ID'];
        $this->load->view('account/transfer',$data);
        
          
      }else{
          $query = $this->member->getMember(array('login'=>$member));
          //echo $this->db->last_query();
          if($query->num_rows() > 0 ){
            if( $query->row()->member_id == $this->session->userdata('mYappH3rb')){
                $data['msg'] = 'Invalid Member ID';
                $this->load->view('account/transfer',$data);
            }else{
                $memberreceiver = $query->row()->member_id;
                if(!is_numeric($amount) || empty($amount)){
                 
                 $this->load->model('account_model','account');
                 $rsBalance = $this->account->get_lastbalance($this->user);
                 $data['balance'] = $rsBalance->balance;
                 $data['msg'] = 'Amount Cannot be empty';
                 
                 $this->load->view('account/transfer',$data);  
                }else{
                  if($amount < 50){
                    //error
                    $this->load->model('account_model','account');
                     $rsBalance = $this->account->get_lastbalance($this->user);
                     $data['balance'] = $rsBalance->balance;
                     $data['msg'] = 'Minimum transfer is RM 50';
                     $this->load->view('account/transfer',$data);  
                  }else{
                     $this->load->model('account_model','account');
                     $rsBalance = $this->account->get_lastbalance($this->user);
                     
                      if($rsBalance->balance < $amount){
                     //erro
                        $data['msg'] = 'Insufficient Amount';
                        $this->load->view('account/transfer',$data);  
                      }else{
                        $data['membername'] = $query->row()->name;
                        $data['available'] = $rsBalance->balance;
                        $data['amount'] = $amount;
                        $data['balance'] = $rsBalance->balance - $amount;
                        
                        $memberid = $this->session->userdata('mYappH3rb');
                        
                         //create account to transfer
                        $transferid = $this->account->transfer($memberid,$amount,$query->row()->member_id);
                        
                                  
                        //transaction out to ledger..
                        $statement = 'TRANSFER TO MEMBER ACCOUNT - ' . $query->row()->name;
                        $arr_merge['transfer_id'] = $transferid;
                        //echo $withdrawid;
                       //// exit();
                        $this->bonus->saveAccount(0,$amount,$memberid,$statement,$arr_merge);
                        //get personal member detail'
                        $query1 = $this->member->getMember(array('member_id'=>$memberid));
                        
                        
                        $statement = 'RECEIVE FROM MEMBER ACCOUNT - ' . $query1->row()->name;
                       
                        $this->bonus->saveAccount($amount,0,$memberreceiver,$statement,$arr_merge);
                        
                        $data['msg'] = 'You Wothdraw Successfully Apply';
                        $this->load->view('account/transfer',$data);
                        
                        
                        
                        
                        
                        
                        //create account to withdraw
                       // $data['balance'] = $this->account->get_lastbalance($memberid)->balance;
                       // $data['msg'] = 'Your Withdraw Successfully Apply!';
                      //  $data['qwithdraw'] = $this->account->getWithdraw($memberid)->result();
                        
                        
                        //$this->load->view('account/transferconfirm',$data);
                      }
                   
                     
                  }
                }
              
            }
            
            
          }else{
            $data['msg'] = 'Invalid Member ID';
            $this->load->view('account/transfer',$data);
            //echo $member;
          }
          
                 
          
           
          
      }
     
    }
    
}