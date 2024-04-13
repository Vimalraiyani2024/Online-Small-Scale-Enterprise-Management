<form action="" method="post" id="form1">
<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>Supplier Entry Form</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="add_supplier" id="btn-popup">Save</button>';
				else
				echo '<button type="submit" name="add_supplier" id="btn-popup">Save</button>';
				?>
			</div>			
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
					<td><label>Supplier Name</label></td>
					<td colspan="3"><div class="checkbox-inline"><label><input type="checkbox" name="iscompany">(Is Company ?)</label></div></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="3"><input type="text" class="form-control" onkeydown="return FixNumber(this.value,50);"  name="supplier_name" placeholder="Supplier Name" required></td>
				  </tr>
				  <tr>
				  	<td>Address</td>
					<td colspan="3"> <textarea class="form-control" rows="2" onkeydown="return FixNumber(this.value,200);"  name="address"placeholder="Address" required></textarea></td>
				</tr>
					<td></td>
					<td><input type="text" class="form-control" name="city" placeholder="City" required></td>
					<td><div class="form-group">
						<select name="state" class="form-control">
							<option selected="selected"></option>
							<option>Gujarat</option>
							<option>Rajsthan</option>
							<option>Madhyapradesh</option>
							<option>Delhi</option>
							<option>Maharastra</option>
						</select>
					</div>
					</td>
					<td><input type="text" class="form-control" name="pincode" placeholder="Pin Code" onkeydown="return FixNumber(this.value,6);" onkeypress="return isNumberKey(this);" required></td>					
				  </tr>
				  <tr>
				  	<td></td>
					<td colspan="3"><input type="text" class="form-control" onkeydown="return FixNumber(this.value,50);"  name="email" placeholder="Email ID" ></td>					
				  <tr>
					<td>Contact Person Name</td>
					<td colspan="2"> <input type="text" class="form-control" onkeydown="return FixNumber(this.value,50);"  name="contact_name" placeholder="Contact Person Name" ></td>
					<td>
					<div class="form-group">
						<select name="designation" class="form-control">
							<option selected="selected"></option>
							<option>Manager</option>
							<option>Ownner</option>
						</select>
					</div>
					</td>
				  </tr>
				  <tr>
					<td>Contact No.</td>
					<td><input type="text" class="form-control" name="mobile" placeholder="Mobile No." onkeypress="return FixNumber(this.value,10);"  onkeydown="return isNumberKey(this);"></td>
					<td><input type="text" class="form-control" name="phone" placeholder="Phone No." onkeypress="return FixNumber(this.value,15);" required ></td>					
				  </tr>
				  <tr>
					<td><div class="checkbox-inline"><label><input type="checkbox" name="isregistered" onChange="CheckAlert(this,vat_tin_no,cst_no);">(Is  Registered?)</label></div></td>
					<td><input type="text" class="form-control" name="vat_tin_no" placeholder="VAT TIN No" disabled="disabled" onkeypress="return FixNumber(this.value,13);"   onkeydown="return isNumberKey(this);"></td>
					<td><input type="text" class="form-control" name="cst_no" placeholder="CST No." disabled="disabled" onkeypress="return FixNumber(this.value,13);"   onkeydown="return isNumberKey(this);"></td>
				</tr>				 
				</tbody>
      		</table>
			</div>
		</div>
	</div>
	</form>
	<div class="overlay"></div>
</div>