<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="?id=4" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h4 id="title">Balance Sheet</h4>
			<div class="table-responsive">
			<table class="table">
			<tr>
				<td>From Date</td>
				<td><input class="form-control" id="sale_exp_quo_date" readonly="readonly" name="from_date" type="text" value="<?php echo date("d-m-Y"); ?>"  placeholder="From Date"/></td>				
				<td>To Date</td>
				<td><input class="form-control" id="sale_ref_quo_date" readonly="readonly" name="to_date" type="text" value="<?php echo date("d-m-Y"); ?>" placeholder="To Date"/></td>
				<td><button type="submit" name="show_balancesheet" id="btn-show-data">Show</button></td>
			</tr>
			<?php
			if (isset($_POST['to_date'])&& isset($_POST['from_date']))
			{
				echo '<tr><td colspan="5" align="center"><b id="b-title">'.ucwords($_SESSION['ossem_enterprise_name']).' Balance Sheet From Date '.$_POST['from_date'].' To Date '.$_POST['to_date'].'</b></td></tr>';
			}
			?>
        </div>
	<div class="form-group"> 
		<table class="table table-hover">
			<thead>
			<tr class="success">
				<td colspan="4" align="left"><b id="b-title">P a r t i c u l a r s</b></td>
			</tr>
			</thead>					
			<tbody>
			<tr>
				
				<!-- <td>Opening Balance </td><td align="right"><?php if($op>=0.00) echo $op;?></td><td><?php if($op<0.00) echo $op*-1;?></td> -->
			</tr>
			<?php 
			if(isset($_POST['show_balancesheet']))
			{
			//Start of Profit Loss		
			$opening=0;$total_sale=0;$closing=0;$total_pur=0;
				// Sales Account
				$from_date=date("Y-m-d",strtotime($_POST['from_date']));
				$to_date=date("Y-m-d",strtotime($_POST['to_date']));
				$rs1=mysql_query("select sum(amount) as total from sales_entry_master where invoice_date>='$from_date' and invoice_date<='$to_date'") or die(mysql_error());
				while($row1=mysql_fetch_array($rs1))
				{
					//echo "<tr><td colspan='3'><b>Sales Account</b></td><td><b>".number_format($row1['total'],2)."</b></tr>";	
					$total_sale = $row1['total'];
				}
				$rs=mysql_query("select sum(amount)  as salesamount,ledger_name from sales_entry_master a,ledger_master b where a.debit_ledger_id=b.ledger_id and a.invoice_date>='$from_date' and a.invoice_date<='$to_date' group by debit_ledger_id") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{ 
				//	echo "<tr><td width=2%><td width=50%>".$row['ledger_name']."</td><td width=10%>".number_format($row['salesamount'],2)."<td width=10%></tr>";
				}		
				// Opening Stock
				$opening=0; 
				$rs = mysql_query("select * from ledger_master where ledger_name='Opening Stock'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					//echo "<tr><td colspan='2'><b>Opening Stock<td></b>".number_format($row['opening_bal'],2)."</tr>";
					$opening=$row['opening_bal'];
				}
						
				// Purchase Account
				$rs1=mysql_query("select sum(amount) as total from pur_entry_master where purchase_date>='$from_date' and purchase_date<='$to_date'") or die(mysql_error());
				while($row1=mysql_fetch_array($rs1))
				{
				//	echo "<tr><td colspan='2'><b>Purchase Account</b></td><td><b>".number_format($row1['total'],2)."</b></tr>";	
					$total_pur = $row1['total'];
				}
				
				$rs=mysql_query("select sum(amount)  as puramount,ledger_name from pur_entry_master a,ledger_master b where a.debit_ledger_id=b.ledger_id and a.purchase_date>='$from_date' and a.purchase_date<='$to_date' group by debit_ledger_id") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{ 
				//	echo "<tr><td width=2%><td width=50%>".$row['ledger_name']."</td><td width=10%>".number_format($row['puramount'],2)."<td width=10%></tr>";
				}		
				
				//Closing Stock 
				$rs = mysql_query("select * from ledger_master where ledger_name='Closing Stock'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					//echo "<tr><td colspan='2'><b>Closing Stock<td></b>".number_format($row['opening_bal'],2)."</tr>";
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
					//echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and 	(entry_type='p' or entry_type='j')  and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$direct_exp=$direct_exp + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r')  and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
						$direct_exp=$direct_exp - $row2['total'];
						$temp = $temp - $row2['total'];
					}
				//	echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$direct_exp+=$op;
					else
						$direct_exp=$direct_exp - ($op*1);
			
				}		
				//echo "<tr><td colspan='2'><b>Total Direct Expense<td></b><b>".number_format($direct_exp,2)."</b></tr>";
			
				//Direct  Income
				$direct_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Direct Income'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
				//	echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$direct_inc=$direct_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$direct_inc=$direct_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
				//	echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$direct_inc+=$op;
					else
						$direct_inc=$direct_inc - ($op*1);
				}
					
			//	echo "<tr><td colspan='2'><b>Total Direct Income<td></b><b>".number_format($direct_inc,2)."</b></tr>";
			
				// Cost of sale
				$costofsale=0;
					$costofsale=($total_pur+$opening+$direct_inc)-($closing+$direct_exp);
				//	echo "<tr><td colspan='2'><b>Cost of Sales<td></b><td><b>".number_format(($total_pur+$opening+$direct_inc)-($closing+$direct_exp),2)."</b></tr>";	
					
				// Gross Profit
				$gp=0;
				$gp=$total_sale - $costofsale;
				//echo "<tr class='warning'><td colspan='2'><b>Gross  Profit<td></b><td><b>".number_format($gp,2)."</b></tr>";	
				
				// Indirect Expenses
				$indirect_exp=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Indirect Expense'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	
					$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
				//	echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and 	(entry_type='p' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$indirect_exp=$indirect_exp + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
						$indirect_exp=$indirect_exp - $row2['total'];
						$temp = $temp - $row2['total'];
					}
				//	echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$indirect_exp+=$op;
					else
						$indirect_exp=$direct_exp - ($op*1);
				}		
				//echo "<tr><td colspan='2'><b>Total Direct Expense<td></b><b>".number_format($indirect_exp,2)."</b></tr>";
			//Indirect  Income
			$indirect_inc=0;
			$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Indirect Income'))") or die(mysql_error());
			while($row=mysql_fetch_array($rs))
			{
				$temp=0;
				$ledger_id= $row['ledger_id'];
				$op = $row['opening_bal'];
				//echo "<tr><td colspan='2'>".$row['ledger_name'];
				$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j')  and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
				while($row1=mysql_fetch_array($rs1))
				{
					$indirect_inc=$indirect_inc + $row1['total'];
					$temp = $temp + $row1['total'];
					}
				$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
				while($row2=mysql_fetch_array($rs2))
				{
						$indirect_inc=$indirect_inc - $row2['total'];
						$temp = $temp - $row2['total'];
				}
				//echo "<td>".number_format($temp+$op,2)."</tr>";	
				if($op>=0)
					$indirect_inc+=$op;
				else
					$indirect_inc=$direct_inc - ($op*1);
			}	
		//	echo "<tr><td colspan='2'><b>Total Indirect Income<td></b><b>".number_format($indirect_inc,2)."</b></tr>";
		//	echo "<tr><td colspan='4'></tr>";
			$netprofit=($gp + $indirect_inc) - $indirect_exp;
			//echo "<tr><td colspan='2'><b>NETT PROFIT<td></b><td><b>".number_format($netprofit,2)."</b></tr>";		
			//End Of Profit Loos
			
				$opening=0;$total_sale=0;$closing=0;$total_pur=0;
				// Capital Account
				$capital_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Capital Account'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total,entry_date from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$capital_inc=$capital_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$capital_inc=$capital_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$capital_inc+=$op;
					else
						$capital_inc=$capital_inc - ($op*1);
				}
					
				echo "<tr><td colspan='2'><b>Capital Acccount<td><td></b><b>".number_format($capital_inc,2)."</b></tr>";
		
				// Loans (Liability)
				$from_date=date("Y-m-d",strtotime($_POST['from_date']));
				$to_date=date("Y-m-d",strtotime($_POST['to_date']));
				$loansliability_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Loans (Liability)'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$loansliability_inc=$loansliability_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$loansliability_inc=$loansliability_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."<td></tr>";	
					if($op>=0)
						$loansliability_inc+=$op;
					else
						$loansliability_inc=$loansliability_inc - ($op*1);
				}
					
				echo "<tr><td colspan='2'><b>Loans (Liability)<td><td></b><b>".number_format($loansliability_inc,2)."</b></tr>";
				
				// Current Liability
				$from_date=date("Y-m-d",strtotime($_POST['from_date']));
				$to_date=date("Y-m-d",strtotime($_POST['to_date']));
				$currentsliability_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Current Liabilities'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$currentsliability_inc=$currentsliability_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$currentsliability_inc=$currentsliability_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$currentsliability_inc+=$op;
					else
						$currentsliability_inc=$currentsliability_inc - ($op*1);
				}
				
				$sc_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Sundry Creditors'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					$rs3 = mysql_query("select sum(amount) as total from pur_entry_master where credit_ledger_id=$ledger_id and purchase_date>='$from_date' and purchase_date<='$to_date'") or die(mysql_error());
					while($row3=mysql_fetch_array($rs3))
					{
						$sc_inc=$sc_inc + $row3['total'];
						$temp = $temp + $row3['total'];
					}
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$sc_inc=$sc_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p') and (entry_date>='$from_date' and entry_date<='$to_date')") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$sc_inc=$sc_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					if($op>=0)
						$sc_inc+=$op;
					else
						$sc_inc=$sc_inc - ($op*1);
				}
				echo "<tr><td colspan='2'>Sundry Creditors<td>".number_format($sc_inc,2)."<td></tr>";
				$currentsliability_inc=$currentsliability_inc+$sc_inc;
				echo "<tr><td colspan='2'><b>Current Liabilities<td><td></b><b>".number_format($currentsliability_inc,2)."</b></tr>";
			
			// Profit Account
			echo "<tr><td colspan='2'><b>Profit Loss A/c<td><td></b><b>".number_format($netprofit,2)."</b></tr>";
			//TOTAL FIRST SIDE
			$total_side1 = $netprofit+$currentsliability_inc+$loansliability_inc+$capital_inc;
			echo "<tr class='warning'><td colspan='2'><b>T O T A L<td><td></b><b>".number_format($total_side1,2)."</b></tr>";
		// END OF SIDE ONE
