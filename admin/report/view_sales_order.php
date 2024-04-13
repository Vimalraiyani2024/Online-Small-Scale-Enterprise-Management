<?php 
if(isset($_REQUEST['tmpid']))
{
	$tmpid=$_REQUEST['tmpid'];
	$rs1=mysql_query("select a.sales_order_id,order_date,delivery_date,customer_name,address,city,state,pincode,mobile_no,phone_no,remark,reference,reference_date,tax,status from sales_order_master a,customer_master b where a.customer_id=b.customer_id and a.sales_order_id='$tmpid'")or die(mysql_error());
	$row=mysql_fetch_array($rs1);				
}
?>
<div id="item_container">
<form action="" method="post" id="form1">	
			<div id="btn-header">	
			<?php 
			if(isset($_REQUEST['cdetail']))				
				echo' <a href="sales.php?close=cdetail" id="close-box">Close</a>';
			else
				echo' <a href="sales.php?close=2" id="close-box">Close</a>';
			?>
			<a href="?print=sales_order&id=<?php echo $row['sales_order_id']; ?>" id="btn-print">Print</a>
			<!--<a href="sales.php?did='.$row[0].'&list=sales_order_del" class="btn-delete">Cancel</a>-->
			<a href="#" class="btn-delete">Cancel</a>
			<h3>Sales Orders</h3>	
			</div>			
			<div class="table-responsive">
			<table class="table table-bordered">
			<tbody>
			  <tr>
				<td colspan="4"><?php echo "<h4>Order No. : ". strtoupper($row[0])."</h4>";?></td>
			</tr>
			<tr>
				
				<td colspan="2" rowspan="5"><b id="b-title">Customer Detail: </b><br /><?php echo strtoupper($row['customer_name'])."<br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'];
				if(isset($row['phone_no']))
				echo'<br>Phone No.'.$row['phone_no'];
				 ?>
				</td>
				<td width="20%">Order Date</td>
				<td><?php echo date("d-m-Y",strtotime($row['order_date'])); ?></td>			
			</tr>
			<tr>					
				<td>Reference Date</td>
				<td><?php echo date("d-m-Y",strtotime($row['reference_date'])); ?></td>
			  </tr>
			<tr>				  	
				
				<td>Reference</td>
				<td><?php echo $row['reference']; ?></td>
			</tr>
			<tr>				  				
				<td>Delivery Date</td>
				<td><?php echo date("d-m-Y",strtotime($row['delivery_date'])); ?></td></td>
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
						<td><b id="b-title">Item</b></td>
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
							$rs=mysql_query("select *from sales_order_detail where sales_order_id='$row[0]'")or die(mysql_error());
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
</form>
