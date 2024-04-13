<?php
	$rs=mysql_query("select *from master where is_verified=1 and user_type<>10")or die(mysql_error());
	if(mysql_num_rows($rs)==0)
		echo "No Client Detail Available..";
	while($row=mysql_fetch_array($rs))	
	{
		echo '<div id="dash-item"><a href="index.php?page=view_customer&id='.$row['enterprise_id'].'">';
		if($row['img']=="")
			echo '<img id="dash-img" class="img-thumbnail" src="../images/init.jpg"></a>';
		else
			echo '<img id="dash-img" class="img-thumbnail" src="../images/'.$row['img'].'"></a>';
		echo '<h4 style="text-align:center">'.ucwords($row['enterprise_name']).'</h4></div>';
	}
		
?>