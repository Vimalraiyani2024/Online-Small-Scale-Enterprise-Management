<?php 
	$rs=mysql_query("select a.supplier_id,supplier_name,address,city,state,pincode,mobile_no,pur_id,(select sum(item_qty*item_price) from purchase_detail where pur_id=b.pur_id) as total_purchase from supplier_master a,purchase_master b where a.is_deleted='0' and b.is_deleted='0' and a.supplier_id=b.supplier_id")or die(mysql_error());
?>
<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="purchase.php?close=purchase" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h3>Supplier Register</h3>	
			<br />
		</div>			
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td><b id="b-title">Supplier Name</b></td>
				<td align="center" width="8%"><b id="b-title">Total Purchase</b></td>
				<td align="center" width="8%"><b id="b-title">Total Receipt</b></td>
				<td align="center" width="8%"><b id="b-title">Total Debit</b></td>					
			</tr>
			</thead>					
			<tbody>
			<tr>
			<?php 	
				$temp=0.0;
				$sub_total=0.0;	
				$tmp=0.0;
				$i=1;						
				$total_purchase=0.0;
				$total_receipt=0.0;
				$total_debit=0.0;
				while($row=mysql_fetch_array($rs))
				{					
						echo '<td>'.$i.'</td>';
						echo '<td><b id=b-title>'.strtoupper($row['supplier_name'])."</b><br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'].'</td>';
						echo '<td align="right">'.number_format($row['total_purchase'],2).'</td>';
						$temp1=mysql_query("select ledger_id from ledger_master where ledger_name=(select supplier_name from supplier_master where supplier_id=".$row['supplier_id'].")")or die(mysql_error());							
						$temp_rs1=mysql_fetch_array($temp1);		
						$debit_ledger_id=$temp_rs1[0];
						$a=mysql_query("select sum(amount) from entry_master where debit_ledger_id='$debit_ledger_id' ")or die(mysql_error());
						$sup=mysql_fetch_array($a);
						$total_receipt+=$sup[0];
						echo '<td align="right">'.$sup[0].'</td>';						
						echo '<td align="right">'.number_format($row['total_purchase']-$sup[0],2).'</td>';
						$total_purchase+=$row['total_purchase'];								
						echo'</tr>';
					$i++;																			
				}																										
				?>	
				<tr>
					<td colspan="2" align="right">Total</td>
					<td align="right"><?php  echo number_format($total_purchase,2); ?></td>
					<td align="right"><?php  echo number_format($total_receipt,2); ?></td>
					<td align="right"><?php  echo number_format($total_purchase-$total_receipt,2); ?></td>
				</tr>
		</table>
	</div>
</div>