<?php include_once("header.php");?>
<form action="" method="post" role="form">
<h4 id="title">Suppliers</h4>
<a href="#modal" id="btn-create">Create</a><br/><br/>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
		<th style="width:6%; text-align:right"><b id="b-title">Sr. No.</b></th>
          <th><b id="b-title">Name</b></th>
          <th><b id="b-title">Contact Name </b></th>
		  <th><b id="b-title">Email Address</b></th>
          <th><b id="b-title">Mobile No.</b></th>
		  <th style="width:3%"></th>
        </tr>
      </thead>
      <tbody>
		  <?php
	 echo "<tr>";
	 $i=1;
	  $rs=mysql_query("select *from supplier_master where is_deleted='0' order by supplier_id desc")or die(mysql_error());
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo '<td style="text-align:right">'.$i++.'</td>';
	  	echo '<td width=30%><a href="purchase.php?sid='.$row[0].'&list=sup_view">'.ucwords($row['supplier_name']).'</a></td>';
		if($row['contact_name']=="")
			echo "<td width=20%>- - -</td>";
		else
		  	echo "<td width=20%>".ucwords($row['contact_name'])."</td>";
		echo "<td width=20%>".$row['email_id']."</td>";
	  	echo "<td width=15%>+91-".$row['mobile_no']."</td>";
		echo'<td><a href="#id='.$row[0].'&update=supplier" <i class="fa fa-edit"></i></a></td>';								
		//echo'<td align="right"><a href="purchase.php?sid='.$row[0].'&list=sup_del"  class="btn-delete">x</a></td>';				
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>
</div>
</form>
<?php  include_once("model/add_supplier.php"); ?>

