<?php include_once("header.php"); ?>
<form action="" method="post" role="form">
	<h4 id="title">Departments</h4>
	<a href="#modal" id="btn-create">Create</a>
	<br /><br />
	<?php
	  $rs=mysql_query("select *from department_master")or die(mysql_error());
	  if (mysql_num_rows($rs)>0)
	  {
	 
		while($row=mysql_fetch_array($rs))
		{	
		error_reporting(0);						
		echo '<div id="box-list"><a href="?eid=2&iid='.$row['dept_id'].'">';
		echo'<img src="../images/dept.png" id="img" class="img-thumbnail"/></a>';
		echo'<div id="box-detail"><a href="?eid=2&iid='.$row['dept_id'].'" id="box-list-link">'.$row['dept_name'].'</a></div></div>';
		}
	}
	else
	echo 'Record Not Found..'; 
	 ?>	
</form>
<?php include_once("model/add_department.php"); ?>