<?php 
	include_once("header.php"); 
	$i=1;
	$month = array('January','February','March','April','May','June','July','August','September','Octomber','November','December');
?>
<form enctype='multipart/form-data' name="form" method='post'>
<div id="item_container">
	<h4 id="title">Upload Attendance </h4>
	<div id="btn-header">
		<a href="employee.php?" id="close-box">Close</a>
		<h4>Upload new csv by browsing to file and clicking on Upload</h4>		
	</div>
	<div class="table-responsive">
		<table class="table table">
			<tr>
			<td>
			<?php 
				echo '<select name="month" class="form-control" required>';
				echo '<option value="">Select Month</option>';
				foreach ($month as $m)
				{
					echo '<option value='.$m.'>'.$m.'</option>';
				}
				echo "</select>";
			?>
			</td>
			<td><?php	
				$y=date("Y");
				$year = array($y-1,$y,$y+1);
				echo '<select name="year" class="form-control" required>';
				echo '<option value="">Select Year</option>';
				foreach ($year as $y1)
				{
					echo '<option value='.$y1.'>'.$y1.'</option>';
					$i++;
				}
				echo "</select>";?>
			</td>
			<td>
			<?php
		    	print "<form enctype='multipart/form-data' action='upload.php' method='post'>";
			?></td>
			<td><input size='50' type='file' class="form-control" name='filename' required></td>
			<?php
			if($_SESSION['ossem_user_type']==1)
				echo '<td><input type="submit" disabled="disabled" id="btn-submit" name="submit" value="Upload"></td>';
			else
				echo '<td><input type="submit" id="btn-submit" name="submit" value="Upload"></td>';
			?>
		</tr>		
		</table>
		<?php
			if(isset($_SESSION['errmsg']))
			{
				echo "<h5 id='err-msg'>".$_SESSION['errmsg']."</h5>";
				unset($_SESSION['errmsg']);
			}
		?>
		<h4 id="title">Attendance List</h4>
		<div class="table-responsive">
		<table class="table table">
		<tr>
			  <td><b id="b-title">Sr. No.</b></td>
			  <td><b id="b-title">Month</b></td>
			  <td><b id="b-title">Year</b></td>
		</tr>
		<tr>
		<?php
			$i=1;
			$r=mysql_query("select distinct month_name,month_year from attendance_master order by month_year") or die(mysql_error());
			while($row=mysql_fetch_array($r))
			{
				echo '<td>'.$i++.'</td>';
				echo '<td>'.$row['month_name'].'</td>';
				echo '<td>'.$row['month_year'].'</td></tr>';
			}
		?>
		</table>
		</div>
		  <a href="#">Download Attedance Sheet Format</a><br /><label>Note :</label>This attendace sheet has specific format. If format not match it will not work properly. Here 0 reprent as absence and 1 represent as present. Demo User can not download this file.
	</form>
	<?php 
	if(isset($_POST['submit'])) 
	{
		if(isset($_FILES['filename']['tmp_name']))
		{
			$year=$_POST['year'];
			$month=$_POST['month'];
			if(is_uploaded_file($_FILES['filename']['tmp_name'])) 
			{
			//	echo "<h5 id='err-msg'>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h5>";
			}
			$i=1;$j=1;
			$handle = fopen($_FILES['filename']['tmp_name'], "r");
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
				if($i!=1)
				{
					$emp_id = $data[0];
					$j=1;$t="";
					foreach ($data as $dd)
					{
						if($j!=1)
						{
							$t += $dd;
							$att =$att.",". $dd;
						}
						$j++;
					}			
					$rs=mysql_query("select *from attendance_master where emp_id='$emp_id' and month_name='$month' and month_year='$year'")or die(mysql_error());					
					if(mysql_num_rows($rs)==0)	
					{
						$import="INSERT into attendance_master(emp_id,month_name,month_year,attendance) values('$emp_id','$month','$year','$att')";
						mysql_query($import) or die(mysql_error());
					}
				}
				$att=0;
				$i++;
			}
			echo '<meta http-equiv="refresh" content="0;url=employee.php?eid=3">';	
			$_SESSION['errmsg']="Your CSV File Uploaded Successfully...";
			fclose($handle); 	 			
		}
		else
			echo '<script>alert("File Upload Please...");</script>';
	}
?>
</div>