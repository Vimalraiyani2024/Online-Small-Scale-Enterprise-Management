<?php
if(isset($_SESSION['ossem_approve_id']))
{
	$id=$_SESSION['ossem_approve_id'];
	$rs=mysql_query("select *from master where enterprise_id='$id'");
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
?>
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> Approve Client For New Account</span>
    </div>	
	<form action="" method="post">
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr style="color:#333333">
					<th colspan="2"><h4>Client's New Account create. It will take few seconds after clicking APPROVE and user-id and password send to email given.</h4></th>					
				</tr>
			</thead>
			<tbody>
			<tr>
				<td>Enterprise Name</td>	
				<td><?php echo strtoupper($row['enterprise_name']);?></td>	
			</tr>
			<tr>	
				<td>Email Address</td>
				<td><?php echo $row['email_id']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit"  class="btn btn-default" name="submit_approve" value="APPROVE" />&nbsp; &nbsp;<a href="index.php?page=2" class="btn btn-default">CLOSE</a></td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	</form>
<?php
	}
}
	if(isset($_REQUEST['submit_approve']))
	{		
		$ob=new ssem;
		include "class.phpmailer.php";
		$id=$_SESSION['ossem_approve_id'];
		$ob->update_status("master","is_verified",1,"enterprise_id",$id);
		unset($_SESSION['ossem_approve_id']);
		$_SESSION['ossem_msg']="New Client Created Successfully....";
				echo "dfsf";
		$rs=mysql_query("select *from master where enterprise_id='$id'");
		$row=mysql_fetch_array($rs);
		$email_id=$row['email_id'];
	
		echo "Database created successfully...";
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->Mailer = 'smtp';
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->Username = "ossem.info@gmail.com";
		$mail->Password = "mitul@123";
		$mail->IsHTML(true);
		$mail->AddReplyTo("ossem.info@gmail.com", "OSSEM....");
		$mail->SetFrom("from@yourdomain.com", "OSSEM");
	   
		$mail->Subject = "....Online OSSEM Registration....";
		$mail->AddAddress($email_id, "Mail From OSSEM...");
		$mail->MsgHTML("<b>Hi,Thank for using OSSEM. Your Registratorn detail accept and verified by administrator!.. <br/><br/>Your user id is : $email_id and Password is abc@1234 <br><br> by <a href='http://www.sparrowsofttech.com/'>OSSEM</a></b><br><br> Thank You.."); 				
		$send = $mail->Send();
		if(!$send)
			echo $mail->ErrorInfo;																		
		echo '<meta http-equiv="refresh" content="0;url=index.php?page=2"> ';
}
?>