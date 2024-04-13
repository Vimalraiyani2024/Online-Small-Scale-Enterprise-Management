<?php include_once("header.php");?>
<form action="" method="post" role="form">
<!--	<a href="#modal" id="btn-create">Create</a><br /><br />-->
	<h4 id="title">Purchase Entry List</h4>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
			<th><b id="b-title">Sr. No.</b></th>
			<th><b id="b-title">Purchase Id</b></th>
			<th><b id="b-title">Date</b></th>		 
			<th><b id="b-title">Credit Ledger Name</b></th>
			<th><b id="b-title">Debit Ledger Name</b></th>
			<th><b id="b-title">Remark</b></th>
			<th style="text-align:right"><b id="b-title">Amount</b></th>
        </tr>
      </thead>
      <tbody>
		  <?php
		 echo "<tr>";		   
		  $rs=mysql_query("select pur_entry_id,purchase_id,(select ledger_name from ledger_master where ledger_id=credit_ledger_id) as supplier_name,(select  ledger_name from ledger_master where ledger_id=debit_ledger_id) as debit_ledger_id1,purchase_date,remark,credit_ledger_id,debit_ledger_id,amount from pur_entry_master a where a.is_deleted='0'")or die(mysql_error());
		  $i=1;
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo '<td width=8%>'.$i++.'</td>';
	  	echo "<td width=10%>".str_pad($row['purchase_id'],8,"0",STR_PAD_LEFT)."</td>";
	  	echo "<td width=10%>".date("d-m-Y",strtotime($row['purchase_date']))."</td>";
		echo "<td>".ucwords($row['supplier_name'])."</td>";		
		echo "<td>".$row['debit_ledger_id1']."</td>";
		echo "<td>".$row['remark']."</td>";
		echo "<td align=right>".$row['amount']."</td>";	
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>
</div>
</form>
<?php 
	include_once("model/add_purchase_entry.php");
 ?>