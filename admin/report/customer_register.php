<?php 
	$rs=mysql_query("select a.customer_id, customer_name,address,city,state,pincode,mobile_no,invoice_id,(select sum(item_qty*item_price) from sales_detail where invoice_id=b.invoice_id) as total_sales,(select sum(amount) from entry_master where credit_ledger_id=a.customer_id)as receipt_total from customer_master a,sales_master b where a.is_deleted='0' and b.is_deleted='0' and a.customer_id=b.customer_id")or die(mysql_error());
	
?>
<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="sales.php?close=sales" id="close-box">Close</a>
			<!--<a href="#" id="btn-print">Print</a>-->
			<h3>Customer Register</h3>	
			<br />
		</div>			
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td><b id="b-title">Customer Name</b></td>
				<td align="right" width="8%"><b id="b-title">Total Sales</b></td>
				<td align="right" width="8%"><b id="b-title">Total Receipt</b></td>
				<td align="right" width="8%"><b id="b-title">Total Debit</b></td>					
			</tr>
			</thead>					
			<tbody>
			<tr>
			<?php 	
				$temp=0.0;
				$sub_total=0.0;	
				$tmp=0.0;
				$i=1;						
				$total_sales=0.0;
				$total_receipt=0.0;
				$total_debit=0.0;
				while($row=mysql_fetch_array($rs))
				{												
					echo '<td>'.$i.'</td>';
					echo '<td><b id=b-title>'.strtoupper($row['customer_name'])."</b><br>".$row['address']."<br>".$row['city']." - ".$row['pincode']." , ".$row['state']."<br>Mobile No. : +91-".$row['mobile_no'].'</td>';
					echo '<td align="right">'.number_format($row['total_sales'],2).'</td>';
					$temp1=mysql_query("select ledger_id from ledger_master where ledger_name=(select customer_name from customer_master where customer_id=".$row['customer_id'].")")or die(mysql_error());							
					$temp_rs1=mysql_fetch_array($temp1);		
					$credit_ledger_id=$temp_rs1[0];
					$a=mysql_query("select sum(amount) from entry_master where credit_ledger_id='$credit_ledger_id' and entry_type='r'")or die(mysql_error());
					$cust=mysql_fetch_array($a);
					$total_receipt+=$cust[0];
					echo '<td align="right">'.$cust[0].'</td>';	
					
					$temp2=mysql_query("select ledger_id from ledger_master where ledger_name=(select customer_name from customer_master where customer_id=".$row['customer_id'].")")or die(mysql_error());							
					$temp_rs2=mysql_fetch_array($temp2);
					$debit_ledger_id=$temp_rs2[0];	

					$a=mysql_query("select sum(amount) from entry_master where debit_ledger_id='$debit_ledger_id'")or die(mysql_error());
					$cust=mysql_fetch_array($a);
					$total_debit+=$cust[0];									
					echo '<td align="right">'.$cust[0].'</td>';
					$total_sales+=$row['total_sales'];								
					echo'</tr>';
					$i++;																			
				}																										
				?>	
				<tr style="font-weight:bold">
					<td colspan="2" align="right">Total</td>
					<td align="right"><?php  echo number_format($total_sales,2); ?></td>
					<td align="right"><?php  echo number_format($total_receipt,2); ?></td>
					<td align="right"><?php  echo number_format($total_debit,2); ?></td>
				</tr>
		</table>
	</div>
</div>