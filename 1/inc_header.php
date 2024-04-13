<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="shortcut icon" href="../img/favico.ico">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">

<title>OSSEM Administrator - Dashboard</title>
</head>
<body>
	<div id="mws-header" class="clearfix">
    	<div id="mws-logo-container">    
        	<div id="mws-logo-wrap">
            	<img src="images/mws-logo.png" alt="OSSEM admin">
			</div>
        </div>       
        <div id="mws-user-tools" class="clearfix">        
            <div id="mws-user-info" class="mws-inset">            
            	<div id="mws-user-photo">
                	<img src="images/profile.jpg" alt="User Photo">
                </div>                
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, Yogesh Kanojiya
                    </div>
                    <ul>                    	
                        <li><a href="index.php?page=11">Change Password</a></li>
                        <li><a href="index.php?page=12">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
    <div id="mws-wrapper">   
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>        
        <div id="mws-sidebar">       
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div> 
			<div id="mws-searchbox" class="mws-inset">
                	<label style="color:#FFFFFF">Admin Panel</label>
            </div>                              
            <div id="mws-navigation">
                <ul>
                    <li class="active"><a href="index.php?page=1"><i class="icon-home"></i> Dashboard</a></li>
                    <li><a href="index.php?page=2"><i class="icon-graph"></i> Pending Request</a></li>
                    <li><a href="index.php?page=3"><i class="icon-calendar"></i> Client</a></li>
                    <li><a href="index.php?page=4"><i class="icon-folder-closed"></i>Manage Account</a></li>                
					<li><a href="index.php?page=6"><i class="icon-cogs"></i>  Messages</a></li>                    
                </ul>
            </div>  
			<div style="width:auto">Last Access :<br/><?php $r=mysql_query("select entry_date from master where is_verified=1 and is_deleted=0 and enterprise_id=".$_SESSION['ossem_user_id']."")or die(""); 
							 $row=mysql_fetch_array($r);
							 echo date("d-m-Y h:i:s A",strtotime($row[0]));  ?></div>       
        </div>		
        
        <div id="mws-container" class="clearfix">
            <div class="container">           
            	<div class="mws-stat-container clearfix">               
                	<a class="mws-stat" href="#">
                    	<span class="mws-stat-icon icol32-group go"></span>                       
                        <span class="mws-stat-content">
                        	<span class="mws-stat-title">New Clients</span>
                            <span class="mws-stat-value"><?php
							$date=date("d-m-Y");
							 $r=mysql_query("select *from master where is_verified=1 and is_deleted=0")or die(""); 
							 $c=0;
							 while($row=mysql_fetch_array($r))
							 {
							 	if(date("d-m-Y",strtotime($row['entry_date']))==$date)
								$c = $c+1;
							 }
						echo $c; ?></span>
                        </span>
                    </a>

                	<a class="mws-stat" href="#">
                    	<span class="mws-stat-icon icol32-group-go"></span>                       
                        <span class="mws-stat-content">
                        	<span class="mws-stat-title">Total Customer</span>
                            <span class="mws-stat-value"><?php $r=mysql_query("select *from master where is_verified=1 and is_deleted=0")or die(""); echo mysql_num_rows($r);?></span>
                        </span>
                    </a>

                	<a class="mws-stat" href="#">
                    	<span class="mws-stat-icon icol32-table"></span>                      
                        <span class="mws-stat-content">
                        	<span class="mws-stat-title">Pending Request</span>
                            <span class="mws-stat-value"><?php $r=mysql_query("select *from master where is_verified=0")or die(""); echo mysql_num_rows($r);?></span>
                        </span>
                    </a>
                    
                	<a class="mws-stat" href="#">
                    	<span class="mws-stat-icon icol32-layout"></span>                        
                        <span class="mws-stat-content">
                        	<span class="mws-stat-title">Messages</span>
                            <span class="mws-stat-value"><?php $r=mysql_query("select *from suggestion")or die(""); echo mysql_num_rows($r);?></span>
                        </span>
                    </a>
                    
                	<a class="mws-stat" href="#">
                    	<span class="mws-stat-icon icol32-tick"></span>
                        <span class="mws-stat-content">
                        	<span class="mws-stat-title">Active Users</span>
                            <span class="mws-stat-value"><?php $r=mysql_query("select *from master where login_status=1")or die(mysql_error()); echo mysql_num_rows($r);?></span>
                        </span>
                    </a>
         	 </div>
	<?php
		if(isset($_REQUEST['page']))
		{
			if($_REQUEST['page']==1)
				include_once("admin_dashboard.php");
			if($_REQUEST['page']==2)
				include_once("admin_pending_request.php");
			if($_REQUEST['page']==3)
				include_once("admin_customer.php");
			if($_REQUEST['page']==4)
				include_once("admin_manage_acc.php");
			if($_REQUEST['page']==6)
				include_once("admin_suggestion.php");
			if($_REQUEST['page']==11)
				include_once("admin_change_pass.php");
			if($_REQUEST['page']==12)
				include_once("logout.php");
			if($_REQUEST['page']=='replay')
				include_once("admin_replay.php");
			if($_REQUEST['page']=='view_customer')
				include_once("admin_view_customer.php");
		}
		else if(isset($_REQUEST['approve'])&& isset($_REQUEST['id']))
		{
			$id=$_REQUEST['id'];			
			$_SESSION['ossem_approve_id']=$id;
			include_once("approve_request.php");
		}
		else if(isset($_REQUEST['op']))
		{
			$id=$_REQUEST['id'];
			if($_REQUEST['op']=='delete')
			{				
				mysql_query("delete from master where enterprise_id='$id'")or die("");
				$_SESSION['ossem_msg']="Request Details Deleted Successfully...";
				
				include_once("admin_pending_request.php");
			}
			else if($_REQUEST['op']=='reset')	
				include_once("reset_password.php");
			else if($_REQUEST['op']=='suggestion')	
			{
				mysql_query("delete from suggestion where sug_id='$id'")or die("");
				$_SESSION['ossem_msg']="Message  Deleted Successfully...";
				include_once("admin_suggestion.php");
			}
		}
		else
			include_once("admin_dashboard.php");	
	?>
	