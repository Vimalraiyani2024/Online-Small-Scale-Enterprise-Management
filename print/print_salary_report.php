<?php 
	$i=1;
	$month = array('January','February','March','April','May','June','July','August','September','Octomber','November','December');
	$total_day = array('31','28','31','30','31','30','31','31','30','31','30','31');
?>
</tbody>
</table>
</div>
	<div id="item_container">	
		<h3>Salary Report</h3>	
		<div class="table-responsive">
		<table class="table table-striped table-bordered">
		<tr> 
			<th><label>Sr. No.<th><label>Employee Name<th><label>Total Days<th><label>Total Leave<th><label>Total Salary<th><label> Print
		</tr>	
		<?php
		$i=1;$j=0;
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
				echo "<tr><td colspan='6' id='err-msg'>No Record Found For The <b>".$month_name." - ".$month_year."</b></tr>";
			else
				echo "<h4 align='center' id='err-msg'>Employee Wise Salary Report Of <b>".$month_name." - ".$month_year."</b></h4>";
			while($row=mysql_fetch_array($rs))
			{	
				$x="";$dno=1;$td=0;$salary=0;
				echo "<tr><td>".$row['emp_id']."</td>";
				echo "<td>".$row['emp_name']."</td>";
				$tmp_total=0;
				$data = explode(",",$row['attendance']);
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
				$salary=$row['basic_salary']*$tmp_total/$total_days;
				echo "<td align='right'>".$total_days."<td align='right'>".($total_days-$tmp_total)."<td align='right'>".number_format(ceil($salary),2)."<td><a href='#' class='fa fa-print'>Print</a><tr>";
			}			
		}
		?>	
</div>