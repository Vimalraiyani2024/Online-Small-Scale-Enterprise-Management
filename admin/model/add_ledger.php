<form action="" method="post" id="form1">
	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>Add New Ledger</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit"  disabled="disabled" name="add_ledger" id="btn-popup">Save</button>';
				else
					echo '<button type="submit" name="add_ledger" id="btn-popup">Save</button>';
				?>
			</div>			
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
				   <tr>
					<td><label>Ledger ID </label></td>
					<?php 
						$rs=mysql_query("select ledger_id from  ledger_master order by ledger_id desc limit 1")or die(mysql_error());
						$row=mysql_fetch_array($rs);
						$i=$row[0];
						if($i==0)
							$i=1;
						else
							$i++;
					?>
					<td colspan="3"><input type="text" disabled="disabled" class="form-control" name="ledger_name" value="<?php echo $i?>" placeholder="Ledger Name" required></td>
				  </tr>
				  </tr>
				  <tr>
					<td><label>Ledger Name</label></td>
					<td colspan="3"><input type="text" onkeydown="return FixNumber(this.value,50);" class="form-control" name="ledger_name" placeholder="Ledger Name" required></td>
				  </tr>	
				  <tr>
				  <td><label>Under Group Name</label></td>
				  <td colspan="3">
				  			<select id="group_id" name="group_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 
							
								$rs=mysql_query("select *from group_master")or die(mysql_error());
								while($row=mysql_fetch_array($rs))								
									echo'<option value='.$row[0].'>'.ucwords($row['group_name']).'</option>';								
						    ?>
						</select>	
						</td> 
					</tr>	
					<tr>
					<td><label>Opening Balance </label></td>
					<td><input class="form-control" name="opening_bal" type="text" id="opening_bal" onkeypress="return isNumberKey1(this);"  onkeydown="return FixNumber(this.value,10);"  required/></td>
				 	</tr>
				</tbody>
      		</table>
			</div>
			
			</div>
		</div>
	</form>
	<div class="overlay"></div>
</div>