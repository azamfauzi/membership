<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Registration Form</h1>
<p>New Member Registration</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Register Form</h2>
				</div>
				<script language="javascript">
				function validate(){
					return false;
				}
				$(document).ready(function() {
					$("#save").click(function(){
						//alert("berul");
						var pass = $("#password").val();
						var pass1 = $("#password1").val();
						if(pass != "" && pass1 != ""){
							if(pass != pass1){
								alert("Password Not Match");
								return false;
							}else{
								return true;	
							}
						}
						
					});
					$("#pin").change(function(){
					 var items = $("#pin").val();
						$.post("<?php echo site_url('member/getpin');?>", { "items": items },
						 function(data){
							// alert(data.somefield);
							 $("#lblpin").html(data.pinpackage);
							 $("#hiddenpin").val(data.pinid);
				
						  // alert(data.name); // John
						   //console.log(data.time); //  2pm
						 }, "json");
					 });
					$("#placement").change(function(){
					 var items = $("#placement").val();
						$.post("<?php echo site_url('member/getmember');?>", { "items": items },
						 function(data){
							// alert(data.somefield);
							 $("#lblplacement").html(data.somefield);
							 $("#hiddenplacement").val(data.memberid);
							// alert(data.memberid);
							
						  // alert(data.name); // John
						   //console.log(data.time); //  2pm
						 }, "json");
					 });
					$("#sponsor").change(function(){
					 var items = $("#sponsor").val();
						$.post("<?php echo site_url('member/getsponsor');?>", { "items": items },
						 function(data){
							// alert(data.somefield);
							 $("#lblsponsor").html(data.somefield);
							 $("#hiddensponsor").val(data.placementid);
						  // alert(data.name); // John
						   //console.log(data.time); //  2pm
						 }, "json");
					 });
				 
				});
				</script>
                
				<div class="box-wrap clear">
               		 <? if(isset($msg)){ 
						print '<div class="notification note-success">
						<p><strong><a href="#" class="close" title="Close notification">close</a>';
						echo $msg;
						print '</strong></p></div>';
						}?>
                     <?
					$attributes = array('id' => 'form','class'=>'validate-form form bt-space15');
					echo form_open('member/savemember/', $attributes);
                    ?>
					<div class="columns clear bt-space15">
						<div class="col2-3">
										
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Sponsor: <span class="required">*</span></label>
								<input type="text" id="sponsor" class="required text fl-space2" name="sponsor" /><div id="lblsponsor"></div>
								<input type="hidden" id="hiddensponsor" name="hiddensponsor" />
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Placement: <span class="required">*</span></label>
								<input type="text" id="placement" class="required text fl-space2" name="placement" /><div id="lblplacement"></div>
								<input type="hidden" id="hiddenplacement" name="hiddenplacement" />
                                <!--<input type="button" name="mybutton" id="mybutton" value="Check Availabilty" />-->
                            </div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Pin Code: <span class="required">*</span></label>
								<input type="text" id="pin" class="required text fl-space2" name="pin" /><div id="lblpin"></div>
								<input type="hidden" id="hiddenpin" name="hiddenpin" />
                                <!--<input type="button" name="mybutton" id="mybutton" value="Check Availabilty" />-->
                            </div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="file" class="form-label size-120 fl-space2">Password: <span class="required">*</span></label>
						      <input type="password" id="password" class="required text fl-space2" name="password" />
							</div><!-- /.form-field -->		
							<div class="form-field clear">
								<label for="password" class="form-label size-120 fl-space2">Confirm Password: <span class="required">*</span></label>
								<input type="password" id="password1" class="required text fl-space2" name="password1" />
						      
							</div><!-- /.form-field -->							
							<div class="rule"></div>	
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Name: <span class="required">*</span></label>
								<input type="text" id="name" class="required text fl-space2" name="name" />
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">NRIC<span class="required">*</span></label>
								<input type="text" id="nric" class="required text fl-space2" name="nric" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">D.O.B:</label>
								<select id="day" name="day">
                                   	<option value=""></option>
                                    <? for($x=1;$x<31;$x++){
										echo '<option value="' . $x . '">' . $x . '</option>';
										
									}?>
									
								</select>
                                - <select id="month" name="month">
                                
                                      <option value='01'>January</option>
                                      <option value='02'>February</option>
                                      <option value='03'>March</option>
                                      <option value='04'>April</option>
                                      <option value='05'>May</option>
                                      <option value='06'>June</option>
                                      <option value='07'>July</option>
                                      <option value='08'>August</option>
                                      <option value='09'>September</option>
                                      <option value='10'>October</option>
                                      <option value='11'>November</option>
                                      <option value='12'>December</option>
                                    </select> - <select id="year" name="year">
                                   	<option value=""></option>
                                    <?
										for($x =1900;$x<2005;$x++){
											?>
                                            	<option value="<?=$x;?>"><? echo $x; ?></option>
							                <?
										}
									?>
									
								</select>
							</div><!-- /.form-field -->		
							<div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">Gender:</label>
								<select id="gender" class="fl-space2 " name="gender">
                                   	<option value=""></option>
									<option value="MALE">MALE</option>
									<option value="FEMALE">FEMALE</option>
									
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
								<input type="text" id="address" class="text fl-space2" name="address" size="40" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Address 1</label>
								<input type="text" id="address1" class="text fl-space2" name="address1" size="40" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Postcode</label>
								<input type="text" id="postcode" class="text fl-space2" name="postcode" />
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">City</label>
								<input type="text" id="city" class="text fl-space2" name="city" size="40" />
							</div><!-- /.form-field -->
                            <div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">State: <span class="required">*</span></label>
								<select id="state" class="fl-space2 required" name="state">
                                   <option value="">[SELECT]</option>
                                    <option value="JOHOR">JOHOR</option>
                                    <option value="KEDAH">KEDAH</option>
                                    <option value="KELANTAN">KELANTAN</option>
                                    <option value="MELAKA">MELAKA</option>
                                    <option value="N. SEMBILAN">N. SEMBILAN</option>
                                    <option value="PAHANG">PAHANG</option>
                                    <option value="PERAK">PERAK</option>
                                    <option value="PERLIS">PERLIS</option>
                                    <option value="SABAH">SABAH</option>
                                    <option value="SARAWAK">SARAWAK</option>
                                    <option value="SELANGOR">SELANGOR</option>
                                    <option value="TERENGGANU">TERENGGANU</option>
                                    <option value="P. PINANG">P. PINANG</option>
                                    <option value="W. P. PUTRAJAYA">W. P. PUTRAJAYA</option>
                                    <option value="W. P. KUALA LUMPUR">W. P. KUALA LUMPUR</option>
                                    <option value="W. P. LABUAN">W. P. LABUAN</option>
									
								</select>
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Mobile Phone<span class="required">*</span></label>
								<input type="text" id="mobilephone" class="required text fl-space2" name="mobilephone" />
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Telephone</label>
								<input type="text" id="telephone" class="text fl-space2" name="telephone" />
							</div><!-- /.form-field -->
                             <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Email</label>
								<input type="text" id="email" class="text fl-space2" name="email" />
							</div><!-- /.form-field -->	
                             <div class="rule"></div>
                              <div class="form-field clear">
								<label for="select" class="form-label size-120 fl-space2">Bank Name:</label>
								<select id="bankname" class="fl-space2" name="bankname">
                                 
									<option value="MAYBANK">MAYBANK</option>
									<option value="CIMB">CIMB</option>
									
								</select>
							</div><!-- /.form-field -->
                              <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Account No</label>
								<input type="text" id="account_no" class="text fl-space2" name="account_no" />
								</div><!-- /.form-field -->	
							  <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Beneficiary Name</label>
								<input type="text" id="beneficiary_name" class="text fl-space2" name="beneficiary_name" />
								</div><!-- /.form-field -->		
                                 <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Beneficiary NRIC</label>
								<input type="text" id="beneficiary_nric" class="text fl-space2" name="beneficiary_nric" />
								</div><!-- /.form-field -->		
                                 <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Relationship</label>
								<input type="text" id="relationship" class="text fl-space2" name="relationship" />
								</div><!-- /.form-field -->		
                                 <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Phone</label>
								<input type="text" id="beneficiary_phone" class="text fl-space2" name="beneficiary_phone" />
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