<?php 
if(isset($_REQUEST['tmpid']))
{
	$tmpid=$_REQUEST['tmpid'];
	$list=$_REQUEST['list'];
	$rs1=mysql_query("select a.po_id,po_date,delivery_date,supplier_name,address,city,state,pincode,mobile_no,phone_no,remark,reference,reference_date,tax,status from pur_order_master a,supplier_master b where a.supplier_id=b.supplier_id and a.po_id='$tmpid'")or die(mysql_error());
	$row=mysql_fetch_array($rs1);				
}
?>
<div id="item_container">
<form action="" method="post" id="form1">	
			<div id="btn-header">		
			<a href="purchase.php?close=2" id="close-box">Close</a>
			<a href="purchase.php?print=purchase_order&id=<?php echo $row[0];?>" id="btn-print">Print</a>
			<a href="#purchase.php?did='.$row[0].'&list=pur_order_del" class="btn-delete">Cancel</a>
			<h3>Purchase Orders</h3>	
			</div>			
			<div class="table-responsive">
			<table class="table table-bordered">
			<tbody>
			  <tr>
				<td colspan="4"><?php echo "<h4>Order No. : ". strtoupper($row[0])."</h4>";?></td>
			</tr>
			<tr>
				
				<td colspan="2" rowspan="5"><b id="b-title">Supplier Detail: </b><br /><?php echo strtoupper($row['supplier_name'])."<br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'];
				if(isset($row['phone_no']))
				echo'<br>Phone No.'.$row['phone_no'];
				 ?>
				</td>
				<td width="20%">Order Date</td>
				<td><?php echo date("d-m-Y",strtotime($row['po_date'])); ?></td>			
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
							$rs=mysql_query("select *from pur_order_detail where po_id='$row[0]'")or die(mysql_error());
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
