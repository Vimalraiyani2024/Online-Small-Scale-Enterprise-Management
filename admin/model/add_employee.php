<form action="" method="post" enctype="multipart/form-data" id="form1">
	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>New Employee</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="add_employee" id="btn-popup">Save</button>';
				else
					echo '<button type="submit" name="add_employee" id="btn-popup">Save</button>';
				?>
			</div>			
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
				   <tr>
					<td><label>Employee ID </label></td>
					<?php 
						$rs=mysql_query("select emp_id from  employee_master order by emp_id desc limit 1")or die(mysql_error());
						$row=mysql_fetch_array($rs);
						$i=$row[0];
						if($i==0)
							$i=1;
						else
							$i++;
					?>
					<td colspan="3"><input type="text" readonly="" class="form-control" name="employee_id "  value="<?php echo $i?>" required></td>
					<td><label>Joining Date </label></td>
					<td colspan="3"><input type="text" id="join_date" class="form-control" name="join_date" readonly="" value="<?php echo date('d-m-Y');?>"placeholder="Ledger Name" required></td>
				  </tr>	
				  <tr>
				  <td><label>Employee Name</label></td>
				  <td colspan="9"><input type="text" class="form-control" name="emp_name" placeholder="Name of Employee" required></td> 
				</tr>	
					<td><label>Address </label></td>
				  <td colspan="3"><textarea rows="3" name="address" id="address" class="form-control" placeholder="Present Address" required></textarea></td> 
				
				  <td colspan="2"><textarea rows="3" name="address1" id="address1" class="form-control" placeholder="Permanant Address" required></textarea></td>
					</tr>
					<tr>
					<td><label>Phone </label></td><td colspan="3"> <input class="form-control" name="phone" type="text" id="phone" onkeydown="return FixNumber(this.value,20);" onkeypress="return isNumberKey1(this);" placeholder="Phone No."></td><td><label>Mobile </label></td><td> <input class="form-control" name="mob" type="text" id="mob" onkeydown="return FixNumber(this.value,10);" onkeypress="return isNumberKey1(this);" placeholder="Mobile No." required></td>
					</tr>
					<tr>
					<td><label>Email Id</label></td><td colspan="3"><input class="form-control" name="email" placeholder="Email Id" type="text" id="email" required></td><td><label>Birth Date </label></td>
					<td colspan="3"><input type="text" id="birth_date" class="form-control" name="birth_date"  value="<?php echo date('d-m-Y');?>" required></td>
					</tr>
					<tr>
					<td><label>Sex</label></td><td><input type="radio" name="sex" id="sex" checked="checked" value="m" /> Male</td><td><input type="radio" name="sex" id="sex" value="f" />Female</td><td></td>
					<td><label>Marital Status</label></td>
					<td colspan="3"><select name="mstatus" id="mstatus" class="form-control">
						<option></option>
						<option value="single">Single</option>
						<option value="married">Married</option>
					</select>
					</td>
					</tr>
					<tr>
					<td><label>Department</label></td>
					<td colspan="3"><select name="dept" id="dept" class="form-control" required/>
						<option></option>
						<?php
							$rs= mysql_query("select * from department_master") or die(mysql_error());
							while($row=mysql_fetch_array($rs))
								echo "<option value=".$row['dept_id'].">".$row['dept_name']."</option>";
						?>
					</select>
					</td>
					<td><label>Job Title</label></td><td colspan="3"><input type="text" placeholder="Job Title" name="jobtitle" class="form-control" id="jobtitle" maxlength="50"/></td>
					</td>
					<tr><td><label>Basic Salary</label></td><td colspan="3"><input class="form-control" name="salary" type="text" id="salary" onkeydown="return FixNumber(this.value,10);" onkeypress="return isNumberKey1(this);" placeholder="Basic Salary" required></td><td><label>Reference By</label></td><td><input type="text" name="ref" id="ref" class="form-control" placeholder="Reference"/> </td>
					</tr>
					<tr>
						<td><label>Select Photo</label></td>
						<Td colspan="2"><input type="file" class="form-control" name="img_emp"/></Td>
					</tr>
				</tbody>
      		</table>
			</div>
			
			</div>
		</div>
	</form>
	<div class="overlay"></div>
</div>