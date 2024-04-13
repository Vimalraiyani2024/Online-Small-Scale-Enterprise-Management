<?php
	session_start();
	error_reporting(E_ALL^ E_DEPRECATED);
	$con=mysql_connect("localhost","root","",true)or die(mysql_error());
	mysql_select_db($_SESSION['ossem_db_name'],$con)or die("Database error ".mysql_error());
	
	if(isset($_REQUEST['sales_order_id']))
	{
		$i =$_REQUEST["sales_order_id"];
		if($i <> "" ) 
		{
		$c1=1;
			$sql = "SELECT * FROM sales_order_master WHERE sales_order_id = ".$i."";
			//$query =);
			echo $i;
			//echo"dddd".$query;
			//$c1=mysql_num_rows( mysql_query($sql));
			$rs=mysql_query("SELECT * FROM sales_order_master WHERE sales_order_id = ".$i."");
			//$c1=mysql_fetch_array($rs);
			//print_r($c1);
			//if ($c1 > 0)
			echo "1";
			//else
			echo "2";						
		}
	}
	
	if(isset($_REQUEST['fetch_cust_id']))
	{
		$cust_id =$_REQUEST["fetch_cust_id"];
		if($cust_id <> "" ) 
		{
			$sql = "SELECT sales_order_id,order_date FROM sales_order_master WHERE customer_id = ".$cust_id;
			$query = mysql_query($sql);
			echo '<select id="order_no" name="order_no" class="form-control" onchange="fetch_order_data(this.value);" required>';
			echo '<option value="">Select Order No</option>';
			echo '<option value="">New Sales</option>';				
			echo'</select>';				
		}
	}
	
	if(isset($_REQUEST['fetch_sales_invoice_date']))	
	{
		$cust_id =$_REQUEST['fetch_sales_invoice_date'];
		if($cust_id <> "" ) 
		{
			$sql = "SELECT * FROM sales_master WHERE invoice_id = '$cust_id'";
			$query = mysql_query($sql);		
			while($rs1=mysql_fetch_array($query))
			{
				$a=explode(",",$rs1['tax']);				
				$result = array();
				$result['ref_date'] =$rs1['ref_date'];			
				$result['tax']= $a[0];	
				echo json_encode($result);			
			}
		}
	}
	
	if(isset($_REQUEST['fetch_cust_id1']))
	{
		$cust_id =$_REQUEST['fetch_cust_id1'];
		if($cust_id <> "" ) 
		{
			$sql = "SELECT invoice_id FROM sales_master WHERE customer_id = ".$cust_id;
			$query = mysql_query($sql);			
			echo '<option value="">Select Order No</option>';			
			while($rs=mysql_fetch_array($query))
			{
				echo '<option value='.$rs['invoice_id'].'>'.$rs['invoice_id'].'</option>';
			}												
		}
	}
	
	if(isset($_REQUEST['fetch_item_id']))
	{
		$item_id =$_REQUEST["fetch_item_id"];
		if($item_id <> "" ) 
		{
			$sql = "SELECT item_desc,item_price,item_name FROM product_master WHERE item_id = ".$item_id;
			$query = mysql_query($sql);
		 	$rs = mysql_fetch_array($query);
			$result = array();
			$result['item_desc'] =$rs['item_desc'];
			$result['item_price']= $rs['item_price'];
			$result['item_name']=$rs['item_name'];
			echo json_encode($result);			
		}
	}	
	if(isset($_REQUEST['sales_order_id']))
	{
		$order_id =$_REQUEST["sales_order_id"];
		if($order_id <> "") 
		{
			$itemCount=0;
			$sql = "SELECT * FROM sales_order_detail WHERE sales_order_id ='$order_id'";
			$rs = mysql_query($sql)or die(mysql_error());
		//	$rs = mysql_fetch_array($query);			
			//$result = array();
			//$result['sales_order_id']=$rs['sales_order_id'];
			//$result['order_date']=$rs['order_date'];			
		//	echo json_encode($result);
		//	echo mysql_num_rows($rss);
			while($row=mysql_fetch_array($rs))
			{
		//	echo "ddddd";
				//$itemCount++;
			//	echo'<tr id="tr'.$itemCount.'"><td>'.$itemCount.'</td><td><input  type="text" readonly id="item_name[]" name="item_name[]" value="'.$row['item_name'].'" class="form-control, text-readonly"/></td><td><input type="text" name="item_desc[]" value="'.$row['item_desc'].'" style="border-style:none;" readonly class="form-control, text-readonly"/></td><td><input type="text" style="text-align:right;max-width:100px" readonly name="item_price[]" id="item_price[]" value="'.$row['item_price'].'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:100px" readonly   id="item_qty[]" name="item_qty[]" value="'.$row['item_qty'].'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:100px" readonly name="total[]" value="55" class="form-control, text-readonly"/></td><td><a class="btn-delete"  id="'.$itemCount .'" name="delele_item" href="">x</a></td></tr>';
			}
			//echo '<tr><td>'.$.'</td></tr>';										
		}
	}	
?>

