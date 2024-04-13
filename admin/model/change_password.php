<?php include_once("header.php");?>
<form method="post" name="form1" action="">
    <?php	
		if(isset($_SESSION['success_msg']))
		{	
			echo '<div class="form-group"> <div class="col-xs-offset-5 col-xs-4"><label id="err-msg">'.$_SESSION['success_msg'].'</label></div></div>';
			unset($_SESSION['success_msg']);
		}
	?>

	   
			<div class="table-responsive" style="width:50%; margin-left:25%">
			<table class="table table">
			<tr>
				<td colspan="2">        <h3 id="title">Change Password</h3></td>
			</tr>
			<tr>
				<td>Old Password</td>
			  	<td><input type="password" class="form-control"  name="old_pass" placeholder=" Enter Old Password" onkeypress="return FixNumber(this.value,50)" required/>							      </td>
			</tr>
			<tr>
				<td>New Password : </td>
				<td><input type="password" class="form-control" name="new_pass" placeholder="Enter New Password" onkeypress="return FixNumber(this.value,50)" required></td>
			</tr>
            <tr>
				<td>Confirm Password :  </td>
				<td><input type="password" class="form-control" name="confirm_pass" placeholder="Enter Confirm Password" onkeypress="return FixNumber(this.value,50)" required></td>
        	</tr>
    		<tr>
		 		<td>	<?php
				if($_SESSION['ossem_user_type']==1)				
         	    	echo '<input type="submit" disabled="disabled" name="update_password"  id="btn-popup" value="Change">';
				else
					echo '<input type="submit" name="update_password"  id="btn-popup" value="Change">';
			?></td>
				<td>
				<a href="index.php?id=1" id="close-box">Close</a>
				</td>
				</tr>
				</table>
            </div>
        </div>
    </form>
