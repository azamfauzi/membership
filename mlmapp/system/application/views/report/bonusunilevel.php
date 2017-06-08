<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Unilevel Bonus</h1>
<p>Unilevel Report</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Unilevel Bonus</h2>
				</div>
				
				<div class="box-wrap clear">
                    <div id="table">
					
						<form method="post" action="#">
						<table class="style1">
							<thead>
								<tr>
									
									
									<th>Member</th>
									<th>Level</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    
								</tr>
							</thead>
							
							<tbody>
								<?
                                foreach($qbonus as $item){
                                ?>
								<tr>
									
									<td><a href="#"><?=$item->login;?></a></td>
									<td><? echo "Level - " . $item->bonusunilevel_level;?></td>
                                    <td><?=$item->created_date;?></td>
                                    
                                    <td><?=$item->bonusunilevel_value;?></td>
								</tr>
                                <?
								}
								?>
								
							
							</tbody>
						</table>
						<!--
						<div class="tab-footer clear">
							<div class="fl">
								<select name="dropdown" class="fl-space">
									<option value="option1">choose action...</option>
									<option value="option2">Edit</option>
									<option value="option3">Delete</option>
								</select>
								<input type="submit" value="Apply" id="submit2" class="button fl-space" />
							</div>
                            
							<div class="pager fr">
								<span class="nav">
									<a href="#" class="first" title="first page"><span>First</span></a>
									<a href="#" class="previous" title="previous page"><span>Previous</span></a>
								</span>
								<span class="pages">
									<a href="#" title="page 1"><span>1</span></a>
									<a href="#" title="page 2" class="active"><span>2</span></a>
									<a href="#" title="page 3"><span>3</span></a>
									<a href="#" title="page 4"><span>4</span></a>
								</span>
								<span class="nav">
									<a href="#" class="next" title="next page"><span>Next</span></a>
									<a href="#" class="last" title="last page"><span>Last</span></a>
								</span>
							</div>
                           </div>
                        -->
						</form>
					</div>
				</div><!-- end of box-wrap -->
			</div> <!-- end of box-body -->
			</div>			
<?php $this->load->view('footer');?>