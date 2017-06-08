<?
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache"); 
?>
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
<title>MyHerb2u.com</title>

<link rel="stylesheet" href="<? echo base_url();?>css/reset.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/screen.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="<? echo base_url();?>css/visualize-light.css" type="text/css"/>
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>css/ie7.css" />
<![endif]-->	
<script type="text/javascript" src="<? echo base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.visualize.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.idtabs.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.datatables.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.jeditable.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.ui.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/jquery.validate.js"></script>

<script type="text/javascript" src="<? echo base_url()?>js/excanvas.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/cufon.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/Zurich_Condensed_Lt_Bd.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/script.js"></script>
</head>

<body>

<div class="pagetop">
	<div class="head pagesize"> <!-- *** head layout *** -->
		<div class="head_top">
			<div class="topbuts">
				<ul class="clear">
				<!--<li><a href="#">View Site</a></li>
				<li><a href="#">Messages</a></li>
				<li><a href="#">Settings</a></li>-->
				<li><a href="<? echo base_url();?>index.php?/auth/logout" class="red">Logout</a></li>
				</ul>
				
				<div class="user clear">
					<img src="<? echo base_url();?>images/avatar.jpg" class="avatar" alt="" />
					<span class="user-detail">
						<span class="name">Welcome <? echo $this->session->userdata('usernamemYappH3rb');?></span>
						<span class="text">Logged as <? echo $this->session->userdata('usernamemYappH3rb');?></span>
						<span class="text">You have <a href="#">5 messages</a></span>
					</span>
				</div>
			</div>
			<div class="logo clear">
			<a href="<? echo base_url();?>index.php?/member" title="View dashboard">
				<img src="<? echo base_url();?>images/logo_earth.png" alt="" class="picture" />
				<span class="textlogo">
					<span class="title">AZ IT SOLUTION</span>
					<span class="text">Excelent MLM Solution</span>
				</span>
			</a>
			</div>
		</div>