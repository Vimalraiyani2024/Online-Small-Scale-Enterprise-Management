<?php 
	include_once("header.php");
	$con=$ob->connection();
	$rs=mysql_query("select *from master where enterprise_id=".$_SESSION['ossem_user_id']."",$con) or die(mysql_error());
	$row=mysql_fetch_array($rs);
	mysql_close($con);
?>
<div class="container">
<form  method="post" name="form1" action="" enctype="multipart/form-data">
	<div class="form-group">
        <h3 id="title">Enterprise Profile</h3>
	</div>
	<?php	
		if(isset($_SESSION['success_msg']))
		{	
			echo '<label id="err-msg">'.$_SESSION['success_msg'].'</label>';
			unset($_SESSION['success_msg']);
		}
	?>
    <div class="form-group">		   
			<div class="table-responsive">
			<table class="table table">
			<tr>
				<td rowspan="3" style="width:25%"><img align="right" width="150px" height="130px" src="../images/<?php echo $row['img']; ?>"/></td>			
				<td colspan="2"><label><?php echo strtoupper($row['enterprise_name']); ?></label></td>
			</tr>
			<tr>
				<td>VAT TIN No. : <?php if($row['vat_tin_no']==0) echo "--NA--"; else echo $row['vat_tin_no'];?></td>
				<td></td>
			</tr>
			<tr>
				<td>CST No. : <?php if($row['cst_no']==0) echo "--NA--"; else echo $row['cst_no'];?></td>
				<td></td>
			</tr>
			<tr>
				<td style="text-align:right"><label>Email Address</label></td>
				<td colspan="2"><input type="text" disabled="disabled" class="form-control" value="<?php echo $row['email_id']; ?>" required/></td>
			</tr>
			<tr>
				<td style="text-align:right"><label>Licence Type</label></td>
				<td colspan="2"><input type="text" disabled="disabled" class="form-control" value="<?php if($row['plan_type']==1) echo "Demo User" ;else if($row['plan_type']==2) echo 'Basic'; if($row['plan_type']==3) echo "Standard"; if($row['plan_type']==4) echo'Adavance'; ?>" required/></td>
			</tr>
			<tr>
				<td style="text-align:right"><label>Address</label></td>
				<td colspan="2"><textarea class="form-control" name="address"><?php echo $row['address']; ?></textarea></td>
			</tr>
			<tr>
				<td style="text-align:right"><label>City</label></td>
				<td colspan="2"><input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>" required/></td>
			</tr>
			<tr>
				<td style="text-align:right"><label>State</label></td>
				<td colspan="2"><input type="text" class="form-control" name="state" value="<?php echo $row['state']; ?>" required/></td>
			</tr>	
			<tr>
				<td style="text-align:right"><label>Mobile No.</label></td>
				<td colspan="2"><input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile']; ?>" required/></td>
			</tr>
			<tr>
				<td style="text-align:right"><label>Logo</label></td>
				<td colspan="2"><input type="file" name="img" class="form-control"/></td>
			</tr>	
			<tr>
				<td colspan="3" style="text-align:center"><p style="color:#339933">You can change some details not all..If you want to chage it contact site administrator..</p></td>
			</tr>								
			</table>		 
		</div>			
    </div>	
 <div class="form-group">
		<div class="col-xs-offset-2 col-xs-3">
		<?php
			if($_SESSION['ossem_user_type']==1)				
				echo '<input type="submit" disabled="disabled" name="update_e_profile"  id="btn-popup" value="Change">';
			else
				echo '<input type="submit" name="update_e_profile"  id="btn-popup" value="Change">';
		?>
		</div>
		<div class="col-xs-offset-0 col-xs-1">
			<a href="index.php?id=1" id="close-box">Close</a>
		</div>
	</div>

</form>
</div>
