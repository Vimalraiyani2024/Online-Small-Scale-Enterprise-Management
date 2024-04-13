<?php
		if(isset($_SESSION['ossem_msg']))
		{
			echo '<h4 style="color:red">'.$_SESSION['ossem_msg'].'</h4>';
			unset($_SESSION['ossem_msg']);
		}
	?>
	 <div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i> Suggestions or Complaints</span>
        </div>
		<div class="mws-panel-body no-padding">
			<table class="mws-datatable-fn mws-table">
				<thead>
					<tr style="text-align:left">
						<th>Sender Name</th>
						<th>Email</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Received On</th>
						<th style="width:5%">Replay</th>
						<th>
					</tr>
				</thead>
				<tbody>
				<?php
					$rs=mysql_query("select *from suggestion",$con)or die(mysql_error());
					if(mysql_num_rows($rs)==0)
						echo '<tr><td colspan="7"><h4>No Message ...</h4></td></tr>';
					while($row=mysql_fetch_array($rs))
						echo '<tr><td>'.ucwords($row['sender_name']).'</td><td>'.$row['email'].'</td><td>'.$row['subject'].'</td><td>'.$row['message1'].'</td><td>'.date("d-m-Y H:s:i",strtotime($row['entry_date'])).'</td><td><a href="index.php?page=replay&id='.$row['sug_id'].'">Replay</a></td><td><a href="index.php?op=suggestion&id='.$row['sug_id'].'">x</a></td></tr>';								
				?>                                                                                                                                           
				</tbody>
			</table>
         </div>
     </div>      