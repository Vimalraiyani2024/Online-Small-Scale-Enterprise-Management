<?php
	$con=$ob->connection();
	update_status("master","login_status",0,"enterprise_id",$_SESSION['ossem_user_id']);
	mysql_close($con);
	unset($_SESSION['ossem_db_name']);
	unset($_SESSION['ossem_enterprise_name']);
	//unset($_SESSION['ossem_address']);
	unset($_SESSION['ossem_email']);
//	unset($_SESSION['ossem_city']);
	//unset($_SESSION['ossem_state']);
	unset($_SESSION['ossem_user_type']);
	//unset($_SESSION['ossem_mobile']);	
	//unset($_SESSION['ossem_img']);		
	unset($_SESSION['ossem_user_id']);
	unset($_SESSION['ossem_user_type1']);
	echo '<meta http-equiv="refresh" content="0;url=../index.php"> ';
	function update_status($tbl,$setcol,$v,$matchcol,$matchval)
	{
		$sql = "update $tbl set $setcol = '$v' where $matchcol = '$matchval'";
		mysql_query($sql) or die(mysql_error());
	}
		
?>

