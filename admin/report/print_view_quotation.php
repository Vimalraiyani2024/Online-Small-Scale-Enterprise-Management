<html>
 <title>Online Small Scale Enterprise Management</title>
 <head>
 	<!-- Menu -->
	 <link href="../styles/bootstrap.min.css" rel="stylesheet">
      <link href="../styles/font-awesome.min.css" rel="stylesheet"> 
    <!-- Bootstrap -->
    <link href="../styles/style.css" rel="stylesheet">
	<script src="../js/jquery.min.js"></script>
	<link href="../styles/popup.css" rel="stylesheet"/>
	<!--Datepicker -->
	<link href="../styles/bootstrap.css" rel="stylesheet">
	
	    <link rel="shortcut icon" href="../img/favicon.ico">
    <link href="../styles/style.css" rel="stylesheet">
	
	</head>
<!--<body onLoad="javascript:window.print();">-->
<body>
<?php 
if(isset($_REQUEST['tmpid']))
{
	session_start();
	error_reporting(E_ALL^ E_DEPRECATED);
	$con=mysql_connect("localhost","root","",true)or die(mysql_error());
	mysql_select_db($_SESSION['db_name'],$con)or die("Database error ".mysql_error());
	
	$tmpid=$_REQUEST['tmpid'];
	$rs1=mysql_query("select a.sales_qua_id,quo_date,customer_name,address,city,state,pincode,mobile_no,phone_no,remark,reference,reference_date,tax,expiry_date,status from sales_qua_master a,customer_master b where a.customer_id=b.customer_id and a.sales_qua_id='$tmpid'")or die(mysql_error());
	$row=mysql_fetch_array($rs1);				
}
?>
<div id="item_container">							
			<div class="table-responsive">
			<table class="table table-bordered">
			<tbody>
			  <tr>
				<td colspan="4"><?php echo "<h4>Quotation No. : ". $row[0]."</h4>";?></td>
			</tr>
			<tr>
				
				<td colspan="2" rowspan="5"><b id="b-title">Customer Detail: </b><br /><?php echo strtoupper($row['customer_name'])."<br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'];
				if(isset($row['phone_no']))
				echo'<br>Phone No.'.$row['phone_no'];
				 ?>
				</td>
				<td width="20%">Quotation Date</td>
				<td><?php echo $row['quo_date']; ?></td>			
			</tr>
			<tr>					
				<td>Reference Date</td>
				<td><?php echo $row['reference_date']; ?></td>
			  </tr>
			<tr>				  	
				
				<td>Reference</td>
				<td><?php echo $row['reference']; ?></td>
			</tr>
			<tr>				  				
				<td>Expiry Date</td>
				<td><?php echo $row['expiry_date']; ?></td></td>
			</tr>
			<tr> 
				
				<td>Tax </td>
				<td>
					<?php				
					 $a=explode(",",$row['tax']); echo $a[2]." ".$a[0]." %";
					?>	
				</td>
			</tr>				
			<tr>
				<Td colspan="4">
					<table class="table table-bordered" id="bill_table">
					<thead>
					<tr class="success">
						<td><b id="b-title">Product</b></td>
						<td><b id="b-title">Decription</b></td>
						<td align="right"><b id="b-title">Unit Price</b></td>
						<td align="right"><b id="b-title">Qtantity</b></td>
						<td align="right"><b id="b-title">Sub Total</b></td>
					</tr>
					</thead>					
					<tbody>
					<tr>
						<?php 	
							$total_qty=0.0;
							$sub_total=0.0;	
							$tmp=0.0;						
							$rs=mysql_query("select *from sales_qua_detail where sales_qua_id='$row[0]'")or die(mysql_error());
							while($ro=mysql_fetch_array($rs)){
								echo '<td>'.$ro['item_name'].'</td>';
								echo '<td>'.$ro['item_desc'].'</td>';
								echo '<td align="right">'.$ro['item_price'].'</td>';								
								echo '<td align="right">'.number_format($ro['item_qty'],2).'</td>';
								$sub_total += $ro['item_price']*$ro['item_qty'];
								echo '<td align=right>'.number_format($ro['item_price']*$ro['item_qty'],2).'</td><tr>';															
							}
							if($a[1]==0.0)
							{
								echo'<tr><td colspan="3" rowspan="4"><b id="b-title">Terms & Condition :</b><br>'.$row["remark"].'</td><td align="right">Total without Taxes </td><td align="right">'.number_format($sub_total,2).'</td></tr>';	
								echo'<tr><td  align="right">'.$a[2].' '.$a[0].' %</td><td align="right">'.(number_format($sub_total*$a[0]/100,2)).'</td></tr>';	
								$tmp=$sub_total+$sub_total*($a[0]/100)+($sub_total*$a[1]/100);
								echo'<tr><td  align="right"><b id="b-title">Total Amount</a></td><td align="right"><b id="b-title">'.number_format($tmp,2).'</b></td></tr>';												
							}							
							else
							{						
								echo'<tr><td colspan="3" rowspan="4"><b id="b-title">Terms & Condition :</b><br>'.$row["remark"].'</td><td align="right">Total without Taxes </td><td align="right">'.number_format($sub_total,2).'</td></tr>';	
								echo'<tr><td  align="right">'.$a[2].' '.$a[0].' %</td><td align="right">'.(number_format($sub_total*$a[0]/100,2)).'</td></tr>';	
								echo'<tr><td  align="right">Additional Tax '.$a[1].' %</td><td align="right">'.number_format($sub_total*$a[1]/100,2).'</td></tr>';	
								$tmp=$sub_total+$sub_total*($a[0]/100)+($sub_total*$a[1]/100);
								echo'<tr><td  align="right"><b id="b-title">Total Amount</a></td><td align="right"><b id="b-title">'.number_format($tmp,2).'</b></td></tr>';					
						
							}																										
					?>							
					</tbody>
				</table>
					</Td>
				</tr>				
				</tbody>
      		</table>
		  </div>
		</table>
</div>
</div>
</body>
</html>