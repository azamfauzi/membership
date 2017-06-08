<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>E-Wallet</h1>
<p>Total E-Wallet</p>
<div class="content-box">
      <div class="box-body">
        <div class="box-header clear">
          <h2>E-Wallet</h2>
        </div>
        
        <div class="box-wrap clear">
                <div class="col2-3">
                  <div class="form-field clear">
                      <h3>Available Balance : RM <?=$balance;?></h3>
                  </div><!-- /.form-field -->
                </div>
          </div>
        </div><!-- end of box-wrap -->
      </div> <!-- end of box-body -->
      </div>
<?php $this->load->view('footer');?>