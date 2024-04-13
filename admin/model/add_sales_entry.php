<form action="" method="post" id="form1">

	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>Sales Entry</h2>
			</div>
			<div id="btn-header">
				<a href="#" class="btn">Close</a>
				<button type="submit" name="add_sales_entry" id="btn-popup">Save</button>
			</div>			
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
				   <tr>
					<td><label>Sales id </label></td>
					<?php 
						$rs=mysql_query("select sales_entry_id from  sales_entry_master order by sales_entry_id desc limit 1")or die(mysql_error());
						$row=mysql_fetch_array($rs);
						$i=$row[0];
						if($i==0)
							$i=1;
						else
							$i++;
					?>
					<td colspan="3"><input type="text" disabled="disabled" class="form-control" name="payment_id" value="<?php echo $i?>" placeholder="Ledger Name" required></td>
					<td><label>Date </label></td>
					<td colspan="3"><input type="text" class="form-control" name="date" id="datepicker1" readonly="" value="<?php echo date('d/m/Y');?>"placeholder="Ledger Name" required></td>
				  </tr>	
				  <tr>
				  <td><label>Customer Name </label></td>
				  <td colspan="9">
				  			<select id="credit_ledger_id" name="credit_ledger_id" class="form-control" required>
							<option selected="selected">Select Customer Name</option>
							<?php 
							
								$rs=mysql_query("select * from ledger_master where group_id IN (select group_id from group_master where group_name='Bank Account' or group_name='Cash On Hand')")or die(mysql_error());
								while($row=mysql_fetch_array($rs))
								{
									echo'<option value='.$row[0].'>'.$row['ledger_name'].'</option>';
								}
						    ?>
						</select>	</td> 
					</tr>	
					<td><label>Sales Name </label></td>
				  <td colspan="9">
				  			<select id="debit_ledger_id" name="debit_ledger_id" class="form-control" required>
							<option selected="selected"> Select Sales Type</option>
							<?php 
							
								$rs=mysql_query("select * from ledger_master where group_id NOT IN (select group_id from group_master where group_name='Bank Account' or group_name='Cash On Hand')")or die("erro " + mysql_error());
								while($row=mysql_fetch_array($rs))
								{
									echo'<option value='.$row[0].'>'.$row['ledger_name'].'</option>';
								}
						    ?>
						</select>	</td> 
					</tr>
					<tr>
					<td><label>Amount </label></td>
					<td>Rs.</td><td> <input class="form-control" name="amount" type="text" id="amount" required/></td>
					<td><label>Remark </label></td>
					<td colspan="6"><input class="form-control" name="remark" type="text" id="remark" required/></td>
				 	</tr>
				</tbody>
      		</table>
			</div>
			
			</div>
		</div>
	</form>
	<div class="overlay"></div>
</div>