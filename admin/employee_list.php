<?php include_once("header.php"); ?>
<form action="" method="post" role="form">
	<h4 id="title">Employee List </h4>
	<a href="#modal" id="btn-create">Create</a>
	<br /><br />
	<?php
	  $rs=mysql_query("select *from employee_master")or die(mysql_error());
	  if (mysql_num_rows($rs)>0)
	  {
	 
		while($row=mysql_fetch_array($rs))
		{	
		error_reporting(0);						
		echo '<div id="box-list"><a href="employee.php?view=employee&empid='.$row['emp_id'].'">';
		if($row['emp_img']=="")
			echo'<img src="../emp_img/emp_m.png" id="img" class="img-thumbnail"/></a>';
		else
			echo'<img src="../emp_img/'.$row['emp_img'].'" id="img" class="img-thumbnail"/></a>';
		echo'<div id="box-detail"><a href="employee.php?view=employee&empid='.$row['emp_id'].'" id="box-list-link" align=center>'.$row['emp_name'].'</a></div></div>';
		}
	}
	else
	echo 'Record Not Found..'; 
	 ?>	
</form>
<?php include_once("model/add_employee.php"); ?>