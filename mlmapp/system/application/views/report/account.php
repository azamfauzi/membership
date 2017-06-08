<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Account Statement</h1>
<p>Member Acccount Statement Report</p>
<div class="content-box">
			<div class="box-body">
				<div class="box-header clear">
					<h2>Account Statement</h2>
				</div>
				
				<div class="box-wrap clear">
           
           <h3>E-wallet :RM <?=$balance;?></h3>
           <div id="table">
					
						<form method="post" action="#">
						<table class="style1">
							<thead>
								<tr>
									<th>Date</th>
                  <th>Statement</th>
									<th>Debit</th>
                  <th>Credit</th>
                  <th>Balance</th>
                                    
								</tr>
							</thead>
							
							<tbody>
								<?
                                foreach($qbonus as $item){
                                ?>
								<tr>
									
									<td><a href="#"><?=$item->created_datetime;?></a></td>
                                    <td><?=$item->statement;?></td>
									<td><?=$item->debit;?></td>
                                    <td><?=$item->credit;?></td>
                                    <td><?=$item->balance;?></td>
                                   
                                    
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