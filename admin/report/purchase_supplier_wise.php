<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="purchase.php?close=purchase" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h4>Purchase Supplier Wise Report</h4>	
			<br />
			<div class="table-responsive">
			<table class="table">
			<tr>
				<td>Supplier</td>
				<td>
				<select id="supplier_id" name="supplier_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 					
								//$rs=mysql_query("select *from supplier_master a where a.is_deleted='0' and supplier_id=(select max(supplier_id) from purchase_master where a.pur_id=pur_id)")or die(mysql_error());
								$rs=mysql_query("select *from supplier_master a where is_deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($rs))					
									echo'<option value='.$row['supplier_id'].'>'.ucwords($row['supplier_name']).'</option>';								
						    ?>
						</select>					
				</td>				
			
				<td><button type="submit" name="show_purchae_by_supplier" id="btn-show-data">Show</button></td>
			</tr>
			<?php
			if (isset($_POST['supplier_id']))
			{
				$q='select supplier_name from supplier_master where supplier_id='.$_POST['supplier_id'].'';
				$r1=mysql_query($q)or die("");
				$r=mysql_fetch_array($r1);
				echo '<tr><td colspan="5"><h4>Purchase for Supplier '.ucwords($r['supplier_name']).'</h4></td></tr>';
			}
			?>
			</table>
        </div>			

		<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td width="10%"><b id="b-title">Invoice No.</b></td>
				<td width="10%"><b id="b-title">Purchase Date</b></td>
				<td><b id="b-title">Purchase Name</b></td>
				<td align="right" width="11%"><b id="b-title"></b></td>
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
				if(isset($_POST['show_purchae_by_supplier']))
				{
				 
					$supplier_id=$_POST['supplier_id'];
					$rs=mysql_query("select a.pur_id,pur_date,supplier_name,(select sum(item_qty * item_price) from purchase_detail where pur_id=a.pur_id) as subtotal,tax  from purchase_master a,supplier_master b where a.supplier_id=b.supplier_id and a.supplier_id=$supplier_id")or die(mysql_error());					
					if(mysql_num_rows($rs)>0)
					{
						while($row=mysql_fetch_array($rs))
						{					
							$a=explode(",",$row['tax']);
							$date1=date($row['pur_date']);												
							echo '<td>'.$i.'</td>';
							echo '<td>'.str_pad($row['pur_id'],8,"0",STR_PAD_LEFT).'</td>';
							echo '<td>'.date("d-m-Y",strtotime($row['pur_date'])).'</td>';
							$i++;					
							$vat1=$row['subtotal']*($a[0]/100);
							$vat2=$row['subtotal']*($a[1]/100);
							$temp=$row['subtotal']+$vat1+$vat2;								
							echo '<td>'.strtoupper($row['supplier_name']).'</td>';
							echo '<td align="right">'.$a[2].' '.$a[0].' %</td>';
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
					else
						echo'<td colspan="9">Record Not Found</td></tr>';																	
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