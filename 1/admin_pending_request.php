<div class="mws-panel grid_8">
	<?php
		if(isset($_SESSION['ossem_msg']))
		{
			echo '<h4 style="color:red">'.$_SESSION['ossem_msg'].'</h4>';
			unset($_SESSION['ossem_msg']);
		}
	?>
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> Pending Request For New Account</span>
    </div>	
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th>Sr No</th>
					<th>Enterprise Name</th>
					<th>Address</th>
					<th>VAT TIN No</th>
					<th>CST No</th>
					<th>Mobile</th>
					<th>Email</th>
					<th style="width:4%"></th>
					<th style="width:4%"></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i=1;
				$rs=mysql_query("select *from master where is_verified=0",$con)or die(mysql_error());
				if(mysql_num_rows($rs)==0)
					echo '<tr><td colspan="9"><h4>No Pending Request...</h4></td></tr>';
				while($row=mysql_fetch_array($rs))
				{
					echo '<tr  style="vertical-align:top"><td>'.$i++.'</td><td>'.strtoupper($row['enterprise_name']).'</td>';
					echo '<td>'.ucwords($row['address']).'<br>'.ucwords($row['city']).'-'.strtoupper($row['state']).'</td>';
					if($row['vat_tin_no']==0)
						echo '<td>'.$row['vat_tin_no'].'</td>';
					else
						echo '<td>-NA-</td>';
					if($row['cst_no']==0)
						echo '<td>'.$row['cst_no'].'</td>';
					else
						echo '<td>-NA-</td>';
					echo '<td>'.$row['mobile'].'</td><td>'.$row['email_id'].'</td><td><a href="index.php?approve=1&id='.$row['enterprise_id'].'" class="btn btn-default">Approve</a></td>';
					echo '<td><a href="index.php?op=delete&id='.$row['enterprise_id'].'" class="btn btn-default">Delete</a></td></tr>';								
				}
			?>                                                                                                                                           
			</tbody>
		</table>
	 </div>
</div>       