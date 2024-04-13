<?php

		if(isset($_SESSION['success_msg']))
		{
			echo '<h4>'.$_SESSION['success_msg'].'</h4>';
			unset($_SESSION['success_msg']);
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
                                	<label class="mws-form-label">Old Password :</label>
                                	<div class="mws-form-item">
                                    	<input type="password" class="large" name="old_pass">										
                                    </div>
                                </div>
								
                            	<div class="mws-form-row">
                                	<label class="mws-form-label">New Password :</label>
                                	<div class="mws-form-item">
                                    	<input type="password" class="large" name="new_pass">										
                                    </div>
                                </div>
								
									<div class="mws-form-row">
                                	<label class="mws-form-label">Confirm Password :</label>
                                	<div class="mws-form-item">
                                    	<input type="password" class="large" name="confirm_pass">
                                    </div>
                                </div>
								
                                <div class="mws-form-row">
                                    <label class="mws-form-label"></label>
                                    <div class="mws-form-item">
                                        <input type="submit" name="update_password"  class="btn btn-default" value="CHANGE">										
										<a href="index.php?page=1" class="btn btn-default">CLOSE</a>
                                    </div>
                                </div>
                            </div>	
						 </form>
                    </div>    	
                </div>