<?php 
if(isset($_REQUEST['empid']))
{
	$tmpid=$_REQUEST['empid'];
	$rs1=mysql_query("select * from employee_master where emp_id='$tmpid'")or die(mysql_error());
	$row=mysql_fetch_array($rs1);				
	if(mysql_num_rows($rs1)>0)
	{
}
?>
<form action="" method="post" enctype="multipart/form-data" id="form1">	
<div id="update_panel">	
			<div id="btn-header">
				<a href="employee.php?eid=2" id="close-box">Close</a>
			</div>			
							
				<div class="table-responsive">
				<table class="table table">      
				<tbody>
				  <tr>
				  	<tr>
						<td rowspan="5" width="30%">
						<?php 
							if($row['emp_img']=="")
								echo'<img src="../emp_img/emp_m.png" id="img" class="img-thumbnail"/></a>';
							else
								echo'<img src="../emp_img/'.$row['emp_img'].'" id="img" class="img-thumbnail"/></a>'; 
						?>
						</td>
					<td colspan="3"><label>Employee ID  :</label></td><td><?php echo str_pad($row['emp_id'],8,"0",STR_PAD_LEFT);?></td><td><label>Joining Date </label></td><td><?php echo date("d-m-Y",strtotime($row['doj']));?></td>
				  </tr>	
				  <tr>
				  </tr>
				  <tr>
					  <td><label>Employee Name</label></td>
					  <td colspan="9"><?php echo ucwords($row['emp_name']);?></td> 
				 </tr>
					<tr>
						<td><label>Phone </label></td><td colspan="3"> <?php echo $row['phone'];?></td><td><label>Mobile </label></td><td> <?php echo $row['mob'];?></td>
					</tr>
					<tr>
						<td><label>Email Id</label></td><td colspan="3"><?php echo $row['email']; ?></td><td><label>Birth Date </label></td>
						<td colspan="3"><?php echo date("d-m-Y",strtotime($row['dob']));?></td>
					</tr>
					 <tr>	
						<td><label>Permenent Address</label></td>
					  <td colspan="9"><?php echo  $row['address'];?></td>
			     </tr>
				  <tr>
				  <td><label>Current Address</label></td>
				  <td colspan="9"><?php echo $row['address1']; ?></td>
					</tr>
					<tr>
						<td><label>Sex</label></td><td colspan="3"><?php if($row['sex']=='m') echo 'Male'; else echo 'Female';?></td>
						<td><label>Marital Status</label></td><td colspan="4"><?php echo $row['marital_status'];?></td>
					</tr>
					<tr>
						<td><label>Department</label></td>
						<td colspan="3"><?php 
							$dept_id = $row['dept_id'];
							$rs=mysql_query("select dept_name from department_master where dept_id =' $dept_id'") or die(mysql_error());
							$t=mysql_fetch_array($rs); 
							echo $t[0];
						?></td>
						<td><label>Job Title</label></td><td colspan="3"><?php echo ucwords($row['job_title']); ?></td>
					<tr><td><label>Basic Salary</label></td><td colspan="3"><?php echo number_format($row['basic_salary'],2)?></td><td><label>Reference By</label></td><td><?php echo $row['reference_by']; ?></td>
					</tr>
				</tbody>
      		</table>
			</div>
			
			</div>
		</div>
	</form>
	<?php } ?>