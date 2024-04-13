<?php
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
	$rs=mysql_query("select *from master where enterprise_id='$id'")or die("");
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		if(isset($_SESSION['ossem_msg']))
		{
			echo '<h4>'.$_SESSION['ossem_msg'].'</h4>';
			unset($_SESSION['ossem_msg']);
		}
?>
  	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-pencil"></i>Change Password</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="" method="post">
                        	<div class="mws-form-inline">
                            	<div class="mws-form-row">
                                	<label class="mws-form-label">New Password :</label>
                                	<div class="mws-form-item">
                                    	<input type="password" class="large" name="new_password">
										<input type="hidden" name="user_id" value="<?php echo $row['enterprise_id']; ?>">
                                    </div>
                                </div>
								
									<div class="mws-form-row">
                                	<label class="mws-form-label">Confirm Password :</label>
                                	<div class="mws-form-item">
                                    	<input type="password" class="large" name="confirm_password">
                                    </div>
                                </div>
								
                                <div class="mws-form-row">
                                    <label class="mws-form-label"></label>
                                    <div class="mws-form-item">
                                        <input type="submit" name="reset_password"  class="btn btn-default" value="RESET">										
										<a href="index.php?page=4" class="btn btn-default">CLOSE</a>
                                    </div>
                                </div>
                            </div>	
						 </form>
                    </div>    	
                </div>
		<?php
		}
		}?>
		
		
	