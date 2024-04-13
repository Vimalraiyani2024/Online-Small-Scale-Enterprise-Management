	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i>Client List</span>
        </div>
		<div class="mws-panel-body no-padding">
			<table class="mws-datatable-fn mws-table">
				<thead>
					<tr style="text-align:right">
						<th>ENTERPRISE NAME</th>
						<th>VAT TIN NO.</th>
						<th>CST NO.</th>
						<th>MOBILE</th>
						<th>EMAIL ID</th>
						<th colspan="2">ENTRY ON</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$rs=mysql_query("select *from master where is_verified=1 and user_type<>10",$con)or die(mysql_error());
					while($row=mysql_fetch_array($rs))
					{
						echo '<tr style="color:black"><td>'.strtoupper($row['enterprise_name']).'</td>';
						if($row['vat_tin_no']!=0)
							echo '<td>'.$row['vat_tin_no'].'</td>';
						else
							echo '<td>-NA-</td>';
						if($row['cst_no']!=0)
							echo '<td>'.$row['cst_no'].'</td>';
						else
							echo '<td>-NA-</td>';
						echo '<td>'.$row['mobile'].'</td><td>'.$row['email_id'].'</td><td>'.date("d-m-y H:i:s",strtotime($row['entry_date'])).'</td><td><a href="index.php?page=view_customer&id='.$row[0].'">View</a></td></tr>';
					}								
				?>                                                                                                                                           
				</tbody>
			</table>
         </div>
     </div>       
