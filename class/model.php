<?php 
date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL^E_DEPRECATED);
session_start();
class ssem
{	
	function __construct()
	{	
		$con1=mysql_connect("localhost","root","")or die(mysql_error());
		if(isset($_SESSION['ossem_db_name'])&& $_SESSION['ossem_user_type'])
		{
			if($_SESSION['ossem_user_type1']==10)
				mysql_select_db('enterprise_master',$con1)or die("Database error ->".mysql_error());									
			else
			{					
				if(!mysql_select_db($_SESSION['ossem_db_name'],$con1))
				{
					echo '<script>alert("Sorry, Your Account Block by Administrator Contact Admin....");</script>';															
					mysql_close($con1);	
					if(isset($_SESSION['ossem_db_name']))unset($_SESSION['ossem_db_name']);
					if(isset($_SESSION['ossem_enterprise_name']))unset($_SESSION['ossem_enterprise_name']);
					if(isset($_SESSION['ossem_email']))unset($_SESSION['ossem_email']);
					if(isset($_SESSION['ossem_user_type']))unset($_SESSION['ossem_user_type']);
					if(isset($_SESSION['ossem_user_id']))unset($_SESSION['ossem_user_id']);
					if(isset($_SESSION['ossem_user_type1']))unset($_SESSION['ossem_user_type1']);
					echo'<meta http-equiv="refresh" content="0;url=../index.php?page=7&fail=xYmz">';
				}
				else
					mysql_select_db($_SESSION['ossem_db_name'],$con1)or die("Database error :".mysql_error());									
			}
		}
	}
	function newconnection()
	{
		$con1=mysql_connect("localhost","root","")or die(mysql_error());
		if(isset($_SESSION['ossem_db_name']))
			mysql_select_db($_SESSION['ossem_db_name'],$con1)or die("Database error :: ".mysql_error());					
		return $con1;
	}
	function connection()
	{
		
		$con= mysql_connect("localhost","root","",true)or die(mysql_error());			
		mysql_select_db('enterprise_master',$con)or die(mysql_error());
		return $con;
	}
	function update_status($tbl,$setcol,$v,$matchcol,$matchval)
	{
		$sql = "update $tbl set $setcol = '$v' where $matchcol = '$matchval'";
		mysql_query($sql) or die(mysql_error());
	}
		
	function login($v)
	{				
		$sql = "select * from master where email_id = '".md5($v[0])."' and password = '$v[1]' and is_verified=1";
		$tmp = $this->fetary($sql);
		return $tmp;
	}		
	function fetary($sql)
	{
		$res = mysql_query($sql) or die(mysql_error());
		
		if(mysql_num_rows($res)>0)
		{
			while($v = mysql_fetch_assoc($res))
			{
				$ans[] = $v;
			}
				return $ans;
		}
		else
		{
			return 0;
		}
	}
	function fetary1($sql)
	{
		$res = mysql_query($sql) or die(mysql_error());
		
		if(mysql_num_rows($res)>0)
		{
			while($v = mysql_fetch_assoc($res))
			{
				$ans[] = $v;
			}
				return $ans;
		}
		else
		{
			return 0;
		}
	}
	function insert($tbl,$cols,$v)
	{
		if($tbl=="department_master")
		{
			$sql="insert into $tbl($cols[0]) values('$v[0]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="sales_entry_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="pur_entry_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="entry_master")
{
	$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]')";
	mysql_query($sql) or die(mysql_error());
}
		if($tbl=="customer_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10],$cols[11],$cols[12],$cols[13],$cols[14])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]','$v[11]','$v[12]','$v[13]','$v[14]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="supplier_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10],$cols[11],$cols[12],$cols[13],$cols[14])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]','$v[11]','$v[12]','$v[13]','$v[14]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="sales_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="sales_detail")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="purchase_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="purchase_detail")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}		
		
		if($tbl=="pur_return")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="pur_return_detail")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="pur_order_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="pur_order_detail")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}	
		
		if($tbl=="sales_order_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="sales_order_detail")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}				
		if($tbl=="product_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="sales_qua_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="sales_qua_detail")
		{	
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="pur_qua_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="pur_qua_detail")
		{	
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}	
		if($tbl=="group_master")
		{
			$sql = "insert into $tbl($cols[0])values('$v[0]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="ledger_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3])values('$v[0]','$v[1]','$v[2]','$v[3]')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if($tbl=="sales_return")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="sales_return_detail")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]')";
			mysql_query($sql) or die(mysql_error());
		}
		if($tbl=="employee_master")
		{
			$sql = "insert into $tbl($cols[0],$cols[1],$cols[2],$cols[3],$cols[4],$cols[5],$cols[6],$cols[7],$cols[8],$cols[9],$cols[10],$cols[11],$cols[12],$cols[13],$cols[14])values('$v[0]','$v[1]','$v[2]','$v[3]','$v[4]','$v[5]','$v[6]','$v[7]','$v[8]','$v[9]','$v[10]','$v[11]','$v[12]','$v[13]','$v[14]')";
			mysql_query($sql) or die(mysql_error());
		}
	}
	function protect($str)
	{		
		return mysql_real_escape_string(strip_tags(trim($str)));
	}
	
	function __destruct()
	{
		//mysql_close();
	}
}
?>
