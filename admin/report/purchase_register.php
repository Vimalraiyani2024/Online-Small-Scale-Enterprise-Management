<?php 
	$rs=mysql_query("select a.pur_id,pur_date,supplier_name,(select sum(item_qty * item_price) from purchase_detail where pur_id=a.pur_id) as subtotal,tax  from purchase_master a,supplier_master b where a.supplier_id=b.supplier_id")or die(mysql_error());
	
?>
<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="purchase.php?close=purchase" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h3>Purchase Register</h3>	
			<br />
			<h4>Purchase 4% and 12.5%	VAT</h4>
		</div>			
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td width="10%"><b id="b-title">Invoice No.</b></td>
				<td width="10%"><b id="b-title">Purchase Date</b></td>
				<td><b id="b-title">Supplier Name</b></td>
				<td align="right" width="8%"><b id="b-title">VAT</b></td>
				<td align="right" width="8%"><b id="b-title">Sub Total</b></td>
				<td align="right" width="8%"><b id="b-title">Tax</b></td>
				<td align="right" width="8%"><b id="b-title">Add. Tax</b></td>
				<td align="right" width="8%"><b id="b-title">Total</b></td>						
			</tr>
			</thead>					
			<tbody>
			<tr>
			<?php 	
				$temp=0.0;
				$sub_total=0.0;	
				$tmp=0.0;
				$i=1;						
				$total=0.0;
				$total_vat1=0.0;
				$total_vat2=0.0;
				while($row=mysql_fetch_array($rs))
				{
					$a=explode(",",$row['tax']); 
					if($a[2]=="VAT")
					{
						echo '<td>'.$i.'</td>';
						echo '<td>'.str_pad($row['pur_id'],8,"0",STR_PAD_LEFT).'</td>';
						echo '<td>'.date("d-m-Y",strtotime($row['pur_date'])).'</td>';
						$i++;					
						$vat1=$row['subtotal']*($a[0]/100);
						$vat2=$row['subtotal']*($a[1]/100);
						$temp=$row['subtotal']+$vat1+$vat2;								
						echo '<td>'.strtoupper($row['supplier_name']).'</td>';
						echo '<td align="right">'.$a[0].' %</td>';
						echo '<td align="right">'.number_format($row['subtotal'],2).'</td>';	
					
						echo '<td align="right">'.number_format($vat1,2).'</td>';	
						echo '<td align="right">'.number_format($vat2,2).'</td>';														
						echo '<td align="right">'.number_format($temp,2).'</td>';
						$sub_total+=$row['subtotal'];
						$total_vat1+=$vat1;
						$total_vat2+=$vat2;
						$total+=$temp;									
						echo'</tr>';
					}																			
				}																										
				?>	
				<tr>
					<td colspan="5" align="right"><b id="b-title">Total</b></td>
					<td align="right"><b id="b-title"><?php echo number_format($sub_total,2); ?></b></td>
					<td align="right"><b id="b-title"><?php echo number_format($total_vat1,2); ?></b></td>
					<td align="right"><b id="b-title"><?php echo number_format($total_vat2,2); ?></b></td>
					<td align="right"><b id="b-title"><?php echo number_format($total,2); ?></b></td>
				</tr>
		</table>
	</div>
	<h4>Purchase 5% and 2% CST	</h4>
	<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td width="10%"><b id="b-title">Invoice No.</b></td>
				<td width="10%"><b id="b-title">Purchase Date</b></td>
				<td><b id="b-title">Supplier Name</b></td>
				<td align="right" width="8%"><b id="b-title">CST</b></td>
				<td align="right" width="8%"><b id="b-title">Sub Total</b></td>
				<td align="right" width="8%"><b id="b-title">Tax</b></td>
				<td align="right" width="8%"><b id="b-title">Add. Tax</b></td>
				<td align="right" width="8%"><b id="b-title">Total</b></td>						
			</tr>
			</thead>					
			<tbody>
			<tr>			
			<?php 
			    $rs1=mysql_query("select a.pur_id,pur_date,supplier_name,(select sum(item_qty * item_price) from purchase_detail where pur_id=a.pur_id) as subtotal,tax  from purchase_master a,supplier_master b where a.supplier_id=b.supplier_id")or die(mysql_error());	
				$temp=0.0;
				$sub_total=0.0;	
				$tmp=0.0;
				$i=1;						
				$total=0.0;
				$total_vat1=0.0;
				$total_vat2=0.0;
				while($row=mysql_fetch_array($rs1))
				{
					$a=explode(",",$row['tax']);
					if($a[2]=="CST")
					{
						echo '<td>'.$i.'</td>';
						echo '<td>'.str_pad($row['pur_id'],8,"0",STR_PAD_LEFT).'</td>';
						echo '<td>'.date("d-m-Y",strtotime($row['pur_date'])).'</td>';
						$i++;					
						$vat1=$row['subtotal']*($a[0]/100);
						$vat2=$row['subtotal']*($a[1]/100);
						$temp=$row['subtotal']+$vat1+$vat2;								
						echo '<td>'.strtoupper($row['supplier_name']).'</td>';
						echo '<td align="right">'.$a[0].' %</td>';
						echo '<td align="right">'.number_format($row['subtotal'],2).'</td>';	
					
						echo '<td align="right">'.number_format($vat1,2).'</td>';	
						echo '<td align="right">'.number_format($vat2,2).'</td>';														
						echo '<td align="right">'.number_format($temp,2).'</td>';
						$sub_total+=$row['subtotal'];
						$total_vat1+=$vat1;
						$total_vat2+=$vat2;
						$total+=$temp;									
						echo'</tr>';
					}																			
				}																										
				?>	
				<tr>
					<td colspan="5" align="right"><b id="b-title">Total</b></td>
					<td align="right"><b id="b-title"><?php echo number_format($sub_total,2); ?></b></td>
					<td align="right"><b id="b-title"><?php echo number_format($total_vat1,2); ?></b></td>
					<td align="right"><b id="b-title"><?php echo number_format($total_vat2,2); ?></b></td>
					<td align="right"><b id="b-title"><?php echo number_format($total,2); ?></b></td>
				</tr>
		</table>
	</div>
</div>