<?php 	
	$rs=mysql_query("select item_name,(select sum(item_qty) from sales_detail where item_name=a.item_name) as total_sales,(select sum(item_qty) from purchase_detail where item_name=a.item_name) as total_purchase from product_master a")or die(mysql_error());
	
?>
<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="sales.php?close=sales" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h3>Product/Item Register</h3>	
			<br />
		</div>			
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="7%"><b id="b-title">Sr. No</b></td>
				<td><b id="b-title">Product </b></td>
				<td align="right" width="12%"><b id="b-title">Total Sales</b></td>
				<td align="right" width="12%"><b id="b-title">Total Purchase</b></td>
				<td align="right" width="12%"><b id="b-title">Total On Hand</b></td>					
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
				$total_purchase=0.0;
				$total_on_hand=0.0;
				while($row=mysql_fetch_array($rs))
				{
					
						echo '<td>'.$i.'</td>';
						echo '<td>'.$row['item_name'].'</td>';
						echo '<td align="right">'.number_format($row['total_sales'],2).'</td>';						
						echo '<td align="right">'.number_format($row['total_purchase'],2).'</td>';						
						echo '<td align="right">'.number_format($row['total_sales']-$row['total_purchase'],2).'</td>';						
						$total_sales+=$row['total_sales'];
						$total_purchase+=$row['total_purchase'];
						$total_on_hand=$total_sales+$total_purchase;						
						echo'</tr>';
					$i++;																			
				}																										
				?>	
				<tr>
					<td colspan="2" align="right">Total</td>
					<td align="right"><b id="b-title"><?php  echo number_format($total_sales,2); ?></b></td>
					<td align="right"><b id="b-title"><?php  echo number_format($total_purchase,2); ?></b></td>
					<td align="right"><b id="b-title"><?php  echo number_format($total_on_hand,2); ?></b></td>
				</tr>
		</table>
	</div>
</div>