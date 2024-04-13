<?php include_once("header.php"); ?>
<form action="" method="post" role="form">
	<h4 id="title">Purchase Quotations</h4>
	<a href="#modal" id="btn-create">Create</a><br /><br/>
 	<div class="table-responsive"> 
   	 <table class="table table-striped">
     <thead>
     <tr>
	 <th width="6%"><b id="b-title">Sr. No.</b></th>
     	<th width="10%"><b id="b-title">Quotation No.</b></th>
        <th width="13%"><b id="b-title">Quotation Date</b></th>
		<th><b id="b-title">Supplier </b></th>
		<th><b id="b-title">Reference</b></th>
		<th><b id="b-title">Ref. Date</b></th>
        <th colspan="2"><b id="b-title">Status</b></th>
     </tr>
     </thead>
     <tbody>
	 <?php
  	 	echo "<tr>";
		$i=1;	  
	  	$rs=mysql_query("select a.pur_qua_id,supplier_name,quo_date,reference,reference_date,status from pur_qua_master a,supplier_master b where a.supplier_id=b.supplier_id  and a.is_deleted=' 0' order by a.entry_date desc")or die(mysql_error());
	
	  	while($row=mysql_fetch_array($rs))
	  	{
			echo '<td>'.$i++.'</td>';
	  		echo '<td><a href="purchase.php?tmpid='.$row['pur_qua_id'].'&list=pur_quo">'.$row['pur_qua_id'].'</a></td>';
	 	 	echo "<td>".date("d-m-Y",strtotime($row['quo_date']))."</td>";
			echo "<td width=35%>".ucwords($row['supplier_name'])."</td>";
	  		echo "<td>".$row['reference']."</td>";	
	  		echo "<td>".date("d-m-Y",strtotime($row['reference_date']))."</td>";					
			if($row['status']=='0')
				$str="Pending";
			else
				$str="";
			echo "<td  width=10%>".$str."</td>";
			echo'<td><a href="#id='.$row[0].'&update=pur_quo" <i class="fa fa-edit"></i></a></td>';				
			echo'<td><a href="purchase.php?print=purchase_quotation&id='.$row[0].'" <i class="fa fa-print"></i></a></td></tr>';															
	  	}
	  	?>
      </tbody>
    </table>
</div>
</form>
<?php include_once("model/pur_create_quotations.php"); ?>