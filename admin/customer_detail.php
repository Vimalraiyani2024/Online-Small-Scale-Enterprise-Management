<?php include_once("header.php");?>
<?php 
if(isset($_REQUEST['cid']))
{
	$cid=$_REQUEST['cid'];
	$rs1=mysql_query("select *from customer_master where customer_id='$cid'")or die(mysql_error());	
	$row=mysql_fetch_array($rs1);
	
	$s_order=mysql_query("select * from sales_order_master where customer_id='$cid'")or die(mysql_error());		
	$s_quo=mysql_query("select * from sales_qua_master where customer_id='$cid'")or die(mysql_error());		
	$sales=mysql_query("select * from sales_master where customer_id='$cid'")or die(mysql_error());		
}
?>
<div id="item_container">
<form action="" method="post" id="form1">	
			<div id="btn-header">		
			<a href="sales.php?close=3" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h3>Customer Detail</h3>						
			</div>			
			<div class="table-responsive">
			<table class="table table-bordered">
			<tbody>
			  <tr>
				<td colspan="4"><?php echo '<b id="b-title">Customer No. : '.$row[0].'</b>'; ?> </td>
			</tr>
			<tr>				
				<td colspan="2" rowspan="5"><b id="b-title">Customer Detail: </b><br /><?php echo strtoupper($row['customer_name'])."<br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'];
				if(isset($row['phone_no']))
				echo'<br>Phone No.'.$row['phone_no'];
				 ?>
				</td>
				<td width="20%">Contact Person</td>
				<td><?php echo $row['contact_name']; ?></td>			
			</tr>
			<tr>					
				<td>Email Address</td>
				<td><?php echo $row['email_id']; ?></td>
			  </tr>
			<tr>				  	
				
				<td>VAT TIN No.</td>
				<td><?php if($row['vat_tin_no']==0) echo"-NA-"; else echo $row['vat_tin_no']; ?></td>
			</tr>
			<tr>				  				
				<td>CST No.</td>
				<td><?php if($row['cst_no']==0) echo"-NA-"; else echo $row['cst_no']; ?></td></td>
			</tr>
			<tr> 
				
				<td>Designation </td>
				<td>
					<?php				
			 echo $row['designation'];
					?>	
				</td>
			</tr>				
			<tr>
				<Td colspan="4">
					<table class="table table-bordered" id="bill_table">
					<thead>
					<tr class="success">
						<td><b id="b-title">Sales Orders(<?php echo mysql_num_rows($s_order);?>)</b></td>
						<td><b id="b-title">Sales Quotations(<?php echo mysql_num_rows($s_quo);?>)</b></td>
						<td><b id="b-title">Sales</b>(<?php echo mysql_num_rows($sales);?>)</td>
					</tr>
					</thead>					
					<tbody>
					<tr>
						<td>
						<?php
						while($rs_order=mysql_fetch_array($s_order))							
							echo '<a href="sales.php?tmpid='.$rs_order['sales_order_id'].'&list=view_sales_order">'.str_pad($rs_order['sales_order_id'],12,"0",STR_PAD_LEFT).' / '.date("d-m-Y",strtotime($rs_order['order_date'])).'</a><br>';							
						?>
						</td>
						<td>						
					<?php							
						while($rs_quo=mysql_fetch_array($s_quo))							
							echo '<a href="sales.php?tmpid='.$rs_quo['sales_qua_id'].'&list=sales_quo">'.$rs_quo['sales_qua_id'].' / '.date("d-m-Y",strtotime($rs_quo['quo_date'])).'</a><br>';																															
					?>	
					</td>
					<td>						
					<?php							
						while($rs_sales=mysql_fetch_array($sales))							
							echo '<a href="sales.php?tmpid='.$rs_sales['invoice_id'].'&&list=invoice">'.$rs_sales['invoice_id'].' / '.date("d-m-Y",strtotime($rs_sales["invoice_date"])).'</a><br>';																															
					?>	
					</td>
					</tr>						
					</tbody>
				</table>
					</Td>
				</tr>				
				</tbody>
      		</table>
		  </div>
		</table>
</div>
</form>