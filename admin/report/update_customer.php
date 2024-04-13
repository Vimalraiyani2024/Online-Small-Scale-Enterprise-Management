<?php 
if(isset($_REQUEST['cid'])&& isset($_REQUEST['update']))
{
	$id=$_REQUEST['cid'];
	$rs=mysql_query("select *from customer_master where customer_id='$id'")or die("");
	$row=mysql_fetch_array($rs);
?>
<form action="" method="post" id="form_add_customer">
<div id="update_panel">		
	<h2>Customer Detail</h2>
	<!--<a href="sales.php?cid='.$row[0].'&list=cust_del" class="btn-delete">Cancel</a>-->
	<a href="#" id="btn-delete">Cancel</a>
	<div id="btn-header">
		<a href="?close=3" id="close-box">Close</a>
		<?php
		
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="update_customer" id="btn-popup">Edit</button>';
				else
					echo '<button  type="submit" name="update_customer" id="btn-popup">Edit</button>';
				?>
	</div>						
	<div class="table-responsive">
		<table class="table">      
		<tbody>
		  <tr>
			<td><label>Customer Name</label></td>
			<td colspan="3"><div class="checkbox-inline"><label><input type="checkbox" name="iscompany">(Is Company ?)</label></div></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3"><input type="text" value="<?php echo $row['customer_name'];?>" onkeypress="return FixNumber(this.value,50);" class="form-control" name="c_name" placeholder="Customer Name" required></td>
		  </tr>
		  <tr>
			<td>Address</td>
			<td colspan="3"> <textarea class="form-control" rows="2" onkeypress="return FixNumber(this.value,200);" name="address"placeholder="Address" required><?php echo $row['address'];?></textarea></td>
		</tr>
			<td></td>
			<td><input type="text" class="form-control" name="city" onkeypress="return FixNumber(this.value,50);" placeholder="City" value="<?php echo $row['city'];?>" required></td>
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
					<td><input type="text" class="form-control" onkeydown="return FixNumber(this.value,50);" name="pincode" value="<?php echo $row['city'];?>" placeholder="Pin Code" onkeydown="return FixNumber(this.value,6);" onkeypress="return isNumberKey(this);" required></td>					
				  </tr>
				  <tr>
				  	<td></td>
					<td colspan="3"><input type="text" class="form-control" onkeypress="return FixNumber(this.value,50);" name="email" value="<?php echo $row['email_id'];?>" placeholder="Email ID" required></td>					
				  <tr>
					<td>Contact Person Name</td>
					<td colspan="2"> <input type="text" class="form-control" onkeypress="return FixNumber(this.value,50);" name="contact_name" value="<?php echo $row['contact_name'];?>" placeholder="Contact Person Name"></td>
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
					<td><input type="text" value="<?php echo $row['mobile_no'];?>" class="form-control" name="mobile_no" placeholder="Mobile No." required onkeypress="return FixNumber(this.value,10);"  onkeydown="return isNumberKey(this);"></td>
					<td><input type="text" class="form-control" name="phone" placeholder="Phone No." onkeypress="return FixNumber(this.value,15);" ></td>					
				  </tr>
				  <tr>
					<td><div class="checkbox-inline"><label><input type="checkbox" name="isregistered" onChange="CheckAlert(this,vat_tin_no,cst_no);">(Is  Registered?)</label></div></td>
					<td><input type="text" class="form-control" value="<?php if($row['vat_tin_no']==0) echo ""; else echo $row['vat_tin_no'];?>" name="vat_tin_no" placeholder="VAT TIN No" disabled="disabled" onkeydown="return FixNumber(this.value,8);"   onkeypress="return isNumberKey(this);"></td>
					<td><input type="text" class="form-control" name="cst_no" value="<?php if($row['cst_no']==0) echo ""; else echo $row['cst_no'];?>" placeholder="CST No." disabled="disabled" onkeydown="return FixNumber(this.value,8);"   onkeypress="return isNumberKey(this);"></td>
				</tr>				 
				</tbody>
      		</table>
			</div>		
	</form>
</div>
<?php
}
?>