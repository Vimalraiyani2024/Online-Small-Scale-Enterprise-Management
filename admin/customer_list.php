<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4 id="title">Customers</h4>
	<a href="#modal" id="btn-create">Create</a><br/><br />
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
			<th style="text-align:right"><b id="b-title">Sr. No.</b></th>		
			<th><b id="b-title">Name</b></th>
			<th><b id="b-title">Contact Name</b></th>
			<th><b id="b-title">Email Address</b></th>
			<th colspan="3" id="b-title"><b>Mobile No</b></th>
        </tr>
      </thead>
      <tbody>
	<?php
	$i=1;
	 echo "<tr>";	 
	   $rs=mysql_query("select *from customer_master where is_deleted='0' order by customer_id desc")or die(mysql_error());	   	 
	  if(mysql_num_rows($rs)==0)
	  	echo '<tr><td colspan="6"><b style="color:#CC0000">No Customer Detail Found...</b></td></tr>';
	 else
	 {	 		
		while($row=mysql_fetch_array($rs))
		{
			echo '<td width=7% align=right>'.$i++.'</td>';
			echo '<td><a href="sales.php?cid='.$row[0].'&view=cust_view">'.$row['customer_name'].'</a></td>';
			if($row['contact_name']=="")
				echo "<td>--</td>";
			else	
				echo "<td>".$row['contact_name']."</td>";
			echo "<td>".$row['email_id']."</td>";
			echo "<td  width=15%>+91 ".$row['mobile_no']."</td>";
			echo'<td><a href="sales.php?update=customer&cid='.$row[0].'"> <i class="fa fa-edit"></i></a></td>';			
			echo "</tr>";
		}		  
	  }	                 
	  ?>
      </tbody>
    </table>
  </div>
</div>
</form>
<?php 	include_once("model/add_customer.php"); ?>

