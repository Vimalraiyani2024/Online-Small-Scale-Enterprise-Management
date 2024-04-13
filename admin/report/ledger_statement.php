<?php
	if(isset($_REQUEST['ledger']))
	{		
		$ledger=$_REQUEST['ledger'];
		$rs=mysql_query("select * from ledger_master where ledger_id='$ledger'") or die(mysql_error());
		while($row=mysql_fetch_array($rs))
		{
			$cr=0;$deb=0;$onhandc=0;$onhandd=0;
			$cs= $row['ledger_id'];
			$op = $row['opening_bal'];
			$bname=$row['ledger_name'];
		}
		if(isset($bname)&& isset($cs)&& isset($op)&&isset($ledger))
		{
?>
<div id="item_container1">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="accounting.php" id="close-box">Close</a>
			<a href="#" id="btn-print">Print</a>
			<h4 id="title">Account Name  :<?php echo $bname; ?></h4>
		<div class="form-group"> 
		<table class="table table-striped table-bordered">
			<thead>
			<tr class="success">
				<td width="6%" align="right"><b id="b-title">Sr. No.</b></td>
				<td width="10%" align="left"><b id="b-title">Date</b></td>
				<td width="40%" align="left"><b id="b-title">Ledger</b></td>
				<td width="12%" align="center"><b id="b-title">Credit Amount</b></td>
				<td width="12%" align="center"><b id="b-title">Debit Amount</b></td>
			</tr>
			</thead>					
			<tbody>
			<tr>
				<td><td colspan="2">Opening Balance </td><td align="right"><?php if($op>=0.00) echo $op;?></td><td><?php if($op<0.00) echo $op*-1;?></td>
			</tr>
			<?php 	
				$i=1;
				$rs=mysql_query("select * from entry_master where credit_ledger_id = '$cs' or debit_ledger_id=$cs");
				while($row=mysql_fetch_array($rs))
				{	
					echo "<tr><td>".$i++."</td><td>".date("d-m-Y",strtotime($row['entry_date']));
					if($row['credit_ledger_id']==$cs)
					{
						$rs1=mysql_query("select ledger_name from ledger_master where ledger_id=".$row['debit_ledger_id']."") or die(mysql_error());
						$deb+=$row['amount'];
						while($row1=mysql_fetch_array($rs1))
							echo "<td>".ucwords($row1['ledger_name'])."<td align='right'><td align='right'>".$row['amount']."";
					}
					if($row['debit_ledger_id']==$cs)
					{
						$rs1=mysql_query("select ledger_name from ledger_master where ledger_id=".$row['credit_ledger_id']."") or die(mysql_error());
						$cr+=$row['amount'];
						while($row1=mysql_fetch_array($rs1))
							echo "<td>".ucwords($row1['ledger_name'])."<td align='right'>".$row['amount']."<td align='right'>";
					}
					echo "</tr>";
				}
				if($op>=0.00) 
					$cr+=$op; 
				else
					$deb+=$op*-1;
					
				$onhand=$cr-$deb;
				if($onhand>=0.00) 
					$onhandc=$onhand;
				else
					$onhandd=$onhand;
			?>	
			<tr style="font-weight:bold">
					<td colspan="3" align="right">Total</td>
					<td align="right"><?php echo number_format($cr,2); ?></td>
					<td align="right"><?php echo number_format($deb,2); ?></td>
			</tr>
			<tr style="font-weight:bold">
					<td colspan="3" align="right">Balance</td>
					<td  align="right"><?php if($onhandc!=0) echo number_format($onhandc,2); ?></td>
					<td  align="right" style="color:#FF0000;"><?php if($onhandd!=0) echo number_format($onhandd,2); ?></td>
			</tr>
		</tbody>		
		</table>
	</div>
</div>
<?php
}
}
?>