<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Password</h1>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Change Password</h2>
				</div>

				<div class="box-wrap clear">
          <?      	
					$attributes = array('id' => 'form','class'=>'validate-form form bt-space15');
					echo form_open('profile/updatepwd/', $attributes);
                    ?>
					<div class="columns clear bt-space15">
						<div class="col2-3">
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">New Password: <span class="required">*</span></label>
								<input type="password" id="name" class="required text fl-space2" name="pwd" value="" />
								
                                <!--<input type="button" name="mybutton" id="mybutton" value="Check Availabilty" />-->
                            </div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Confirm Password: <span class="required">*</span></label>
								<input type="password" id="phoneno" class="required text fl-space2" name="pwd1" value=""/>
							    <!--<input type="button" name="mybutton" id="mybutton" value="Check Availabilty" />-->
                            </div><!-- /.form-field -->
                      	</div>
						
                        
					</div>
					<div class="rule"></div>
						<div class="form-field clear">
						<input type="submit" id="save" name="save" class="button fl" value="Update" />
                       
                        </div>																		
					
					</form>
					
					</div><!-- end of box-wrap -->
			</div> <!-- end of box-body -->
			</div>			
<?php $this->load->view('footer');?>