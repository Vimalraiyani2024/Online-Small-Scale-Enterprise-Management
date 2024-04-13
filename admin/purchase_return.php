<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4 id="title">Purchase Return</h4>
	<a href="#modal1" id="btn-create">Create</a>
	<br /><br />
  <div class="table-responsive"> 
   	 <table class="table table-striped">
      <thead>
        <tr>
		<th  width="6%" style="text-align:right"><b id="b-title"> Sr. No.</b></th>
          <th  width="10%"><b id="b-title">Retun In. No.</b></th>
          <th width="10%"><b id="b-title">Return Date</b></th>
		  <th><b id="b-title">Supplier</b> </th>
		  <th><b id="b-title">Reference</b></th>
        	<th><b id="b-title">Ref. Date</b></th>
			<th style="text-align:right" width="13%"><b id="b-title">Amount</b></th>
		<th></th>
        </tr>
      </thead>
      <tbody>
	<?php
	echo "<tr>";
	$i=1;
	$rs=mysql_query("select a.pur_return_id,supplier_name,pur_return_date,reference,ref_date,tax,(select sum(item_price*item_qty) from pur_return_detail where pur_return_id=a.pur_return_id) as total from pur_return a,supplier_master b where  a.supplier_id=b.supplier_id and a.is_deleted='0' order by a.pur_return_id desc")or die(mysql_error());
	while($row=mysql_fetch_array($rs))
	{		
		$a=explode(",",$row['tax']); 
		$temp= str_pad($row['pur_return_id'],"0",8,STR_PAD_LEFT);
		echo '<td>'.$i++.'</td>';
		echo '<td><a href="purchase.php?tmpid='.$row['pur_return_id'].'&list=view_pur_return">'.str_pad($row['pur_return_id'],8,"0",STR_PAD_LEFT).'</a></td>';
		echo "<td>".date("d-m-Y",strtotime($row['pur_return_date']))."</td>";
		echo "<td width=30%>".ucwords($row['supplier_name'])."</td>";
		echo "<td>".$row['reference']."</td>";		
		echo "<td >".date("d-m-Y",strtotime($row['ref_date']))."</td>";
		$tmp=$row['total']+$row['total']*($a[0]/100)+($row['total']*$a[1]/100);
		echo'<td align="right">'.number_format($tmp,2).'</td>';					
		echo'<td><a href="#id='.$row[0].'&update=pur_return" <i class="fa fa-edit"></i></a></td>';				
		echo'<td><a href="purchase.php?print=purchase_return&id='.$row[0].'" <i class="fa fa-print"></i></a></td></tr>';																			
		echo "</tr>";
	}
?>
     </tbody>
    </table>
  </div>
</form>
<?php 
	include_once("model/add_purchase_return.php");
 ?>

