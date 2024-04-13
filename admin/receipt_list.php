<?php include_once("header.php");?>
<form action="" method="post" role="form">
<a href="#modal" id="btn-create">Create</a><br /><br />
<h4 id="title">Receipt Entry List</h4>
  <div class="table-responsive"> 
    <table class="table table-striped ">
      <thead>
        <tr>
		<th style="text-align:right"><b id="b-title">Sr. No.</b></th>
          <th><b id="b-title">Receipt No</b></th>
          <th><b id="b-title">Date</b></th>
		  <th><b id="b-title">Credit Ledger</b></th>
		  <th><b id="b-title">Debit Ledger</b></th>
		   <th><b id="b-title">Remark</b></th>
		  <th style="text-align:right"><b id="b-title">Amount</b></th>		  		
        </tr>
      </thead>
      <tbody>
			  <?php
	 echo "<tr>";
	 $i=1;
	  $rs=mysql_query("select * from entry_master where entry_type='r' order by entry_id desc")or die(mysql_error());
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo '<td style="text-align:right">'.$i++.'</td>';
	  	echo "<td width=10%>".str_pad($row['entry_id'],8,"0",STR_PAD_LEFT)."</td>";
	  	echo "<td width=10%>".date("d-m-Y",strtotime($row['entry_date']))."</td>";
		$credit_ledger_id = $row['credit_ledger_id'];
		$debit_ledger_id = $row['debit_ledger_id'];
		$rs1=mysql_query("select ledger_name from ledger_master where ledger_id=$credit_ledger_id ")or die(mysql_error());
		$row1=mysql_fetch_array($rs1);
			echo "<td>".$row1[0]."</td>";
		$rs1=mysql_query("select ledger_name from ledger_master where ledger_id=$debit_ledger_id")or die(mysql_error());
		$row1=mysql_fetch_array($rs1);
		echo "<td>".$row1[0]."</td>";
		echo "<td>".$row['remark']."</td>";	
		echo "<td align=right>".$row['amount']."</td>";		
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>
</form>
<?php 
	include_once("model/add_receipt.php");
 ?>

