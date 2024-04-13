<?php include_once("header.php"); ?>
<form action="" method="post" role="form">
	<h4 id="title">Items / Products</h4>
	<a href="#modal" id="btn-create">Create</a>
	<br /><br />
	<?php
	  $rs=mysql_query("select *from product_master")or die(mysql_error());
	  if (mysql_num_rows($rs)>0)
	  {
	 
		while($row=mysql_fetch_array($rs))
		{	
		echo '<div id="box-list"><a href="#">';
		if($row['image_name']=="")
			echo'<img src="../images/init.jpg" id="img" class="img-thumbnail"/></a>';
		else
			echo'<img src="../images/'.$row['image_name'].'" id="img" class="img-thumbnail"/></a>';
		echo'<div id="box-detail"><a href="#" id="box-list-link">'.$row['item_name'].'</a><br> Rate : '.$row['item_rate'].'<br> Price : '.$row['item_price'].'</div></div>';
		}
	}
	else
	echo 'Record Not Found..'; 
	 ?>	
</form>
<?php include_once("model/add_product.php"); ?>
