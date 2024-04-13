<script language="javascript">
function isNumberKey(evt){	  	
 var charCode = (evt.which) ? evt.which : event.keyCode;
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8)
	return false;

 return true;		
}
function FixNumber(evt,no)
{
		 if(evt.length >= no)
			return false;
		return true;
}
</script>
<section id="inner-headline">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="pageTitle">Contact Us</h2>
		</div>
	</div>
</section>
<div class="row">
	<div class="col-md-6">
		<h3>Write Us</h3>		
		<div class="contact-form">
			<form id="contact-form" role="form"  action="" method="post">
				<div class="form-group has-feedback">
					<label for="name">Name*</label>
					<input type="text" class="form-control" maxlength="50" id="name1" name="name1" onkeydown ="return FixNumber(this.value,50)" placeholder="Your Name" required>
					<i class="fa fa-user form-control-feedback"></i>
				</div>
				<div class="form-group has-feedback">
					<label for="email">Email*</label>
					<input type="email" class="form-control" maxlength="50" id="email" name="email" placeholder="Email Address" required>
					<i class="fa fa-envelope form-control-feedback"></i>
				</div>
				<div class="form-group has-feedback">
					<label for="subject">Subject*</label>
					<input type="text" class="form-control" maxlength="50" id="subject" name="subject" placeholder="" required>
					<i class="fa fa-navicon form-control-feedback"></i>
				</div>
				<div class="form-group has-feedback">
					<label for="message">Message*</label>
					<textarea class="form-control" rows="6" maxlength="500" id="message" name="message1" placeholder="Your Message" required></textarea>
					<i class="fa fa-pencil form-control-feedback"></i>
				</div>
				<input type="submit" value="Submit" name="btn_send_msg" class="btn btn-default" id="btn-btnok">
			</form>
		</div>		
	</div>
</div>
</section>