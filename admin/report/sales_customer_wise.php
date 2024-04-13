<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="sales.php?close=sales" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h4>Sales Customer Wise Report</h4>	
			<br />
			<div class="table-responsive">
			<table class="table">
			<tr>
				<td>Customer</td>
				<td>
				<select id="customer_id" name="customer_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 					
								$rs=mysql_query("select *from customer_master where is_deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($rs))					
									echo'<option value='.$row['customer_id'].'>'.ucwords($row['customer_name']).'</option>';								
						    ?>
						</select>					
				</td>				
			
				<td><button type="submit" name="show_sales_by_date" id="btn-show-data">Show</button></td>
			</tr>
			<?php
			if (isset($_POST['customer_id']))
			{
				$q='select customer_name from customer_master where customer_id='.$_POST['customer_id'].'';
				$r1=mysql_query($q)or die("");
				$r=mysql_fetch_array($r1);
				echo '<tr><td colspan="5"><h4>Sales for Customer '.ucwords($r['customer_name']).'</h4></td></tr>';
			}
			?>
        </div>			

		<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td width="10%"><b id="b-title">Invoice No.</b></td>
				<td width="10%"><b id="b-title">Sales Date</b></td>
				<td><b id="b-title">Customer Name</b></td>
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
				if(isset($_POST['show_sales_by_date']))
				{
				 
					$customer_id=$_POST['customer_id'];
					$rs=mysql_query("select a.invoice_id,invoice_date,customer_name,(select sum(item_qty * item_price) from sales_detail where invoice_id=a.invoice_id) as subtotal,tax  from sales_master a,customer_master b where a.customer_id=b.customer_id and a.customer_id='$customer_id'")or die(mysql_error());					
					if(mysql_num_rows($rs)>0)
					{
						while($row=mysql_fetch_array($rs))
						{					
							$a=explode(",",$row['tax']);
							$date1=date("d-m-Y",strtotime($row['invoice_date']));												
							echo '<td>'.$i.'</td>';
							echo '<td>'.$row['invoice_id'].'</td>';
							echo '<td>'.date("d-m-Y",strtotime($row['invoice_date'])).'</td>';
							$i++;					
							$vat1=$row['subtotal']*($a[0]/100);
							$vat2=$row['subtotal']*($a[1]/100);
							$temp=$row['subtotal']+$vat1+$vat2;								
							echo '<td>'.strtoupper($row['customer_name']).'</td>';
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
				<tr style="font-weight:bold">
					<td colspan="5" align="right">Total</td>
					<td align="right"><?php echo number_format($sub_total,2); ?></td>
					<td align="right"><?php echo number_format($total_vat1,2); ?></td>
					<td align="right"><?php echo number_format($total_vat2,2); ?></td>
					<td align="right"><?php echo number_format($total,2); ?></td>
				</tr>
		</table>
</div>