<?php include_once("header.php");?>
<form action="" method="post" role="form">
<!--	<a href="#modal" id="btn-create">Create</a><br /><br />-->
<h4 id="title">Sales Entry List</h4>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
		<th><b id="b-title">Sr. No.</b></th>
		  <th><b id="b-title">Invoice No.</b></th>
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
	 $i=1;
	  $rs=mysql_query("select sales_entry_id,invoice_id,(select  ledger_name from ledger_master where ledger_id=credit_ledger_id) as customer_name,(select  ledger_name from ledger_master where ledger_id=debit_ledger_id) as debit_ledger,invoice_date,remark,credit_ledger_id,debit_ledger_id,amount from sales_entry_master a where a.is_deleted='0'")or die(mysql_error());
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo '<td>'.$i++.'</td>';
	  	echo "<td width=8%>".$row['invoice_id']."</td>";		
	  	echo "<td width=10%>".date("d-m-Y",strtotime($row['invoice_date']))."</td>";
		echo "<td>".$row['customer_name']."</td>";
		echo "<td>".$row['debit_ledger']."</td>";		
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
	include_once("model/add_sales_entry.php");
 ?>