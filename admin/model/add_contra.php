<form action="" method="post" id="form1">
	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>New Contra Entry</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled"  name="add_entry" id="btn-popup">Save</button>';
				else
					echo '<button type="submit" name="add_entry" id="btn-popup">Save</button>';
				?>				
			</div>			
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
				   <tr>
					<td><label>Contra id </label></td>
					<?php 
						$rs=mysql_query("select entry_id from  entry_master where entry_type='c' order by entry_id desc limit 1")or die(mysql_error());
						$row=mysql_fetch_array($rs);
						$i=$row[0];
						if($i==0)
							$i=1;
						else
							$i++;
					?>
					<td colspan="3"><input type="text" readonly="" class="form-control" name="entry_id" readonly="readonly"  value="<?php echo $i; ?>" required /></td>
					<td><label>Date </label></td>
					<td colspan="3"><input type="text" class="form-control" id="datepicker1" name="entry_date" readonly="" value="<?php echo date('d-m-Y');?>"placeholder="Ledger Name" required></td>
				  </tr>	
				  <tr>
				  <td><label>Credit Ledger Name </label></td>
				  <td colspan="9">
				  			<select id="credit_ledger_id" name="credit_ledger_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 
							
								$rs=mysql_query("select * from ledger_master where group_id IN (select group_id from group_master where group_name='Bank Account' or group_name='Cash On Hand')")or die(mysql_error());
								while($row=mysql_fetch_array($rs))
								{
									echo'<option value='.$row[0].'>'.$row['ledger_name'].'</option>';
								}
						    ?>
						</select>	</td> 
					</tr>	
					<td><label>Debit Ledger Name </label></td>
				  <td colspan="9">
				  			<select id="debit_ledger_id" name="debit_ledger_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 
							
								$rs=mysql_query("select * from ledger_master where group_id IN (select group_id from group_master where group_name='Bank Account' or group_name='Cash On Hand')")or die("erroe " + mysql_error());
								while($row=mysql_fetch_array($rs))
								{
									echo'<option value='.$row[0].'>'.$row['ledger_name'].'</option>';
								}
						    ?>
						</select>	</td> 
					</tr>
					<tr>
					<td><label>Amount </label></td>
					<td>Rs.</td><td> <input class="form-control" name="amount" type="text" id="amount"  onkeydown="return FixNumber(this.value,10);" onkeypress="return isNumberKey1(this);" required/></td>
					<td><label>Remark </label></td>
					<td colspan="6"><input class="form-control" name="remark" type="text" id="remark" required/></td>
				 	</tr>
					<tr><td><input type="hidden" name="entry_type" id="entry_type" value="c" /></tr>
				</tbody>
      		</table>
			</div>
			
			</div>
		</div>
	</form>
	<div class="overlay"></div>
</div>