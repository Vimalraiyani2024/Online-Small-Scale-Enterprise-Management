<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<a href="#modal" id="btn-create">Create</a><br /><br/>
  	<h4 id="title">Group List</h4><br />
	<div class="row">
	<?php
		$rs=mysql_query("select *from group_master")or die(mysql_error());
	  	while($row=mysql_fetch_array($rs))	  		
	  		echo "<div class='col-md-3'><label>".ucwords($row['group_name'])."</label></div>";	
	 ?>
  </div>
</form>
<?php 
	include_once("model/add_group.php");
 ?>

