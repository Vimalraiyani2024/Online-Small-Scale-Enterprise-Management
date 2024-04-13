<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4 id="title">Sales Orders</h4>
	<a href="#modal"  id="btn-create">Create</a><br /><br/>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
			<th style="text-align:right"><b id="b-title">Sr. No.</b></th>
			<th><b id="b-title">Order No.</b></th>
			<th><b id="b-title">Order Date</b></th>
			<th><b id="b-title">Customer </b></th>
			<th><b id="b-title">Reference</b></th>
			<th><b id="b-title">Ref. Date</b></th>
			<th colspan="2"><b id="b-title">Status</b></th>
			<th></th>
        </tr>
      </thead>	
      <tbody>
		  <?php
	 echo "<tr>";
	 $i=1;
	 $rs=mysql_query("select a.sales_order_id,customer_name,order_date,reference,reference_date,status from sales_order_master a,customer_master b where a.customer_id=b.customer_id and a.is_deleted='0' order by entry_date desc")or die(mysql_error());
	 if(mysql_num_rows($rs)==0)
	  	echo '<tr><td colspan="6"><b style="color:#CC0000">No Sales Order Found...</b></td></tr>';
	 else
	{
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo '<td width=6% style="text-align:right">'.$i++.'</td>';
	  	echo '<td width=10%><a href="sales.php?tmpid='.$row['sales_order_id'].'&list=view_sales_order">'.strtoupper($row['sales_order_id']).'</td>';
		echo "<td width=10%>".date("d-m-Y",strtotime($row['order_date']))."</td>";
	  	echo "<td width=40%>".$row['customer_name']."</td>";
	 	echo "<td>".$row['reference']."</td>";
	 	echo "<td>".date("d-m-Y",strtotime($row['reference_date']))."</td>";		
		if($row['status']=='0')
				$str="Pending";
			else
				$str="";
	  	echo "<td>".$str."</td>";		
		echo'<td><a href="?cid='.$row['sales_order_id'].'&update=sales_order" <i class="fa fa-edit"></i></a></td>';				
		echo'<td><a href="?print=sales_order&id='.$row['sales_order_id'].'" <i class="fa fa-print"></i></a></td>';				
		echo "</tr>";
	  }
 	}
?>
      </tbody>
    </table>
</div>
</form>
<?php 
	include_once("model/add_sales_order.php");
 ?>

