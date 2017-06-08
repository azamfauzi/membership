<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Transfer</h1>
<p>Transfer</p>
<div class="content-box">
      <div class="box-body">
        <div class="box-header clear">
          <h2>Transfer</h2>
        </div>
        <?
        $attributes = array('id' => 'form','class'=>'validate-form form bt-space15');
          echo form_open('account/savetransfer/', $attributes);
        ?>
        <div class="box-wrap clear">
                <div class="col2-3">
                  <div class="form-field clear">
                      <h3>Available Balance : RM <?=$available;?></h3>
                      <h3>Transfer Amount : RM <?=$amount;?></h3>
                      <h3>Transfer To : <?=$membername;?></h3>
                      <h3>Balance Amount : RM <?=$balance;?></h3>
                  </div><!-- /.form-field -->
                  <div class="form-field clear">
                    <input type="hidden" name="amount" value="<?=$amount;?>">
                    <input type="hidden" name="membername" value="<?=$member;?>">
                    <input type="submit" id="save" name="save" class="button fl" value="Confirm" />
                  </div>  
                </div>
          </div>
        </div><!-- end of box-wrap -->
        </form>
      </div> <!-- end of box-body -->
      </div>      
<?php $this->load->view('footer');?>