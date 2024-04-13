<section id="inner-headline">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="pageTitle">Login</h2>
		</div>
	</div>
</section>
<div class="row">
	<div class="login-form">
		<div class="head">
			<div class="login_head">
				<img src="img/team1.jpg" height="100" width="100" alt=""/>Access and Manage Your Instances From This OSSEM Account.</div>
				<form action=""  method="POST">
				<li>
					<input type="text" class="text" value="USER NAME" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'USERNAME';}" name="email" required>
				</li>
				<li>
				<input type="password" value="Password" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Password';}" name="password" required>
				</li>
			  <?php	
				if(isset($_REQUEST['fail'])){
					if($_REQUEST['fail']==0)?> <font color="#FF0000">Wrong Password or User ID!!<br /></font>					
			  <?php }?>
				<div class="p-container">
					<a href="index.php?page=8"   type="submit"> Join US</a>
					<input type="submit" id="signin"  value="SIGN IN" name="login">
					<div class="clear"> </div>
				</div>
				</form>
			</div>
	</div>
	<div style="min-height:160px">
	</div>
</div>
</section>