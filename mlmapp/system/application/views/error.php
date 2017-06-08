<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Error Reporting</h1>

<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Error Reporting</h2>
				</div>
				
				<div class="box-wrap clear">
                 
					<div class="columns clear bt-space15">
						<div class="col2-3">
										
							
							<div class="form-field clear">
                          		<?
								if(is_array($error)){
									foreach($error as $item){
										print '<h4>Error:</h4>' . $item . '<br />';
									}
								}else{
										print '<h4>Error:</h4> <?php echo $error; ?><br />';
								}
								?>
								
								
									
                          
                            </div><!-- /.form-field -->
                            
						</div>
						
                        
					</div>
			       
					</div><!-- end of box-wrap -->
			</div> <!-- end of box-body -->
			</div>			
<?php $this->load->view('footer');?>