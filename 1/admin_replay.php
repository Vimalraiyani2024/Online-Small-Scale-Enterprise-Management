<?php
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
	$rs=mysql_query("select *from suggestion where sug_id='$id'")or die("");
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
?>
  	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-pencil"></i> Replay To Visitor or Cleint</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="" method="post">
                        	<div class="mws-form-inline">
                            	<div class="mws-form-row">
                                	<label class="mws-form-label">Send To :</label>
                                	<div class="mws-form-item">
                                    	<input type="text" class="large" readonly="readonly" name="sender" value="<?php echo $row['sender_name']; ?>">
                                    </div>
                                </div>
                            	
									<div class="mws-form-row">
                                	<label class="mws-form-label">Email Id :</label>
                                	<div class="mws-form-item">
                                    	<input type="text" class="large" name="email_id" readonly="readonly" value="<?php echo $row['email']; ?>">
                                    </div>
                                </div>
                           
							   	<div class="mws-form-row">
                                	<label class="mws-form-label">Subject :</label>
                                	<div class="mws-form-item">
                                    	<input type="text" class="large" name="subject" required>
                                    </div>
                                </div>
								
									<div class="mws-form-row">
                                	<label class="mws-form-label">Message :</label>
                                	<div class="mws-form-item">
                                    	  <textarea rows="" name="msg" cols="" class="large autosize" required></textarea>
                                    </div>
                                </div>
								
                                <div class="mws-form-row">
                                    <label class="mws-form-label"></label>
                                    <div class="mws-form-item">
                                        <input type="submit" name="btn"  class="btn btn-default" value="REPLAY">										
										<a href="index.php?page=6" class="btn btn-default">CLOSE</a>
                                    </div>
                                </div>
                            </div>	
							<?php
							include "class.phpmailer.php";
							if(isset($_REQUEST['btn']))
							{
								if(isset($_POST['msg'])&& isset($_POST['email_id']))
								{
									$subject=$_POST['subject'];
									$msg=$_POST['msg'];
									$sender=$_POST['sender'];
									$email_id=$_POST['email_id'];															
							
									$mail   = new PHPMailer;
									$mail->IsSMTP();
									$mail->Mailer = 'smtp';
									$mail->SMTPAuth = true;
									$mail->Host = 'smtp.gmail.com';
									$mail->Port = 587;
									$mail->SMTPSecure = 'tls';
									$mail->Username = "ossem.info@gmail.com";
									$mail->Password = "mitul@123";
									$mail->IsHTML(true);
									$mail->AddReplyTo("ossem.info@gmail.com", "OSSEM..");
									$mail->SetFrom("from@yourdomain.com", "OSSEM...");
								   
									$mail->Subject = $subject;
									$mail->AddAddress($email_id, "Mail From OSSEM...");
									$mail->MsgHTML($msg); 
									
									$send = $mail->Send();
									if($send){
										echo '<center><h3 style="color:#009933;">Mail sent successfully...</h3></center>';
									}
									else{
										echo $mail->ErrorInfo;
									}
								}
								else
									echo "Please Fill Subject and Message Content";
							}
							?>						
                        </form>
                    </div>    	
                </div>
		<?php
		}
		}?>
		
		
	