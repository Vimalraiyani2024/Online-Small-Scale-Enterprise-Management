<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span><i class="icon-table"></i>Client List</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th>ENTERPRISE NAME</th>
					<th>MOBILE</th>
					<th>EMAIL ID</th>
					<th>FROM</th>
					<th>VALID TO</th>
					<th style="width:13%"></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$rs=mysql_query("select *from master where is_verified=1 and user_type<>10",$con)or die(mysql_error());
				if(mysql_num_rows($rs)==0)
					echo '<tr><td colspan="6"><h4>No Data Found..</h4></td></tr>';
				while($row=mysql_fetch_array($rs))
				{
					echo '<tr style="color:black"><td>'.strtoupper($row['enterprise_name']).'</td>';					
					echo '<td>'.$row['mobile'].'</td><td>'.$row['email_id'].'</td><td>'.date("d-m-Y",strtotime($row['entry_date'])).'</td>';
					
					$date1 = date("d-m-Y", strtotime($row['entry_date']));
					$date2 = date("d-m-Y", strtotime("+2 year", strtotime($date1)));
						
					echo '<td>'.$date2.'</td>';
					echo '<td><a href="index.php?op=reset&id='.$row[0].'">Reset Password</a></td></tr>';
				}								
			?>                                                                                                                                           
			</tbody>
		</table>
	 </div>
 </div>       
