<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<!-- Uploaded by raphael_primo. More ThemeForest Templates in http://www.templates4all.net/ -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8"><!-- /Added by HTTrack -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="AIT"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>myherb2u: Login Page</title>

<link rel="stylesheet" href="<? echo base_url();?>css/reset.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/screen.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/visualize-light.css" type="text/css"/>
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" />
<![endif]-->	
</head>

<body class="login">

<div class="login-box">
<div class="login-border">
<div class="login-style">
	<div class="login-header">
		<div class="logo clear">
			<img src="<? echo base_url();?>images/logo_earth_bw.png" alt="" class="picture" />
			<span class="textlogo">
				<span class="title">MEMBER LOGIN</span>
				<span class="text">myherbs2u.com</span>
			</span>
		</div>
	</div>
	<form action="<? echo base_url() . "index.php?/auth/login/";?>" method="post">
		
		<div class="login-inside">
			<div class="login-data">
				<div class="row clear">
					<label for="user">Username:</label>
    					<input type="text" name="username" value="M00001" size="25" class="text" id="username" />
    				</div>
 				<div class="row clear">
					<label for="password">Password:</label>
					<input type="password" name="password" value="abc123" size="25" class="text" id="password" />
				</div>
				<input type="submit" class="button" value="Login" />
			</div>
			<p>Tekan login selepas mengisi..</p>
		</div>
		<div class="login-footer clear">
			<span class="remember">
				<!--<input type="checkbox" class="checkbox" checked="checked" id="remember" /> <label for="remember">Remember</label>-->
			</span>
			<a href="#" class="button green fr-space">Back to Page</a>
		</div>
	</form>

</div>
</div>
</div>

<div class="login-links">
	<p><strong>&copy; 2010 Copyright by <a href="http://www.ait.sk/">Affinity Information Technology.</a></strong> All rights reserved.</p> 
</div>

<script type="text/javascript" src="<? echo base_url();?>js/jquery.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.visualize.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.idtabs.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.datatables.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.jeditable.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.ui.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/jquery.validate.js"></script>

<script type="text/javascript" src="<? echo base_url();?>js/excanvas.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/cufon.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/Zurich_Condensed_Lt_Bd.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/script.js"></script>
<!--
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12958851-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->
</body>

<!-- Uploaded by raphael_primo. More ThemeForest Templates in http://www.templates4all.net/ -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8"><!-- /Added by HTTrack -->
</html>
