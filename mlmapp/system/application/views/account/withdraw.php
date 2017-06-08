<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Withdraw</h1>
<p>Withdraw</p>
<div class="content-box">
      <div class="box-body">
        <div class="box-header clear">
          <h2>Withdraw</h2>
        </div>
        <?
        $attributes = array('id' => 'form','class'=>'validate-form form bt-space15');
          echo form_open('account/checkwithdraw/', $attributes);
        ?>
        <div class="box-wrap clear">
                <? if(isset($msg)){ 
                print '<div class="notification note-success">
                                <p><strong><a href="#" class="close" title="Close notification">close</a>';
                echo $msg;
                print '</strong></p></div>';
                }?>
                <div class="col2-3">
                  <div class="form-field clear">
                      <h3>Available Balance : RM <?=$balance;?></h3>
                      <label for="textfield" class="form-label size-120 fl-space2">Withdraw Amount: <span class="required">*</span></label>
                      <input type="text" size="10" id="amount" class="required text fl-space2" name="amount" value="" /> Minimum amount is RM50.00
                  </div><!-- /.form-field -->
                  <div class="form-field clear">
                    <input type="submit" id="save" name="save" class="button fl" value="Proceed" />
                  </div>    
                </div>
          </div>
        </div><!-- end of box-wrap -->
        </form>
        <div class="box-wrap clear">
              <h3>Withdraw Status History</h3>
              <table class="style1">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                
                                    
                </tr>
              </thead>
              
              <tbody>
                <?
                if(isset($qwithdraw)){
                  foreach($qwithdraw as $item){
                  ?>
                  <tr>
                    
                    <td><a href="#"><?=$item->created_date;?></a></td>
                                      <td><?=$item->withdraw_amount;?></td>
                                      <td><?=$item->withdraw_status;?></td>
                  </tr>
                                  <?
                  }
                }
                ?>
                
              
              </tbody>
            </table>
          </div>
        </div><!-- end of box-wrap -->
      </div> <!-- end of box-body -->
      
      </div>      
<?php $this->load->view('footer');?>