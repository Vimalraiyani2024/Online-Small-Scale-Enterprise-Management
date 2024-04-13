<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4  id="title">Sales Return</h4>
	<a href="#modal" id="btn-create">Create</a><br/><br/>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
		<th style="text-align:right; width:6%"><b id="b-title">Sr No.</b></th>
          <th style="text-align:right"><b id="b-title">Re. Invoice No.</b></th>
		  <th><b id="b-title">Customer </b></th>
          <th><b id="b-title">Return Date</b></th>
		  <th><b id="b-title">Reference </b></th>
		  <th><b id="b-title">Reference Date</b></th>		  
		  <th  style="text-align:right"><b id="b-title">Amount</b></th> 
		  <th colspan="2"></th>        
        </tr>
      </thead>
      <tbody>
		  <?php
	 echo "<tr>";
	 $i=1;
	 $rs=mysql_query("select a.sales_return_id,customer_name,return_date,reference,ref_date,(select sum(item_price*item_qty) from sales_return_detail where sales_return_id=a.sales_return_id) as total from sales_return a,customer_master b where  a.customer_id=b.customer_id and a.is_deleted='0' order by a.entry_date desc")or die(mysql_error());	 
 
	  while($row=mysql_fetch_array($rs))
	  {
	 	echo '<td style="text-align:right;">'.$i++.'</td>';
	  	echo '<td style="text-align:right ;width=10%"><a href="sales.php?tmpid='.$row['sales_return_id'].'&&list=view_sales_return">'.$row['sales_return_id'].'</a></td>';
	 	echo "<td width=30%>".$row['customer_name']."</td>";
		echo "<td>".date("d-m-Y",strtotime($row['return_date']))."</td>";
		echo "<td>".$row['reference']."</td>";	
		echo "<td>".date("d-m-Y",strtotime($row['ref_date']))."</td>";			
	  	echo "<td align=right>".$row['total']."</td>";
		echo'<td><a href="#id='.$row['sales_return_id'].'&update=sales_return" <i class="fa fa-edit"></i></a></td>';				
		echo'<td><a href="?print=sales_return&id='.$row['sales_return_id'].'" <i class="fa fa-print"></i></a></td></tr>';										
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>
</div>
</form>
<?php 
	include_once("model/add_sales_return.php");
 ?>

