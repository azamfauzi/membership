<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Profile</h1>
<p>Profile Detail</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Profile</h2>
				</div>
				
				<div class="box-wrap clear">
                	<? if(isset($msg)){ 
								print '<div class="notification note-success">
                                <p><strong><a href="#" class="close" title="Close notification">close</a>';
								echo $msg;
								print '</strong></p></div>';
								}?>
                    <?
                	$attributes = array('id' => 'form','class'=>'validate-form form bt-space15');
					echo form_open('profile/saveprofile/', $attributes);
                    ?>
					<div class="columns clear bt-space15">
						<div class="col2-3">
							
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Name: <span class="required">*</span></label>
								<input type="text" size="50" id="name" class="required text fl-space2" name="name" value="<? if(isset($rsProfile)){ echo $rsProfile->name;}?>" />
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">NRIC<span class="required">*</span></label>
								<input type="text" id="nric" maxlength="12" class="required text fl-space2" name="nric" value="<? if(isset($rsProfile)){ echo $rsProfile->nric;}?>" />
							</div><!-- /.form-field -->
                            <?
                            if(isset($rsProfile->dob)){
								$dob = explode("-",$rsProfile->dob);
								$year = $dob[0];
								$month = $dob[1];
								$day = $dob[2];
												
							}else{
								$year = "";
								$month = "";
								$day = "";
							}
							?>
                            <div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">D.O.B:</label>
								<select id="day" name="day">
                                   	<option value=""></option>
                                    <? for($x=1;$x<31;$x++){
										if($day == $x){
											$selected = " selected";
										}else{
											$selected = "";
										}
										if($x<10){
											
											echo '<option ' . $selected . ' value="0' . $x . '">0' . $x . '</option>';
										}else{
											echo '<option  ' . $selected . ' value="' . $x . '">' . $x . '</option>';
										}
										
									}?>
									
								</select>
                                - <select id="month" name="month">
                                
                                      <option value='01' <? if($month == "01"){ echo ' selected';}?>>January</option>
                                      <option value='02' <? if($month == "02"){ echo ' selected';}?>>February</option>
                                      <option value='03' <? if($month == "03"){ echo ' selected';}?>>March</option>
                                      <option value='04' <? if($month == "04"){ echo ' selected';}?>>April</option>
                                      <option value='05' <? if($month == "05"){ echo ' selected';}?>>May</option>
                                      <option value='06' <? if($month == "06"){ echo ' selected';}?>>June</option>
                                      <option value='07' <? if($month == "07"){ echo ' selected';}?>>July</option>
                                      <option value='08' <? if($month == "08"){ echo ' selected';}?>>August</option>
                                      <option value='09' <? if($month == "09"){ echo ' selected';}?>>September</option>
                                      <option value='10' <? if($month == "10"){ echo ' selected';}?>>October</option>
                                      <option value='11' <? if($month == "11"){ echo ' selected';}?>>November</option>
                                      <option value='12' <? if($month == "12"){ echo ' selected';}?>>December</option>
                                    </select> - <select id="year" name="year">
                                   	<option value=""></option>
                                    <?
										for($x =1900;$x<2005;$x++){
											?>
                                            	<option <? if($year == $x){ echo ' selected';}?> value="<?=$x;?>"><? echo $x; ?></option>
							                <?
										}
									?>
									
								</select>
							</div><!-- /.form-field -->		
							<div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">Gender:</label>
								<select id="gender" class="fl-space2 " name="gender">
                                   	<option value=""></option>
									<option <? if(isset($rsProfile) && $rsProfile->gender == 'MALE'){ echo " selected";}?> value="MALE">MALE</option>
									<option <? if(isset($rsProfile) && $rsProfile->gender == 'FEMALE'){ echo " selected";}?> value="FEMALE">FEMALE</option>
									
								</select>
							</div><!-- /.form-field -->
                        
						</div>
						<div class="col1-3 lastcol">
							<div class="mark_blue bt-space20">
								<h4>Pemberitahuan:</h4>
								<p class="clean-padding bt-space10">Sila isi kesemua maklumat yang perlu disisi.</p>
								<ul class="standard clean-padding bt-space20">
								<li class="bt-space5">Kegagalan mengisi data dengan tepat boleh menyebabkan ralat sistem.</li>
								<li class="bt-space5">Pastikan data yang dimasukkan adalah tepat.</li>
								</ul>
							</div> 
							
						</div>
                        
					</div>
					
					<div class="rule"></div>
						
					<div class="columns clear bt-space15">
					
							
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Address</label>
								<input type="text" id="address" class="text fl-space2" value="<? if(isset($rsProfile)){ echo $rsProfile->address;}?>" name="address" size="40" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Address 1</label>
								<input type="text" id="address1" class="text fl-space2" name="address1" value="<? if(isset($rsProfile)){ echo $rsProfile->address1;}?>" size="40" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Postcode</label>
								<input type="text" id="postcode" class="text fl-space2" name="postcode" value="<? if(isset($rsProfile)){ echo $rsProfile->postcode;}?>" />
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">City</label>
								<input type="text" id="city" class="text fl-space2" name="city" size="40" value="<? if(isset($rsProfile)){ echo $rsProfile->city;}?>" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">State: <span class="required">*</span></label>
								<? if(isset($rsProfile)){ $state = $rsProfile->state;}?>
                                <select id="state" class="fl-space2 required" name="state">
                                   <option value="" >[SELECT]</option>
                                    <option value="JOHOR" <? if($state == "JOHOR"){ echo ' selected';}?>>JOHOR</option>
                                    <option value="KEDAH" <? if($state == "KEDAH"){ echo ' selected';}?>>KEDAH</option>
                                    <option value="KELANTAN" <? if($state == "KELANTAN"){ echo ' selected';}?>>KELANTAN</option>
                                    <option value="MELAKA" <? if($state == "MELAKA"){ echo ' selected';}?>>MELAKA</option>
                                    <option value="N. SEMBILAN" <? if($state == "N. SEMBILAN"){ echo ' selected';}?>>N. SEMBILAN</option>
                                    <option value="PAHANG" <? if($state == "PAHANG"){ echo ' selected';}?>>PAHANG</option>
                                    <option value="PERAK" <? if($state == "PERAK"){ echo ' selected';}?>>PERAK</option>
                                    <option value="PERLIS" <? if($state == "PERLIS"){ echo ' selected';}?>>PERLIS</option>
                                    <option value="SABAH" <? if($state == "SABAH"){ echo ' selected';}?>>SABAH</option>
                                    <option value="SARAWAK" <? if($state == "SARAWAK"){ echo ' selected';}?>>SARAWAK</option>
                                    <option value="SELANGOR" <? if($state == "SELANGOR"){ echo ' selected';}?>>SELANGOR</option>
                                    <option value="TERENGGANU" <? if($state == "TERENGGANU"){ echo ' selected';}?>>TERENGGANU</option>
                                    <option value="P. PINANG" <? if($state == "P. PINANG"){ echo ' selected';}?>>P. PINANG</option>
                                    <option value="W. P. PUTRAJAYA" <? if($state == "W. P. PUTRAJAYA"){ echo ' selected';}?>>W. P. PUTRAJAYA</option>
                                    <option value="W. P. KUALA LUMPUR" <? if($state == "W. P. KUALA LUMPUR"){ echo ' selected';}?>>W. P. KUALA LUMPUR</option>
                                    <option value="W. P. LABUAN" <? if($state == "W. P. LABUAN"){ echo ' selected';}?>>W. P. LABUAN</option>
									
								</select>
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Mobile Phone<span class="required">*</span></label>
								<input type="text" id="mobilephone" class="required text fl-space2" name="mobilephone" value="<? if(isset($rsProfile)){ echo $rsProfile->mobilephone;}?>" />
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Telephone</label>
								<input type="text" id="telephone" class="text fl-space2" name="telephone" value="<? if(isset($rsProfile)){ echo $rsProfile->telephone;}?>" />
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Email</label>
								<input type="text" id="email" class="text fl-space2" name="email" value="<? if(isset($rsProfile)){ echo $rsProfile->email;}?>"/>
							</div><!-- /.form-field -->	
                             <div class="rule"></div>
                              <div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">Bank Name:</label>
								<select id="bankname" class="fl-space2" name="bankname" >
                                 
									<option value="MAYBANK">MAYBANK</option>
									<option value="CIMB">CIMB</option>
									
								</select>
							</div><!-- /.form-field -->
                              <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Account No</label>
								<input type="text" id="account_no" class="text fl-space2" name="account_no" value="<? if(isset($rsProfile)){ echo $rsProfile->account_no;}?>" />
								</div><!-- /.form-field -->	
							  <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Beneficiary Name</label>
								<input type="text" id="beneficiary_name" class="text fl-space2" name="beneficiary_name" value="<? if(isset($rsProfile)){ echo $rsProfile->beneficiary_name;}?>" />
								</div><!-- /.form-field -->		
                                 <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Beneficiary NRIC</label>
								<input type="text" id="beneficiary_nric" class="text fl-space2" name="beneficiary_nric" value="<? if(isset($rsProfile)){ echo $rsProfile->beneficiary_nric;}?>" />
								</div><!-- /.form-field -->		
                                 <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Relationship</label>
								<input type="text" id="relationship" class="text fl-space2" name="relationship" value="<? if(isset($rsProfile)){ echo $rsProfile->relationship;}?>" />
								</div><!-- /.form-field -->		
                                 <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Phone</label>
								<input type="text" id="beneficiary_phone" class="text fl-space2" name="beneficiary_phone" value="<? if(isset($rsProfile)){ echo $rsProfile->beneficiary_phone;}?>" />
								</div><!-- /.form-field -->																
							
					
						
						
					</div>	
					<div class="rule"></div>
						<div class="form-field clear">
						<input type="submit" id="save" name="save" class="button fl" value="Save" />
                        
                        </div>																		
					
					</form>
					</div><!-- end of box-wrap -->
			</div> <!-- end of box-body -->
			</div>			
<?php $this->load->view('footer');?>