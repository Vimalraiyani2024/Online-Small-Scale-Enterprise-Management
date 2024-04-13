<?php
	if(isset($_POST['login']))
	{
		$o=new ssem1;	
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$val = array($email,$pass);		
		$flg = $o->login($val);						
		if($flg!=0)
		{						
			$_SESSION['ossem_db_name'] = $flg[0]['db_name'];
			$_SESSION['ossem_enterprise_name'] = $flg[0]['enterprise_name'];
			$_SESSION['ossem_address']=$flg[0]['address'];
			$_SESSION['ossem_email'] = $flg[0]['email_id'];
			$_SESSION['ossem_city'] = $flg[0]['city'];
			$_SESSION['ossem_state'] = $flg[0]['state'];				
			$_SESSION['ossem_mobile']=$flg[0]['mobile'];
			$_SESSION['ossem_img']=$flg[0]['img'];	
			$_SESSION['ossem_user_type1']=$flg[0]['user_type'];			
			$_SESSION['ossem_user_type']=$flg[0]['plan_type'];			
			$_SESSION['ossem_user_id'] = $flg[0]['enterprise_id'];
			
			if(isset($_SESSION['ossem_db_name']))
			{
				if($_SESSION['ossem_user_type1']!=10)
				{	
					$con1=mysql_connect("localhost","root","",true)or die(mysql_error());
					if(!mysql_select_db($_SESSION['ossem_db_name'],$con1))
					{						
						echo'<meta http-equiv="refresh" content="0;url=index.php?page=7&fail=xYmz">';
						mysql_close($con1);	
					}
				}	
				else				
				{
					$o->update_status("master","login_status",1,"enterprise_id",$_SESSION['ossem_user_id']);	
					if($_SESSION['ossem_user_type1']==10)
					{
						$o->update_status("master","entry_date",date("Y-m-d H:i:s A"),"enterprise_id",$_SESSION['ossem_user_id']);	
						header('location:1/index.php');							
					}
					else		
					header('location:admin/index.php?id=1');
				}
			}										
		}
		else
		{								
			header("location:index.php?page=7&fail=0");
		}
	}
	if(isset($_REQUEST['btn_register']))
	{
		$o=new ssem1;
		$name = $_POST['e_name'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];	
		$mobile=$_POST['mobile_no'];
		$email = $_POST['email'];
		$vat_tin_no = $_POST['vat_tin_no'];
		$cst_no=$_POST['cst_no'];
		$rb_list=$_POST['rb_list'];
		$d=date("Y-m-d H:i:s");
		$rs=mysql_query("select *from master")or die(mysql_error());
		while($row=mysql_fetch_array($rs))
		{
			if($row['email_id']==$email)				
				exit();		
		}
		$newid=mysql_query("select max(enterprise_id) from master")or die(mysql_error());
		$row=mysql_fetch_array($newid);		
		$dbname="db_".($row[0]+1);
		
		$q=mysql_query("insert into master(enterprise_name,address,city,state,email_id,password,db_name,vat_tin_no,cst_no,plan_type,entry_date,mobile) values('$name','$address','$city','$state','$email','1234','$dbname','$vat_tin_no','$cst_no','$rb_list','$d','$mobile')")or die(mysql_error());
			
		if($q>0)
			echo '<script>alert("Your Account Detail Save Successfully..Check Your Mail after 24 Hour...");</script>';
		else
			echo '<script>alert("Your Account Not created...");</script>';		
	}
	
	if(isset($_REQUEST['btn_send_msg']))
	{	
		$o=new ssem1;
		$name=$_POST['name1'];
		$email=$_POST['email'];
		$subject=$_POST['subject'];
		$msg=$_POST['message1'];
		$d=date("Y-m-d H:i:s");
		$ar=array($name,$email,$subject,$msg,$d);
		$ar1=array("sender_name","email","subject","message1","entry_date");
		$tmp=insert("suggestion",$ar1,$ar);		
		echo '<script>alert("Your Message is Send....");</script>';
		echo '<meta http-equiv="refresh" content="0;url=index.php?page=6"> ';
	}
	function insert($tbl,$cols,$v)
	{
		if($tbl=="suggestion")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}
	}
?>