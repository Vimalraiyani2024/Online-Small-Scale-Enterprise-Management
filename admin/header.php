<?php
	include_once("../class/autoload.php");
	if(isset($_SESSION['ossem_user_id']) && isset($_SESSION['ossem_db_name']))
	{							
		if($_SESSION['ossem_user_type1']!=10)
		{
		$con=$ob->newconnection();
?>
<!DOCTYPE html>
 <title>Online Small Scale Enterprise Management</title>
 	<!-- Menu -->
	<link rel="shortcut icon" href="../img/favico.ico">
    <link rel="stylesheet" type="text/css" href="../styles/menu_style.css">
	<link href="../styles/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/font-awesome.min.css" rel="stylesheet"> 
    <!-- Bootstrap -->
    <link href="../styles/style.css" rel="stylesheet">
	<script src="../js/jquery.min.js"></script>
	
	<!-- Side Menu -->
	<script src="../js/jquery-latest.min.js" type="text/javascript"></script>
 
	<!--Model Window-->
	<link href="../styles/popup.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="../js/jquery.autocomplete.js" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	
	<!--Datepicker -->
	<link href="../styles/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="../styles/datepicker.css">
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/jquery-1.9.1.min.js"></script>
	
	<!-- Validation -->
	<script src="../slider-js/validate.js"></script>
	<link rel="stylesheet" href="../js/jquery-ui.min.css"/>
	<script src="../js/jquery-ui.js"></script>
  	<script>
  	$(function() {
    	$( "#sale_quo_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		$("#sale_ref_quo_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		$("#sale_exp_quo_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		$("#receipt_entry_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		$("#payment_entry_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		$("#datepicker1").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		$("#datepicker2").datepicker({ dateFormat: 'dd-mm-yy' }).val();	
		
		$("#join_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
		$("#datepicker2").datepicker();	
		$("#birth_date").datepicker({ dateFormat: 'dd-mm-yy' }).val();	

	});

function isNumberKey(evt){	  	
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8 && (charCode<96||charCode>106))
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
		 if(evt.length>=no)
			return false;
		return true;
}
function disableElement(obj){
     obj.value = ' - N.A. - ';
     obj.disabled = true;
}
 
function enableElement(obj){
     obj.value = '';
     obj.disabled = false;
}
function CheckAlert(element,o1,o2){	
	if (element.checked)
	{
		enableElement(o1);		
		enableElement(o2);
	}				
	else 
	{
		disableElement(o1);
		disableElement(o2);
	}		
}
</script>	
</head>
<body>
<div id="header">
	<div class="container">
		<div class="inner">
          <h5></h5>  
		</div>
	</div>
</div>
	<div id="menu1" class="menu_container green full_width topfixed container">
		<label for="hidden_menu_collapser" class="mobile_collapser">Menu</label> <!-- Mobile menu title -->
		<input id="hidden_menu_collapser" type="checkbox">
		<ul>
			<li><a href="index.php?id=1"><i class="fa fa-th-list"></i>Dashboard</a></li>
			<li><a href="index.php?id=2">Sales</a></li>
			<li><a href="index.php?id=3">Purchase</a></li>
			<li><a href="index.php?id=4"> Accounting</a></li>
			<?php
			if($_SESSION['ossem_user_type']!=2)
				echo '<li><a href="index.php?id=5">Employee</a></li>';
			?>
			<li class="right last"><a href="#">
			<?php  echo ucwords($_SESSION['ossem_enterprise_name']); ?></a>
			   <div class="menu_dropdown_block ">
					<div class="md-container">
						<h4>Account Setting</h4>
						<ul class="menu_submenu">
							<li><a href="index.php?id=6">Enterprise Info</a></li> 
							<li><a href="index.php?id=7">Password Change</a></li>                                                
						</ul>
						<h4>Other Settings</h4>
						<p class="links">                           						
							<a href="index.php?id=8">Log Out</a>
						</p>
					</div>
				</div>
			</li>
		</ul> 		 
	</div>
<?php
	if(isset($_REQUEST['id']))
	{
		if($_REQUEST['id']=="1")
			include_once("dashboard.php");
		else if($_REQUEST['id']=="2")
			include_once("sales.php");
		else if($_REQUEST['id']=="3")
			include_once("purchase.php");
		else if($_REQUEST['id']=="4")
			include_once("accounting.php");
		else if($_REQUEST['id']=="5")			
			include_once("employee.php");
		else if($_REQUEST['id']=="6")			
			include_once("model/company_info.php");
		else if($_REQUEST['id']=="7")			
			include_once("model/change_password.php");
		else if($_REQUEST['id']=="8")			
			include_once("logout.php");
		else
			include_once("dashboard.php");
	}	
?>
</div>
<?php 
 }
 }
 else{
 ?>
	<meta http-equiv="refresh" content="0;url=../index.php"> 
 <?php
 }
 ?>