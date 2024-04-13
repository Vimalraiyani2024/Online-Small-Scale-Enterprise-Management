<?php include_once("header.php");?>
<?php 
if(isset($_REQUEST['sid']))
{
	$sid=$_REQUEST['sid'];
	$rs1=mysql_query("select *from supplier_master where supplier_id=$sid")or die(mysql_error());	
	$row=mysql_fetch_array($rs1);
	
	$p_order=mysql_query("select * from pur_order_master where supplier_id='$sid'")or die(mysql_error());		
	$p_quo=mysql_query("select * from pur_qua_master where supplier_id='$sid'")or die(mysql_error());
		
	$purchase=mysql_query("select * from purchase_master where supplier_id='$sid'")or die(mysql_error());		
}
?>
<div id="item_container">
<form action="" method="post" id="form1">	
			<div id="btn-header">		
			<a href="purchase.php?close=purchase" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h3>Supplier Detail</h3>					
			</div>			
			<div class="table-responsive">
			<table class="table table-bordered">
			<tbody>
			  <tr>
				<td colspan="4"><?php echo '<b id="b-title">Supplier No. : '.$row[0].'</b>';?> </td>
			</tr>
			<tr>				
				<td colspan="2" rowspan="5"><b id="b-title">Supplier Detail: </b><br /><?php echo strtoupper($row['supplier_name'])."<br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'];
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
					<table class="table table-bordered">
					<thead>
					<tr class="success">
						<td><b id="b-title">Purchase Orders(<?php echo mysql_num_rows($p_order);?>)</b></td>
						<td><b id="b-title">Purchase Quotations(<?php echo mysql_num_rows($p_quo);?>)</b></td>
						<td><b id="b-title">Purchase</b>(<?php echo mysql_num_rows($purchase);?>)</td>
					</tr>
					</thead>					
					<tbody>
					<tr>
						<td>
						<?php
						while($rs_purchase=mysql_fetch_array($p_order))							
							echo '<a href="purchase.php?tmpid='.$rs_purchase['po_id'].'&&list=view_pur_order">'.$rs_purchase['po_id'].' / '.date("d-m-Y",strtotime($rs_purchase['po_date'])).'</a><br>';							
						?>
						</td>
						<td>						
					<?php							
						while($rs_quo=mysql_fetch_array($p_quo))							
							echo '<a href="purchase.php?tmpid='.$rs_quo['pur_qua_id'].'&&list=pur_quo">'.$rs_quo['pur_qua_id'].' / '.date("d-m-Y",strtotime($rs_quo['quo_date'])).'</a><br>';																															
					?>	
					</td>
					<td>						
					<?php							
						while($rs_purchase=mysql_fetch_array($purchase))							
							echo '<a href="purchase.php?tmpid='.$rs_purchase['pur_id'].'&&list=view_invoice">'.$rs_purchase['pur_id'].' / '.date("d-m-Y",strtotime($rs_purchase["pur_date"])).'</a><br>';																															
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
</form>