//--------------------------------------------------------------------------------------------------------------------
		// START OF SIDE SECOND
						$opening=0;$total_sale=0;$closing=0;$total_pur=0;
				// FIXED ASSETS
				$asset_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Asset'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='p' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$asset_inc=$asset_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$asset_inc=$asset_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."<td></tr>";	
					if($op>=0)
						$asset_inc+=$op;
					else
						$asset_inc=$capital_inc - ($op*1);
				}
				echo "<tr><td colspan='2'><b>Fixed Assets<td><td></b><b>".number_format($asset_inc,2)."</b></tr>";
		
				// Investments
				$invest_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Investments'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='p' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{	
						$invest_inc=$invest_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select count(e_id) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$invest_inc=$invest_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."<td></tr>";	
					if($op>=0)
						$invest_inc+=$op;
					else
						$invest_inc=$invest_inc - ($op*1);
					$invest_inc;
				}
				echo "<tr><td colspan='2'><b>Investments<td><td></b><b>".number_format($invest_inc,2)."</b></tr>";
				
				// Current ASSETS
				$from_date=date("Y-m-d",strtotime($_POST['from_date']));
				$to_date=date("Y-m-d",strtotime($_POST['to_date']));
				$currentasset_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Current Assets'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					echo "<tr><td colspan='2'>".$row['ledger_name'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='p' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$currentasset_inc=$currentasset_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r') and entry_date>='$from_date' or entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$currentasset_inc=$currentasset_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					echo "<td>".number_format($temp+$op,2)."</tr>";	
					if($op>=0)
						$currentasset_inc+=$op;
					else
						$currentasset_inc=$currentasset_inc - ($op*1);
				}
				//Sundry Debtors
				$sd_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Sundry Debtors'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					$rs3 = mysql_query("select sum(amount) as total from sales_entry_master where credit_ledger_id=$ledger_id and invoice_date>='$from_date' and invoice_date<='$to_date'") or die(mysql_error());
					while($row3=mysql_fetch_array($rs3))
					{
						$sd_inc=$sd_inc + $row3['total'];
						$temp = $temp + $row3['total'];
					}
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='p' or entry_type='j') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$sd_inc=$sd_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='r') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$sd_inc=$sd_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					if($op>=0)
						$sd_inc+=$op;
					else
						$sd_inc=$sd_inc - ($op*1);
				}
				echo "<tr><td colspan='2'>Sundry Debtors<td>".number_format($sd_inc,2)."<td></tr>";
				
				///CAsh
				$cash_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Cash On Hand'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j' or entry_type='c') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$cash_inc=$cash_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p' or entry_type='c') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$cash_inc=$cash_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					if($op>=0)
						$cash_inc+=$op;
					else
						$cash_inc=$cash_inc - ($op*1);
				}
				echo "<tr><td colspan='2'>Cash On Hand<td>".number_format($cash_inc,2)."<td></tr>";
				///Bank
				$bank_inc=0;
				$rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Bank Account'))") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{	$temp=0;
					$ledger_id= $row['ledger_id'];
					$op = $row['opening_bal'];
					$rs1 = mysql_query("select sum(amount) as total from entry_master where credit_ledger_id=$ledger_id and (entry_type='r' or entry_type='j' or entry_type='c') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row1=mysql_fetch_array($rs1))
					{
						$bank_inc=$bank_inc + $row1['total'];
						$temp = $temp + $row1['total'];
					}
					$rs2= mysql_query("select sum(amount) as total from entry_master where debit_ledger_id=$ledger_id and (entry_type='j' or entry_type='p' or entry_type='c') and entry_date>='$from_date' and entry_date<='$to_date'") or die(mysql_error());
					while($row2=mysql_fetch_array($rs2))
					{
							$bank_inc=$bank_inc - $row2['total'];
							$temp = $temp - $row2['total'];
					}
					if($op>=0)
						$bank_inc+=$op;
					else
						$bank_inc=$bank_inc - ($op*1);
				}
				echo "<tr><td colspan='2'>Bank Acccounts<td>".number_format($bank_inc,2)."<td></tr>";
				//
				$currentasset_inc=$currentasset_inc+$sd_inc+$bank_inc+$cash_inc;
				echo "<tr><td colspan='2'><b>Current Assets<td><td></b><b>".number_format($currentasset_inc,2)."</b></tr>";
				
			//TOTAL SECOND SIDE
			$total_side2 = $invest_inc+$currentasset_inc+$asset_inc;
			echo "<tr class='warning'><td colspan='2'><b>T O T A L<td><td></b><b>".number_format($total_side2,2)."</b></tr>";
		// END OF SIDE ONE
		echo "<tr><td id='err-msg'>This Entry Are Demo Entry So Total of Both Side Are Not Same</tr>";
// END OF SIDE TWO ----------------------------------------------
			
						
		
		}
	?>	
		</tbody>		
		</table>
	</div>
</div>