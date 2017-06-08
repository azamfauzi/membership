<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Hierarchy</h1>
<p>Member Hierarcy</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Sponsor Bonus</h2>
				</div>
				<div class="box-wrap clear">
                    <div id="table">
                       
						<ul id="test" class="tree categories">
                        	 <?
							echo $hierarchy;
							?>
                            
							
							
							</ul>
					</div>
				</div><!-- end of box-wrap -->
			</div> <!-- end of box-body -->
			</div>			
<?php $this->load->view('footer');?>