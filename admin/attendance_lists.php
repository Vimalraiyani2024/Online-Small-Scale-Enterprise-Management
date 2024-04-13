<?php include_once("header.php");?>
<form action="" method="post" role="form">
<a href="#modal" id="btn-create">Create</a><br /><br />
<h4>Attendance Lists </h4>
  <div class="table-responsive"> 
    <table class="table table-striped ">
      <thead>
        <tr>
          <th>Sr. No</th>
          <th>Month </th>
		  <th>Year </th>
		  <th></th>
		   <th>Remark</th>
		  <th style="text-align:right">Amount</th>		  
		  <th></th>
        </tr>
      </thead>
      <tbody>
	 <?php
	  $i=1;
	  echo "<tr>";
	  $rs=mysql_query("select * from attendace_master")or die(mysql_error());
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo "<td width=10%>".$row['entry_id']."</td>";
	  	echo "<td width=10%>".$row['entry_date']."</td>";
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
		echo'<td><a href="#?cid='.$row[0].'" id="btn-delete"> x </a></td>';	
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

