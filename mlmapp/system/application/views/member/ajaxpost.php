<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>
<h1>Registration Form</h1>
<script language="javascript">
$(document).ready(function() {
	$("#mybutton").click(function(){
						   
		 var items = $("#field1").val();
			$.post("<?php echo site_url('member/getmemberx');?>", { "items": items },
			 function(data){
				 alert(data.somefield);
			  // alert(data.name); // John
			   //console.log(data.time); //  2pm
			 }, "json");
		 });
  // Handler for .ready() called.
});
</script>
	<form method="post">
	<input type="text" name="field1" id="field1" />
    <input type="button" id="mybutton" name="mybutton" value="check" />
	</form>
<?php $this->load->view('footer');?>