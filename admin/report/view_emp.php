<?php 
if(isset($_REQUEST['eid'])&&isset($_REQUEST['iid']))
{
	$iid=$_REQUEST['iid'];
	$rs=mysql_query("select * from employee_master where dept_id='$iid'")or die(mysql_error());
	$rs1=mysql_query("select * from department_master where dept_id='$iid'")or die(mysql_error());
	$row1=mysql_fetch_array($rs1);
	$row=mysql_fetch_array($rs);				
	if(mysql_num_rows($rs)!=0)
	{
?>
<form action="" method="post" role="form">
		<h4 id="title">Employee List for Department <?php echo $row1['dept_name'] ?></h4>
		<br />
		<?php 
		while($row=mysql_fetch_array($rs))
		{							
			echo '<div id="box-list"><a href="employee.php?view=employee&empid='.$row['emp_id'].'">';
			if($row['emp_img']=="")
				echo'<img src="../emp_img/emp_m.png" id="img" class="img-thumbnail"/></a>';
			else
				echo'<img src="../emp_img/'.$row['emp_img'].'" id="img" class="img-thumbnail"/></a>';
			echo'<div id="box-detail"><a href="employee.php?view=employee&empid='.$row['emp_id'].'" id="box-list-link" align=center>'.$row['emp_name'].'</a></div></div>';
		}
	}
	else
		echo "<h4>No employee available for department </h4>";

	 ?>	
</form>
<?php  } ?>