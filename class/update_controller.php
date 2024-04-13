<?php
	if(isset($_POST['update_plan']))
	{
		$id=$_POST['enterprise_id'];
		$rb_list=$_POST['rb_list'];
		$temp=mysql_query("update master set plan_type='$rb_list' where enterprise_id='$id'")or die(mysql_error());
		if($temp>0)
				$_SESSION['success_msg']="Client Detail Update Successfully..";
		echo '<meta http-equiv="refresh" content="0;url=index.php?page=3"> ';
	}
	if(isset($_POST['update_password']))
	{
		$con1=$ob->connection();
		$old_pass = $_POST['old_pass'];
		$new_pass=$_POST['new_pass'];
		$confirm_pass=$_POST['confirm_pass'];
		$user_id=$_SESSION['ossem_user_id'];		
		$rs=mysql_query("select *from master where password='".md5($old_pass)."' and enterprise_id='$user_id'",$con1)or die(mysql_error());
		$count=mysql_num_rows($rs);
		if($new_pass!=$confirm_pass)
			$_SESSION['success_msg']="New password Not match with Confirm password..";						
		else if($count==0)		
			$_SESSION['success_msg']="Old Password Incorrect..";						
		else
		{			
			$sql = "update master set password='".md5($new_pass)."' where enterprise_id='$user_id'";
			$temp=mysql_query($sql,$con1) or die(mysql_error());
			if($temp>0)
				$_SESSION['success_msg']="Password Change Successfully..";		
		}	
		mysql_close($con1);
	}
	if(isset($_POST['reset_password']))
	{
		$con1=$ob->connection();
		$new_pass=$_POST['new_password'];
		$confirm_pass=$_POST['confirm_password'];
		$user_id=$_POST['user_id'];		
		if($new_pass!=$confirm_pass)
			$_SESSION['ossem_msg']="New password Not match with Confirm password..";												
		else
		{			
			$sql = "update master set password='".md5($new_pass)."' where enterprise_id='$user_id'";
			$temp=mysql_query($sql,$con1) or die(mysql_error());
			if($temp>0)
				$_SESSION['ossem_msg']="Password Change Successfully..";		
		}	
		mysql_close($con1);
	}
	if(isset($_POST['update_e_profile']))
	{
		$con1=$ob->connection();
		$address = $_POST['address'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$mobile=$_POST['mobile'];
		$user_id=$_SESSION['ossem_user_id'];	
		$file_name=$_FILES['img']['name'];			
		$new_file_name=$_SESSION['ossem_user_id']."".date("j")."".time();	
		$image_name="";								
		if($_FILES["img"]["name"]!="")
		{				
			if((($_FILES["img"]["type"] == "image/gif")|| ($_FILES["img"]["type"] == "image/jpeg")|| ($_FILES["img"]["type"] == "image/jpg")|| ($_FILES["img"]["type"] == "image/png"))&& ($_FILES["img"]["size"] <= 512000)) 
			{
				if($_FILES["img"]["error"] > 0) 
					$image_name="";
				else 
				{
					$path="../images/";				
					$path=$path.$new_file_name.$file_name;				
				 	move_uploaded_file($_FILES["img"]["tmp_name"],$path);
					$image_name=$new_file_name.$file_name;			
	   			}
			} 
			else 
			{
			    echo '<script> alert("File must be include valid format and size");</script>';
				return false;
			}
			$sql = "update master set address='".$address."',city='".$city."',state='".$state."',mobile='".$mobile."',img='".$image_name."' where enterprise_id='$user_id'";
		}	
		else						
			$sql = "update master set address='".$address."',city='".$city."',state='".$state."',mobile='".$mobile."' where enterprise_id='$user_id'";
		$temp=mysql_query($sql,$con1) or die(mysql_error());
		if($temp>0)
			$_SESSION['success_msg']="Profile Change Successfully..";			
		mysql_close($con1);
	}
?>