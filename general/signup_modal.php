<section id="inner-headline">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="pageTitle">Create Your Account Here</h2>
		</div>
	</div>
</section>
<div class="row">
	<div class="col-md-7">
		<div class="modal-body form-group">
			 <form role="form" id="sign_up" class="login_form" method="post">
				<div class="form-group">					
					<label>Your Enterprise Name</label><input name="e_name" type="text"  onkeydown="return FixNumber(this.value,40);" class="form-control" placeholder="Enterprise Name" required />
				</div>
				<div class="form-group">
					<label>Complete Address</label>
					<textarea name="address" class="form-control" placeholder="Enter Address"  onkeydown="return FixNumber(this.value,200);"  required></textarea>						
				</div>
				<div class="form-group">
					<label>City</label>
					<input name="city" type="text" class="form-control" placeholder="Enter City"  onkeydown="return FixNumber(this.value,30);" required />					
				</div>
				<div class="form-group">
					<label>State</label>
					<input name="state" type="text" class="form-control" placeholder="Enter State"  onkeydown="return FixNumber(this.value,30);" required />					
				</div>
				<div class="form-group">
					<label>Mobile No.</label>
					<input name="mobile_no" type="text" class="form-control"  placeholder="Enter Mobile No." onkeydown="return FixNumber(this.value,10);" onkeypress="return isNumberKey(this);" required>
				</div>
				<div class="form-group">
					<label>Email Id</label>
					<input name="email" type="text" class="form-control" placeholder="Enter Email Id"  onkeydown="return FixNumber(this.value,50);" required>
				</div>
				<div class="form-group">
						<label>VAT TIN No.</label>
						<input name="vat_tin_no" type="text" class="form-control"  placeholder="Enter VAT TIN No."  onkeypress="return FixNumber(this.value,13);" onkeydown="return isNumberKey(this);" required>
					</div>
					<div class="form-group">
						<label>CST No.</label>
						<input name="cst_no" type="text" class="form-control"  placeholder="Enter CST No."  onkeypress="return FixNumber(this.value,13);" onkeydown="return isNumberKey(this);" required>
					</div>	
					<div class="form-group">
						<label>Plan Type</label>
						<br />
						<label class="radio-inline" style="font-size:15px;font-weight:800">
							<input type="radio"  name="rb_list" value="2" required>Basic
						</label>
						<label class="radio-inline" style="font-size:15px;font-weight:800">
							<input type="radio" name="rb_list" id="rb_list"  value="3"  required>Standard
					</label>
					<label class="radio-inline" style="font-size:15px;font-weight:800">
			  			<input type="radio"  name="rb_list" id="rb_list" value="4"  required>Advanced
					</label>	
					</div>																		
				 <button  class="btn btn-success" type="submit" name="btn_register"  id="btn-btnok"><i class="fa fa-save"></i> Create This Account</button>					
				 <a href="index.php?page=7" class="btn btn-default" id="btn-btnok" style="float:right"><i class="fa fa-times"></i> Close</a>
			</form>
			</div>
	</div>
</div>