<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Product Maintain</h1>
<p>Member Registration Succes</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Pin Registration</h2>
				</div>
				
				<div class="box-wrap clear">
                
					<div class="columns clear bt-space15">
						<div class="col2-3">
										
							<h1>Product Maintain Success <a href="#modal-label" class="label modal-link">INFO</a></h1>
							<div class="notification note-success">
                                <a href="#" class="close" title="Close notification">close</a>
                                <p><strong>Success notification:</strong> Product Maintain Success... ....</p>
                                
                            </div>
                            <form method="post" action="#">
                            <table class="style1">
                            <thead>
                            <tr>
                                <th>Particular</th>
                                <th class="full">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <td class="edit-field edit-textfield long"><?=$rs->name;?></td>
                            </tr>
                            <tr>
                                <th>Login</th>
                                <td class="edit-field edit-textfield long"><?=$rs->login;?></td>
                            </tr>
                            </tbody>
                            </table>
                            </form>
						</div>
						
                        
					</div>
			      
					
					</div><!-- end of box-wrap -->
			</div> <!-- end of box-body -->
			</div>			
<?php $this->load->view('footer');?>