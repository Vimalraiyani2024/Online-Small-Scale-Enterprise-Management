<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4 id="title">Purchase Order</h4>
	<a href="#modal" id="btn-create">Create</a>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
			<th style="text-align:right"><b id="b-title">Sr. No.</b></th>
          <th><b id="b-title">Order No.</b></th>
          <th><b id="b-title">Date</b></th>
		  <th><b id="b-title">Supplier Name</b></th>
		  <th><b id="b-title">Reference</b></th>
		  <th><b id="b-title">Ref. Date</b></th>
          <th colspan="3"><b id="b-title">Status</b></th>
        </tr>
      </thead>
      <tbody>
		  <?php
	 echo "<tr>";
	 $i=1;
	 $rs=mysql_query("select a.po_id,supplier_name,po_date,reference,reference_date,status from pur_order_master a,supplier_master b where  a.supplier_id=b.supplier_id and a.is_deleted='0'  group by a.po_id order by a.entry_date desc")or die(mysql_error());
	 if(mysql_num_rows($rs)==0)
	  	echo '<tr><td colspan="6"><b style="color:#CC0000">No Purchase Order Found...</b></td></tr>';
	 else
	{
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo  '<td style="text-align:right">'.$i++.'</td>';
	  	echo '<td width=8%><a href="purchase.php?tmpid='.$row['po_id'].'&list=view_pur_order">'.strtoupper($row['po_id']).'</td>';
		echo "<td>".date("d-m-Y",strtotime($row['po_date']))."</td>";
	  	echo "<td width=30%>".ucwords($row['supplier_name'])."</td>";
	 	echo '<td>'.$row['reference'].'</td>';
		echo '<td>'.date("d-m-Y",strtotime($row['reference_date'])).'</td>';
		if($row['status']=='0')
				$str="Pending";
			else
				$str="";
	  	echo "<td>".$str."</td>";
		echo'<td><a href="#id='.$row[0].'&update=pur_order" <i class="fa fa-edit"></i></a></td>';				
		echo'<td><a href="purchase.php?print=purchase_order&id='.$row[0].'" <i class="fa fa-print"></i></a></td></tr>';										
		echo "</tr>";
	  }
 	}
?>
      </tbody>
    </table>
  </div>
</div>
</form>
<?php 
	include_once("model/add_purchase_order.php");
 ?>

