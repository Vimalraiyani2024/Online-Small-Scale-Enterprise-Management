<?php include_once("header.php"); ?>
<form action="" method="post" role="form">
	<h4 id="title">Sales Quotations</h4>
	<a href="#modal" id="btn-create">Create</a><br /><br />
 	<div class="table-responsive"> 
   	 <table class="table table-striped">
     <thead>
     <tr>
	 	<th width="6%"><b id="b-title">Sr. No.</b></th>
     	<th width="10%"><b id="b-title">Quotation No.</b></th>
        <th width="13%"><b id="b-title">Quotation Date</b></th>
		<th><b id="b-title">Customer</b> </th>
		<th><b id="b-title">Reference</b></th>
		<th><b id="b-title">Ref. Date</b></th>
        <th colspan="3"><b id="b-title">Status</b></th>
     </tr>
     </thead>
     <tbody>
	 <?php
  	 	echo "<tr>";
		$i=1;	  
	  	$rs=mysql_query("select a.sales_qua_id,customer_name,quo_date,reference,reference_date,status from sales_qua_master a,customer_master b where  a.customer_id=b.customer_id and a.is_deleted='0' order by a.sales_qua_id desc")or die(mysql_error());
		
		
	  	while($row=mysql_fetch_array($rs))
	  	{
			echo '<td align=right>'.$i++.'</td>';
	  		echo '<td><a href="sales.php?tmpid='.$row['sales_qua_id'].'&list=sales_quo">'.$row['sales_qua_id'].'</a></td>';
	 	 	echo "<td>".date("d-m-Y",strtotime($row['quo_date']))."</td>";
			echo "<td width=30%>".$row['customer_name']."</td>";
	  		echo "<td>".$row['reference']."</td>";	
			echo "<td>".date("d-m-Y",strtotime($row['reference_date']))."</td>";		
			if($row['status']=='0')
				$str="Pending";
			else
				$str="";
			echo "<td  width=10%>".$str."</td>";
			echo'<td><a href="#id='.$row['sales_qua_id'].'&update=sales_quotation" <i class="fa fa-edit"></i></a></td>';				
		    echo'<td><a href="?print=sales_quo&id='.$row['sales_qua_id'].'" <i class="fa fa-print"></i></a></td></tr>';								
	  	}		
	  	?>
      </tbody>
    </table>
</div>
</form>
<?php 	
	include_once("model/create_quotations.php");
?>