<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Product Maintainance</h1>
<p>Buy Product</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Maintain Product</h2>
				</div>
				<script language="javascript">
				function validate(){
					return false;
				}
				$(document).ready(function() {
					
					$("#pin").change(function(){
					 var items = $("#pin").val();
						$.post("<?php echo site_url('member/getpinmaintain');?>", { "items": items },
						 function(data){
							// alert(data.somefield);
							 $("#lblpin").html(data.pinpackage);
							 $("#hiddenpin").val(data.pinid);
				
						  // alert(data.name); // John
						   //console.log(data.time); //  2pm
						 }, "json");
					 });
					
				
				 
				});
				</script>
				<div class="box-wrap clear">
                    <?
					$attributes = array('id' => 'form','class'=>'validate-form form bt-space15');
					echo form_open('member/savemaintain/', $attributes);
                    ?>
					<div class="columns clear bt-space15">
						<div class="col2-3">
					        <div class="form-field clear">
								<label for="textfield" class="form-label size-120 fl-space2">Pin Code: <span class="required">*</span></label>
								<input type="text" id="pin" class="required text fl-space2" name="pin" /><div id="lblpin"></div>
								<input type="hidden" id="hiddenpin" name="hiddenpin" />
                                <!--<input type="button" name="mybutton" id="mybutton" value="Check Availabilty" />-->
                            </div><!-- /.form-field -->
                           
                         </div>																
							
					
						
						
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