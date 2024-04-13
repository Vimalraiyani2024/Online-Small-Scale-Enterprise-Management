<?php 
		include_once("../class/autoload.php");
		$con1= $ob->connection();
		$rs1=mysql_query("select *from master where enterprise_id=".$_SESSION['ossem_user_id']."",$con1)or die(mysql_error());	
		$rowE=mysql_fetch_array($rs1);
		mysql_close($con1);		
		$con=$ob->newconnection();	
			
?>
<html>
 <title>Profit Loss Print</title>
 <head>
	<link href="../styles/bootstrap.min.css" rel="stylesheet">     
    <link href="../styles/style.css" rel="stylesheet">
	<script src="../js/jquery.min.js"></script>
	<link href="../styles/bootstrap.css" rel="stylesheet">	
	<link rel="shortcut icon" href="../img/favico.ico">
    <link href="../styles/style.css" rel="stylesheet">	
	</head>
<body style="font-family:'Times New Roman', Times, serif; font-size:8px">
<?php
	if (isset($_REQUEST['from'])&& isset($_REQUEST['to']))	
	{	
		$from_date=date("Y-m-d",strtotime($_REQUEST['from']));
		$to_date=date("Y-m-d",strtotime($_REQUEST['to']));
?>
<div id="item_container">
			<h4 id="title">Profit Loss</h4>
			<div class="table-responsive">
			<table class="table">
			<?php	
				echo '<tr><td colspan="5"><b id="b-title">Profit Loss From Date '.$from_date.' To Date '.$to_date.'</b></td></tr>';			
			?>
			</table>
        </div>
	<div class="form-group"> 
		<table class="table table-hover">
			<thead>
			<tr class="success">
				<td colspan="4" width="40%" align="left"><b id="b-title">P a r t i c u l a r s</b></td>
			</tr>
			</thead>					
			<tbody>
			<tr>
				<!-- <td>Opening Balance </td><td align="right"><?php if($op>=0.00) echo $op;?></td><td><?php if($op<0.00) echo $op*-1;?></td> -->
			</tr>
			<?php 
		//	if(isset($_POST['show_profit_loss']))
			{
				$opening=0;$total_sale=0;$closing=0;$total_pur=0;
				// Sales Account
				
				$rs1=mysql_query("select sum(amount) as total from sales_entry_master where invoice_date>='$from_date' and invoice_date<='$to_date'") or die(mysql_error());
				while($row1=mysql_fetch_array($rs1))
				{
					echo "<tr><td colspan='3'><b>Sales Account</b></td><td><b>".number_format($row1['total'],2)."</b></tr>";	
					$total_sale = $row1['total'];
				}
				$rs=mysql_query("select sum(amount)  as salesamount,ledger_name from sales_entry_master a,ledger_master b where a.debit_ledger_id=b.ledger_id and a.invoice_date>='$from_date' and a.invoice_date<='$to_date' group by debit_ledger_id") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{ 
					echo "<tr><td width=2%><td width=50%>".$row['ledger_name']."</td><td width=10%>".number_format($row['salesamount'],2)."<td width=10%></tr>";
				}		
				// Opening Stock
				$opening=0; 
				$rs = mysql_query("select * from ledger_master where ledger_name='Opening Stock'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					echo "<tr><td colspan='2'><b>Opening Stock<td></b>".number_format($row['opening_bal'],2)."</tr>";
					$opening=$row['opening_bal'];
				}
						
				// Purchase Account
				$rs1=mysql_query("select sum(amount) as total from pur_entry_master where purchase_date>='$from_date' and purchase_date<='$to_date'") or die(mysql_error());
				while($row1=mysql_fetch_array($rs1))
				{
					echo "<tr><td colspan='2'><b>Purchase Account</b></td><td><b>".number_format($row1['total'],2)."</b></tr>";	
					$total_pur = $row1['total'];
				}
				
				$rs=mysql_query("select sum(amount)  as puramount,ledger_name from pur_entry_master a,ledger_master b where a.debit_ledger_id=b.ledger_id and a.purchase_date>='$from_date' and a.purchase_date<='$to_date' group by debit_ledger_id") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{ 
					echo "<tr><td width=2%><td width=50%>".$row['ledger_name']."</td><td width=10%>".number_format($row['puramount'],2)."<td width=10%></tr>";
				}		
				
				//Closing Stock 
				$rs = mysql_query("select * from ledger_master where ledger_name='Closing Stock'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					echo "<tr><td colspan='2'><b>Closing Stock<td></b>".number_format($row['opening_bal'],2)."</tr>";
					$closing=$row['opening_bal'];
				}
				// Direct Expenses
				$direct_exp=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Direct Expense'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	
					$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and 	(entry_type='p' or entry_type='j')") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$direct_exp=$direct_exp + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r')") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
						$direct_exp=$direct_exp - $row2['total'];
						$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$direct_exp+=$op;
					else
						$direct_exp=$direct_exp - ($op*1);
			
				}		
				echo "<tr><td colspan='2'><b>Total Direct Expense<td></b><b>".number_format($direct_exp,2)."</b></tr>";
			
				//Direct  Income
				$direct_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Direct Income'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j')") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$direct_inc=$direct_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p')") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$direct_inc=$direct_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$direct_inc+=$op;
					else
						$direct_inc=$direct_inc - ($op*1);
				}
					
				echo "<tr><td colspan='2'><b>Total Direct Income<td></b><b>".number_format($direct_inc,2)."</b></tr>";
			
				// Cost of sale
				$costofsale=0;
					$costofsale=($total_pur+$opening+$direct_inc)-($closing+$direct_exp);
					echo "<tr><td colspan='2'><b>Cost of Sales<td></b><td><b>".number_format(($total_pur+$opening+$direct_inc)-($closing+$direct_exp),2)."</b></tr>";	
					
				// Gross Profit
				$gp=0;
				$gp=$total_sale - $costofsale;
				echo "<tr class='warning'><td colspan='2'><b>Gross  Profit<td></b><td><b>".number_format($gp,2)."</b></tr>";	
			
				
				// Indirect Expenses
				$indirect_exp=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Indirect Expense'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	
					$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and 	(entry_type='p' or entry_type='j')") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$indirect_exp=$indirect_exp + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r')") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
						$indirect_exp=$indirect_exp - $row2['total'];
						$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$indirect_exp+=$op;
					else
						$indirect_exp=$direct_exp - ($op*1);
				}		
				echo "<tr><td colspan='2'><b>Total Direct Expense<td></b><b>".number_format($indirect_exp,2)."</b></tr>";
			//Indirect  Income
				$indirect_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Indirect Income'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j')") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$indirect_inc=$indirect_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p')") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
						$indirect_inc=$indirect_inc - $row2['total'];
						$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$indirect_inc+=$op;
					else
						$indirect_inc=$direct_inc - ($op*1);
				}
				
				echo "<tr><td colspan='2'><b>Total Indirect Income<td></b><b>".number_format($indirect_inc,2)."</b></tr>";
				echo "<tr><td colspan='4'></tr>";
				$netprofit=($gp + $indirect_inc) - $indirect_exp;
				echo "<tr><td colspan='2'><b>NETT PROFIT<td></b><td><b>".number_format($netprofit,2)."</b></tr>";

}	?>	
		</tbody>		
		</table>
	</div>
</div>
<?php
} ?>