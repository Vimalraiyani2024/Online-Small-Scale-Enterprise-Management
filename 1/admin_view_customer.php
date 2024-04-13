<?php
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
	$rs=mysql_query("select *from master where enterprise_id='$id'",$con)or die(mysql_error());
	if(mysql_num_rows($rs)!=0)
	{
		$row=mysql_fetch_array($rs);					
?>
<form action="" method="post" >
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i>Client Details</span>
        </div>
		<div class="mws-panel-body no-padding">
			<table class="mws-datatable-fn mws-table">
				<tbody>
				<?php
				
						echo '<tr style="color:black"><td><b>Name</b></td><td>'.strtoupper($row['enterprise_name']).'</td></tr>';
						echo '<tr><input type="hidden" value='.$row['enterprise_id'].' name="enterprise_id"><td  style="vertical-align:top"><b>Address</b></td><td>'.ucwords($row['address']).'<br>'.ucwords($row['city']).'<br>'.ucwords($row['state']).'</td></tr>';
						echo '<tr><td style="width:30%"><b>CST TIN No.</b></td>';
						if($row['vat_tin_no']!=0)
							echo '<td>'.$row['vat_tin_no'].'</td>';
						else
							echo '<td>-NA-</td>';
						echo '</tr><tr><td><b>CST No.</b></td>';
						if($row['cst_no']!=0)
							echo '<td>'.$row['cst_no'].'</td>';
						else
							echo '<td>-NA-</td>';
						echo '</tr><tr>';
						echo '<td><b>Mobile No : </b></td><td>'.$row['mobile'].'</td></tr>';
						echo '<td><b>Email Address</b></td><td>'.$row['email_id'].'</td></tr>';
						$date1 = date("d-m-Y", strtotime($row['entry_date']));
						$date2 = date("d-m-Y", strtotime("+2 year", strtotime($date1)));
							
						echo '<tr><td><b>Starting Date</b></td><td>'.$date1.'</td></tr>';
						echo '<tr><td><b>Ending Date</b></td><td>'.$date2.'</td></tr>';
						$p="";
						if($row['plan_type']==1)
							$p="Demo User";
						else if($row['plan_type']==2)
							$p="Basic";
						else if($row['plan_type']==3)
							$p="Standard";
						else if($row['plan_type']==4)
							$p="Adavaced";
						echo '<tr><td><b>Plan Type</b></td><td>'.$p.'</td></tr>';
						echo '<tr><td><b>Plan Type</b></td><td><label class="radio-inline" style="font-size:15px">';
						if($row['plan_type']==1)
							echo '<input type="radio"  name="rb_list" value="1" checked=checked required>Demo User</label>';
						else
							echo '<input type="radio"  name="rb_list" value="1" required>Demo User</label>';
						echo '<label class="radio-inline" style="font-size:15px">';
							
						if($row['plan_type']==2)
							echo '<input type="radio" checked="checked" name="rb_list" value="2" required>Basic</label>';
						else
							echo '<input type="radio"  name="rb_list" value="2" required>Basic</label>';						
												
						echo '<label class="radio-inline" style="font-size:15px;">';
						if($row['plan_type']==3)
							echo '<input type="radio" name="rb_list" id="rb_list"  value="3" checked="checked"  required>Standard	</label>';
						else
							echo '<input type="radio" name="rb_list" id="rb_list"  value="3"  required>Standard	</label>';
								
						echo '<label class="radio-inline" style="font-size:15px">';
			  			if($row['plan_type']==4)
							echo '<input type="radio" checked="checked" name="rb_list" id="rb_list" value="4"  required>Advanced</label>';
						else
							echo '<input type="radio"  name="rb_list" id="rb_list" value="4"  required>Advanced</label>	';
						echo '</td></tr>';											
						echo '<tr><td></td><td><input type="submit" value="UPDATE" class="btn btn-default" name="update_plan">&nbsp; &nbsp;<a href="index.php?page=3" class="btn btn-default">CLOSE</a></td></tr>';																	
				?>                                                                                                                                           
				</tbody>
			</table>
         </div>
     </div>       
	 </form>
<?php
} } ?>
