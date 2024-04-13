<?php
error_reporting(E_ALL^E_DEPRECATED);
date_default_timezone_set("Asia/Kolkata");
session_start();
class ssem1
{
	function __construct()
	{
		$con=mysql_connect("localhost","root","",true)or die(mysql_error());
		mysql_select_db('enterprise_master',$con)or die(mysql_error());			   
	}

	function update_status($tbl,$setcol,$v,$matchcol,$matchval)
	{
		$sql = "update $tbl set $setcol = '$v' where $matchcol = '$matchval'";
		mysql_query($sql) or die(mysql_error());
	}
		
	function login($v)
	{				
		$sql = "select * from master where email_id = '$v[0]' and password = '".md5($v[1])."' and is_verified=1";
		$tmp = $this-> fetary($sql);
		return $tmp;
	}		
	function fetary($sql)
	{
		$res = mysql_query($sql) or die(mysql_error());
		
		if(mysql_num_rows($res)>0)
		{
			while($v = mysql_fetch_assoc($res))			
				$ans[] = $v;			
			return $ans;
		}
		else
			return 0;
	}
	function closeconnection()
	{
		mysql_close();
	}	
}
?>
