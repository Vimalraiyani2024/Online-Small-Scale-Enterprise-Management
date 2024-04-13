 <?php 	
include_once("class/autoload1.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Online Small Scale Enterprise Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- css -->
	<link href="styles/bootstrap.min.css" rel="stylesheet" />
	<link rel="shortcut icon" href="img/favico.ico">
	<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
	<link href="css/jcarousel.css" rel="stylesheet" />
	<link href="css/flexslider.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/style_login.css" rel='stylesheet' type='text/css' />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
</script>
<script>	
function isNumberKey(evt){	  	
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8)
	return false;

 return true;		
}
function isNumberKey1(evt){	  	
 var charCode = (evt.which) ? evt.which : event.keyCode
// alert(charCode);
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8)
	return false;

 return true;		
}
function FixNumber(evt,no)
{
		 if(evt.length >=no)
			return false;
		return true;
}
</script>
</head>
<body style="color:#000000; font-family:cambria;">
<div class="container">
	<header>
        <div class="navbar navbar-default navbar-static-top">
        	<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><img src="img/logo.png" height="90" style="float:left; vertical-align:top" width="200px"   alt="Small Scale Entrprise Management"/></a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>                   
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php?page=1">Home</a></li> 
					<li><a href="index.php?page=2">About Us</a></li>
					<li><a href="index.php?page=3">Services</a></li>
					<li><a href="index.php?page=4">Portfolio</a></li>
					<li><a href="index.php?page=5">Pricing</a></li>
					<li><a href="index.php?page=6">Contact</a></li>
					<li><a href="index.php?page=7">Login</a></li>
				</ul>
			</div>
        </div>
	</header>
<?php

	if(isset($_REQUEST['page']))
	{
		if($_REQUEST['page']==1)
			include_once("general/home.php");
		if($_REQUEST['page']==2)
			include_once("general/about.php");
		if($_REQUEST['page']==3)
			include_once("general/services.php");
		if($_REQUEST['page']==4)
			include_once("general/portfolio.php");
		if($_REQUEST['page']==5)
			include_once("general/pricing.php");
		if($_REQUEST['page']==6)
			include_once("general/contact.php");
		if($_REQUEST['page']==7)
		{
			if(isset($_SESSION['ossem_user_id']) && isset($_SESSION['ossem_db_name']))
			{
				if($_SESSION['ossem_user_type1']==10)
					echo'<meta http-equiv="refresh" content="0;url=1/index.php">';
				else							
					echo'<meta http-equiv="refresh" content="0;url=admin/index.php?id=1">';															
			}							
			else		
				include_once("general/login.php");
		}
		if($_REQUEST['page']==8)
			include_once("general/signup_modal.php");
	}
	else
		include_once("general/home.php");
?>
<?php include_once("general/webfooter.php"); ?>
<script src="slider-js/jquery.js"></script>
<script src="slider-js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="slider-js/jquery.fancybox.pack.js"></script>
<script src="slider-js/jquery.fancybox-media.js"></script> 
<script src="slider-js/portfolio/jquery.quicksand.js"></script>
<script src="slider-js/portfolio/setting.js"></script>
<script src="slider-js/jquery.flexslider.js"></script>
<script src="slider-js/animate.js"></script>
<script src="slider-js/custom.js"></script>
<script src="slider-js/validate.js"></script>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
</body>
</html>




	
