<?php 
	$i=1;
	$month = array('January','February','March','April','May','June','July','August','September','Octomber','November','December');
	$total_day = array('31','28','31','30','31','30','31','31','30','31','30','31');
?>
<div id="item_container">
	<form action="" method="post" id="form1">	
		<div id="btn-header">		
			<a href="employee.php" id="close-box">Close</a>
<!--			<a href="#" id="btn-print">Print</a>-->
			<h3>Leave Summary</h3>	
			<br />
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
			<td><input type="submit" id="btn-submit" name="OK" value="Report"/>				
		</tr>		
		</table>
			</div>
		</div>
		<div class="table-responsive">
		<table class="table table-striped table-bordered">
		<tr> 
			<th><label>Sr. No.<th><label>Employee Name<th><label>Total Days<th><label>Leave Days<th><label>Total Leave
		</tr>	
		<?php
		$i=1;$j=0;
		if(isset($_POST['OK']))
		{
			
			$month_name=$_POST['month']; $month_year=$_POST['year'];
			foreach ($month as $mo)
			{
				$j++;
				if($mo==$month_name)
					break;
			}
			
			$total_days=$total_day[$j-1];
			$rs=mysql_query("select * from attendance_master a,employee_master b where a.emp_id=b.emp_id and month_name='$month_name' and month_year='$month_year'")or die(mysql_error());
			if(mysql_num_rows($rs)=="")
				echo "<tr><td colspan='5' id='err-msg'>No Record Found For The <b>".$month_name." - ".$month_year."</b></tr>";
			else
				echo "<h4 align='center' id='err-msg'>Leave Report Of <b>".$month_name." - ".$month_year."</b></h4>";
			while($row=mysql_fetch_array($rs))
			{	
				$x="";$dno=1;$td=0;
				echo "<tr><td>".$row['emp_id']."</td>";
				echo "<td>".$row['emp_name']."</td>";
				$tmp_total=0;
				$data = explode(",",$row['attendance']);
				//echo $data;
				foreach ($data as $dd)
				{
					$dno++;
					if($td>=$total_days)
						break;
					$td++;
					if($dd=='0')
						if($x=="")
							$x="".$dno;
						else
							$x=$x.",".$dno;
					$tmp_total+=$dd;					
				}
				if($x=="")
					echo "<td align='right'>".$total_days."<td align='right'> No Leave <td align='right'>".($total_days-$tmp_total)."<tr>";
				else
					echo "<td align='right'>".$total_days."<td align='right'>".$x."<td align='right'>".($total_days-$tmp_total)."<tr>";
			}			
		}
		?>	
</form>
</div>